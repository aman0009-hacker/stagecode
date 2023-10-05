<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class OrderDelivered extends RowAction
{
    protected $selector = '.order-delivered';
    public $name = 'Order Delivered';

    public function handle(model $model)
    {
        try {
            $id = $model->id;
            $encryptedID = Crypt::encryptString($model->id);
            if (isset($id) && !empty($id)) {
                $data = Order::find($id);
                if ($data->status === 'Payment_Done') {
                    $data->status = "Delivered";
                    $data->save();
                    if ($data->save() == true) {
                        $user_id = Order::find($model->id)->user_id;
                        $order_no = Order::find($model->id)->order_no;
                        $emailData = User::join('orders', 'users.id', '=', 'orders.user_id')
                            ->where('orders.user_id', $user_id)
                            ->select('users.email')
                            ->first();


                        if (isset($emailData)) {
                            $emailDataName = $emailData->email;
                            //het current user emailid end
                            $details = [
                                'email' => 'Order Delivered for Order number ' . $order_no . '.',
                                'body' => 'We are pleased to inform you that your order with order number ' . $order_no . ' has been successfully delivered.',
                                'encryptedID' => $encryptedID,
                                'status' => 'OrderDelivered'
                            ];
                            \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));

                        } else {
                            return $this->response()->error('Oops! Kindly submit documents as required');
                        }
                    }
                } else {
                    return $this->response()->error('Please first pay the order price');
                }

                return $this->response()->success('Congratulations!!! Your order has been delivered')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }
    public function dialog()
    {
        $this->confirm('Are you sure for order delivered?');
    }
}