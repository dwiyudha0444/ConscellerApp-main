<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::alert(session('success'));
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
            $datas = Jobs::all();
            // dd($datas->category->name);
            return view('dashboard.jobs.index', compact('datas'));
        } else {
            $datas = Jobs::where('user_id', Auth::user()->id)->get();
            // dd($datas->category->name);
            return view('dashboard.jobs.index', compact('datas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.jobs.create', compact('categories'));
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
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if (Auth::user()->roles == "admin") {
            $data['status'] = "aktif";
        }

        $imageName = time() . '.' . $request->photo->extension();
        // $request->image->move(public_path('images'), $imageName);
        $request->photo->storeAs('public/jobs', $imageName);

        $data['photo'] = $imageName;
        $post = Jobs::create($data);
        // dd($request->categories);
        return redirect()->route('jobs.index')->with('success', 'Tunggu admin approve postingan kamu');
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
        $data = Jobs::find($id);
        $categories = Category::all();
        // dd($data);
        return view('dashboard.jobs.edit', compact('data', 'categories'));
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
        // $data = request()->except(['_method', '_token']);

        // $imageName = '';
        $user = Jobs::findOrFail($id);

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/jobs', $imageName);
            $data['photo'] = $imageName;
            if ($user->photo) {
                Storage::delete('public/jobs/' . $user->photo);
            }
        } else {
            $imageName = $user->photo;
        }
        $user->update($data);
        return redirect()->route('jobs.index')->with('success', 'Berhasil update postingan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $jobs = Jobs::where('id', $request->id)->first();
        // dd($user);

        if ($jobs->photo) {
            Storage::delete('public/jobs/' . $jobs->photo);
        }
        $jobs->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    public function updateStatus(Request $request)
    {
        $data = Jobs::find($request->id);
        // dd($data);
        $data->update([
            'status' => 'aktif'
        ]);
        return response()->json([
            'status' => 200
        ]);
    }
}
