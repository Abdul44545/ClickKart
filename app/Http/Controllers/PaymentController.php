<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use App\Models\Ordercompelete;
use App\Models\Card;
class PaymentController extends Controller
{
    //
   
   function paymentPage(Request $request)
{
   
    \Stripe\Stripe::setApiKey('sk_test_51RoRc2LEgwEgUnAE7KzwnQAxI6oG4ywjwrLWhCuQg4y6E2rPOLaymXmrCsizJxzVAjMQhsfihAtpL4JUd7z83TCC00NtM6PjXU');
  
        $charge =Charge::create([
                'amount' => $request->amount * 100, 
                'currency' => 'usd',
                'source' => $request->stripToken,
                'description' => 'Student Fee ',
            ]);

                if ($charge->status === 'succeeded') {
              $getCardData = Card::where('user_id', $request->usrt_id)->get();
    
                foreach ($getCardData as $card) {
                    $card->delete();
                }
               Ordercompelete::where('booking_key', $request->group_id)->update(['payment_prosses' => 'paid']);
                      
                 return redirect()->route('OderPage')->with('success','Your payment is completed');

           }else{
                           return redirect()->back()->with('error','Your payment is not  completed ! error');

           }
}
}


