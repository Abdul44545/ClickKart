<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
class SellerController extends Controller
{
    //
   function SellerPanal(){
            $sellerID = Auth::id();

            $gettotalOrders = Ordercompelete::where('seller_id', $sellerID)->count();

            $TotalRevenue = Ordercompelete::with('product')
                ->where('seller_id', $sellerID)
                ->where('payment_prosses', 'paid')
                ->get();

            $Revenue = 0;

            foreach ($TotalRevenue as $order) {
                if ($order->product) {
                    $Revenue += $order->product->Price * $order->quantity;
                }
            }
            $totalcustamers = Ordercompelete::where('seller_id', $sellerID)
            ->distinct('user_id')
            ->count('user_id');
            $gettotalProducts = Product::where('Submiter_id', $sellerID)->count();
        $userId=Auth::id();
        $graphOrders = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->get();
         

          
    return view('SellerDashboard', [
    'gettotalOrders' => $gettotalOrders,
    'Revenue' => $Revenue,
    'totalcustamers' => $totalcustamers,
    'gettotalProducts' => $gettotalProducts,
    'graphOrders'=>$graphOrders
]);     
}






}
