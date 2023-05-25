<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\PortofolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PortofolioController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::toast(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles === 'admin') {
            $datas = Portofolio::all();
            return view('dashboard.portofolio.index', compact('datas'));
        } else {
            $datas = Portofolio::where('user_id', Auth::user()->id)->get();
            return view('dashboard.portofolio.index', compact('datas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->description === null) {
            Alert::error('Silahkan lengkapi data diri');
            return redirect()->route('userProfile');
        } else {
            return view('dashboard.portofolio.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'url' => 'required|url',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/portofolio', $imageName);
            $data['photo'] = $imageName;

            $portofolio = new Portofolio([
                "name" => $request->name,
                "user_id" => Auth::user()->id,
                "url" => $request->url,
                "tgl1" => $request->tgl1,
                "tgl2" => $request->tgl2,
                "tgl3" => $request->tgl3,
                "tgl4" => $request->tgl4,
                "jdwl" => $request->jdwl,
                "jdwl2" => $request->jdwl2,
                "jdwl3" => $request->jdwl3,
                "jdwl4" => $request->jdwl4,
                "photo" => $imageName,
            ]);
            $portofolio->save();
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/portofolioImages', $imageName);
                $image = new PortofolioImage([
                    'portofolio_id' => $portofolio->id,
                    'images' => $imageName,
                ]);
                $image->save();
            }
        }

        return redirect()->route('portofolio.index')->with('success', 'Berhasil menambahkan portofolio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portofolios = Portofolio::find($id);
        // dd($portofolios);
        return view('dashboard.portofolio.edit', compact('portofolios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);

        // $imageName = '';
        $portofolio = Portofolio::findOrFail($id);

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/portofolio', $imageName);
            $data['photo'] = $imageName;
            if ($portofolio->photo) {
                Storage::delete('public/portofolio/' . $portofolio->photo);
            }
        } else {
            $imageName = $portofolio->photo;
        }
        $portofolio->update($data);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/portofolioImages', $imageName);
                $portofolio = new PortofolioImage([
                    'portofolio_id' => $id,
                    'images' => $imageName
                ]);
                $portofolio->save();
            }
        }

        return redirect()->route('portofolio.index')->with('berhasil update portofolio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteImage($id)
    {
        $image = PortofolioImage::where('id', $id)->first();
        $cek = Portofolio::where('id', $image->portofolio_id)->first();
        // dd($cek);

        if ($image->images) {
            Storage::delete('public/portofolioImages/' . $image->images);
        }
        $image->delete();
        return redirect()->route('portofolio.edit', $cek->id);
    }
}
