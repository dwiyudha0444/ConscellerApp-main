<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jobs;
use App\Models\Portofolio;
use App\Models\PortofolioImage;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $datas = User::where('roles', 'freelance')->get();
        $categories = Category::all();
        // dd($datas);
        return view('frontend.home', compact('datas', 'categories'));
    }

    public function detailFreelance($id)
    {
        $data = Portofolio::where('user_id', $id)->first();

        $images = PortofolioImage::where('portofolio_id', $data->id)->get();
        $rekomens = Portofolio::where('user_id', $id)->inRandomOrder()->get();
        $categories = Category::all();

        return view('frontend.details-freelance', compact('data', 'images', 'rekomens', 'categories'));
    }

    public function detailPortofolio($id)
    {
        $data = Portofolio::where('id', $id)->first();
        $images = PortofolioImage::where('portofolio_id', $data->id)->get();
        $rekomens = Portofolio::where('user_id', $data->user_id)->inRandomOrder()->get();
        $categories = Category::all();
        return view('frontend.details-freelance', compact('data', 'images', 'rekomens', 'categories'));
    }

    public function filterFreelance(Request $request)
    {
        $categories = Category::all();
        $keyword = $request->search;
        $datas = User::where('name', 'like', "%" . $keyword . "%")
            ->where('roles', 'freelance')->get();
        return view('frontend.home', compact('datas', 'categories'));
    }
}
