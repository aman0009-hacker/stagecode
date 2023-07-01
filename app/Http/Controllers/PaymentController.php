<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EazyPayController;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\PaymentHandling;
use App\Models\PaymentDataHandling;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public $encryption_key;
    public $EAZYPAY_BASE_URL;
    public $EAZYPAY_BASE_URL_VERIFY;

    public function __construct()
    {
        $this->encryption_key = config('eazypay.encryption_key');
        $this->EAZYPAY_BASE_URL = env('EAZYPAY_BASE_URL', '');
        $this->EAZYPAY_BASE_URL_VERIFY= env('EAZYPAY_BASE_URL_VERIFY','');
    }

    public function paymentResponse(Request $request)
    {
        //dd($request);
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

                    /*
                    "Response_Code" => "E000",
                    "Unique_Ref_Number" => "2306301647032",
                    "Service_Tax_Amount" => "0.00",
                    "Processing_Fee_Amount" => "0.00",
                    "Total_Amount" => "10000.00",
                    "Transaction_Amount" => "10000",
                    "Transaction_Date" => "30-06-2023 14:24:34",
                    "Interchange_Value" => null,
                    "TDR" => null,
                    "Payment_Mode" => "NET_BANKING",
                    "SubMerchantId" => "45",
                    "ReferenceNo" => "3281",
                    "ID" => "600477",
                    "RS" => "ddf30156e88e88b7e45007af65c3aecd74e0e8315ffb2c115e81928607d3fe004df35c8887a479a5951df51e39527e5be0103af921786974e1965a4e321d977a",
                    "TPS" => "N",
                    "mandatory_fields" => "3281|45|10000",
                    "optional_fields" => "null",
                    "RSV" => "c5036cc5258a0f066c3260b7316eb285f91bec128047a49bacb094c7030c5a49708eac460d3d4801db57d17cca7cb35778e31e5dc64d73f4e84ec281fb07f5d3",
                    */

                );


                //code to send info to DB
                $paymentHandling = new PaymentDataHandling();
                $paymentHandling->merchant_id = $request['ID'] ?? '';
                $paymentHandling->encryption_key = config('eazypay.encryption_key') ?? '';
                $paymentHandling->sub_merchant_id = $request['SubMerchantId'] ?? '';
                $paymentHandling->reference_no = $request['ReferenceNo'] ?? '';
                $paymentHandling->paymode = $request['Payment_Mode'] ?? '';
                $paymentHandling->return_url = config('eazypay.return_url') ?? '';
                $paymentHandling->eazy_pay_base_url = env('EAZYPAY_BASE_URL', '') ?? '';
                $paymentHandling->transaction_id = $request['Unique_Ref_Number'] ?? '';
                $paymentHandling->transaction_amount = $request['Transaction_Amount'] ?? '';
                //$paymentHandling->transaction_date = $request['Transaction_Date'] ?? '';
                $paymentHandling->transaction_date =Carbon::createFromFormat('d-m-Y H:i:s', $request['Transaction_Date'])->format('Y-m-d H:i:s');
                $paymentHandling->amount = $request['Total_Amount'] ?? '';
                $paymentHandling->user_id = Auth::user()->id ?? '';
                $paymentHandling->payment_status = $this->response_code($request['Response_Code']) ?? '';
                $paymentHandling->payment_status_code = $request['Response_Code'] ?? '';
                $paymentHandling->data = 'Registration_Amount' ?? '';
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
                    return "success";
                } else {
                    return "failure";
                }
            } else if (isset($request) && !empty($request)) {
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
                    'RSV' => $request['RSV']
                );
                //code to send info to DB
                $paymentHandling = new PaymentDataHandling();
                $paymentHandling->merchant_id = $request['ID'] ?? '';
                $paymentHandling->encryption_key = config('eazypay.encryption_key') ?? '';
                $paymentHandling->sub_merchant_id = $request['SubMerchantId'] ?? '';
                $paymentHandling->reference_no = $request['ReferenceNo'] ?? '';
                $paymentHandling->paymode = $request['Payment_Mode'] ?? '';
                $paymentHandling->return_url = config('eazypay.return_url') ?? '';
                $paymentHandling->eazy_pay_base_url = env('EAZYPAY_BASE_URL', '') ?? '';
                $paymentHandling->transaction_id = $request['Unique_Ref_Number'] ?? '';
                $paymentHandling->transaction_amount = $request['Transaction_Amount'] ?? '';
                $paymentHandling->transaction_date =Carbon::createFromFormat('d-m-Y H:i:s', $request['Transaction_Date'])->format('Y-m-d H:i:s');
                // $paymentHandling->transaction_date = $request['Transaction_Date'] ?? '';
                $paymentHandling->amount = $request['Total_Amount'] ?? '';
                $paymentHandling->user_id = Auth::user()->id ?? '';
                $paymentHandling->payment_status = $this->response_code($request['Response_Code']) ?? '';
                $paymentHandling->payment_status_code = $request['Response_Code'] ?? '';
                $paymentHandling->data = 'Registration_Amount' ?? '';
                $dbResponse = $paymentHandling->save();
                if ($dbResponse) {

                }
                return $request['Response_Code'];
                //code to send info to DB

            }
        } catch (\Exception $ex) {

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
            'E0864' => 'Card acceptor contact acquirer'
        );
        return $errorCodes[$code];
    }

    public function paymentData(Request $request)
    { 

     //dd($request["Status"]);

    }

    public function paymentProcessVerify(Request $request)
    {
        // $response = Http::post($this->EAZYPAY_BASE_URL_VERIFY, [
        //     'name' => 'Steve',
        //     'role' => 'Network Administrator',
        // ]);
        try
        {
            $merchantId=$request->input('merchantId');
            $referenceNo=$request->input('referenceNo');
            $transactionId=$request->input('transactionId');

            if(isset($merchantId) && !empty($merchantId))
            {
                if(isset($referenceNo) && !empty($referenceNo))
                {
                    $this->EAZYPAY_BASE_URL_VERIFY= $this->EAZYPAY_BASE_URL_VERIFY.'ezpaytranid=&amount=&paymentmode=&merchantid='.$merchantId.'&trandate=&pgreferenceno='.$referenceNo;
                    //return $this->EAZYPAY_BASE_URL_VERIFY;
                    $response=Http::get($this->EAZYPAY_BASE_URL_VERIFY);
                    dd($response);
                    if($response->successful())
                    {
                        $responseData = $response->json();
                        $status = $responseData['status'];
                        echo $responseData;
                        echo $status;
                    }
                    else 
                    {
                        return "not success";
                    }
                  
                }
                else if(isset($transactionId) && !empty($transactionId))
                {
                    $this->EAZYPAY_BASE_URL_VERIFY= $this->EAZYPAY_BASE_URL_VERIFY.'ezpaytranid='.$transactionId.'&amount=&paymentmode=&merchantid='.$merchantId.'&trandate=&pgreferenceno=';
                    //echo $this->EAZYPAY_BASE_URL_VERIFY;
                    $response=Http::get($this->EAZYPAY_BASE_URL_VERIFY);
                    dd($response);
                    if($response->successful())
                    {
                        $responseData = $response->json();
                        $status = $responseData['status'];
                        echo $responseData;
                        echo $status;
                    }
                }
            }
        }
        catch(\Exception $ex)
        {

        }
    }

    public function paymentVerify(Request $request)
    {
     return view('components.payment-verify');
    }

    


    public function paymentProcess(Request $request)
    {
        // Call the getPaymentUrl method
        $amount = $request->input('amount'); // Example amount
        $reference_no = rand(1111, 9999);
        //$reference_no = 'ABC123'; // Example reference number
        $optionalField = null; // Example optional field (can be null)
        //Instantiate the EazyPayController

        $base = new EazyPayController();
        $url = $base->getPaymentUrl($amount, $reference_no, $optionalField);
        //dd($url);
        // Do something with the generated URL
        // For example, you can redirect the user to the payment URL
        return redirect()->to($url);
        //  $value=$url;
    }

    public function index(Request $request)
    {
        return view('components.payment-process');
    }










}