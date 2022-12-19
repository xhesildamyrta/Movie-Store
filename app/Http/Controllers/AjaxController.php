<?php

namespace App\Http\Controllers;

use App\Models\VideoCategories;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function movies(){

        $products = VideoCategories::with('video')->where('category_id', request('catId'))->get();
        $name = request('name');
        return view('category-partial',compact('products', 'name'));
    }
}
