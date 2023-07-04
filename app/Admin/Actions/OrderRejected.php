<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class OrderRejected extends RowAction
{
    public $name = 'Reject';

    public function handle(Model $model, Request $request)
    {
        try {
            $id = $model->id;
            if (isset($id) && !empty($id)) {
                $data = Order::find($id);
                $data->status = "Rejected";
                $data->save();

                if($data->save()==true)
                {
                    $user_id=Order::find($model->id)->user_id;
                    $emailData = User::join('orders', 'users.id', '=', 'orders.user_id')
                    ->where('orders.user_id', $user_id)
                    ->select('users.email')
                    ->first();
                    // $user_id=Order::find($model->id)->user_id;
                if (isset($emailData)) {
                    $emailDataName = $emailData->email;
                    //het current user emailid end
                    $details = [
                        'email' => 'PSIEC ADMIN PANEL',
                        'body' => 'Oops!!! Your order no '. $model->id . ' has rejected due to following cause '. $request->get('reason') ?? ''.'.'
                        //'encryptedID' => $encryptedID,


                    ];
                    \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                    //\Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                    //dd("Email is Sent.");
                } else {
                    return $this->response()->error('Oops! Kindly submit documents as required');
                }
                }
                return $this->response()->success('Oops!!! Your order no '. $model->id . ' has rejected due to following cause '. $request->get('reason') ?? ''.'.')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function form()
    {
        $this->textarea('reason', 'Reason')->rules('required');
    }
 
}