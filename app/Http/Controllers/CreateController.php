<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Video;
use App\Models\VideoCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $user = Auth::user();

        if (auth()->check()) {
            if ($user->hasRole('admin')) {
                return view('create', compact('categories'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function add(Request $request)
    {
        $video = new Video();

        $imageName = $request->file('image')->getClientOriginalName();

        $request->image->move(public_path('img'), $imageName);

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


        foreach($request->category as $category){
            $videoCat = new VideoCategories();
            $videoCat->category_id = $category;
            $videoCat->video_id = $video->id;
            $videoCat->save();

        }

        return redirect()->route('create')->with('success_message', 'Item added successfully!');
    }


}
