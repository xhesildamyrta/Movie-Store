<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoCategories;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductsController extends Controller
{
    public function index(){

        $products = Video::orderBy('title')->paginate(6);

        return view('all-products', compact('products'));
    }

    public function product($product) {
        $video = Video::where('title', $product)->get();
        $categories = VideoCategories::with('category')->where('video_id', $video[0]->id)->get();

        return view('product', compact('video', 'categories'));
    }

    public function home() {
        $products = Video::all()->take(-3);

        return view('welcome', compact('products'));
    }
}
