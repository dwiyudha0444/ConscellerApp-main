<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Jobs;
use App\Models\Portofolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles === 'admin') {
            $users = User::all()->count();
            $jobs = Jobs::where('status', 'aktif')->count();
            $category = Category::all()->count();
            // dd($users);

            return view('dashboard.dashboard', compact(['users', 'jobs', 'category']));
        }
        if (Auth::user()->roles === 'client' || Auth::user()->roles === 'freelance') {
            $jobs = Jobs::where('user_id', Auth::user()->id)->count();
            $portofolio = Portofolio::where('user_id', Auth::user()->id)->count();
            $experience = Experience::where('user_id', Auth::user()->id)->count();
            return view('dashboard.dashboard', compact(['jobs', 'portofolio', 'experience']));
        }
    }
}
