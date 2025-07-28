<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
  use App\Models\Card;
        use App\Models\shipping;
        use App\Models\User;
        use App\Models\Ordercompelete;
        use App\Models\shippermessag;
class CustomerController extends Controller
{
 public function SellerCustomer()
{
    if (!Auth::check()) {
        return back()->with('error', 'Please login');
    }

    $sellerId = Auth::id();

    // تمام آرڈرز حاصل کریں
    $orders = Ordercompelete::with(['user', 'shipping'])
        ->where('seller_id', $sellerId)
        ->get();

    // یوزرز کو گروپ کر کے آرڈر گنیں
    $grouped = $orders->groupBy('user_id')->map(function ($group) {
        $order = $group->first();
        return [
            'name' => $order->user->name ?? 'N/A',
            'email' => $order->user->email ?? 'N/A',
            'city' => $order->shipping->City ?? 'N/A',
            'phone' => $order->shipping->phone_number ?? 'N/A',
            'orders_count' => $group->count(),
            'user_id' => $order->user_id,
        ];
    })->values();

    // پھر manually pagination کریں
    $perPage = 10;
    $page = request()->get('page', 1);
    $paginatedCustomers = new \Illuminate\Pagination\LengthAwarePaginator(
        $grouped->forPage($page, $perPage),
        $grouped->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    return view('SellerCustomerPage', ['customers' => $paginatedCustomers]);
}



public function searchCustomers(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $sellerId = Auth::id();
    $search = $request->input('query');

    $orders = Ordercompelete::with(['user', 'shipping'])
        ->where('seller_id', $sellerId)
        ->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        })
        ->get();

 $customers = $orders->groupBy('user_id')->map(function ($group) {
    $firstOrder = $group->first();
    $order = $group->first();
    return [
        'name' => $firstOrder->user->name ?? 'N/A',
        'email' => $firstOrder->user->email ?? 'N/A',
        'city' => $firstOrder->shipping->City ?? 'N/A',
        'phone' => $firstOrder->shipping->phone_number ?? 'N/A',
        'orders_count' => $group->count(),
        'user_id' => $order->user_id, // ✅ IDs as array

    ];
})->values();


    return response()->json(['customers' => $customers]);
}


   
 function customerOrderview($id){
        $getOrders = Ordercompelete::with(['user', 'product','shipping'])->where('user_id',$id)->get();
     
        return view('customerOrderView',['information'=>$getOrders]);
  }
}

