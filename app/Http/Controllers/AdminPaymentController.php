<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Card;
use App\Models\shipping;
use App\Models\User;
use App\Models\Ordercompelete;
use App\Models\shippermessag;
use Illuminate\Support\Facades\Auth;
use App\Models\Normalpayment;
use App\Models\paymentrequest;
use App\Models\Payment;
class AdminPaymentController extends Controller
{
    //
    function AdminPaymentPage(){
        $getData=Normalpayment::all();
        $total=0;
        foreach($getData as $data){
            $total += $data->amount;
        }
       $Onrequested=paymentrequest::with(['paymentinfo','user'])->where('status' , 'pending')->get();
       $AprovePayment=paymentrequest::with(['paymentinfo','user'])->where('status' , 'aprove')->get();
        $P_total=0;
        foreach($AprovePayment as $p_data){
            $P_total += $p_data->amount;
        }
        return view('AdminPaymentPage',[
            'Requests'=>$Onrequested,
            'tatalIncom'=>$total,
            'P_total'=>$P_total
        ]);
    }
    function AdminPaymentView($id){
       $Onrequested=paymentrequest::with(['paymentinfo','user'])->find($id);
      
        return view('ViewPaymentAprovelDetails',[
            'request' => $Onrequested, 
        ]);
    }
// In your controller (e.g., AdminPaymentController.php)
public function adminpaymentsapprove($id)
{
    $paymentRequest = paymentrequest::findOrFail($id);
    
    $paymentRequest->status="aprove";
    $paymentRequest->save();

    return response()->json([
        'success' => true,
        'message' => 'Payment request #'.$id.' has been approved successfully.'
    ]);
}

public function adminpaymentsreject(Request $request, $id)
{   
    $paymentRequest = paymentrequest::findOrFail($id);
    $paymentRequest->reason=$request->reason;
    $paymentRequest->status="reject";
    $paymentRequest->save();
    $base=new Normalpayment;
    $base->user_id=$paymentRequest->user_id;
    $base->amount=$paymentRequest->WithdrawelAmount;
    $base->action="deposite";
    $base->seller_id=$paymentRequest->user_id;
    $base->aprovel="reject";
    $base->save();
    return response()->json([
        'success' => true,
        'message' => 'Payment request #'.$id.' has been rejected.'
    ]);
}
}
