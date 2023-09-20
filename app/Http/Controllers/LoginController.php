<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\PaymentDataHandling;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Log;



use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['msg' => 'Credentials do not match'])->withInput($request->input());
        } else {
            Session::put('loginUserId', $user->id);
            Session::put('loginUserEmail', $user->email);
            //return redirect()->route('home')->withInput(Input:all());
            return redirect()->route('home')->withInput(['currentId' => $user->id, "data" => "success"]);

        }
    }

    public function postLogout(Request $request)
    {
        Session::flush();
        Auth::logout();
        response()->redirect('/login');
    }

    public function myaccount(Request $request)
    {
        try {
            if (Auth::check()) {
                $checkCurrentUserId = Auth::user()->id;
                if (isset($checkCurrentUserId)) {
                    $approvedStatus = User::where('id', $checkCurrentUserId)->first();
                    if (isset($approvedStatus) && $approvedStatus->approved == 0) {
                        return redirect()->route('home');
                    } else if (isset($approvedStatus) && $approvedStatus->approved == 1) {
                        $userPayment = PaymentDataHandling::whereIn('payment_status', ['RIP', 'SIP', 'SUCCESS'])
                            ->where('data', 'Registration_Amount')
                            ->where('user_id', $checkCurrentUserId)
                            ->first();
                        if ($userPayment && isset($userPayment)) {
                            return redirect()->route('RawMaterial');
                        } else {
                            return redirect()->route('payment.process');
                        }
                    } else if (isset($approvedStatus) && $approvedStatus->approved == 2) {
                        return redirect()->route('chat');
                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }

    }


    public function chartStatus(Request $request)
    {
        try {
            if (Auth::check()) {
                $currentUserId = Auth::user()->id;
                if (isset($currentUserId) && !empty($currentUserId) && $currentUserId > 0) {
                    $data = User::where('approved', 2)->where('id', $currentUserId)->first();
                    if (isset($data)) {
                        return response()->json(['hasRecord' => true]);
                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function sendemail($email,$adminId)
    {
        
        
        try
        {
            $alladmin=AdminUser::where('is_verified','1')->get();

        foreach($alladmin as $singleadmin)
        {
            if($singleadmin->email==$email)
            {
                return response()->json(['data'=>"match"]);	
            }
        }


            $otp=random_int(1000, 9999);
            $details = [
                'email' => 'Email Verification',
              
                'body' => 'Your OTP is '. $otp,
            ];

            \Mail::to($email)->send(new \App\Mail\PSIECMail($details));

            AdminUser::where('id',$adminId)->update(['otp'=>$otp,'email'=>$email]);
            
    
           
    
            return response()->json(["data"=>"success"]);

        }
         catch(\Exception $e)
         {
            return response()->json(["data"=>"fail"]);
         }

    }
    public function verifyotp($otp,$adminId)
    {
        $admindata=AdminUser::where('id',$adminId)->first();

        if($admindata->otp==$otp)
        {
            $admindata->is_verified=1;
            $admindata->save();
           return response()->json(['data'=>'success']);
        }
        else
        {
            return response()->json(['data'=>'fail']);
        }
    }
}