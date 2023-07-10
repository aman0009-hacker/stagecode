<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EazyPayController extends Controller
{
    //Payment Gateway Properties Start
    public $merchant_id;
    public $encryption_key;
    public $sub_merchant_id;
    //public $reference_no;
    public $paymode;
    public $return_url;
    public $EAZYPAY_BASE_URL;
    //Payment Gateway Properties End

    public function __construct()
    {
        $this->merchant_id = config('eazypay.merchant_id');
        $this->encryption_key = config('eazypay.encryption_key');
        $this->sub_merchant_id = config('eazypay.sub_merchant_id');
        //$this->reference_no = rand(1111, 9999);
        $this->paymode = config('eazypay.paymode');
        $this->return_url = config('eazypay.return_url');
        $this->EAZYPAY_BASE_URL = env('EAZYPAY_BASE_URL', '');
    }

    public function getPaymentUrl($amount, $reference_no, $optionalField=null)
    {
        try {
        $mandatoryField = $this->getMandatoryField($amount, $reference_no);
        $optionalField = $this->getOptionalField($optionalField);
        $amount = $this->getAmount($amount);
        $reference_no = $this->getReferenceNo($reference_no);
        $paymentUrl = $this->generatePaymentUrl($mandatoryField, $optionalField, $amount, $reference_no);
        return $paymentUrl;
        // return redirect()->to($paymentUrl);
    } catch (\Throwable $ex) {
        Log::info($ex->getMessage());
   
    }
    }


    protected function generatePaymentUrl($mandatoryField, $optionalField, $amount, $reference_no)
    {
        $encryptedUrl = $this->EAZYPAY_BASE_URL . "merchantid=" . $this->merchant_id . "&mandatory fields=" . $mandatoryField . "&optional fields=" . $optionalField . "&returnurl=" . $this->getReturnUrl() . "&Reference No=" . $reference_no . "&submerchantid=" . $this->getSubMerchantId() . "&transaction amount=" . $amount . "&paymode=" . $this->getPaymode();
        return $encryptedUrl;
   }

    protected function getMandatoryField($amount, $reference_no)
    {
        return $this->getEncryptValue($reference_no . '|' . $this->sub_merchant_id . '|' . $amount);
    }

    // optional field must be seperated with | eg. (20|20|20|20)
    protected function getOptionalField($optionalField=null)
    {
        if (!is_null($optionalField)) {
            return $this->getEncryptValue($optionalField);
        }
        return null;
    }

    protected function getAmount($amount)
    {
        return $this->getEncryptValue($amount);
    }

    protected function getReturnUrl()
    {
        return $this->getEncryptValue($this->return_url);
    }

    protected function getReferenceNo($reference_no)
    {
        return $this->getEncryptValue($reference_no);
    }

    protected function getSubMerchantId()
    {
        return $this->getEncryptValue($this->sub_merchant_id);
    }

    protected function getPaymode()
    {
        return $this->getEncryptValue($this->paymode);
    }


    // use @ to avoid php warning php throw warning while using mcrypt functions
    protected function getEncryptValue($str)
    {
       $encrypted = openssl_encrypt($str, 'aes-128-ecb', $this->encryption_key, OPENSSL_RAW_DATA);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted);
    }


   

}