<?php

namespace App\Http\Controllers;

use App\Models\PaymentDataHandling;
use Illuminate\Http\Request;

class FirstPageController extends Controller
{
    public function home()
    {
        $id=\Auth::user()->id;
   
   $payment_data = PaymentDataHandling::where('user_id', $id)
    ->where('payment_status', 'SUCCESS')
    ->where('data', 'Registration_Amount')
    ->first();
   
  
    
    return view('home',compact('payment_data'));
    }
}
