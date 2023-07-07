<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProcessController extends Controller
{
    public function index()
    {
        return view('components.order-process');
    }

    public function jspart(Request $request)
    {
        // $allfiles = $request->file('files');
      
        // $data = new imageupload();
        // $num = 0;
        // foreach ($allfiles as $image) {
        //     $files = time() . "." . $image->getClientOriginalExtension();
        //     $image->move(public_path('uploads'), $files);
        //     if ($num == 0) {
        //         $data->upload = $files;
        //         $num++;
        //     } elseif ($num == 1) {
        //         $data->file1 = $files;

        //     } else {
        //         $data->file2 = $files;
        //     }
        // }


        // $data->amount = $request->amount;
        // $data->cheque = $request->cheque;
        // $data->save();


        // return redirect()->back();



    }
}