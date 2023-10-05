<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Comments;

class FileUploadController extends Controller
{
    public function fileUploadPost(Request $request)
    {

        try {
            $currentId = $request->input('txtIds');
            $gst = $msme = $itr = $aadhar = $pan = $utility = 0;
            $gstValue = $msmeValue = $itrValue = $aadharValue = $panValue = $utilityValue = 0;
            $queryDocument = Attachment::where('user_id', $currentId)->get();


            foreach ($queryDocument as $data) {
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "gstfile" && isset($data->fileno) && !empty($data->fileno)) {
                    $gst = 1;
                }
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "msmefile" && isset($data->fileno) && !empty($data->fileno)) {
                    $msme = 1;
                }
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "itrfile" && isset($data->fileno) && !empty($data->fileno)) {
                    $itr = 1;
                }
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "aadharfile" && isset($data->fileno) && !empty($data->fileno)) {
                    $aadhar = 1;
                }
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "panfile" && isset($data->fileno) && !empty($data->fileno)) {
                    $pan = 1;
                }
                if (isset($data->file_type) && $data->file_type != "" && $data->file_type == "utilityfile" && isset($data->fileno) && !empty($data->fileno)) {
                    $utility = 1;
                }

            }
            if ($gst == 1) {


                $gstValue = 'required|mimes:pdf|max:5000';
            } else {

                $gstValue = 'mimes:pdf|max:5000';
            }
            if ($msme == 1) {

                $msmeValue = 'required|mimes:pdf|max:5000';
            } else {

                $msmeValue = 'mimes:pdf|max:5000';
            }
            if ($itr == 1) {
                $itrValue = 'required|mimes:pdf|max:5000';

            } else {

                $itrValue = 'mimes:pdf|max:5000';
            }

            $aadharValue = 'required|mimes:pdf|max:5000';

            $panValue = 'required|mimes:pdf|max:5000';
            if ($utility == 1) {

                $utilityValue = 'required|mimes:pdf|max:5000';
            } else {
                $utilityValue = 'mimes:pdf|max:5000';

            }

            if ($request->hasFile('extradoc1')) {
                if ($request->file('extradoc1')) {

                    $documentextra1 = 'required|mimes:pdf|max:5000';
                } else {
                    $documentextra1 = 'mimes:pdf|max:5000';
                }
            } else {
                $documentextra1 = 'mimes:pdf|max:5000';
            }
            if ($request->hasFile('extradoc2')) {
                if ($request->file('extradoc2')) {

                    $documentextra2 = 'required|mimes:pdf|max:5000';
                } else {
                    $documentextra2 = 'mimes:pdf|max:5000';
                }
            } else {
                $documentextra2 = 'mimes:pdf|max:5000';
            }
            if ($request->hasFile('extradoc3')) {
                if ($request->file('extradoc3')) {

                    $documentextra3 = 'required|mimes:pdf|max:5000';
                } else {
                    $documentextra3 = 'mimes:pdf|max:5000';
                }

            } else {
                $documentextra3 = 'mimes:pdf|max:5000';
            }

            //new code added
            $rules = [
                'gstFile' => $gstValue,
                'msmeFile' => $msmeValue,
                'itrFile' => $itrValue,
                'aadharFile' => $aadharValue,
                'panFile' => $panValue,
                'utilityFile' => $utilityValue,
                'extradoc1' => $documentextra1,
                'extradoc2' => $documentextra2,
                'extradoc3' => $documentextra3
            ];
            // Create a Validator instance with the rules

            $validator = Validator::make($request->all(), $rules);


            // Check if validation fails
            if ($validator->fails()) {
                // Redirect back with input data and errors
                return redirect()->route('documentProcess')->withInput()->withErrors($validator);
            }
            //new code added
            $fileName = "";
            $fileNameMsme = "";
            $fileNameItr = "";
            $fileNameAadhar = "";
            $fileNamePan = "";
            $fileNameUtility = "";
            $fileextradoc1 = "";
            $fileextradoc2 = "";
            $fileextradoc3 = "";
            if ($request->hasFile('gstFile')) {
                $fileName = time() . '1.' . $request->gstFile->getClientOriginalName();

                $request->gstFile->move(public_path('uploads'), $fileName);
            }

            if ($request->hasFile('msmeFile')) {
                $fileNameMsme = time() . '2.' . $request->msmeFile->getClientOriginalName();
                $request->msmeFile->move(public_path('uploads'), $fileNameMsme);
            }

            if ($request->hasFile('itrFile')) {
                $fileNameItr = time() . '3.' . $request->itrFile->getClientOriginalName();
                $request->itrFile->move(public_path('uploads'), $fileNameItr);

            }
            if ($request->hasFile('aadharFile')) {
                $fileNameAadhar = time() . '4.' . $request->aadharFile->getClientOriginalName();
                $request->aadharFile->move(public_path('uploads'), $fileNameAadhar);

            }

            if ($request->hasFile('panFile')) {
                $fileNamePan = time() . '5.' . $request->panFile->getClientOriginalName();
                $request->panFile->move(public_path('uploads'), $fileNamePan);

            }
            if ($request->hasFile('utilityFile')) {
                $fileNameUtility = time() . '6.' . $request->utilityFile->getClientOriginalName();
                $request->utilityFile->move(public_path('uploads'), $fileNameUtility);

            }
            if ($request->hasfile('extradoc1')) {
                $fileextradoc1 = time() . '7.' . $request->extradoc1->getClientOriginalName();
                $request->extradoc1->move(public_path('uploads'), $fileextradoc1);
            }
            if ($request->hasfile('extradoc2')) {
                $fileextradoc2 = time() . '8.' . $request->extradoc2->getClientOriginalName();
                $request->extradoc2->move(public_path('uploads'), $fileextradoc2);
            }
            if ($request->hasfile('extradoc3')) {
                $fileextradoc3 = time() . '9.' . $request->extradoc3->getClientOriginalName();
                $request->extradoc3->move(public_path('uploads'), $fileextradoc3);
            }
            $attachments = Attachment::where('user_id', $currentId)->get();
            foreach ($attachments as $attachment) {
                switch ($attachment->file_type) {
                    case 'gstfile':


                        $attachment->filename = $fileName;
                        break;
                    case 'msmefile':
                        $attachment->filename = $fileNameMsme;
                        break;
                    case 'itrfile':
                        $attachment->filename = $fileNameItr;
                        break;
                    case 'aadharfile':
                        $attachment->filename = $fileNameAadhar;
                        break;
                    case 'panfile':
                        $attachment->filename = $fileNamePan;
                        break;
                    case 'utilityfile':
                        $attachment->filename = $fileNameUtility;
                        break;
                    case 'extradoc1':

                        $attachment->filename = $fileextradoc1;
                        break;
                    case 'extradoc2':
                        $attachment->filename = $fileextradoc2;
                        break;
                    case 'extradoc3':
                        $attachment->filename = $fileextradoc3;
                        break;
                    default:
                        // Handle any other cases if needed
                        break;
                }
                $attachment->updated_at = Carbon::now();
                $attachment->save();
            }
            // Check if any rows were affected
            $query = $attachments->count();
            if (isset($query) && $query > 0) {

                $stateUpdate = User::find($currentId);
                $email = User::find($currentId)->email;
                if ($stateUpdate) {
                    $stateUpdate->state = 4;
                    $stateUpdate->save();
                }
                if (isset($stateUpdate)) {
                    $details = [
                        'email' => 'Registration Successful',
                        'body' => 'We are pleased to inform you that your account registration process has initiated. Your Registration is Pending for
                        approval within 7 days. After
                        approval you can pay the
                        Registration fee Rupees 10,000/-',
                    ];
                    \Mail::to($email)->send(new \App\Mail\PSIECMail($details));
                    return redirect()->route('updatedDocument')->with(['currentId' => $currentId, "data" => "success"]);
                }
            } else {
                return redirect()->back()->withInput();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return redirect()->route('documentProcess')->withInput()->withErrors();

        }
    }

    public function fileUploadPostUpdate(Request $request)
    {
        try {
            $request->validate([
                'gstFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'msmeFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'itrFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'aadharFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'panFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'utilityFile' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'OtherFile1' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'OtherFile2' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
                'OtherFile3' => 'mimes:jpeg,png,jpg,zip,pdf|max:4000',
            ]);
            $fileName = "";
            $fileNameMsme = "";
            $fileNameItr = "";
            $fileNameAadhar = "";
            $fileNamePan = "";
            $fileNameUtility = "";
            if ($request->hasFile('gstFile')) {
                $fileName = time() . '.' . $request->gstFile->getClientOriginalName();

                $request->gstFile->move(public_path('uploads'), $fileName);
            }

            if ($request->hasFile('msmeFile')) {
                $fileNameMsme = time() . '.' . $request->msmeFile->getClientOriginalName();
                $request->msmeFile->move(public_path('uploads'), $fileNameMsme);
            }

            if ($request->hasFile('itrFile')) {
                $fileNameItr = time() . '.' . $request->itrFile->getClientOriginalName();
                $request->itrFile->move(public_path('uploads'), $fileNameItr);

            }
            if ($request->hasFile('aadharFile')) {
                $fileNameAadhar = time() . '.' . $request->aadharFile->getClientOriginalName();
                $request->aadharFile->move(public_path('uploads'), $fileNameAadhar);

            }
            if ($request->hasFile('panFile')) {
                $fileNamePan = time() . '.' . $request->panFile->getClientOriginalName();
                $request->panFile->move(public_path('uploads'), $fileNamePan);

            }
            if ($request->hasFile('utilityFile')) {
                $fileNameUtility = time() . '.' . $request->utilityFile->getClientOriginalName();
                $request->utilityFile->move(public_path('uploads'), $fileNameUtility);

            }

            //code for 3 extra file start
            if ($request->hasFile('OtherFile1')) {
                $fileNameUtility1 = time() . '.' . $request->OtherFile1->getClientOriginalName();
                $request->OtherFile1->move(public_path('uploads'), $fileNameUtility1);

            }
            if ($request->hasFile('OtherFile2')) {
                $fileNameUtility2 = time() . '.' . $request->OtherFile2->getClientOriginalName();
                $request->OtherFile2->move(public_path('uploads'), $fileNameUtility2);

            }
            if ($request->hasFile('OtherFile3')) {
                $fileNameUtility3 = time() . '.' . $request->OtherFile3->getClientOriginalName();
                $request->OtherFile3->move(public_path('uploads'), $fileNameUtility3);

            }
            //code for 3 extra file end
            $query = DB::table('documents')->where('userid', Auth::user()->id)->update([
                'gstcardpath' => $fileName,
                'msmecardpath' => $fileNameMsme,
                'itrcardpath' => $fileNameItr,
                'aadharcardpath' => $fileNameAadhar,
                'pancardpath' => $fileNamePan,
                'utilitycardpath' => $fileNameUtility,


                "updated_at" => Carbon::now(),
                # new \Datetime()
            ]);
            $attachmentQuery = DB::table('attachments')->insert([
                ['filename' => $fileNameUtility1, 'path' => $fileNameUtility1, 'userid' => Auth::user()->id, 'mime_type' => 'pdf'],
                ['filename' => $fileNameUtility2, 'path' => $fileNameUtility2, 'userid' => Auth::user()->id, 'mime_type' => 'pdf'],
                ['filename' => $fileNameUtility3, 'path' => $fileNameUtility3, 'userid' => Auth::user()->id, 'mime_type' => 'pdf'],
            ]);
            if (isset($query)) {
                return redirect()->route('updatedDocument')->with(["data" => "success"]);
            } else {
                return redirect()->back()->withInput();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function userMsgHandling(Request $request)
    {
        try {

            $userMsg = $request->input("userTxt");
            $userData = $request->input("admin-message");
            $adminData = $request->input("user-message");
            $supervisor = "user";

            $query = User::find(1);
            $query->comment = $userMsg;
            $query->supervisor = "user";
            $query->save();

            $previousAdmin = Comments::where('user_id', 1)
                ->where('supervisor', 'admin')
                ->whereNotNull('comment')
                ->select('comment')
                ->orderBy('id', 'desc')
                ->get();

            $previousUser = Comments::where('user_id', 1)
                ->where('supervisor', 'user')
                ->whereNotNull('comment')
                ->select('comment')
                ->orderBy('id', 'desc')
                ->get();

            if (isset($query)) {
                return response()->json(["msg" => "success", "userMsg" => $userMsg, "previousAdmin" => $previousAdmin, "previousUSer" => $previousUser]);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function adminReturnMsg(Request $request)
    {
        try {

            $adminResponse = Comments::where('user_id', 1)
                ->where('supervisor', 'admin')
                ->whereNotNull('comment')
                ->select('comment')
                ->orderBy('id', 'desc')
                ->get();

            if (isset($adminResponse)) {
                return response()->json(['msg' => "success", "adminResponse" => $adminResponse]);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());

        }
    }


    public function store(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                $id = Auth::user()->id;
                $attachment = new Attachment([
                    'filename' => $imageName,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'file_type' => 'other',
                    'fileno' => 'additional files'
                ]);
                $user = User::find($id);
                $user->attachment()->save($attachment);
            }
            return response()->json(['success' => $imageName]);
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function storeimagecomment($data)
    {
        try {
            $messageData = $data;
            $queryData = User::join('comments', 'users.id', '=', 'comments.user_id')
                ->where('comments.user_id', auth()->user()->id)
                ->orderBy('comments.created_at', 'desc')
                ->select('comments.*')
                ->first();
            $admin_id = $queryData->admin_id;
            if (isset($messageData) && !empty($messageData)) {
                $data = new Comments;
                $data->admin_id = $admin_id;
                $data->user_id = Auth::user()->id;
                $data->comment = $messageData;
                // $data->username=$adminusername;
                $data->commented_by = "user";
                $data->username = Auth::user()->name;
                $data->save();
                if ($data->save()) {
                    $latestData = Comments::latest()->where('admin_id', $admin_id)->where('user_id', Auth::user()->id)->get();
                    return response()->json(["msg" => "success", 'latestData' => $latestData]);
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }
}