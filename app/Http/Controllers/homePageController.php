<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
// use Illuminate\Http\Request;

class homePageController extends Controller
{
    public function home()
    {
        $productsdata=Entity::paginate(4);

        return view('home',compact('productsdata'));
    }
}
