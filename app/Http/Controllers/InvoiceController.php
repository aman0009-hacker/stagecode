<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\PaymentDataHandling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use PDF;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        try {
            $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
            if (isset($orderId) && !empty($orderId)) {

                $PaymentMode = Order::find($orderId)->payment_mode;
                if ($PaymentMode == "online") {
                    $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
                    $userId = Auth::user()->id;
                    //Code for invoice start
                    $order = Order::with([
                        'invoices',
                        'address',
                        'orderItems',
                        'payments',
                    ])->where('id', $orderId)
                        ->where('user_id', $userId)
                        ->first();

                    if (
                        !isset($order->invoices) || $order->invoices()->count() === 0 ||
                        !isset($order->address) || $order->address()->count() === 0 ||
                        !isset($order->orderItems) || $order->orderItems()->count() === 0 ||
                        !isset($order->payments) || $order->payments()->count() === 0
                    ) {
                        return redirect()->route('order')->with('error', 'Order not found.');
                    }

                    $totalAmount = $order->amount;
                    $bookingAmount = $order->payments->where('data', 'Booking_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->value('transaction_amount');
                    $interest_amount = 0;
                    // ii- Find tax amount
                    $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                    $sgstPercent = env('SGST', 9);
                    // Set your SGST percentage here (e.g., 9%)
                    $totalTaxAmount = ($totalAmount * ($cgstPercent + $sgstPercent) / 100) ?? 0;
                    $centralTaxAmount = ($totalAmount * $cgstPercent / 100) ?? 0;
                    $stateTaxAmount = ($totalAmount * $sgstPercent / 100) ?? 0;
                    // iii- Find the complete amount
                    $completeAmount = ($totalAmount + $totalTaxAmount) ?? 0;
                    $balance = $completeAmount - $bookingAmount;
                    //insert in invoice table
                    $invoice = Invoice::where('order_id', $orderId)->orderBy('created_at', 'desc')->first();

                    $invoice->amount = $totalAmount;
                    $invoice->totaltax = $totalTaxAmount;
                    $invoice->initial_amount = $bookingAmount;
                    $invoice->balance = $balance;
                    $invoice->save();

                    /* $balance return for normal online payment case */
                    $finalbalancepayment = PaymentDataHandling::where('order_id', $orderId)->where('user_id', $userId)->where('data', 'Booking_Final_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->first();
                    if ($finalbalancepayment) {
                        $balance = $balance . " (Paid)";
                    }

                    /* $balance return for invalid cheque online payment case */
                    $finalInvalidChequeBalancePayment = PaymentDataHandling::where('order_id', $orderId)->where('user_id', $userId)->where('data', 'Invalid_Cheque_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->first();
                    if ($finalInvalidChequeBalancePayment) {
                        $interest_amount = Order::find($orderId)->interest_amount;
                        $balance = $balance + round($interest_amount, 2) . "(Paid)";
                    }


                    /* $balance return for balance on booking online payment case */
                    $balance_on_booking_amount = Order::find($orderId)->balance_on_booking;
                    if ($balance_on_booking_amount) {
                        $balance = $completeAmount . " (Paid)";
                    }

                    //insert in invoice table
                    $pdf = PDF::loadView('components.invoice', [
                        'Advance_booking_amount' => $bookingAmount,
                        'IRN' => env('IRN', ''),
                        'AckNo' => $order->invoices->pluck('invoice_id')[0],
                        'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'PSIECAddress' => json_decode($order->address->psiec_address_ludhiana, true),
                        'shipping_name' => $order->address->shipping_name,
                        'shipping_address' => $order->address->shipping_address,
                        'shipping_state' => $order->address->shipping_state,
                        'shipping_district' => $order->address->shipping_district,
                        'shipping_city' => $order->address->shipping_city,
                        'shipping_zipcode' => $order->address->shipping_zipcode,
                        'shipping_gst_number' => $order->address->shipping_gst_number,
                        'shipping_gst_statecode' => $order->address->shipping_gst_statecode,
                        'billing_name' => $order->address->billing_name,
                        'billing_address' => $order->address->billing_address,
                        'billing_state' => $order->address->billing_state,
                        'billing_district' => $order->address->billing_district,
                        'billing_city' => $order->address->billing_city,
                        'billing_zipcode' => $order->address->billing_zipcode,
                        'billing_gst_number' => $order->address->billing_gst_number,
                        'billing_gst_statecode' => $order->address->billing_gst_statecode,
                        'InvoiceNo' => $order->invoices->pluck('invoice_id')[0],
                        'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'DeliveryNote' => env('DELIVERY_NOTE', ''),
                        'ModeTermsofPayment' => $order->payment_mode,
                        'OtherReferences' => env('OTHER_REFERENCES', ''),
                        'Buyers_Order_No' => $order->order_no,
                        'DatedOrderNo' => Carbon::parse($order->created_at)->format('d-m-Y'),
                        'DispatchDocNo' => env('DISPATCH_DOC_NO', ''),
                        'DeliveryNoteDate' => env('DELIVERYNOTEDATE', ''),
                        'DispatchedThrough' => env('DISPATCHED_THROUGH', ''),
                        'Destination' => env('DESTINATION', ''),
                        'BillofLandingLR-RRNo' => env('BILL_OF_LANDING_LR_RR_NO', ''),
                        'MotorVehicleNo' => env('MOTOR_VEHICLE_NO', ''),
                        'TermsofDelivery' => $order->invoices->pluck('delivery_terms')[0],
                        'DescriptionofGoods' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'price' => $orderItem->measurement,
                                'rate' => $orderItem->price,
                                'amount' => $orderItem->quantity * $orderItem->price,
                            ];
                        }),
                        'id' => $order->id,
                        'HSNSAC' => env('HSN_SAC', ''),

                        'Per' => env('PER', ''),
                        'Balance' => $balance,
                        'InterestAmount' => round($interest_amount, 2),
                        'BalanceOnBooking' => round($balance_on_booking_amount, 2),
                        'Amount' => $totalAmount,
                        'CGST' => $centralTaxAmount,
                        'SGST' => $stateTaxAmount,
                        'TCSonSales' => env('TCS_ON_SALES', ''),
                        'Taxablevalue' => $completeAmount,
                        'TotalTaxAmount' => $totalTaxAmount,
                        'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
                        'invoice_date' => $order->invoices->pluck('invoice_date')[0],
                        'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'updated_at' => Carbon::parse($order->invoices->pluck('updated_at')[0])->format('d-m-Y'),
                        'invoice_id' => $order->invoices->pluck('invoice_id')[0],
                        'complete_amount' => $completeAmount,
                        'CGSTTAX' => $cgstPercent,
                        'SGSTTAX' => $sgstPercent,
                        'order_items' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'measurement' => $orderItem->measurement,
                            ];
                        }),
                    ]);

                    return $pdf->download('invoice.pdf');
                } else if ($PaymentMode == "cheque") {
                    //code for cheque start
                    $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
                    $userId = Auth::user()->id;
                    //Code for invoice start
                    $order = Order::with([
                        'invoices',
                        'address',
                        'orderItems',
                        'payments',
                    ])->where('id', $orderId)
                        ->where('user_id', $userId)
                        ->first();
                    if (
                        !isset($order->invoices) || $order->invoices()->count() === 0 ||
                        !isset($order->address) || $order->address()->count() === 0 ||
                        !isset($order->orderItems) || $order->orderItems()->count() === 0 ||
                        !isset($order->payments) || $order->payments()->count() === 0
                    ) {
                        return redirect()->route('order')->with('error', 'Order not found.');
                    }

                    $totalAmount = $order->amount;
                    $bookingAmount = $order->payments->where('data', 'Booking_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->value('transaction_amount');

                    // ii- Find tax amount
                    $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                    $sgstPercent = env('SGST', 9);
                    // Set your SGST percentage here (e.g., 9%)
                    $totalTaxAmount = ($totalAmount * ($cgstPercent + $sgstPercent) / 100) ?? 0;
                    $centralTaxAmount = ($totalAmount * $cgstPercent / 100) ?? 0;
                    $stateTaxAmount = ($totalAmount * $sgstPercent / 100) ?? 0;
                    // iii- Find the complete amount
                    $completeAmount = ($totalAmount + $totalTaxAmount) ?? 0;
                    $balance = $completeAmount - $bookingAmount;


                    //code for cheque end
                    //insert in invoice table
                    $invoice = Invoice::where('order_id', $orderId)->orderBy('created_at', 'desc')->first();
                    $invoice->amount = $totalAmount;
                    $invoice->totaltax = $totalTaxAmount;
                    $invoice->initial_amount = $bookingAmount;
                    $invoice->balance = $balance;
                    $invoice->save();

                    $finalbalancepayment = PaymentDataHandling::where('order_id', $orderId)->where('user_id', $userId)->where('data', 'Booking_Final_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->first();
                    if ($finalbalancepayment) {
                        $balance = $balance . " (Paid)";
                    }

                    $balance_on_booking_amount = Order::find($orderId)->balance_on_booking;
                    if ($balance_on_booking_amount) {
                        $balance = $completeAmount . " (Paid)";
                    }
                    //insert in invoice table
                    $pdf = PDF::loadView('components.invoice', [
                        'Advance_booking_amount' => $bookingAmount,
                        'IRN' => env('IRN', ''),
                        'AckNo' => $order->invoices->pluck('invoice_id')[0],
                        'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'PSIECAddress' => json_decode($order->address->psiec_address_ludhiana, true),
                        'shipping_name' => $order->address->shipping_name,
                        'shipping_address' => $order->address->shipping_address,
                        'shipping_state' => $order->address->shipping_state,
                        'shipping_district' => $order->address->shipping_district,
                        'shipping_city' => $order->address->shipping_city,
                        'shipping_zipcode' => $order->address->shipping_zipcode,
                        'shipping_gst_number' => $order->address->shipping_gst_number,
                        'shipping_gst_statecode' => $order->address->shipping_gst_statecode,
                        'billing_name' => $order->address->billing_name,
                        'billing_address' => $order->address->billing_address,
                        'billing_state' => $order->address->billing_state,
                        'billing_district' => $order->address->billing_district,
                        'billing_city' => $order->address->billing_city,
                        'billing_zipcode' => $order->address->billing_zipcode,
                        'billing_gst_number' => $order->address->billing_gst_number,
                        'billing_gst_statecode' => $order->address->billing_gst_statecode,
                        'InvoiceNo' => $order->invoices->pluck('invoice_id')[0],
                        'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'DeliveryNote' => env('DELIVERY_NOTE', ''),
                        'ModeTermsofPayment' => $order->payment_mode,
                        'OtherReferences' => env('OTHER_REFERENCES', ''),
                        'Buyers_Order_No' => $order->order_no,
                        'DatedOrderNo' => Carbon::parse($order->created_at)->format('d-m-Y'),
                        'DispatchDocNo' => env('DISPATCH_DOC_NO', ''),
                        'DeliveryNoteDate' => env('DELIVERYNOTEDATE', ''),
                        'DispatchedThrough' => env('DISPATCHED_THROUGH', ''),
                        'Destination' => env('DESTINATION', ''),
                        'BillofLandingLR-RRNo' => env('BILL_OF_LANDING_LR_RR_NO', ''),
                        'MotorVehicleNo' => env('MOTOR_VEHICLE_NO', ''),
                        'TermsofDelivery' => $order->invoices->pluck('delivery_terms')[0],
                        'DescriptionofGoods' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'price' => $orderItem->measurement,
                                'rate' => $orderItem->price,
                                'amount' => $orderItem->quantity * $orderItem->price,
                            ];
                        }),
                        'id' => $order->id,
                        'HSNSAC' => env('HSN_SAC', ''),

                        'Per' => env('PER', ''),
                        'Balance' => $balance,
                        'Amount' => $totalAmount,
                        'CGST' => $centralTaxAmount,
                        'SGST' => $stateTaxAmount,
                        'TCSonSales' => env('TCS_ON_SALES', ''),
                        'Taxablevalue' => $completeAmount,
                        'TotalTaxAmount' => $totalTaxAmount,
                        'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
                        'invoice_date' => $order->invoices->pluck('invoice_date')[0],
                        'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('d-m-Y'),
                        'updated_at' => Carbon::parse($order->invoices->pluck('updated_at')[0])->format('d-m-Y'),
                        'invoice_id' => $order->invoices->pluck('invoice_id')[0],
                        'complete_amount' => $completeAmount,
                        'BalanceOnBooking' => round($balance_on_booking_amount, 2),
                        'CGSTTAX' => $cgstPercent,
                        'SGSTTAX' => $sgstPercent,
                        'order_items' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'measurement' => $orderItem->measurement,
                            ];
                        }),
                    ]);
                    return $pdf->download('invoice.pdf');
                }
            } else {
                return redirect()->back()->withInput();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

}