<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
use App\Models\PaymentDataHandling;
use App\Models\User;
// use Illuminate\Http\Request;

class homePageController extends Controller
{
    public function home()
    {
        $productsdata=Entity::paginate(4);

        return view('home',compact('productsdata'));
    }

    public function pagination($page)
    {



        $products = Entity::paginate(4, ['*'], 'page', $page);
            return response()->json($products);
}

public function loginornot()
{
    if(\Auth::check())
    {
       $userid= \Auth::user()->id;
       $approved=User::where('id',$userid)->first();
    //    dd($approved);
       $userdata=PaymentDataHandling::where('user_id',$userid)->get();
       if($approved->approved=="0")
       {
          return response()->json('notapproved');
       }


       if(count($userdata)>0)
       {

          return response()->json('paymentdone');
       }
       else

       {
         return response()->json('paymentnotdone');
       }
    }

    else

    {
          return response()->json('notauthenticated');
    }
}
}
