<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    //Code for download PDF start
    public function index()
    {
     $pdf=PDF::loadView('components.invoice', [
        'title' => 'ghjhg hkjgg hkj',
     ]);
     return $pdf->download('sample.pdf');
    }


    //code for download PDF end
}
