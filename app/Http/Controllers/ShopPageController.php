<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\User;
use App\Models\Ordercompelete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    //
 function Shop() {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $userId = Auth::id();
    $CarInfo = Card::where('user_id', $userId)->with('product')->get(); 

    $totalPrice = 0;
    foreach ($CarInfo as $card) {
        if ($card->product) {
            $totalPrice += $card->product->Price;
        }
    }

   $product = Product::paginate(10);

    return view('ShopPage', [
        'Products' => $product,
        'card' => $CarInfo,
        'totalPrice' => $totalPrice,
    ]);
}
   public function addToCart(Request $request)
{
    $product = Product::find($request->product_id);

    if (!Auth::check()) {
        return response()->json(['message' => 'Please Login'], 404);
    }

    $userId = Auth::id();

    $productchek = Card::where('user_id', $userId)
        ->where('product_id', $request->product_id)
        ->exists();

    if ($productchek) {
        return response()->json(['message' => 'This product already selected'], 409);
    }

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Save to Cart
    $base = new Card;
    $base->user_id = $userId;
    $base->product_id = $request->product_id;
    $base->quantity = "1";
    $base->save();


    $CarInfo = Card::where('user_id', $userId)->with('product')->get();
      $CarInfoCount=$CarInfo->count();
  $totalPrice = 0;
foreach ($CarInfo as $card) {
    $totalPrice += $card->product->Price; // یا جو بھی field ہو
}

return response()->json([
    'message' => 'Product added to cart successfully',
    'cart_count' => $CarInfoCount,
    'total_price' => $totalPrice
]);
}
public function search(Request $request)
{
    $search = $request->input('search'); // یہ وہی 'search' ہونا چاہیے جو form کے input name میں دیا ہے

    $products = Product::when($search, function($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })
        ->paginate(10);

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $userId = Auth::id();
    $CarInfo = Card::where('user_id', $userId)->with('product')->get(); 

    $totalPrice = 0;
    foreach ($CarInfo as $card) {
        if ($card->product) {
            $totalPrice += $card->product->Price;
        }
    }

    return view('ShopPage', [
        'Products' => $products,
        'card' => $CarInfo,
        'totalPrice' => $totalPrice,
    ]);
}
function SellectCardPage() {
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Please login and add products');
    }

    $userId = Auth::id();
    $card = Card::with('product')->where('user_id', $userId)->get();

    return view('SellectCardPage', ['card' => $card]);
}
  

  public function updateQuantity(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:cards,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $card = Card::where('id', $request->item_id)
                ->where('user_id', Auth::id())
                ->first();

    if (!$card) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    $card->quantity = $request->quantity;
    $card->save();

    $total = Card::where('user_id', Auth::id())
        ->join('products', 'products.id', '=', 'cards.product_id')
        ->selectRaw('SUM(products.Price * cards.quantity) as total')
        ->value('total') ?? 0;
     
    return response()->json([
        'message' => 'Quantity updated',
        'cart_count' => Card::where('user_id', Auth::id())->count(),
        'total_price' => number_format($total, 2),
    ]);
}

public function removeFromCart(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:cards,id',
    ]);

    $card = Card::where('id', $request->item_id)
                ->where('user_id', Auth::id())
                ->first();

    if (!$card) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }

    $card->delete();

    $total = Card::where('user_id', Auth::id())
        ->join('products', 'products.id', '=', 'cards.product_id')
        ->selectRaw('SUM(products.Price * cards.quantity) as total')
        ->value('total') ?? 0;

    return response()->json([
        'message' => 'Item removed',
        'cart_count' => Card::where('user_id', Auth::id())->count(),
        'total_price' => number_format($total, 2),
    ]);
}

 function verify(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'Please login first.']);
    }

    $userId = Auth::id();
    $cartItems = Card::where('user_id', $userId)->count();

    if ($cartItems == 0) {
        return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
    }

    return response()->json(['success' => true]);
}
// public function show()
// {
//     if (!Auth::check()) {
//         return redirect()->route('login')->with('error', 'Please login first.');
//     }
//     $total = Card::where('user_id', Auth::id())
//         ->join('products', 'products.id', '=', 'cards.product_id')
//         ->selectRaw('SUM(products.Price * cards.quantity) as total')
//         ->value('total') ?? 0;
     
//     $userId = Auth::id();
//     $cartItems = Card::with('product')->where('user_id', $userId)->get();

//     return view('CheckoutPage', compact('cartItems','total'));
// }









public function show()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login to proceed to checkout.');
    }

    $userId = Auth::id();
    $cartItems = Card::with('product')
        ->where('user_id', $userId)
        ->get();

    // Calculate total more reliably
    $total = $cartItems->sum(function($item) {
        return ($item->product->Price ?? 0) * ($item->quantity ?? 1);
    });

    return view('CheckoutPage', compact('cartItems', 'total'));
}

public function placeOrder(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
        'total_price' => 'required|numeric|min:0',
    ]);

    try {
        DB::beginTransaction();

        // Get cart items
        $cartItems = Card::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'grand_total' => $request->total_price,
            'item_count' => $cartItems->count(),
            'payment_method' => 'cash_on_delivery',
            'shipping_fullname' => $request->first_name . ' ' . $request->last_name,
            'shipping_email' => $request->email,
            'shipping_phone' => $request->phone,
            'shipping_address' => $request->address,
            'shipping_city' => $request->city,
            'shipping_postalcode' => $request->postal_code,
            'notes' => $request->notes,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->Price,
            ]);
        }

        // Clear the cart
        Card::where('user_id', Auth::id())->delete();

        DB::commit();

        return redirect()->route('order.success', ['order' => $order->order_number])
            ->with('success', 'Order placed successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error processing your order: ' . $e->getMessage());
    }
}

public function Orderplace(Request $request, $id)
{
    $userId = Auth::id();
    $cartItems = Card::with('product')->where('user_id', $userId)->get();
    $user = User::find($userId);

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty!');
    }
    $totalPrice = Card::where('user_id', Auth::id())
        ->join('products', 'products.id', '=', 'cards.product_id')
        ->selectRaw('SUM(products.Price * cards.quantity) as total')
        ->value('total') ?? 0;
    // $totalPrice = 0;
    // foreach($cartItems as $cal){
    //     $totalPrice += $cal->product->Price;
    // }
    $getKey = uniqid(); 
    try {
         $shipping=new shipping;
         $shipping->name=$request->first_name;
         $shipping->user_id=$userId;
         $shipping->email=$request->email;
         $shipping->Address=$request->address;
         $shipping->phone_number=$request->phone;
         $shipping->City=$request->city;
         $shipping->postalCode=$request->postal_code;
         $shipping->Notes=$request->notes;
         $shipping->booking_key=$getKey;

         $shipping->save();
    } catch (\Throwable $th) {
               return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
    }
    try {
        foreach ($cartItems as $item) {
            $order = new Ordercompelete;
            $order->user_id = $userId;
            $order->product_id = $item->product_id;
            $order->quantity = $item->quantity; 
            $order->booking_key = $getKey;      
            $order->payment_prosses = 'pending'; 
            $order->status = 'pending';             
            $order->seller_id =$item->product->Submiter_id;             
            $order->save();
        }

        return view('PaymentPage', [
            'total_amount' => $totalPrice,
            'student' => $user,
            'group_id' => $getKey,
        ]);
        
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
    }

}

}

