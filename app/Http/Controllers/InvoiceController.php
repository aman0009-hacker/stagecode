<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentDataHandling;
use PDF;
use Carbon\Carbon;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        try {
            $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
            $userId = Auth::user()->id;
            //Code for invoice start
            $order = Order::with([
                'invoices',
                'address',
                'orderItems',
                'payments'
            ])->where('id', $orderId)
                ->where('user_id', $userId)
                ->first();
            // if (!$order) {
            //     return redirect()->route('order')->with('error', 'Order not found.');
            // }
              // Check if related data exists
        if (!$order->invoices || $order->invoices->isEmpty() ||
        !$order->address || $order->address->isEmpty() ||
        !$order->orderItems || $order->orderItems->isEmpty() ||
        !$order->payments || $order->payments->isEmpty()
    ) {
        return redirect()->route('order')->with('error', 'Order not found.');
    }
            //"{"psiec_biilling_name": "Punjab Small Industries & Export Corp. Ind.", "psiec_billing_area": "Area-B", "psiec_biilling_city": "Ludhiana", "psiec_biilling_gst": "03AABCP1602M1ZT", "psiec_biilling_state": "Punjab", "psiec_biilling_code": "03", "psiec_biilling_cin": "U51219CH9162SGC002427"}"
            // i- Find total amount
            //$totalAmount =
                // $order->payments->where('data', 'Registration_Amount')->where('payment_status', 'SUCCESS')->sum('transaction_amount')
                // + $order->payments->where('data', 'Booking_Amount')->where('payment_status', 'SUCCESS')->sum('transaction_amount')
                // + (
                //     $order->payments->where('data', 'Booking_Final_Amount')->where('payment_status', 'SUCCESS')->sum('transaction_amount')
                //     ?: ($order->payment_mode === 'cheque' ? $order->check_amount : 0)
                // );
             $totalAmount=   $order->payments
             ->where('data', 'Booking_Final_Amount')
             ->where('payment_status', 'SUCCESS')
             ->value('transaction_amount') ?: ($order->payment_mode === 'cheque' ? $order->check_amount : 0);
             $bookingAmount=$order->payments->where('data', 'Booking_Amount')->where('payment_status', 'SUCCESS')->value('transaction_amount');
             // ii- Find tax amount
            $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
            $sgstPercent = env('SGST', 9);
            ; // Set your SGST percentage here (e.g., 9%)
            $totalTaxAmount = ($totalAmount * ($cgstPercent + $sgstPercent) / 100) ?? 0;
            $centralTaxAmount = ($totalAmount * $cgstPercent / 100) ?? 0;
            $stateTaxAmount = ($totalAmount * $sgstPercent / 100) ?? 0;
            // iii- Find the complete amount
            $completeAmount = ($totalAmount + $totalTaxAmount) ?? 0;
            $balance= $totalAmount-$bookingAmount;
            // Prepare the data for the response
            // $invoiceData = [
            //     'IRN' => env('IRN', ''),
            //     'AckNo' => $order->invoices->pluck('invoice_id')[0],
            //     'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d H:i'),
            //     'PSIECAddress' => json_decode($order->address->psiec_address_ludhiana, true),
            //     // foreach ($psiecAddress as $key => $value) {
            //     //     // $key will contain the key, and $value will contain the corresponding value
            //     //     echo "Key: $key, Value: $value <br>";
            //     // }
            //     // Key: psiec_biilling_name, Value: Punjab Small Industries & Export Corp. Ind.
            //     // Key: psiec_billing_area, Value: Area-B
            //     // Key: psiec_biilling_city, Value: Ludhiana
            //     // Key: psiec_biilling_gst, Value: 03AABCP1602M1ZT
            //     // Key: psiec_biilling_state, Value: Punjab
            //     // Key: psiec_biilling_code, Value: 03
            //     // Key: psiec_biilling_cin, Value: U51219CH9162SGC002427
            //     'shipping_name' => $order->address->shipping_name,
            //     'shipping_address' => $order->address->shipping_address,
            //     'shipping_state' => $order->address->shipping_state,
            //     'shipping_district' => $order->address->shipping_district,
            //     'shipping_city' => $order->address->shipping_city,
            //     'shipping_zipcode' => $order->address->shipping_zipcode,
            //     'shipping_gst_number' => $order->address->shipping_gst_number,
            //     'shipping_gst_statecode' => $order->address->shipping_gst_statecode,
            //     'billing_name' => $order->address->billing_name,
            //     'billing_address' => $order->address->billing_address,
            //     'billing_state' => $order->address->billing_state,
            //     'billing_district' => $order->address->billing_district,
            //     'billing_city' => $order->address->billing_city,
            //     'billing_zipcode' => $order->address->billing_zipcode,
            //     'billing_gst_number' => $order->address->billing_gst_number,
            //     'billing_gst_statecode' => $order->address->billing_gst_statecode,
            //     'InvoiceNo' => $order->invoices->pluck('invoice_id')[0],
            //     'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
            //     'DeliveryNote' => env('DELIVERY_NOTE', ''),
            //     'ModeTermsofPayment' => $order->payment_mode,
            //     'OtherReferences' => env('OTHER_REFERENCES', ''),
            //     //'ReferenceNoDate' => $order->invoices->invoice_id . " " . $order->invoices->created_at,
            //     'Buyers_Order_No' => $order->id,
            //     'DatedOrderNo' => Carbon::parse($order->created_at)->format('Y-m-d') ,
            //     'DispatchDocNo' => env('DISPATCH_DOC_NO', ''),
            //     'DeliveryNoteDate' => env('DELIVERYNOTEDATE', ''),
            //     'DispatchedThrough' => env('DISPATCHED_THROUGH', ''),
            //     'Destination' => env('DESTINATION', ''),
            //     'BillofLandingLRRRNo' => env('BILL_OF_LANDING_LR_RR_NO', ''),
            //     'MotorVehicleNo' => env('MOTOR_VEHICLE_NO', ''),
            //     'TermsofDelivery' => $order->invoices->pluck('delivery_terms')[0],
            //     'DescriptionofGoods' => $order->orderItems->map(function ($orderItem) {
            //         return [
            //             'id' => $orderItem->id,
            //             'category_name' => $orderItem->category_name,
            //             'quantity' => $orderItem->quantity,
            //             'measurement' => $orderItem->measurement,
            //         ];
            //     }),
            //     'id' => $order->id,
            //     'HSNSAC' => env('HSN_SAC', ''),
            //     'Rate' => env('RATE', ''),
            //     'Per' => env('PER', ''),
            //     'Amount' => $totalAmount,
            //     'CGST' => $centralTaxAmount,
            //     'SGST' => $stateTaxAmount,
            //     'TCSonSales' => env('TCS_ON_SALES', ''),
            //     'Taxablevalue' => $completeAmount,
            //     'TotalTaxAmount' => $totalTaxAmount,
            //     'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
            //     'invoice_date' => $order->invoices->pluck('invoice_date')[0],
            //     'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
            //     'updated_at' => $order->invoices->pluck('updated_at')[0],
            //     'invoice_id' => $order->invoices->pluck('invoice_id')[0],
            //     'complete_amount' => $completeAmount,
            //     'CGSTTAX' => $cgstPercent,
            //     'SGSTTAX' => $sgstPercent,
            //     'order_items' => $order->orderItems->map(function ($orderItem) {
            //         return [
            //             'id' => $orderItem->id,
            //             'category_name' => $orderItem->category_name,
            //             'quantity' => $orderItem->quantity,
            //             'measurement' => $orderItem->measurement,
            //         ];
            //     }),
            // ];
            //return response()->json($invoiceData);
            //Code for invoice done
            if (isset($orderId) && !empty($orderId)) {
                //dd(Crypt::decrypt($orderIDInvoice));
                $pdf = PDF::loadView('components.invoice', [
                    'IRN' => env('IRN', ''),
                    'AckNo' => $order->invoices->pluck('invoice_id')[0],
                    'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
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
                    'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                    'DeliveryNote' => env('DELIVERY_NOTE', ''),
                    'ModeTermsofPayment' => $order->payment_mode,
                    'OtherReferences' => env('OTHER_REFERENCES', ''),
                    //'ReferenceNoDate' => $order->invoices->invoice_id . " " . $order->invoices->created_at,
                    'Buyers_Order_No' => $order->id,
                    'DatedOrderNo' => Carbon::parse($order->created_at)->format('Y-m-d'),    
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
                        ];
                    }),
                    'id' => $order->id,
                    'HSNSAC' => env('HSN_SAC', ''),
                    'Rate' => env('RATE', ''),
                    'Per' => env('PER', ''),
                    'Balance'=>$balance,
                    'Amount' => $totalAmount,
                    'CGST' => $centralTaxAmount,
                    'SGST' => $stateTaxAmount,
                    'TCSonSales' => env('TCS_ON_SALES', ''),
                    'Taxablevalue' => $completeAmount,
                    'TotalTaxAmount' => $totalTaxAmount,
                    'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
                    'invoice_date' => $order->invoices->pluck('invoice_date')[0],
                    'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                    'updated_at' => Carbon::parse($order->invoices->pluck('updated_at')[0])->format('Y-m-d'),
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
            }

        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

}