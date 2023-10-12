<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\User;
use Illuminate\Support\Facades\Log;


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
                    $emailData = User::join('attachments', 'users.id', '=', 'attachments.user_id')
                        ->where('attachments.user_id', $model->id)
                        ->select('users.email')
                        ->first();
                    if (isset($emailData)) {
                        $emailDataName = $emailData->email;
                        //the current user emailid end
                        $details = [
                            'email' => 'Account Verification Successful - Access Your Payment Link',
                            'body' => 'We are pleased to inform you that your account verification process has been successfully completed.',
                            'status' => 'account approved',
                            'encryptedID' => $encryptedID,


                        ];
                        \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));

                    } else {
                        return $this->response()->error('Oops! Kindly submit documents as required');
                    }
                }
                return $this->response()->success('User request has succsesfully approved.')->refresh();
            } else if (isset($approvedStatus) && $approvedStatus == 1) {
                return $this->response()->success('User request has already approved.')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

}