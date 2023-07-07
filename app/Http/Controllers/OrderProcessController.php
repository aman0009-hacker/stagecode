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
}
