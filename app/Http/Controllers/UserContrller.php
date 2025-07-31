<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserContrller extends Controller
{
 
    function login(){
        return view('LginPage');
    }
    function Registar(){
        return view('RegistarPage');

    }

    public function store(Request $request)
    {
 try {
 
        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already registered!'
            ], 409); 
        }

      
        $getForm = new User;
        $getForm->name = $request->name;
        $getForm->email = $request->email;
        $getForm->password = $request->password; 
        $getForm->role = $request->user_type;
        $getForm->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful! go in login'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Registration failed!',
            'error' => $e->getMessage()
        ], 500);
    }
}
function loginChek(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('AdminPanal')->with('success', 'Welcome Admin');
        } elseif ($user->role == 'seller') {
            return redirect()->route('SellerPanal')->with('success', 'Welcome Seller');
        } elseif ($user->role == 'buyer') {
            return redirect()->route('Click_Kard.view')->with('success', 'Welcome Buyer');
        } elseif ($user->role == 'admin') {
            return redirect()->route('AdminPanal')->with('success', 'Welcome Seller');
        }
        else {
            Auth::logout();
            return redirect()->back()->with('error', 'Invalid role!');
        }
    } else {
        return redirect()->back()->with('error', 'Invalid email or password!');
    }
}
function logout()
{
   Auth::logout(); 
    return redirect('/login');
    
}

}



