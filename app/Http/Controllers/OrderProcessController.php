<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class OrderProcessController extends Controller
{
    public function index(Request $request)
    {
        $txtOrderGlobalModalID=$request->input('txtOrderGlobalModalID');
        Session::forget('txtOrderGlobalModalID');
        Session::put('txtOrderGlobalModalID', $txtOrderGlobalModalID ?? '');
        if(isset($txtOrderGlobalModalID) && !empty($txtOrderGlobalModalID))
        {
            return view('components.order-process',compact('txtOrderGlobalModalID'));
            //dd($txtOrderGlobalModalID=$request->input('txtOrderGlobalModalID'));
        }
    }

    public function jspart(Request $request)
    {
        $allfiles = $request->file('files');
        $modalIdInput = $request->input('modalId');
            // Find the Order model based on $modalIdInput
        $order = Order::findOrFail($modalIdInput);
        $num = 0;
        foreach ($allfiles as $image) {
            //$files = time() . "." . $image->getClientOriginalExtension();   
            $files =time().rand(11,99) . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $files);
            if ($num == 0) {
                $order->upload = $files;
                $num++;
            } else if ($num == 1) {
                $order->file1 = $files;
                $num++;
            } else {
                $order->file2 = $files;
            }
        }
        $order->check_amount = $request->amount;
        $order->cheque_number = $request->cheque;
        $order->save();
        return redirect()->back();
    }
}