<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{
    public function fileUploadPost(Request $request)
    {
        //dd($request->input('documents'));

        //dd(Auth::user()->id);

        $currentId = $request->input('txtIds');
        $gst=$msme=$itr=$aadhar=$pan=$utility=0;
        $gstValue=$msmeValue=$itrValue=$aadharValue=$panValue=$utilityValue=0;
        $queryDocument=DB::table('documents')->where('userid',$currentId)->get();
        //$documents="Kindly upload the document ";
       
        foreach($queryDocument as $data)
        {
            if(isset($data->gstcard) && $data->gstcard!="")
            {
                $gst=1;
            }
            if(isset($data->msmecard) && $data->msmecard!="")
            {
                $msme=1;
            }
            if(isset($data->itrcard) && $data->itrcard!="")
            {
                $itr=1;
            }
            if(isset($data->aadharcard) && $data->aadharcard!="")
            {
                $aadhar=1;
            }
            if(isset($data->pancard) && $data->pancard!="")
            {
                $pan=1;
            }
            if(isset($data->utilitycard) && $data->utilitycard!="")
            {
                $utility=1;
            }
        }

       
        if($gst==1)
        {
         
            $gstValue= 'required|mimes:jpeg,png,jpg,zip,pdf|max:50';
        }
        else 
        {
            $gstValue= 'mimes:jpeg,png,jpg,zip,pdf|max:50';   
        }
        if($msme==1)
        {
            $msmeValue=  'required|mimes:jpeg,png,jpg,zip,pdf|max:50';
        }
        else 
        {
            $msmeValue=  'mimes:jpeg,png,jpg,zip,pdf|max:50';  
        }
        if($itr==1)
        {
            $itrValue= 'required|mimes:jpeg,png,jpg,zip,pdf|max:50';   
        }
        else 
        {
            $itrValue='mimes:jpeg,png,jpg,zip,pdf|max:50';  
        }
        $aadharValue='required|mimes:jpeg,png,jpg,zip,pdf|max:50';
        $panValue='required|mimes:jpeg,png,jpg,zip,pdf|max:50';

        if( $utility==1)
        {
            $utilityValue=  'required|mimes:jpeg,png,jpg,zip,pdf|max:50';
        }
        else 
        {
            $utilityValue= 'mimes:jpeg,png,jpg,zip,pdf|max:50';
        }
      



  
          $request->validate([
            'gstFile' => $gstValue,
            'msmeFile' =>  $msmeValue,
            'itrFile' =>  $itrValue,
            'aadharFile' => $aadharValue,
            'panFile' => $panValue,
            'utilityFile' => $utilityValue,
        ]);


        //dd($currentId);
        // $request->validate([
        //     'gstFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        //     'msmeFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        //     'itrFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        //     'aadharFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        //     'panFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        //     'utilityFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:50',
        // ]);
        //dd("jkljkl");
        $fileName = "";
        $fileNameMsme = "";
        $fileNameItr = "";
        $fileNameAadhar = "";
        $fileNamePan = "";
        $fileNameUtility = "";
        if ($request->hasFile('gstFile')) {
            $fileName = time() . '.' . $request->gstFile->getClientOriginalName();
            //dd($fileName);
            $request->gstFile->move(public_path('uploads'), $fileName);
        }
        //dd($fileName);
        if ($request->hasFile('msmeFile')) {
            $fileNameMsme = time() . '.' . $request->msmeFile->getClientOriginalName();
            $request->msmeFile->move(public_path('uploads'), $fileNameMsme);
        }
        //dd($fileNameMsme);
        if ($request->hasFile('itrFile')) {
            $fileNameItr = time() . '.' . $request->itrFile->getClientOriginalName();
            $request->itrFile->move(public_path('uploads'), $fileNameItr);
            //dd($fileNameItr);
        }
        if ($request->hasFile('aadharFile')) {
            $fileNameAadhar = time() . '.' . $request->aadharFile->getClientOriginalName();
            $request->aadharFile->move(public_path('uploads'), $fileNameAadhar);
            //dd($fileNameAadhar);
        }

        if ($request->hasFile('panFile')) {
            $fileNamePan = time() . '.' . $request->panFile->getClientOriginalName();
            $request->panFile->move(public_path('uploads'), $fileNamePan);
            //dd($fileNamePan);
        }
        if ($request->hasFile('utilityFile')) {
            $fileNameUtility = time() . '.' . $request->utilityFile->getClientOriginalName();
            $request->utilityFile->move(public_path('uploads'), $fileNameUtility);
            //dd($fileNameUtility);
        }
        //dd("success");
        $query = DB::table('documents')->where('userid', $currentId)->update([
            'gstcardpath' => $fileName,
            'msmecardpath' => $fileNameMsme,
            'itrcardpath' => $fileNameItr,
            'aadharcardpath' => $fileNameAadhar,
            'pancardpath' => $fileNamePan,
            'utilitycardpath' => $fileNameUtility,

            // "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
            "updated_at" => \Carbon\Carbon::now(), # new \Datetime()



        ]);

        if (isset($query)) {
            $stateUpdate = DB::table('users')->where('id', $currentId)->update(['state' => 4]);
            if (isset($stateUpdate)) {
                return redirect()->route('updatedDocument')->with(['currentId' => $currentId, "data" => "success"]);
            }
        }
        else 
        {
            return redirect()->back()->withInput();
        }

    }


}