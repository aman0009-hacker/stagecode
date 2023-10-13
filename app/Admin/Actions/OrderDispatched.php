<?php

namespace App\Admin\Actions;

use App\Models\OrderItem;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentDataHandling;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
            $bookingAmount = PaymentDataHandling::where('order_id', $allorder->id)->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->value('transaction_amount');
            //new logic for request total
            $total = 0;
            foreach ($order as $item) {
                $item->quantity = $request->quantity[$num] ?? 1;
                $item->price = $request->price[$num] ?? 0;
                //new code for store price
                $total = $total + ($item->price * $item->quantity);
                $num++;
            }
            if (isset($bookingAmount) && !empty($bookingAmount)) {
                /*-------static calculation for booking amount and the final payment to be done---starts--*/

                $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                $sgstPercent = env('SGST', 9);
                // Set your SGST percentage here (e.g., 9%)
                $totalTaxAmount = ($total * ($cgstPercent + $sgstPercent) / 100) ?? 0; //static calculation for total amount with tax

                $balanceAmount = $bookingAmount - ($totalTaxAmount + $total);
                // dd($balanceAmount);                     ///remaining amount after static calculation
                if ($balanceAmount > 0) {
                    $allorder->balance_on_booking = $balanceAmount;
                    $allorder->save();
                    // dd($allorder->save());
                }

                /*-------static calculation for booking amount and the final payment to be done---ends--*/

                $allorder->amount = $total;
                //new logic for request total
                $allorder->save();

                $num = 0;
                foreach ($order as $item) {
                    $item->quantity = $request->quantity[$num];
                    //new code for store price
                    $item->price = $request->price[$num];
                    //new code for store price
                    $item->save();
                    $num++;
                }
                $id = $model->id;

                if (isset($id) && !empty($id)) {
                    $data = Order::find($id);
                    $encryptedID = Crypt::encryptString($data->id);
                    $data->status = "Dispatched";
                    $data->save();
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

                        } else {
                            return $this->response()->error('Oops! Kindly submit documents as required');
                        }
                    }
                    return $this->response()->success('Congratulations!!! Your order no ' . $model->order_no . ' is ready for dispatch. kindly make a full payment against invoice')->refresh();
                }
            } else {
                return $this->response()->error('Oops! Booking Amount not yet recieved.');
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function form()
    {
        $data = OrderItem::where('order_id', $this->getKey())->get();
        $order_id = Order::find($this->getKey());
        $this->text('total', 'Total amount')->default($order_id->amount)->attribute('class', 'item_name')->placeholder('total amount');
        foreach ($data as $element) {
            $this->text('Item name')->rules('required')->default($element->category_name)->readonly()->attribute('class', 'item_name');
            $this->text('quantity[]', 'Quantity')->rules('required')->default($element->quantity)->attribute('class', 'item_name');
            $this->text('price[]', 'Price')->rules(['numeric', 'regex:/^\d+(?:\.\d{1,2})?$/'])->help('(amount without tax per ton)')->rules('required');


        }

    }


}