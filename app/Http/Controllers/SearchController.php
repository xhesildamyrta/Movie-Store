<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required'
        ]);
        $query = $request->input('query');
        $products = Video::where('title', 'like', "%$query%")->
                           orWhere('description', 'like', "%$query%")->paginate(6);

        return view('search')->with(['products' => $products,
            'query' => $query]);
    }
}
