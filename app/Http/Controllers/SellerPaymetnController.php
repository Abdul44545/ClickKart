<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class SellerPaymetnController extends Controller
{
     function SellerPaymentPage(){
      if(!Auth::check()){
         return back()->with('error','Please Login');
      }
       $userId=Auth::id();
       $methods=Payment::where('user_id',$userId)->get();
  return view('SellerPaymentPage', ['Methods' => $methods]);

     }
     function paymentDelete($id){
       $delete=Payment::destroy($id); 
       if($delete){
         return response()->json([
            'success' => true,
            'message' => 'Payment method deleted successfully!'
        ]);
       }else{
         return response()->json([
            'success' => false,
            'message' => 'Something went wrong while delete payment method.',
            'error' => $e->getMessage()
        ], 500);
       }
            
     }
 public function store(Request $request)
{
    try {
        Payment::create([
            'user_id' => auth()->id(),
            'method' => $request->method,
            'AccountTitle' => $request->account_title,
            'AccountNumber' => $request->account_number,
            'status' => 'Active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment method added successfully!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong while adding payment method.',
            'error' => $e->getMessage()
        ], 500);
    }
}

   
      function updatePaymentMethodbtn($id){
      $getPaymentMethod = Payment::find($id);
        return view('updatepaymentPage',['information'=>$getPaymentMethod]);
      }

public function pageupdate(Request $request, $id)
{
    $payment = Payment::findOrFail($id);
    $payment->method = $request->method;
    $payment->AccountTitle = $request->account_title;
    $payment->AccountNumber = $request->account_number;
    $payment->save();

    return response()->json(['message' => 'Payment method updated successfully']);
}

}