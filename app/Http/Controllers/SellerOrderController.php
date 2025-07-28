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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Mail\MyMails;


class SellerOrderController extends Controller
{
 
    function SellerOrders(){
        if(!Auth::check()){
            return back()->with('error','please login');
        }
        $userId=Auth::id();
        $getOrders = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->paginate(7);
        $graphOrders = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->get();
            $totalAmount = 0;
        $orignalpayment = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->where('payment_prosses','paid')->get();
        $orderCompeleted = Ordercompelete::where('seller_id', $userId)->where('status','compelete')->get();
        $orderUnCompeleted = Ordercompelete::where('seller_id', $userId)->where('payment_prosses','pending')->get();
        $orderpaied = Ordercompelete::where('seller_id', $userId)->where('payment_prosses','paid')->get();

            foreach ($orignalpayment as $order) {
                if ($order->product) {
                    $totalAmount += $order->product->Price * $order->quantity ;
                }
            }

        return view('SellerOrderpanal',[
            'products'=>$getOrders,
            'graphOrders'=>$graphOrders,
            'totalAmount'=>$totalAmount,
            'orderCompeleted'=>$orderCompeleted,
            'orderUnCompeleted'=>$orderUnCompeleted,
            'orderpaied'=>$orderpaied
        ]);
    }
        function SellerComeleteOrders(){
        if(!Auth::check()){
            return back()->with('error','please login');
        }
        $userId=Auth::id();
        $getOrders = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->where('status','compelete')->paginate(7);
        $totalOrder = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->paginate(7);
        $graphOrders = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->where('payment_prosses','paid')->get();
         $totalAmount = 0;
        $orignalpayment = Ordercompelete::with(['user', 'product','shipping'])->where('seller_id', $userId)->where('payment_prosses','paid')->get();
        $orderCompeleted = Ordercompelete::where('seller_id', $userId)->where('status','compelete')->get();
        $orderUnCompeleted = Ordercompelete::where('seller_id', $userId)->where('payment_prosses','pending')->get();
        $orderpaied = Ordercompelete::where('seller_id', $userId)->where('payment_prosses','paid')->get();

            foreach ($orignalpayment as $order) {
                if ($order->product) {
                    $totalAmount += $order->product->Price * $order->quantity ;
                }
            }

        return view('SellerOrderpanal',[
            'products'=>$getOrders,
            'graphOrders'=>$graphOrders,
            'totalAmount'=>$totalAmount,
            'orderCompeleted'=>$orderCompeleted,
            'orderUnCompeleted'=>$orderUnCompeleted,
            'totalOrder'=>$totalOrder,
            'orderpaied'=>$orderpaied
        ]);
    }

   public function markAsShipped(Request $request)
{
    $order = Ordercompelete::find($request->id);
    $order->status = 'compelete';
    $order->save();
    $Notifications=new Notification;
    $Notifications->user_id=$order->user_id;
    $Notifications->message="Your Order is Compeleted Please retune a confarmation";
    $Notifications->status="true";
    $Notifications->save();
    return response()->json(['message' => 'Successfully Compeleted Order']);
    
}
 public function Viewproductbtn($id)
{   
   

    $getOrder = Ordercompelete::with(['user', 'product', 'shipping'])
        ->find($id);

    return view('OrderDetails', ['order' => $getOrder]);
}
  function asseing_shiper($id){
        $getOrders = Ordercompelete::with(['user', 'product','shipping'])->find($id);
     
        return view('ShipperAssign',['information'=>$getOrders]);
  }

public function submitTracking(Request $request)
{
    try {
        $shipping = Ordercompelete::find($request->order_id);
        $getUser=$shipping->user_id;
        $getProduct=$shipping->product_id;
        $getUserInfo=User::find($getUser);
        $getProduct=Product::find($getProduct);
         $getUserEmail=$getUserInfo->email;
      $message = "Your product name \"" . $getProduct->name . "\" was ordered on " . $shipping->created_at->format('d M Y, h:i A') . ". The tracking ID is: " . $request->tracking_id . ".";
          if (!$shipping) {
            return response()->json([
                'success' => false,
                'message' => '❌ Shipping record not found'
            ]);
        }

        $shipping->TrackingID = $request->tracking_id;
        $shipping->save();

        try {
            Mail::to($getUserEmail)->send(new MyMails($message));
            return response()->json([
                'success' => true,
                'message' => '✅ Tracking ID saved and mail sent successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());

            return response()->json([
                'success' => true, 
                'message' => '⚠️ Tracking ID saved, but failed to send mail.',
                'mail_error' => $e->getMessage()
            ]);
        }

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => '❌ An error occurred while saving tracking ID.',
            'error' => $e->getMessage()
        ], 500);
    }
}

      function putAction($id){
      $getOrders = Ordercompelete::with(['user', 'product','shipping'])->find($id);
     
        return view('putactionOrder',['information'=>$getOrders]);
      }
      function updateOrderStatus(Request $request){
 try {
       

        $shipping = Ordercompelete::find($request->order_id);

        if (!$shipping) {
            return response()->json([
                'success' => false,
              'message' => '❌  record not found '

            ]);
        }

        $shipping->TrackingID = $request->tracking_id;
        $shipping->save();

        return response()->json([
            'success' => true,
            'message' => '✅ Tracking ID saved successfully.'
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '❌ An error occurred while saving tracking ID.',
                'error' => $e->getMessage()
            ], 500);
        }
}
public function updateStatus(Request $request)
{
    try {
        $order = Ordercompelete::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        $getUser = $order->user_id;
        $getProductId = $order->product_id;

        $getUserInfo = User::find($getUser);
        $getProduct = Product::find($getProductId);

        if (!$getUserInfo || !$getProduct) {
            return response()->json([
                'success' => false,
                'message' => 'User or Product not found.'
            ], 404);
        }

        $getUserEmail = $getUserInfo->email;
        $message = "Your product name \"" . $getProduct->name . "\" was ordered on " . $order->created_at->format('d M Y, h:i A') . ". This order is : " . $request->status . ".";

        try {
            Mail::to($getUserEmail)->send(new MyMails($message));

            return response()->json([
                'success' => true,
                'message' => '✅ Status updated and mail sent successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());

            return response()->json([
                'success' => true,
                'message' => '⚠️ Status updated, but failed to send mail.',
                'mail_error' => $e->getMessage()
            ]);
        }

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update order. Error: ' . $e->getMessage()
        ], 500);
    }
}
     
  public function getChartData(Request $request)
{
    $userId = auth()->id();
    $filter = $request->input('filter', 'weekly');

    $query = \App\Models\Ordercompelete::with('product')
        ->where('seller_id', $userId)
        ->whereHas('product');

    // Filter logic
    if ($filter == 'weekly') {
        $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    } elseif ($filter == 'monthly') {
        $query->whereMonth('created_at', now()->month);
    } elseif ($filter == 'yearly') {
        $query->whereYear('created_at', now()->year);
    }

    $graphOrders = $query->get();

    $dataPoints = [];
    $index = 1;
    foreach ($graphOrders as $order) {
        if ($order->product) {
            $dataPoints[] = [
                "x" => $index++,
                "y" => (float)$order->product->Price * $order->quantity
            ];
        }
    }

    return response()->json(['dataPoints' => $dataPoints]);
}


}

