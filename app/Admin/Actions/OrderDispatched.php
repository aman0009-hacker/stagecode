<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;

class OrderDispatched extends RowAction
{
    public $name = 'Dispatch';
    //protected $selector = '.order-approved';

    public function handle(Model $model)
    {
        try {
            $id = $model->id;
            if (isset($id) && !empty($id)) {
                $data = Order::find($id);
                $data->status = "Dispatched";
                $data->save();

                if($data->save()==true)
                {
                    $user_id=Order::find($model->id)->user_id;
                    $emailData = User::join('orders', 'users.id', '=', 'orders.user_id')
                    ->where('orders.user_id', $user_id)
                    ->select('users.email')
                    ->first();
                if (isset($emailData)) {
                    $emailDataName = $emailData->email;
                    //het current user emailid end
                    $details = [
                        'email' => 'PSIEC ADMIN PANEL',
                        'body' => 'Congratulations!!! Your order no '. $model->id . ' is ready for dispatch. kindly make a full payment against invoice',
                        //'encryptedID' => $encryptedID,


                    ];
                    \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                    //\Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                    //dd("Email is Sent.");
                } else {
                    return $this->response()->error('Oops! Kindly submit documents as required');
                }
                }
                return $this->response()->success('Congratulations!!! Your order no '. $model->id . ' is ready for dispatch. kindly make a full payment against invoice')->refresh();
            }
        } catch (\Exception $ex) {

        }
    }


    public function dialog()
    {
        $this->confirm('Are you sure for order dispatch?');
    }

   
   
}