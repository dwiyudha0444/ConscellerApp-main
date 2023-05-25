<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::toast(session('success'));
            }

            if (session('error')) {
                Alert::toast(session('error'));
            }

            return $next($request);
        });
    }
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // $data = request()->except(['_token']);
        // dd($request->all());

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->roles === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang ' . Auth::user()->name);
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email atau password salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerClient(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'same:password',
            'phone' => 'required'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'client',
            'phone' => $request->phone
        ]);

        $user->save();
        return redirect()->route('login')->with('success', 'Register berhasil, silahkan login!');
    }

    public function registerFreelance(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'same:password',
            'phone' => 'required'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'freelance',
            'phone' => $request->phone
        ]);

        $user->save();
        return redirect()->route('login')->with('success', 'Register berhasil, silahkan login!');
    }
}
