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
class SellerMessageController extends Controller
{
    //
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
    
    // Mark the message as read
    if($message->status === 'unread') {
        $message->update(['status' => 'read']);
    }

    return view('SellViewMessager', compact('message'));
}
}
