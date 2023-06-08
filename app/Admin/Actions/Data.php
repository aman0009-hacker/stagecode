<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\User;


class Data extends RowAction
{
    public $name = 'Approved';

    public function dialog()
    {
        $this->confirm('Are you sure for approval?');
    }

    public function handle(Model $model)
    {
        try {
            $approvedStatus = $model->approved;
            $encryptedID = Crypt::encryptString($model->id);

            //check documents are present or not
            if (isset($approvedStatus) && ($approvedStatus == 0 || $approvedStatus == 2)) {
                // send values in model "documents" start
                $user = $model::find($model->id);
                $user->approved = 1;
                $user->comment = null;
                $user->approved_at = Carbon::now();
                $resultQuery = $user->save();
                // send values in model "documents" end
                if (isset($resultQuery) && $resultQuery === true) {
                    //get current user emailid start
                    // $emailData = DB::table('users')->join('attachments', 'users.id', '=', 'attachments.user_id')->where('attachments.user_id', $model->id)->select('users.email')->first();
                    $emailData = User::join('attachments', 'users.id', '=', 'attachments.user_id')
                        ->where('attachments.user_id', $model->id)
                        ->select('users.email')
                        ->first();
                    if (isset($emailData)) {
                        $emailDataName = $emailData->email;
                        //het current user emailid end
                        $details = [
                            'email' => 'Mail from PSIEC Admin Panel',
                            'body' => 'Congratulations!!! Your account has successfully verified.',
                            'encryptedID' => $encryptedID,


                        ];
                        \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                        //\Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                        //dd("Email is Sent.");
                    } else {
                        return $this->response()->error('Oops! Kindly submit documents as required');
                    }
                }
                return $this->response()->success('User request has succsesfully approved.')->refresh();
            } else if (isset($approvedStatus) && $approvedStatus == 1) {
                return $this->response()->success('User request has already approved.')->refresh();
            }
        } catch (\Exception $ex) {
            //return $this->response()->error('Oops! Sending mail has encountered some internal problem');
        }
    }

}