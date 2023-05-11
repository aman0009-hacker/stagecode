<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OTPHandleController extends Controller
{
  public function store(Request $request)
  {
    $contact_number = $request->input('contact_number');
    $userOtp = $request->input('userOtp');
    $id = $request->input('id');
    $otp_generation_time = Carbon::now();

    if ($userOtp == "1234") {
      if (isset($contact_number) && !empty($contact_number) && isset($userOtp) && !empty($userOtp)) {
        $query = DB::table('users')->where('id', $id)->update(['contact_number' => $contact_number, 'otp' => $userOtp, 'otp_generated_at' => $otp_generation_time, 'state' => 2]);
        if (isset($query) && $query != "" && (int) $query > 0) {
          return redirect()->route('userDocument')->with(['currentId' => $id, 'contact_number' => $contact_number, "data" => "success"]);
        }
      }
    } else {
      return redirect()->route('signUpSubmit')->with(['currentId' => $id, 'contact_number' => $contact_number, "data" => "notsuccess"]);
    }
  }
}