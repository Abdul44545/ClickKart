<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\Notification;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    function AdminOrderPanal(){
   $sellerID = Auth::id();

            $gettotalOrders = Ordercompelete::where('payment_prosses', 'paid')->count();
        $getOrders = Ordercompelete::with(['user', 'product','shipping'])->paginate(7);

            $TotalRevenue = Ordercompelete::with('product')
                ->where('payment_prosses', 'paid')
                ->get();

            $Revenue = 0;

            foreach ($TotalRevenue as $order) {
                if ($order->product) {
                    $Revenue += $order->product->Price * $order->quantity;
                }
            }
            $totalcustamers = Ordercompelete::
            distinct('user_id')
            ->count('user_id');
            $gettotalProducts = Product::count();
        $userId=Auth::id();
        $graphOrders = Ordercompelete::with(['user', 'product','shipping'])->get();
         

          
    return view('AdminOrderPage', [
    'products'=>$getOrders,
    'gettotalOrders' => $gettotalOrders,
    'Revenue' => $Revenue,
    'totalcustamers' => $totalcustamers,
    'gettotalProducts' => $gettotalProducts,
    'graphOrders'=>$graphOrders
]);     
}
}
