<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterResponse extends FortifyRegisterResponse
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        $currentEmail=($request->input('email'));
        $currentId="";
        $currentConatct="";
        if(isset($currentEmail) && $currentEmail!="")
        {
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $data = User::find(Auth::user()->id);
        $currentId=$data->id;$currentConatct=$data->contact_number;

        }
<<<<<<< HEAD

=======
       
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        if(isset($currentId) && !empty($currentId))
        {
        return redirect()->route('signUpSubmit')->with( ['data' => "success" , 'currentId'=> $currentId, 'contact_number'=>$currentConatct] );
        }         else {
            return redirect()->route('signUp')->with( ['data' => "notsuccess" , 'currentId'=> $currentId] );
        }
    }
}