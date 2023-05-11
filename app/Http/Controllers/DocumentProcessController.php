<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DocumentProcessController extends Controller
{
  public function ajaxRequestPostDocument(Request $request)
  {

    $currentId = $request->input('txtID');
    $gstNumber = $request->input('gstNumber');
    $msmeNumber = $request->input('msmeNumber');
    $itrNumber = $request->input('itrNumber');
    $adharCardNumber = $request->input('adharCardNumber');
    $panCardNumber = $request->input('panCardNumber');
    $utilityCardNumber = $request->input('utilityCardNumber');

    $request->validate([
      'adharCardNumber'=>"required",
      'panCardNumber'=>"required"
    ]);

    // $dataDocuments=array();
    // if(isset($gstNumber) && !empty($gstNumber))
    // {
    // array_push($dataDocuments,"gstNumber");
    // }
    // if(isset($msmeNumber) && !empty($msmeNumber))
    // {
    // array_push($dataDocuments,"msmeNumber");
    // }
    // if(isset($itrNumber) && !empty($itrNumber))
    // {
    // array_push($dataDocuments,"itrNumber");
    // }
    // if(isset($adharCardNumber) && !empty($adharCardNumber))
    // {
    // array_push($dataDocuments,"adharCardNumber");
    // }
    // if(isset($panCardNumber) && !empty($panCardNumber))
    // {
    // array_push($dataDocuments,"panCardNumber");
    // }
    // if(isset($utilityCardNumber) && !empty($utilityCardNumber))
    // {
    // array_push($dataDocuments,"utilityCardNumber");
    // }
    //dd($dataDocuments);
    if (isset($currentId) && $currentId != "") {
      $query = DB::table('documents')->insert([
        [
          'gstcard' => $gstNumber,
          'msmecard' => $msmeNumber,
          'itrcard' => $itrNumber,
          'aadharcard' => $adharCardNumber,
          'pancard' => $panCardNumber,
          'utilitycard' => $utilityCardNumber,
          'userid' => $currentId,
          "created_at" => \Carbon\Carbon::now(),
          # new \Datetime()
          "updated_at" => \Carbon\Carbon::now(),
          # new \Datetime()
        ],
      ]);

      if (isset($query) && $query == "true") {

        $stateUpdate = DB::table('users')->where('id', $currentId)->update(['state' => 3]);
        if (isset($stateUpdate)) {
          return redirect()->route('documentProcess')->with(['currentId' => $currentId, "data" => "success"]);
        }
      } else {
        return redirect()->back()->withInput();
      }

    }
  }

  public function documentOutput(Request $request)
  {
    // dd("jljlkj");
    return redirect()->route('home')->with(['tab' => "myaccount"]);
  }
}