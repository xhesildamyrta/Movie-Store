<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModifyController extends Controller
{
    public function index($id)
    {
        $product = Video::where('id', $id)->first();

        $user = Auth::user();

        if (auth()->check()) {
            if ($user->hasRole('admin')) {
                return view('modify', compact('product'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request, $id)
    {
        $video = Video::where('id', $id)->first();

        $video->title = $request->title;
        $video->description = $request->description;
        $video->rating = $request->rating;
        $video->videoURL = $request->video;
        $video->runtime = $request->runtime;
        $video->yearOfRelease = $request->year;
        $video->photoURL = $request->photoURL;
        $video->rentalPrice = $request->rental;
        $video->trailerURL = $request->trailerURL;
        $video->save();


        return redirect()->route('modify', [ 'id'=> $id ])->with('success_message', 'Item updated successfully!');
    }

}
