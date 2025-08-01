<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Normalpayment;
use App\Models\paymentrequest;

class SellerPaymetnController extends Controller
{
   function SellerPaymentPage(){
    if(!Auth::check()){
        return back()->with('error','Please Login');
    }
    $userId = Auth::id();

    $Onrequested=paymentrequest::with('paymentinfo')->where('user_id' ,$userId)->get();

    $getData = Normalpayment::where('seller_id', $userId)
                  ->where('action', 'deposite')
                            ->get();

    $n_data = Normalpayment::where('seller_id', $userId)
                   ->where('action', 'withdrawal')
                           ->get();

    $d_total = 0;
    $N_total = 0;

    foreach($getData as $Data){
        $d_total += $Data->amount;
    }

    foreach($n_data as $Data){
        $N_total += $Data->amount;
    }

    $Ftotal = $d_total - $N_total;

    $methods = Payment::where('user_id', $userId)->get();

    return view('SellerPaymentPage', [
        'Methods' => $methods,
        'totalPayment' => $Ftotal,
        'Onrequested'=>$Onrequested
    ]);
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
public function tWidthraRequestStore(Request $request)
{
    $request->validate([
        'method_id'   => 'required|integer',
        'amount'      => 'required|numeric|min:1',
        'description' => 'nullable|string|max:255',
    ]);

    $userId = Auth::id();

     $d_total = Normalpayment::where('seller_id', $userId)
                        ->where('action', 'deposite')
                        ->sum('amount');

$N_total = Normalpayment::where('seller_id', $userId)
                         ->where('action', 'withdrawal')
                         ->sum('amount');

$Ftotal = $d_total - $N_total;

if ($Ftotal < $request->amount){
        return response()->json([
            'success' => false,
            'message' => 'Not enough balance for this withdrawal.',
        ], 400); 
    }

    $base = new paymentrequest();
    $base->user_id     = $userId;
    $base->submiter_follow_id = $request->method_id;
    $base->WithdrawelAmount = $request->amount;
    $base->description = $request->Description ?? null;
    $base->status      = 'pending';
    $base->save();
     $Update=new Normalpayment;
     $Update->user_id=Auth::id();
     $Update->amount=$request->amount;
     $Update->action="withdrawal";
     $Update->seller_id=Auth::id();
     $Update->save();
  $d_total = Normalpayment::where('seller_id', $userId)
                        ->where('action', 'deposite')
                        ->sum('amount');

$N_total = Normalpayment::where('seller_id', $userId)
                         ->where('action', 'withdrawal')
                         ->sum('amount');

$Ftotal = $d_total - $N_total;
$Onrequested=paymentrequest::with('paymentinfo')->where('user_id' ,$userId)->get();
    
    return response()->json([
        'success' => true,
        'message' => 'Withdrawal request submitted successfully!',
        'data'    => $Ftotal,
        'Onrequested'=>$Onrequested,
    ]);
}

}