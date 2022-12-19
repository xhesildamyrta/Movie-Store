<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    public function remove(Request $request)
    {
          $id = $request->id;
          Video::destroy($id);

        return redirect()->route('all-products')->with('success_message', 'Item deleted successfully!');
    }
}
