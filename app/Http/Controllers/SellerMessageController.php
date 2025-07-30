<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\Notification;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
use App\Models\repalce;
class SellerMessageController extends Controller
{
   
    function SellerMessagePanal(){
        if(!Auth::check()){
            return back()->with('error','please login');
        }
        $sellerId=Auth::id();
        $getMessages=shippermessag::with('product')->where('seller_id' , $sellerId)->get();
        return view('SelletrMessagepanal', ['Messages' => $getMessages]);
    }
public function MessageViewSeller($id)
{
    $message = shippermessag::with('product')->findOrFail($id);
    
    
    if($message->status === 'unread') {
        $message->update(['status' => 'read']);
    }

    return view('SellViewMessager', compact('message'));
}
 public function SellerRepalyMessage(Request $request)
{
    $messagerepy_id = $request->messagerepy_id;
    $getData = shippermessag::find($messagerepy_id);
     $getData->status="read";
     $getData->save();
    try {
        $base = new repalce;
        $base->seller_id = Auth::id();
        $base->product_id = $getData->product_id;
        $base->user_id = $getData->user_id;
        $base->smessage_reply_id = $request->messagerepy_id;
        $base->message = $request->reply; 
        $base->status  ="unread";
        $base->save();

        return response()->json([
            'success' => true,
            'message' => 'Your reply has been sent successfully.',
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send reply: ' . $th->getMessage(),
        ], 500);
    }
}
}
