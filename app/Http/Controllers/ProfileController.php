<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Auth;
use App\Models\varification;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    function SellerProflePage(){
        if(!Auth::check()){
            return back()->with('error','Please login');
        }
        $user=Auth::user();
        $getid=Auth::id();
        $getINFO=varification::where('user_id',$getid)->first(); 
        if($getINFO){
        return view('SellerProfilePage',['user'=>$user , 'getinfo'=>$getINFO]);
        }else{

        }
        return view('SellerProfilePage',['user'=>$user]);
    }
public function save_profile_Seller(Request $request)
{
    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found!',
        ]);
    }

   
    $user->name  = $request->name;
    $user->email = $request->email;
    if ($request->hasFile('profile_image')) {
    $user->image_path = $request->file('profile_image')->store('images', 'public');
    }
    $user->save();

    $verification = varification::firstOrNew(['user_id' => $user->id]);

    if ($request->hasFile('profile_image')) {
        $verification->Pimage = $request->file('profile_image')->store('images', 'public');
    }

    if ($request->hasFile('cnic_front')) {
        $verification->C_F_image = $request->file('cnic_front')->store('images', 'public');
    }

    if ($request->hasFile('cnic_back')) {
        $verification->C_B_image = $request->file('cnic_back')->store('images', 'public');
    }

    $verification->phon = $request->phone;
    $verification->adrees = $request->address;

    if ($verification->save()) {
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'verification_data' => [
                'profile_image' => asset('storage/' . $verification->Pimage),
                'cnic_front'    => asset('storage/' . $verification->C_F_image),
                'cnic_back'     => asset('storage/' . $verification->C_B_image),
                'phone'         => $verification->phon,
                'address'       => $verification->adrees,
            ],
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Profile not saved!',
        ]);
    }
}

}