<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Video;

class ProfileController extends Controller
{
    public function show() {
        $user = Auth::user();
        $uid = Auth::id();
        $purchases = Order::with('video')->where('user_id', $uid)->get();
        //For illustration purposes
        if(count($purchases) > 0)
          $purchases[0]->dueDate = '2021-05-23';


        foreach($purchases as $purchase){
            $start_date = Carbon::now();
            $end_date= Carbon::parse($purchase->dueDate);
            $difference = $start_date->diff($end_date)->days;
            if($start_date < $end_date){
                $purchase->expiration = $difference;
            }
            else{
                $purchase->expiration = $difference * (-1);
            }
        }

        return view('user-profile', compact('user', 'purchases'));
    }

    public function update(Request $request) {
        $uid = Auth::id();
        $user = User::find($uid);

        if ($request['new_password'] == null && $request['password_confirmation'] == null) {
            $request->validate([
                'name' =>'required|min:4|string|max:255',
                'email'=>'required|email|string|max:255'
            ]);

            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
        }
        else {
            $request->validate([
                'name' => 'required|min:4|string|max:255',
                'email' => 'required|email|string|max:255',
                'new_password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            ]);
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['new_password']);
            $user->save();
        }
        return back()->with('message','Profile Updated');
    }
}
