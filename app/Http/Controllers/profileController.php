<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\PaymentDataHandling;
use App\Models\State;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class profileController extends Controller
{
    public function profile()
    {
        try {
            $user = Auth::user();
            $states = State::all();
            $address = Address::where('user_id', $user->id)->get()->last();
            return view('components.profile', compact('user', 'address', 'states'));
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }
    public function storedata(Request $request)
    {
        try {
            $id = $request->id;
            $main = user::find($id);
            $main->name = $request->firstname;
            $main->last_name = $request->lastname;
            $main->email = $request->email;
            $main->contact_number = $request->number;
            if ($request->file) {
                $image = $request->file;
                $realname = time() . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $realname);
                $main->user_image = $realname;
            }
            $main->save();
            Alert::success('Profile updated successfully', 'Your profile has been successfully updated');
            return redirect()->back();
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function removeimage(request $request)
    {
        try {
            $id = $request->userimageid;
            $data = user::find($id);
            $data->user_image = "";
            $data->save();
            Alert::success('Image removed successfully', 'Your Image has been successfully removed');
            return redirect()->back();
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function addresssave(request $request)
    {

        try {
            $address = new Address();
            $valid = Validator::make($request->all(), [
                "shipname" => 'required',
                "shipgstnumber" => 'required|min:15|max:15',
                "shipgstcode" => 'required|min:2|max:2',
                "shipstate" => 'required',
                "shipcity" => 'required',
                "shipdistrict" => 'required',
                "shippincode" => 'required|min:6|max:6',
                "shipaddress" => 'required',
                "billname" => 'required',
                "billgstnumber" => 'required|min:15|max:15',
                "billgstcode" => 'required|min:2|max:2',
                "billstate" => 'required',
                "billcity" => 'required',
                "billdistrict" => 'required',
                "billpincode" => 'required|min:6|max:6',
                "billaddress" => 'required',
            ]);
            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid);
            }
            $user_id = Address::where('user_id', Auth::user()->id)->get()->last();
            $shipState = State::where('id', $request->shipstate)->first();
            $billState = State::where('id', $request->billstate)->first();
            if ($user_id != "") {
                $user_id->user_id = Auth::user()->id;
                $user_id->shipping_name = $request->shipname;
                $user_id->shipping_gst_number = $request->shipgstnumber;
                $user_id->shipping_gst_statecode = $request->shipgstcode;
                $user_id->shipping_state = $shipState->name;
                $user_id->shipping_city = $request->shipcity;
                $user_id->shipping_district = $request->shipdistrict;
                $user_id->shipping_zipcode = $request->shippincode;
                $user_id->shipping_address = $request->shipaddress;
                $user_id->billing_name = $request->billname;
                $user_id->billing_gst_number = $request->billgstnumber;
                $user_id->billing_gst_statecode = $request->billgstcode;
                $user_id->billing_state = $billState->name;
                $user_id->billing_city = $request->billcity;
                $user_id->billing_district = $request->billdistrict;
                $user_id->billing_zipcode = $request->billpincode;
                $user_id->billing_address = $request->billaddress;
                $user_id->save();
                Alert::success('Data is updated', 'Your address has been updated succesfully ');
                return redirect()->back();
            } else {
                $address->user_id = Auth::user()->id;
                $address->shipping_name = $request->shipname;
                $address->shipping_gst_number = $request->shipgstnumber;
                $address->shipping_gst_statecode = $request->shipgstcode;
                $address->shipping_state = $shipState->name;
                $address->shipping_city = $request->shipcity;
                $address->shipping_district = $request->shipdistrict;
                $address->shipping_zipcode = $request->shippincode;
                $address->shipping_address = $request->shipaddress;
                $address->billing_name = $request->billname;
                $address->billing_gst_number = $request->billgstnumber;
                $address->billing_gst_statecode = $request->billgstcode;
                $address->billing_state = $billState->name;
                $address->billing_city = $request->billcity;
                $address->billing_district = $request->billdistrict;
                $address->billing_zipcode = $request->billpincode;
                $address->billing_address = $request->billaddress;
                $address->save();
                Alert::success('Data is saved', 'Your address has been store succesfully ');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }

    }

    public function userdashboard()
    {
        try {
            $arr = 0;
            $auth_id = auth::user()->id;
            $data = auth::user();
            $order = Order::where('user_id', $auth_id)->orderBy('id', 'DESC')->with('orderItems')->get();
            //  total order amount per month
            $user_order_total = DB::table('orders')
                ->selectRaw('Month(created_at) as month, SUM(amount) as total_amount')
                ->where('user_id', $auth_id)
                ->groupBy('month')
                ->get();
            $chardate = "";
            foreach ($user_order_total as $date) {
                if ($date->month === null || $date->total_amount === null) {

                } else {

                    $month = DateTime::createFromFormat('!m', $date->month);
                    $chardate .= "['" . $month->format('F') . "'," . $date->total_amount . "],";
                }
            }
            $chartrim = rtrim($chardate, ',');
            //  total purchse in order
            $user_per_month = DB::table('orders')
                ->selectRaw('Month(created_at) as month , count(id) as id')
                ->where('user_id', $auth_id)->groupBy('month')->get();
            $charorder = "";
            foreach ($user_per_month as $month) {
                $order_m = DateTime::createFromFormat('!m', $month->month);
                $charorder .= "['" . $order_m->format('F') . "'," . $month->id . "],";
            }
            $order_trim = rtrim($charorder, ',');
            if (count($order) > 0) {
                foreach ($order as $total) {
                    $arr += $total->amount;
                }
            }
            $total_amount = "['amount',$arr]";
            // per day order
            $per_month_amount = DB::table('orders')
                ->selectRaw('Date(created_at) as date, amount as total_amount')
                ->where('user_id', $auth_id)
                ->groupBy('date', 'amount')
                ->get();

            $perday = "";
            foreach ($per_month_amount as $day) {
                if ($day->date === null || $day->total_amount === null) {

                } else {
                    $month = new DateTime($day->date);
                    $perday .= "['" . $month->format('d') . "'," . $day->total_amount . "],";

                }
            }

            $perday_trim = rtrim($perday, ',');


            return view('userDashboard.dashboard', compact('data', 'order', 'chartrim', 'order_trim', 'total_amount', 'perday_trim'));
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function userorder()
    {
        try {
            $data = auth::user();

            $main = Order::with('orderItems')->where('user_id', $data->id)->get();
            return view('userDashboard.order', compact('data', 'main'));
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function wallet()
    {
        $user_id = Auth::user()->id;
        $allorders = Order::where('user_id', $user_id)->get();
<<<<<<< HEAD
=======

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        $orderDetails = [];
        $counter = 0;
        $orderData = [
            "Order_No" => [],
            // Changed to an empty array
            "Balance_on_booking" => [],
            // Changed to an empty array
            "booking_transaction_id" => [],
            // Changed to an empty array
            "final_transaction_id" => [],
            // Changed to an empty array
            "Booking_Initial_Amount" => [],
            // Changed to an empty array
            "Final_Amount" => [],
            // Changed to an empty array
            "Final_Payment_Mode" => [],
            // Changed to an empty array
            "Cheque_Info" => [],
            // Changed to an empty array
        ];
        foreach ($allorders as $order) {
            if (isset($order->id) && !empty($order->id)) {
                $order_id = $order->order_no;
                if (isset($order_id) && !empty($order_id)) {
                    // Append the order_id to the "Order No" array
                    $orderData["Order_No"][] = $order_id;
                } else {
                    $orderData["Order_No"][] = "(N/A)";
                }



                $balance_on_booking = Order::where('id', $order->id)->where('user_id', $user_id)->value('balance_on_booking');
                if (isset($balance_on_booking) && !empty($balance_on_booking)) {
                    $orderData['Balance_on_booking'][] = $balance_on_booking;
                } else {
                    $orderData['Balance_on_booking'][] = "(N/A)";
                }
                // Append the other data to their respective arrays based on your business logic
                $final_transaction = PaymentDataHandling::where('order_id', $order->id)
                    ->where('user_id', $user_id)
                    ->where('data', 'Booking_Final_Amount')
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->pluck('transaction_id')
                    ->last();

                $invalid_cheque_transaction = PaymentDataHandling::where('order_id', $order->id)
                    ->where('user_id', $user_id)
                    ->where('data', 'Invalid_Cheque_Amount')
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->pluck('transaction_id')
                    ->last();
                if (isset($final_transaction) && !empty($final_transaction)) {
                    $orderData['final_transaction_id'][] = $final_transaction;
                } elseif (isset($invalid_cheque_transaction) && !empty($invalid_cheque_transaction)) {
                    $orderData['final_transaction_id'][] = $invalid_cheque_transaction;
                } else {
                    $orderData['final_transaction_id'][] = "(N/A)";
                }



                $booking_transaction = PaymentDataHandling::where('order_id', $order->id)->where('user_id', $user_id)->where('data', 'Booking_Amount')->pluck('transaction_id')->last();
                if (isset($booking_transaction) && !empty($booking_transaction)) {
                    $orderData['booking_transaction_id'][] = $booking_transaction;
                } else {
                    $orderData['booking_transaction_id'][] = "(N/A)";
                }



                $initial_amount = PaymentDataHandling::where('order_id', $order->id)
                    ->where('user_id', $user_id)
                    ->where('data', 'Booking_Amount')
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->get()
                    ->last();

                if (isset($initial_amount) && !empty($initial_amount) && isset($initial_amount->transaction_amount) && !empty($initial_amount->transaction_amount)) {
                    $orderData['Booking_Initial_Amount'][] = $initial_amount->transaction_amount;
                } else {
                    $orderData['Booking_Initial_Amount'][] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
                }

                $final_amount = PaymentDataHandling::where('order_id', $order->id)
                    ->where('user_id', $user_id)
                    ->where('data', 'Booking_Final_Amount')
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->get()
                    ->last();

                $invalid_cheque_amount = PaymentDataHandling::where('order_id', $order->id)
                    ->where('user_id', $user_id)
                    ->where('data', 'Invalid_Cheque_Amount')
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->get()
                    ->last();

                if (isset($final_amount) && !empty($final_amount) && isset($final_amount->payment_status) && !empty($final_amount->payment_status)) {
                    if (strtolower($final_amount->payment_status) === strtolower('success') || strtolower($final_amount->payment_status) === strtolower('rip') || strtolower(strtolower($final_amount->payment_status)) === strtolower('sip')) {
                        $totalAmount = $final_amount->transaction_amount;
                        $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();
                        if (isset($invoice) && isset($invoice->amount) && isset($invoice->totaltax)) {

                            $orderData['Final_Amount'][] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax})";

                        } else {
                            $orderData['Final_Amount'] = $totalAmount . " <span style='color:green;font-weight:600'>(Paid With Tax)</span>";
                        }

                    } else {
                        $orderData['Final_Amount'][] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
                    }
                } elseif (isset($invalid_cheque_amount) && !empty($invalid_cheque_amount)) {

                    $totalAmount = $invalid_cheque_amount->transaction_amount;
                    $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();
                    $interestAmount = Order::where('id', $order->id)->where('user_id', $user_id)->value('interest_amount');
                    $interestAmountRound = round($interestAmount, 2);
                    if (isset($invoice) && isset($invoice->amount)) {

                        $orderData['Final_Amount'][] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax}, Interest: {$interestAmountRound})";

                    } else {
                        $orderData['Final_Amount'] = $totalAmount . " <span style='color:green;font-weight:600'></span>";
                    }
                } elseif (isset($balance_on_booking) && !empty($balance_on_booking)) {
                    $invoice = Invoice::where('order_id', $order->id)->orderBy('created_at', 'desc')->first();

                    $totalAmount = $invoice->amount + $invoice->totaltax;

                    if (isset($invoice) && isset($invoice->amount)) {
                        $orderData['Final_Amount'][] = $totalAmount . " (Amount: {$invoice->amount}, Tax: {$invoice->totaltax})";
                    } else {
                        $orderData['Final_Amount'] = $totalAmount . " <span style='color:green;font-weight:600'></span>";
                    }
                } else {
                    $final_check_amount = Order::where('user_id', $user_id)->where('id', $order->id)->where('payment_mode', 'cheque')->get()->last();

                    if (
                        isset($final_check_amount) &&
                        !empty($final_check_amount) &&
                        isset($final_check_amount->final_payment_status) &&
                        !empty($final_check_amount->final_payment_status) &&
                        $final_check_amount->final_payment_status === 'verified'
                    ) {
                        $orderData['Final_Amount'][] = "<span style='color:green;font-weight:600'>(Paid With Cheque)</span>";
                    } else {
                        $orderData['Final_Amount'][] = "<span style='color:red;font-weight:600'>(Unpaid)</span>";
                    }
                }

                $paymentMode = $order->payment_mode;
                if (isset($paymentMode) && !empty($paymentMode)) {
                    $orderData['Final_Payment_Mode'][] = $paymentMode;
                } else {
                    $orderData['Final_Payment_Mode'][] = "<span style='color:red;font-weight:600'>(N/A)</span>";
                }

                if ($order->payment_mode === 'cheque') {
                    if ($order->cheque_final_amount != null || $order->final_amount != "") {
                        $chequeDate = $order->Cheque_Date ?? '';
                        $chequeAmount = $order->check_amount ?? '';
                        $chequeNumber = $order->cheque_number ?? '';
                        $finalAmount = $order->cheque_final_amount ?? '';
                        $checkcompletionDate = Carbon::parse($order->cheque_arrival_date ?? '')->format("m/d/Y");
                        $orderData['Cheque_Info'][] = "[Cheque Date: " . $checkcompletionDate . "]" . " " . "[Cheque Number: " . $chequeNumber . "]" . "  " . " [Final Cheque Amount: " . $finalAmount . "]";
                    } else {

                        $chequeDate = '';
                        if ($order->Cheque_Date) {
                            $chequeDate = Carbon::parse($order->Cheque_Date)->format("m/d/Y");
                        }

                        $chequeAmount = $order->check_amount ?? '';
                        $chequeNumber = $order->cheque_number ?? '';
                        $orderData['Cheque_Info'][] = "[Cheque Date: " . $chequeDate . "]" . " " . "[Cheque Number: " . $chequeNumber . "]" . "  " . " [Cheque Amount: " . $chequeAmount . "]";
                    }
                } else {
                    $orderData['Cheque_Info'][] = "<span style='color:black;font-weight:600'>(N/A)</span>";
                }
            }

            $orderDetails[] = $orderData;

        }
        $data = auth::user();
        $registration_data = PaymentDataHandling::where('user_id', $user_id)->where('data', 'Registration_Amount')->first();

        return view('userDashboard.wallet', compact('orderData', 'registration_data', 'data'));
    }

    public function useraddress()
    {
        try {
            $data = auth::user();
            $address = address::where('user_id', $data->id)->get()->last();
            return view('userDashboard.address', compact('data', 'address'));
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }
}