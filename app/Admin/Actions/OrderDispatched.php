<?php

namespace App\Admin\Actions;

use App\Models\OrderItem;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Crypt;

class OrderDispatched extends RowAction
{
    public $name = 'Payment Request';
    protected $selector = '.order-approved';

    public function handle(Model $model, request $request)
    {
        $num = 0;
        try {
            $order = OrderItem::where('order_id', $this->getKey())->get();
            $allorder = order::find($this->getKey());
            // $allorder->amount = $request->total;
            //new logic for request total
            $total=0;
            foreach ($order as $item) {
                $item->price = $request->price[$num] ?? 0;
                //new code for store price
                $total=$total+$item->price;
            }
            $allorder->amount = $total;
            //new logic for request total
            $allorder->save();
            foreach ($order as $item) {
                $item->quantity = $request->quantity[$num];
                //new code for store price
                $item->price = $request->price[$num];
                //new code for store price
                $item->save();
                $num++;
            }
            $id = $model->id;
            //dd($id);
            if (isset($id) && !empty($id)) {
                $data = Order::find($id);
                $encryptedID = Crypt::encryptString($data->id);
                $data->status = "Dispatched";
                $data->save();
                //Session::put('txtOrderGlobalModalCompleteID',$id);
                //new code for update incoice table
                $latestInvoice = Invoice::where('order_id', $id)
                    ->orderBy('updated_at', 'desc')
                    ->first();
                if ($latestInvoice) {
                    // You can access the attributes of the latest invoice like this:
                    $latestInvoice->invoice_date = Carbon::today()->format('Y-m-d');
                    $latestInvoice->save();
                } else {
                }
                //new code for update imvoice table
                if ($data->save() == true) {
                    $user_id = Order::find($model->id)->user_id;
                    $emailData = User::join('orders', 'users.id', '=', 'orders.user_id')
                        ->where('orders.user_id', $user_id)
                        ->select('users.email')
                        ->first();
                    if (isset($emailData)) {
                        $emailDataName = $emailData->email;
                        //het current user emailid end
                        $details = [
                            'email' => 'Payment Required for Order ' . $model->order_no,
                            'body' => 'We are pleased to inform you that your order with order number ' . $model->order_no . ' is now ready for dispatch. To facilitate the completion of this process, we kindly request that you make the full payment against the invoice.',
                            'encryptedID' => $encryptedID,
                            'status' => 'Dispatched'
                        ];
                        \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));
                        //\mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
                        //dd("Email is Sent.");
                    } else {
                        return $this->response()->error('Oops! Kindly submit documents as required');
                    }
                }
                return $this->response()->success('Congratulations!!! Your order no ' . $model->order_no . ' is ready for dispatch. kindly make a full payment against invoice')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function form()
    {
        $data = OrderItem::where('order_id', $this->getKey())->get();
        $order_id = Order::find($this->getKey());
        $this->text('total', 'Total amount')->default($order_id->amount)->attribute('class', 'item_name')->rules('required')->placeholder('total amount');
        foreach ($data as $element) {
            $this->text('Item name')->rules('required')->default($element->category_name)->readonly()->attribute('class', 'item_name');
            $this->text('quantity[]', 'Quantity')->rules('required')->default($element->quantity)->attribute('class', 'item_name');
            $this->text('price[]', 'Price')->rules(['numeric', 'regex:/^\d+(?:\.\d{1,2})?$/'])->help('(amount without tax)')->rules('required');


        }

    }


}