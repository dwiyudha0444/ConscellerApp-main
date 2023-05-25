<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jobs;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class JobsController extends Controller
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
        $categories = Category::all();
        $jobs = Jobs::where('status', 'aktif')->get();
        return view('frontend.jobs', compact('categories', 'jobs'));
    }

    public function detail($id)
    {
        $data = Jobs::find($id);
        $rekomens = Jobs::where('category_id', $data->category_id)->inRandomOrder(4)->get();
        $categories = Category::all();
        return view('frontend.details-jobs', compact('data', 'rekomens', 'categories'));
    }

    public function wishlist()
    {
        $datas = Wishlist::where('user_id', Auth::user()->id)->get();
        $categories = Category::all();
        return view('frontend.wishlist', compact('datas', 'categories'));
    }

    public function addWishlist($id)
    {
        $cek =  Wishlist::where('job_id', $id)->get();
        if ($cek->count() > 0) {
            return redirect()->back()->with('error', 'Job sudah ada di wishlist');
        } else {
            Wishlist::create([
                'user_id' => Auth::user()->id,
                'job_id' => $id
            ]);

            return redirect()->back()->with('success', 'Berhasil menambah ke wishlist');
        }
    }

    public function destroy(Request $request)
    {
        $data = Wishlist::find($request->id);
        $data->delete();
        return response()->json([
            'status' => 200
        ]);
    }

    public function filterKategori($id)
    {
        $jobs = Jobs::where('category_id', $id)->where('status', 'aktif')->get();
        $categories = Category::all();
        return view('frontend.jobs', compact('categories', 'jobs'));
    }

    public function filterJobs(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->search;
        $jobs = Jobs::where('name', 'like', "%" . $keyword . "%")->get();
        return view('frontend.jobs', compact('jobs', 'categories'));
    }
}
