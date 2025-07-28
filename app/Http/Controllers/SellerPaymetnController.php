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
 public function store(Request $request)
{
    try {
        Payment::create([
            'user_id' => auth()->id(),
            'method' => $request->method,
            'AccountTitle' => $request->account_title,
            'AccountNumber' => $request->account_number,
            'BankName' => $request->bank_name,
            'IBANNumber' => $request->iban,
            'BranchCode' => $request->branch_code,
            'MobileNumber' => $request->mobile_number,
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
}
