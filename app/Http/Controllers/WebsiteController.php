<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Product;
use App\Models\shipping;
use App\Models\Notification;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
use App\Models\repalce;
class WebsiteController extends Controller
{
    // 
    function Click_Kard(){

        return view('firstWeb');
    }
function UserNotification() {
    $UserID = Auth::id();
    $getReply = repalce::with('product')->where('user_id', $UserID)->get();
    return view('UserNotificationPage', ['Messages' => $getReply]);
}
public function markAllRead()
{
    repalce::where('user_id', Auth::id())->update(['status' => ' read']);
    return response()->json(['message' => 'All notifications marked as read.']);
}

public function deleteAll()
{
    repalce::where('user_id', Auth::id())->delete();
    return response()->json(['message' => 'All notifications deleted.']);
}
 function UserProflePage(){
    return view('WebProfilePage');
 }
}
