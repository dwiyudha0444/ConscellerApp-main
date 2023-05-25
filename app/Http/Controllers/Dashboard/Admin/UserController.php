<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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
        $datas = User::all();
        return view('dashboard.users.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'same:password',
            'roles' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'description' => 'required|max:255',
            'phone' => 'required|integer'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $imageName = time() . '.' . $request->photo->extension();
        // $request->image->move(public_path('images'), $imageName);
        $request->photo->storeAs('public/users', $imageName);

        $data['photo'] = $imageName;
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Berhasil menambahkan user baru');
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
        $data = User::find($id);
        return view('dashboard.users.edit', compact('data'));
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
        $user = User::findOrFail($id);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/users', $imageName);
            $data['photo'] = $imageName;
            if ($user->photo) {
                Storage::delete('public/users/' . $user->photo);
            }
        } else {
            $imageName = $user->photo;
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Berhasil updata user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        // dd($user);

        if ($user->photo) {
            Storage::delete('public/users/' . $user->photo);
        }
        $user->delete();

        return response()->json([
            'status' => 200
        ]);
    }

    public function getUser()
    {
        $data = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.index', compact('data'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = $request->all();
        // $data = request()->except(['_method', '_token']);

        // $imageName = '';
        $user = User::findOrFail($id);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/users', $imageName);
            $data['photo'] = $imageName;
            if ($user->photo) {
                Storage::delete('public/users/' . $user->photo);
            }
        } else {
            $imageName = $user->photo;
        }
        $user->update($data);
        return redirect()->route('userProfile')->with('success', 'Berhasil update profile');
    }
}
