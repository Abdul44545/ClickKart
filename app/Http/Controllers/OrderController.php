<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
     function OderPage(){
        if(!Auth::check()){
            return back()->with('error','Please Login');
        }
        $UserId=Auth::id();
            $getData = Ordercompelete::with('product')
                ->where('user_id', $UserId)
                ->where('payment_prosses', 'paid')
                ->get(); 
            return  view('OrderPage',['Products'=>$getData]);
     }





public function sendMessage(Request $request, $orderId)
{
 
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Please login.',
        ]);
    }
    $order = Ordercompelete::findOrFail($orderId);

    $base = new shippermessag;
    $base->user_id = $order->user_id;  
    $base->product_id = $order->product_id;
    $base->Order_id = $order->id;
    $base->message = $request->message;
    $base->save(); 

    return response()->json([
        'success' => true,
        'message' => 'Message sent successfully to the shipper.',
    ]);
}

}
