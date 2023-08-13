<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class OrderPayment extends RowAction
{
    public $name = 'Payment Done';
    public function handle(Model $model , Request $request)
    {
        try {
            $id = $model->id;
            $encryptedID = Crypt::encryptString($model->id);
            //new code for cheque start
            $cheque_arrival_date = $request->cheque_arrival_date ?? '';
            $cheque_final_amount = $request->cheque_final_amount ?? '';
            //new code for cheque end
            if (isset($id) && !empty($id)) {
                $data = Order::find($id);
                $data->status = "Payment_Done";
                $data->final_payment_status="verified";
                $data->cheque_arrival_date= $cheque_arrival_date;
                $data->cheque_final_amount= $cheque_final_amount;
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
                        'email' => 'Final Booking Amount Payment Successful',
                        // 'body' => 'Congratulations!!! Your order no '. $model->order_no . ' payment has successfully received. Orders has delivered soon.',
                        'body' => 'We are pleased to inform you that final booking amount of your order with order number '.$model->order_no.' has been successfully processed and will be delivered to you soon.',
                        'encryptedID' => $encryptedID,
                        'status'=>'OrderPayment'
                    ];
                    \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                    //\mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                    //dd("Email is Sent.");
                } else {
                    return $this->response()->error('Oops! Kindly submit documents as required');
                }
                }
                return $this->response()->success('Congratulations!!! Your order no '. $model->order_no . ' payment has successfully received. Orders has delivered soon.')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    // public function dialog()
    // {
    //     $this->confirm('Are you sure for payment approval?');
    // }

    public function form()
    {
        $this->date('cheque_arrival_date', 'Cheque Completion Date');
        $this->text('cheque_final_amount','Cheque Final Amount');
    }


}