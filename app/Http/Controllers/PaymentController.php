<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EazyPayController;
use App\Models\Address;
use App\Models\Attachment;
use App\Models\City;
use App\Models\Order;
use App\Models\PaymentDataHandling;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public $encryption_key;
    public $EAZYPAY_BASE_URL;
    public $EAZYPAY_BASE_URL_VERIFY;
    public $storeValue = 1;
    public $arr = [];
    //public $UserID;

    public function __construct()
    {
        $this->encryption_key = config('eazypay.encryption_key');
        $this->EAZYPAY_BASE_URL = env('EAZYPAY_BASE_URL', '');
        $this->EAZYPAY_BASE_URL_VERIFY = env('EAZYPAY_BASE_URL_VERIFY', '');
    }

    public function paymentResponse(Request $request)
    {

        try {
            if (isset($request) && !empty($request) && isset($request['Total_Amount']) && isset($request['Response_Code']) && $request['Response_Code'] == "E000") {
                $data = array(
                    'Response_Code' => $request['Response_Code'],
                    'Unique_Ref_Number' => $request['Unique_Ref_Number'],
                    'Service_Tax_Amount' => $request['Service_Tax_Amount'],
                    'Processing_Fee_Amount' => $request['Processing_Fee_Amount'],
                    'Total_Amount' => $request['Total_Amount'],
                    'Transaction_Amount' => $request['Transaction_Amount'],
                    'Transaction_Date' => $request['Transaction_Date'],
                    'Interchange_Value' => $request['Interchange_Value'],
                    'TDR' => $request['TDR'],
                    'Payment_Mode' => $request['Payment_Mode'],
                    'SubMerchantId' => $request['SubMerchantId'],
                    'ReferenceNo' => $request['ReferenceNo'],
                    'ID' => $request['ID'],
                    'RS' => $request['RS'],
                    'TPS' => $request['TPS'],
                    'mandatory_fields' => $request['mandatory_fields'],
                    'optional_fields' => $request['optional_fields'],
                    'RSV' => $request['RSV'],

                );
                //code to send info to DB
                $paymentHandling = PaymentDataHandling::where('reference_no', $request['ReferenceNo'])->first();
                $paymentHandling->merchant_id = $request['ID'] ?? '';
                $paymentHandling->encryption_key = config('eazypay.encryption_key') ?? '';
                $paymentHandling->sub_merchant_id = $request['SubMerchantId'] ?? '';
                $paymentHandling->reference_no = $request['ReferenceNo'] ?? '';
                $paymentHandling->paymode = $request['Payment_Mode'] ?? '';
                $paymentHandling->return_url = config('eazypay.return_url') ?? '';
                $paymentHandling->eazy_pay_base_url = env('EAZYPAY_BASE_URL', '') ?? '';
                $paymentHandling->transaction_id = $request['Unique_Ref_Number'] ?? '';
                $paymentHandling->transaction_amount = $request['Transaction_Amount'] ?? '';

                $paymentHandling->transaction_date = Carbon::createFromFormat('d-m-Y H:i:s', $request['Transaction_Date'])->format('Y-m-d H:i:s');
                $paymentHandling->amount = $request['Total_Amount'] ?? '';

                $paymentHandling->payment_status_code = $request['Response_Code'] ?? '';

                $dbResponse = $paymentHandling->save();
                if ($dbResponse) {
                }
                //code to send info to DB
                $verification_key = $data['ID'] . '|' . $data['Response_Code'] . '|' . $data['Unique_Ref_Number'] . '|' .
                    $data['Service_Tax_Amount'] . '|' . $data['Processing_Fee_Amount'] . '|' . $data['Total_Amount'] . '|' .
                    $data['Transaction_Amount'] . '|' . $data['Transaction_Date'] . '|' . $data['Interchange_Value'] . '|' .
                    $data['TDR'] . '|' . $data['Payment_Mode'] . '|' . $data['SubMerchantId'] . '|' . $data['ReferenceNo'] . '|' .
                    $data['TPS'] . '|' . $this->encryption_key;
                $encrypted_message = hash('sha512', $verification_key);
                if ($encrypted_message == $data['RS']) {
<<<<<<< HEAD
=======

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
                    // new code to verify
                    $request = new Request([
                        'merchantId' => $request['ID'],
                        'referenceNo' => $request['ReferenceNo'],
                        'transactionId' => $request['Unique_Ref_Number'],

                    ]);
                    $returnVal = $this->paymentProcessVerify($request);
                    if (isset($returnVal) && $returnVal == "SUCCESS") {
                        $encryptedResponse = Crypt::encrypt([
                            'paymentResponse' => 'SUCCESS',
                            'reference_no' => $data['ReferenceNo'],
                            'transaction_id' => $data['Unique_Ref_Number'],
                            'transactionAmount' => $data['Transaction_Amount'],
                        ]);
                        $paymentData = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Registration_Amount')
                            ->first();
                        $paymentDataOrder = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Amount')
                            ->first();
                        $paymentDataOrderFinal = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Final_Amount')
                            ->first();
                        if ($paymentData) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('user_id');
                            $user = User::find($id);
                            $user->comment = "Done";
                            $user->save();
                            return redirect()->route('congratulations', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrder) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('order_id');
                            $order = Order::find($id);
                            $order->payment_status = "verified";
                            $order->save();
                            return redirect()->route('booking', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrderFinal) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('order_id');
                            $order = Order::find($id);
                            $order->final_payment_status = "verified";
                            $order->payment_mode = "online";
                            $order->save();
                            return redirect()->route('order', ['encryptedResponse' => $encryptedResponse]);
                        }

                    } else {
                        $encryptedResponse = Crypt::encrypt([
                            'paymentResponse' => 'FAILURE',
                            'reference_no' => $data['ReferenceNo'],
                            'transaction_id' => $data['Unique_Ref_Number'],
                        ]);
<<<<<<< HEAD
=======

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
                        $paymentData = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Registration_Amount')
                            ->first();
                        $paymentDataOrder = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Amount')
                            ->first();
                        $paymentDataOrderFinal = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Final_Amount')
                            ->first();
                        if ($paymentData) {
                            return redirect()->route('payment.process', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrder) {

                            return redirect()->route('orderProcess', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrderFinal) {

                            return redirect()->route('payment.complete.process', ['encryptedResponse' => $encryptedResponse]);
                        }

                    }
                } else {

                }
            } else if (isset($request) && !empty($request) && isset($request['Response_Code'])) {
                $data = array(
                    'Response_Code' => $request['Response_Code'],
                    'Unique_Ref_Number' => $request['Unique_Ref_Number'],
                    'Service_Tax_Amount' => $request['Service_Tax_Amount'],
                    'Processing_Fee_Amount' => $request['Processing_Fee_Amount'],
                    'Total_Amount' => $request['Total_Amount'],
                    'Transaction_Amount' => $request['Transaction_Amount'],
                    'Transaction_Date' => $request['Transaction_Date'],
                    'Interchange_Value' => $request['Interchange_Value'],
                    'TDR' => $request['TDR'],
                    'Payment_Mode' => $request['Payment_Mode'],
                    'SubMerchantId' => $request['SubMerchantId'],
                    'ReferenceNo' => $request['ReferenceNo'],
                    'ID' => $request['ID'],
                    'RS' => $request['RS'],
                    'TPS' => $request['TPS'],
                    'mandatory_fields' => $request['mandatory_fields'],
                    'optional_fields' => $request['optional_fields'],
                    'RSV' => $request['RSV'],
                );
                //code to send info to DB
                $paymentHandling = PaymentDataHandling::where('reference_no', $request['ReferenceNo'])->first();
                $paymentHandling->merchant_id = $request['ID'] ?? '';
                $paymentHandling->encryption_key = config('eazypay.encryption_key') ?? '';
                $paymentHandling->sub_merchant_id = $request['SubMerchantId'] ?? '';
                $paymentHandling->reference_no = $request['ReferenceNo'] ?? '';
                $paymentHandling->paymode = $request['Payment_Mode'] ?? '';
                $paymentHandling->return_url = config('eazypay.return_url') ?? '';
                $paymentHandling->eazy_pay_base_url = env('EAZYPAY_BASE_URL', '') ?? '';
                $paymentHandling->transaction_id = $request['Unique_Ref_Number'] ?? '';
                $paymentHandling->transaction_amount = $request['Transaction_Amount'] ?? '';
                $paymentHandling->transaction_date = Carbon::createFromFormat('d-m-Y H:i:s', $request['Transaction_Date'])->format('Y-m-d H:i:s');
<<<<<<< HEAD
                $paymentHandling->amount = $request['Total_Amount'] ?? '';
                $paymentHandling->payment_status_code = $request['Response_Code'] ?? '';
=======

                $paymentHandling->amount = $request['Total_Amount'] ?? '';

                $paymentHandling->payment_status_code = $request['Response_Code'] ?? '';

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
                $dbResponse = $paymentHandling->save();
                if ($dbResponse) {
                    $request = new Request([
                        'merchantId' => $request['ID'],
                        'referenceNo' => $request['ReferenceNo'],
                        'transactionId' => $request['Unique_Ref_Number'],

                    ]);
                    $returnVal = $this->paymentProcessVerify($request);
                    if (isset($returnVal) && $returnVal == "SUCCESS") {
                        $encryptedResponse = Crypt::encrypt([
                            'paymentResponse' => 'SUCCESS',
                            'reference_no' => $data['ReferenceNo'],
                            'transaction_id' => $data['Unique_Ref_Number'],
                            'transactionAmount' => $data['Transaction_Amount'],
                        ]);
                        $paymentData = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Registration_Amount')
                            ->first();
                        $paymentDataOrder = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Amount')
                            ->first();
                        $paymentDataOrderFinal = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Final_Amount')
                            ->first();
                        if ($paymentData) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('user_id');
                            $user = User::find($id);
                            $user->comment = "Done";
                            $user->save();
                            return redirect()->route('congratulations', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrder) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('order_id');
                            $order = Order::find($id);
                            $order->payment_status = "verified";
                            $order->save();
                            return redirect()->route('booking', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrderFinal) {
                            $id = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])->value('order_id');
                            $order = Order::find($id);
                            $order->final_payment_status = "verified";
                            $order->save();
                            return redirect()->route('order', ['encryptedResponse' => $encryptedResponse]);
                        }
<<<<<<< HEAD
=======

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
                    } else {
                        $encryptedResponse = Crypt::encrypt([
                            'paymentResponse' => 'FAILURE',
                            'reference_no' => $data['ReferenceNo'],
                            'transaction_id' => $data['Unique_Ref_Number'],
                        ]);

                        $paymentData = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Registration_Amount')
                            ->first();
                        $paymentDataOrder = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Amount')
                            ->first();
                        $paymentDataOrderFinal = PaymentDataHandling::where('reference_no', $data['ReferenceNo'])
                            ->where('data', 'Booking_Final_Amount')
                            ->first();
                        if ($paymentData) {
                            return redirect()->route('payment.process', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrder) {

                            return redirect()->route('orderProcess', ['encryptedResponse' => $encryptedResponse]);
                        } else if ($paymentDataOrderFinal) {

                            return redirect()->route('payment.complete.process', ['encryptedResponse' => $encryptedResponse]);
                        }

                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            dd($ex->getMessage());
        }
    }

    public function response_code($code)
    {
        $errorCodes = array(
            'E000' => 'Payment Successful',
            'E001' => 'Unauthorized Payment Mode',
            'E002' => 'Unauthorized Key',
            'E003' => 'Unauthorized Packet',
            'E004' => 'Unauthorized Merchant',
            'E005' => 'Unauthorized Return URL',
            'E006' => 'Transaction Already Paid, Received Confirmation from the Bank, Yet to Settle the transaction with the Bank',
            'E007' => 'Transaction Failed',
            'E008' => 'Failure from Third Party due to Technical Error',
            'E009' => 'Bill Already Expired',
            'E0031' => 'Mandatory fields coming from merchant are empty',
            'E0032' => 'Mandatory fields coming from database are empty',
            'E0033' => 'Payment mode coming from merchant is empty',
            'E0034' => 'PG Reference number coming from merchant is empty',
            'E0035' => 'Sub merchant id coming from merchant is empty',
            'E0036' => 'Transaction amount coming from merchant is empty',
            'E0037' => 'Payment mode coming from merchant is other than 0 to 9',
            'E0038' => 'Transaction amount coming from merchant is more than 9 digit length',
            'E0039' => 'Mandatory value Email in wrong format',
            'E00310' => 'Mandatory value mobile number in wrong format',
            'E00311' => 'Mandatory value amount in wrong format',
            'E00312' => 'Mandatory value Pan card in wrong format',
            'E00313' => 'Mandatory value Date in wrong format',
            'E00314' => 'Mandatory value String in wrong format',
            'E00315' => 'Optional value Email in wrong format',
            'E00316' => 'Optional value mobile number in wrong format',
            'E00317' => 'Optional value amount in wrong format',
            'E00318' => 'Optional value pan card number in wrong format',
            'E00319' => 'Optional value date in wrong format',
            'E00320' => 'Optional value string in wrong format',
            'E00321' => 'Request packet mandatory columns is not equal to mandatory columns set in enrolment or optional columns are not equal to optional columns length set in enrolment',
            'E00322' => 'Reference Number Blank',
            'E00323' => 'Mandatory Columns are Blank',
            'E00324' => 'Merchant Reference Number and Mandatory Columns are Blank',
            'E00325' => 'Merchant Reference Number Duplicate',
            'E00326' => 'Sub merchant id coming from merchant is non numeric',
            'E00327' => 'Cash Challan Generated',
            'E00328' => 'Cheque Challan Generated',
            'E00329' => 'NEFT Challan Generated',
            'E00330' => 'Transaction Amount and Mandatory Transaction Amount mismatch in Request URL',
            'E00331' => 'UPI Transaction Initiated Please Accept or Reject the Transaction',
            'E00332' => 'Challan Already Generated, Please re-initiate with unique reference number',
            'E00333' => 'Referer value is null / invalid Referer',
            'E00334' => 'Value of Mandatory parameter Reference No and Request Reference No are not matched',
            'E00335' => 'Payment has been cancelled',
            'E0801' => 'FAIL',
            'E0802' => 'User Dropped',
            'E0803' => 'Canceled by user',
            'E0804' => 'User Request arrived but card brand not supported',
            'E0805' => 'Checkout page rendered Card function not supported',
            'E0806' => 'Forwarded / Exceeds withdrawal amount limit',
            'E0807' => 'PG Fwd Fail / Issuer Authentication Server failure',
            'E0808' => 'Session expiry / Failed Initiate Check, Card BIN not present',
            'E0809' => 'Reversed / Expired Card',
            'E0810' => 'Unable to Authorize',
            'E0811' => 'Invalid Response Code or Guide received from Issuer',
            'E0812' => 'Do not honor',
            'E0813' => 'Invalid transaction',
            'E0814' => 'Not Matched with the entered amount',
            'E0815' => 'Not sufficient funds',
            'E0816' => 'No Match with the card number',
            'E0817' => 'General Error',
            'E0818' => 'Suspected fraud',
            'E0819' => 'User Inactive',
            'E0820' => 'ECI 1 and ECI6 Error for Debit Cards and Credit Cards',
            'E0821' => 'ECI 7 for Debit Cards and Credit Cards',
            'E0822' => 'System error. Could not process transaction',
            'E0823' => 'Invalid 3D Secure values',
            'E0824' => 'Bad Track Data',
            'E0825' => 'Transaction not permitted to cardholder',
            'E0826' => 'Rupay timeout from issuing bank',
            'E0827' => 'OCEAN for Debit Cards and Credit Cards',
            'E0828' => 'E-commerce decline',
            'E0829' => 'This transaction is already in process or already processed',
            'E0830' => 'Issuer or switch is inoperative',
            'E0831' => 'Exceeds withdrawal frequency limit',
            'E0832' => 'Restricted card',
            'E0833' => 'Lost card',
            'E0834' => 'Communication Error with NPCI',
            'E0835' => 'The order already exists in the database',
            'E0836' => 'General Error Rejected by NPCI',
            'E0837' => 'Invalid credit card number',
            'E0838' => 'Invalid amount',
            'E0839' => 'Duplicate Data Posted',
            'E0840' => 'Format error',
            'E0841' => 'SYSTEM ERROR',
            'E0842' => 'Invalid expiration date',
            'E0843' => 'Session expired for this transaction',
            'E0844' => 'FRAUD - Purchase limit exceeded',
            'E0845' => 'Verification decline',
            'E0846' => 'Compliance error code for issuer',
            'E0847' => 'Caught ERROR of type:[ System.Xml.XmlException ] . strXML is not a valid XML string',
            'E0848' => 'Incorrect personal identification number',
            'E0849' => 'Stolen card',
            'E0850' => 'Transaction timed out, please retry',
            'E0851' => 'Failed in Authorize - PE',
            'E0852' => 'Cardholder did not return from Rupay',
            'E0853' => 'Missing Mandatory Field(s)The field card_number has exceeded the maximum length of',
            'E0854' => 'Exception in CheckEnrollmentStatus: Data at the root level is invalid. Line 1, position 1.',
            'E0855' => 'CAF status = 0 or 9',
            'E0856' => '412',
            'E0857' => 'Allowable number of PIN tries exceeded',
            'E0858' => 'No such issuer',
            'E0859' => 'Invalid Data Posted',
            'E0860' => 'PREVIOUSLY AUTHORIZED',
            'E0861' => 'Cardholder did not return from ACS',
            'E0862' => 'Duplicate transmission',
            'E0863' => 'Wrong transaction state',
            'E0864' => 'Card acceptor contact acquirer',
        );
        return $errorCodes[$code];
    }

    public function paymentData(Request $request)
    {
        dd($request);
    }

    public function paymentProcessVerify(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'merchantId' => 'required',
                'referenceNo' => 'sometimes|required_without:transactionId',
                'transactionId' => 'sometimes|required_without:referenceNo',
            ]);
            $merchantId = $request->input('merchantId');
            $referenceNo = $request->input('referenceNo');
            $transactionId = $request->input('transactionId');
            if (isset($merchantId) && !empty($merchantId)) {
                if (isset($referenceNo) && !empty($referenceNo)) {
                    $this->EAZYPAY_BASE_URL_VERIFY = $this->EAZYPAY_BASE_URL_VERIFY . 'ezpaytranid=&amount=&paymentmode=&merchantid=' . $merchantId . '&trandate=&pgreferenceno=' . $referenceNo;
                    $response = Http::get($this->EAZYPAY_BASE_URL_VERIFY);
                    if ($response->successful()) {
                        $responseData = $response->body();
                        // Extract the status from the response
                        $status = '';
                        parse_str($responseData, $parsedResponse);
                        if (isset($parsedResponse['status'])) {
                            $status = $parsedResponse['status'];
                            //set status of payment in DB
                            $paymentHandling = PaymentDataHandling::where('reference_no', $referenceNo)->first();
                            $paymentHandling->payment_status = $status ?? '';
                            $queryResponse = $paymentHandling->save();
                            if (isset($queryResponse) && isset($status) && ($status == "RIP" || $status == "SIP" || $status == "SUCCESS")) {
                                return "SUCCESS";
                            } else {
                                return "OTHER";
                            }
                        }
                    } else {
                        return "not success";
                    }
                } else if (isset($transactionId) && !empty($transactionId)) {
                    $this->EAZYPAY_BASE_URL_VERIFY = $this->EAZYPAY_BASE_URL_VERIFY . 'ezpaytranid=' . $transactionId . '&amount=&paymentmode=&merchantid=' . $merchantId . '&trandate=&pgreferenceno=';
                    $response = Http::get($this->EAZYPAY_BASE_URL_VERIFY);
                    if ($response->successful()) {
                        $responseData = $response->body();
                        // Extract the status from the response
                        $status = '';
                        parse_str($responseData, $parsedResponse);
                        if (isset($parsedResponse['status'])) {
                            $status = $parsedResponse['status'];
                            //set status of payment in DB
                            $paymentHandling = PaymentDataHandling::where('transaction_id', $transactionId)->first();
                            $paymentHandling->payment_status = $status ?? '';
                            $queryResponse = $paymentHandling->save();
                            if (isset($queryResponse) && isset($status) && ($status == "RIP" || $status == "SIP" || $status == "SUCCESS")) {
                                return "SUCCESS";
                            } else {
                                return "OTHER";
                            }
                        }

                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function paymentVerify(Request $request)
    {
        return view('components.payment-verify');
    }

    public function paymentProcess(Request $request)
    {

        try {
            if (Auth::check()) {
                Session::forget('GLOBALUSERID');
                Session::put('GLOBALUSERID', Auth::user()->id ?? '');
                $amount = "";
                $validator = Validator::make($request->all(), [
                    'amountValue' => ['required', 'in:10000'],
                ]);
                if ($validator->fails()) {
                    $amount = 10000;
                } else {
                    $amount = $request->input('amountValue');
                }

                $reference_no = time() . Str::random(5);
                $paymentDataHandling = new PaymentDataHandling();
                $paymentDataHandling->reference_no = $reference_no;
                $paymentDataHandling->user_id = Auth::user()->id ?? '';
                $paymentDataHandling->data = "Registration_Amount";
                $paymentDataHandling->user_amount = $amount;
                $paymentDataHandling->save();
                $optionalField = null;
                $base = new EazyPayController();
                $url = $base->getPaymentUrl($amount, $reference_no, $optionalField);

                return redirect()->to($url);
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function paymentProcessOrder(Request $request)
    {
        try {
            Session::forget('GLOBALUSERID');
            Session::put('GLOBALUSERID', Auth::user()->id ?? '');
            $amount = "";
            $validator = Validator::make($request->all(), [
                'amountOrder' => ['required', 'in:200000'],
            ]);
            if ($validator->fails()) {
                $amount = 200000;
            } else {
                $amount = $request->input('amountOrder');
            }

            $reference_no = time() . Str::random(5);
            $paymentDataHandling = new PaymentDataHandling();
            $paymentDataHandling->reference_no = $reference_no;
            $paymentDataHandling->user_id = Auth::user()->id ?? '';
            $paymentDataHandling->data = "Booking_Amount";
            $paymentDataHandling->user_amount = $amount;
            $paymentDataHandling->order_id = Session::get('txtOrderGlobalModalID') ?? '';
            $paymentDataHandling->save();
            $optionalField = null;
            $base = new EazyPayController();
            $url = $base->getPaymentUrl($amount, $reference_no, $optionalField);
            return redirect()->to($url);
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function index(Request $request)
    {
        return view('components.payment-process');
    }

    public function paymentComplete(Request $request)
    {
        $address = Address::where('user_id', Auth::user()->id)->latest()->first();
       

        $states = State::all();
        $txtOrderGlobalModalCompleteID = $request->input('txtOrderGlobalModalCompleteID');
        Session::forget('txtOrderGlobalModalCompleteID');
        Session::put('txtOrderGlobalModalCompleteID', $txtOrderGlobalModalCompleteID ?? '');
        Session::put('change_the_code', $txtOrderGlobalModalCompleteID ?? ''); //generate new session for order id
        $userId = Auth::user()->id;
        $document = Attachment::where('user_id', $userId)->get();
        foreach ($document as $singleDocument) {
            if ($singleDocument->file_type === "gstfile") {
                $gstfile = $singleDocument->fileno;
            }
        }
        $amount = Order::where('id', $txtOrderGlobalModalCompleteID)->value('amount');
        $bookingAmount = PaymentDataHandling::where('order_id', $txtOrderGlobalModalCompleteID)
            ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
            ->where('user_id', $userId)
            ->value('transaction_amount');

        /*-------logic for giving final payment amount in the input----starts---*/
        if ($amount && $bookingAmount) {
            $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
            $sgstPercent = env('SGST', 9); // Set your SGST percentage here (e.g., 9%)


            $totalTaxAmount = ($amount * ($cgstPercent + $sgstPercent) / 100) ?? 0;

            $amountToPay = ($amount + $totalTaxAmount) - $bookingAmount;
        } else {
            $amountToPay = '';
        }
        /*-------logic for giving final payment amount in the input----starts---*/

        $orderdata = order::where('id', $txtOrderGlobalModalCompleteID)->value('balance_on_booking');
        if (!$orderdata) {
            $orderdata = null;
        }
        return view('components.order-complete-process', compact('txtOrderGlobalModalCompleteID', 'states', 'address', 'gstfile', 'orderdata', 'amountToPay'));
    }

    public function getUserId()
    {
        $userId = Auth::user()->id;
        return $userId;
    }

    public function paymentCompleteProcessAddress(Request $request)
    {

        try {

            $validator1 = Validator::make(
                $request->all(),
                [
                    'shipping_name' => 'required',
                    'shipping_address' => 'required',
                    'shipping_state' => 'required',
                    'shipping_district' => 'required',
                    'shipping_city' => 'required',
                    'shipping_zipcode' => 'required|min:6|max:6',
                    'shipping_gst_number' => 'required|min:15|max:15',
                    'shipping_gst_statecode' => 'required|min:2|max:2',
                ]
            );
            if ($validator1->fails()) {
                // Validation failed, handle the error
                return response()->json(['success' => false, 'message' => "error", 'data' => 'data'], 400);

            }
            if ((!$request->has('is_same'))) {
                $validator2 = Validator::make(
                    $request->all(),
                    [
                        'billing_name' => 'required',
                        'billing_address' => 'required',
                        'billing_district' => 'required',
                        'billing_state' => 'required',
                        'billing_city' => 'required',
                        'billing_zipcode' => 'required|min:6|max:6',
                        'billing_gst_number' => 'required|min:15|max:15',
                        'billing_gst_statecode' => 'required|min:2|max:2',
                    ]
                );

                if ($validator2->fails()) {
                    // Validation failed, handle the error
                    return response()->json(['success' => false, 'message' => "error", 'data' => 'data'], 400);

                }
            }
            $orderId = $request->input('txtOrderGlobalModalCompleteIDValue') ?? '';
            //save order id
            Session::forget('txtOrderGlobalModalCompleteIDAlternative');
            Session::put('txtOrderGlobalModalCompleteIDAlternative', $orderId ?? '');
            //save order id

            $shippingState = State::where('id', $request->shipping_state)->first();
            if (isset($orderId) && !empty($orderId)) {
                $address = new Address();
                $address->user_id = Auth::user()->id ?? '';
                $address->order_id = $orderId;
                $address->shipping_name = $request->shipping_name;
                $address->shipping_address = $request->shipping_address;
                $address->shipping_state = $shippingState->name;
                $address->shipping_district = $request->shipping_district;
                $address->shipping_city = $request->shipping_city;
                $address->shipping_zipcode = $request->shipping_zipcode;
                $address->shipping_gst_number = $request->shipping_gst_number;
                $address->shipping_gst_statecode = $request->shipping_gst_statecode;
                if (($request->has('is_same'))) {
                    $address->billing_name = $request->shipping_name;
                    $address->billing_address = $request->shipping_address;
                    $address->billing_state = $shippingState->name;
                    $address->billing_district = $request->shipping_district;
                    $address->billing_city = $request->shipping_city;
                    $address->billing_zipcode = $request->shipping_zipcode;
                    $address->billing_gst_number = $request->shipping_gst_number;
                    $address->billing_gst_statecode = $request->shipping_gst_statecode;
                    $address->save();
                } else {
                    $billingState = State::where('id', $request->billing_state)->first();

                    $address->billing_name = $request->billing_name;
                    $address->billing_address = $request->billing_address;
                    $address->billing_state = $billingState->name;
                    $address->billing_district = $request->billing_district;
                    $address->billing_city = $request->billing_city;
                    $address->billing_zipcode = $request->billing_zipcode;
                    $address->billing_gst_number = $request->billing_gst_number;
                    $address->billing_gst_statecode = $request->billing_gst_statecode;
                    $address->save();

                }
            }
            if (Auth::check()) {
                $addressId = Address::where('user_id', Auth::user()->id)->get()->last();
                if (isset($orderId) && !empty($orderId)) {
                    $addressToOrder = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->update(['address_id' => $addressId->id]);

                    return redirect()->back();
                } else {
                    return response()->json(['success' => false, 'message' => "no_order", 'data' => 'data'], 400);
                }
            }
        } catch (\Throwable $ex) {
<<<<<<< HEAD
            Log::info($ex->getMessage());

=======

            dd($ex->getMessage());
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
        }
    }

    public function paymentProcessOrderComplete(Request $request)
    {
        try {
            $paymentMode = $request->input('paymentMode');
            $amountOrderFinal = $request->input('amountOrderFinal');
            if (isset($paymentMode) && !empty($paymentMode) && $paymentMode == "online" && isset($amountOrderFinal) && !empty($amountOrderFinal)) {
                try {
                    $validator = Validator::make($request->all(), [
                        'paymentMode' => 'required',
                        'amountOrderFinal' => 'required',
                    ]);
                    if ($validator->fails()) {
                        // Validation failed, handle the error
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    Session::forget('GLOBALUSERID');
                    Session::put('GLOBALUSERID', Auth::user()->id ?? '');

                    $amount = $amountOrderFinal;
                    //$reference_no = rand(1111, 9999);
                    $reference_no = time() . Str::random(5);
                    $paymentDataHandling = new PaymentDataHandling();
                    $paymentDataHandling->reference_no = $reference_no;
                    $paymentDataHandling->user_id = Auth::user()->id ?? '';
                    $paymentDataHandling->data = "Booking_Final_Amount";
                    $paymentDataHandling->user_amount = $amount;
                    $paymentDataHandling->order_id = Session::get('txtOrderGlobalModalCompleteIDAlternative') ?? '';
                    $data = $paymentDataHandling->save();
                    if ($data) {
                        $main = order::find(Session::get('txtOrderGlobalModalCompleteIDAlternative'));
                        $main->payment_mode = "online";
                        $main->save();
                        $optionalField = null;
                        $base = new EazyPayController();
                        $url = $base->getPaymentUrl($amount, $reference_no, $optionalField);
                        return redirect()->to($url);
                    }

                } catch (\Throwable $ex) {
                    Log::info($ex->getMessage());
                }
            } else if (isset($paymentMode) && !empty($paymentMode) && $paymentMode == "cheque") {
                $member_at = "";
                $userID = Auth::user()->id ?? '';
                if (isset($userID) && !empty($userID)) {
                    $member_at = User::find($userID)->member_at;
                } else {
                    return redirect()->route('login');
                }
                if (isset($member_at) && !empty($member_at)) {
                    $customerStartDate = Carbon::parse($member_at);
                    $threeYearsAgo = Carbon::now()->subYears(3);
                    if ($customerStartDate <= $threeYearsAgo) {
                        $txtOrderGlobalModalCompleteID = Session::get('txtOrderGlobalModalCompleteIDAlternative');

                        if (isset($txtOrderGlobalModalCompleteID) && !empty($txtOrderGlobalModalCompleteID)) {
                            $value = Order::find($txtOrderGlobalModalCompleteID);
                            $value->payment_mode = "cheque";
                            $returnValue = $value->save();
                            if ($returnValue) {
                                $paymentMode = "cheque";
                                return redirect()->route('order', compact('paymentMode'));
                            }
                        }
                    } else {
                        Alert::warning('You are not eligible to avail cheque payment !');
                        return redirect()->back();
                    }
                } else {
                    $user = User::with([
                        'paymentDataHandling' => function ($query) {
                            $query->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                                ->where("data", "Registration_Amount")
                                ->orderBy('updated_at', 'desc')
                                ->limit(1);
                        },
                    ])->find($userID);

                    if ($user) {
                        if ($user->paymentDataHandling->isNotEmpty()) {
                            $updatedAt = $user->paymentDataHandling->first()->updated_at;

                            $customerStartDate = Carbon::parse($updatedAt);
                            $threeYearsAgo = Carbon::now()->subYears(3);

                            if ($customerStartDate <= $threeYearsAgo) {

                                $txtOrderGlobalModalCompleteID = Session::get('txtOrderGlobalModalCompleteID');

                                if (isset($txtOrderGlobalModalCompleteID) && !empty($txtOrderGlobalModalCompleteID)) {
                                    $value = Order::find($txtOrderGlobalModalCompleteID);
                                    $value->payment_mode = "cheque";
                                    $returnValue = $value->save();
                                    if ($returnValue) {
                                        $paymentMode = "cheque";
                                        return redirect()->route('order', compact('paymentMode'));
                                    }
                                }
                            } else {
                                Alert::warning('You are not eligible to avail cheque payment !');
                                return redirect()->back();
                            }
                        }
                    } else {
                        Alert::warning('You are not eligible to avail cheque payment !');
                        return redirect()->back();
                    }
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function getCities($stateId)
    {
        try {
            $cities = City::where('state_id', $stateId)->get();
            return response()->json($cities);
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function paymentCompletion(Request $request, $id, $status)
    {
        try {

            if (Auth::check()) {
                $order_id = Crypt::decryptString($id);
                $address = Address::where('user_id', Auth::user()->id)->latest()->first() ?? '';
                $states = State::all();
                $txtOrderGlobalModalCompleteID = $order_id;
                $userId = Auth::user()->id;
                $document = Attachment::where('user_id', $userId)->get();
                foreach ($document as $singleDocument) {
                    if ($singleDocument->file_type === "gstfile") {
                        $gstfile = $singleDocument->fileno;
                    }
                }
                $amount = Order::where('id', $txtOrderGlobalModalCompleteID)->value('amount');
                Session::forget('txtOrderGlobalModalCompleteID');
                if (Session::has('txtOrderGlobalModalCompleteIDAlternative') && Session::get('txtOrderGlobalModalCompleteIDAlternative') != null && Session::get('txtOrderGlobalModalCompleteIDAlternative') != "") {

                    Session::put('txtOrderGlobalModalCompleteID', Session::get('txtOrderGlobalModalCompleteIDAlternative') ?? '');

                } else {
                    Session::put('txtOrderGlobalModalCompleteID', $txtOrderGlobalModalCompleteID ?? '');

                }

                $bookingAmount = PaymentDataHandling::where('order_id', $txtOrderGlobalModalCompleteID)
                    ->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])
                    ->where('user_id', $userId)
                    ->value('transaction_amount');

                /*-------logic for giving final payment amount in the input----starts---*/
                if ($amount && $bookingAmount) {
                    $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                    $sgstPercent = env('SGST', 9);
                    // Set your SGST percentage here (e.g., 9%)
                    $totalTaxAmount = ($amount * ($cgstPercent + $sgstPercent) / 100) ?? 0;

                    $amountToPay = ($amount + $totalTaxAmount) - $bookingAmount;
                } else {
                    $amountToPay = '';
                }
                /*-------logic for giving final payment amount in the input----starts---*/

                $orderdata = order::where('id', $txtOrderGlobalModalCompleteID)->value('balance_on_booking');
                if (!$orderdata) {
                    $orderdata = null;
                }
                return view('components.order-complete-process', compact('txtOrderGlobalModalCompleteID', 'states', 'address', 'gstfile', 'orderdata', 'amountToPay'));
            } else {

                return view('auth.login');
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }

    }

    public function paymentInvalidChequeCompletion(Request $request, $id)
    {

        try {

            if (Auth::check()) {
                $order_id = Crypt::decryptString($id);
<<<<<<< HEAD
                $txtOrderGlobalModalCompleteID = $order_id;
                $amount = Order::where('id', $txtOrderGlobalModalCompleteID)->pluck('total_cheque_amount_with_tax');
=======

                $txtOrderGlobalModalCompleteID = $order_id;
                $amount = Order::where('id', $txtOrderGlobalModalCompleteID)->pluck('total_cheque_amount_with_tax');

>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
                Session::forget('txtOrderGlobalModalCompleteID');
                if (Session::has('txtOrderGlobalModalCompleteIDAlternative') && Session::get('txtOrderGlobalModalCompleteIDAlternative') != null && Session::get('txtOrderGlobalModalCompleteIDAlternative') != "") {

                    Session::put('txtOrderGlobalModalCompleteID', Session::get('txtOrderGlobalModalCompleteIDAlternative') ?? '');

                } else {
                    Session::put('txtOrderGlobalModalCompleteID', $txtOrderGlobalModalCompleteID ?? '');

                }


                return view('components.order-process-invalid-cheque', compact('txtOrderGlobalModalCompleteID', 'amount'));

            } else {

                return view('auth.login');
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }

    }

    public function paymentProcessInvalidChequeCompletion(Request $request)
    {

        try {
            Session::forget('GLOBALUSERID');
            Session::put('GLOBALUSERID', Auth::user()->id ?? '');
            $amount = "";

            $orderId = $request->maindatas;

            $validAmount = Order::find($orderId);
            $chequeAmount = $validAmount->total_cheque_amount_with_tax;

            if ($validAmount) {
                // Update the payment_mode field
                $validAmount->payment_mode = 'online';
                $validAmount->save();
            }

            $validator = Validator::make($request->all(), [
                'invalidChequeAmount' => ['required', 'in:' . $chequeAmount],
            ]);
            if ($validator->fails()) {
                $amount = $chequeAmount;
            } else {
            }
            $amount = $request->input('invalidChequeAmount');
            $reference_no = time() . Str::random(5);
            $paymentDataHandling = new PaymentDataHandling();
            $paymentDataHandling->reference_no = $reference_no;
            $paymentDataHandling->paymode = 'online';
            $paymentDataHandling->user_id = Auth::user()->id ?? '';
            $paymentDataHandling->data = "Invalid_Cheque_Amount";
            $paymentDataHandling->user_amount = $amount;
            $paymentDataHandling->order_id = $orderId ?? '';
            $paymentDataHandling->save();
            $optionalField = null;
            $base = new EazyPayController();
            $url = $base->getPaymentUrl($amount, $reference_no, $optionalField);
            return redirect()->to($url);
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function paymentMethodChange($paymentModes, $data)
    {
        try {
            $member_at = "";
            $userID = Auth::user()->id ?? '';
            if ($paymentModes === 'cheque') {
                if (isset($userID) && !empty($userID)) {
                    $member_at = User::find($userID)->member_at;
                } else {
                    return redirect()->route('login');
                }
                if (isset($member_at) && !empty($member_at)) {

                    $customerStartDate = Carbon::parse($member_at);
                    $threeYearsAgo = Carbon::now()->subYears(3);
                    if ($customerStartDate <= $threeYearsAgo) {
                        if (isset($data) && !empty($data)) {
                            $value = Order::find($data);
                            $value->payment_mode = "cheque";
                            $value->save();
                            return response()->json(['main' => 'cheque_success']);
                        } else {
                            return response()->json(['main' => 'sms_error']);
                        }
                    } else {
                        return response()->json(['main' => 'cheque_error']);
                    }
                } else {
                    return response()->json(['main' => 'cheque_error']);
                }

            } elseif ($paymentModes === 'online') {

                if (isset($data) && !empty($data)) {
                    $value = Order::find($data);
                    $value->payment_mode = "online";
                    $value->save();

                    return response()->json(['main' => 'online_success']);
                } else {
                    return response()->json(['main' => 'sms_error']);
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

}