<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EazyPayController extends Controller
{
    //Payment Gateway Properties Start
    public $merchant_id;
    public $encryption_key;
    public $sub_merchant_id;
    public $reference_no;
    public $paymode;
    public $return_url;
    public $EAZYPAY_BASE_URL;
    //Payment Gateway Properties End

    public function __construct()
    {
        $this->merchant_id = config('eazypay.merchant_id');
        $this->encryption_key = config('eazypay.encryption_key');
        $this->sub_merchant_id = config('eazypay.sub_merchant_id');
        $this->reference_no = rand(1111, 9999);
        $this->paymode = config('eazypay.paymode');
        $this->return_url = config('eazypay.return_url');
        $this->EAZYPAY_BASE_URL = env('EAZYPAY_BASE_URL', '');
    }

    public function getPaymentUrl($amount, $reference_no, $optionalField = null)
    {
        $mandatoryField = $this->getMandatoryField($amount, $reference_no);
        $optionalField = $this->getOptionalField($optionalField);
        $amount = $this->getAmount($amount);
        $reference_no = $this->getReferenceNo($reference_no);
        $paymentUrl = $this->generatePaymentUrl($mandatoryField, $optionalField, $amount, $reference_no);
        return $paymentUrl;
        // return redirect()->to($paymentUrl);
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
    protected function getOptionalField($optionalField = null)
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
        //Code provided by icici
        // $block = @mcrypt_get_block_size('rijndael_128', 'ecb');
        // $pad = $block - (strlen($str) % $block);
        // $str .= str_repeat(chr($pad), $pad);
        // return base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->encryption_key, $str, MCRYPT_MODE_ECB));
        // Result :- Function 'mcrypt_get_block_size' has been removed and is available up to PHP 7.2
        //code provided by ICICI

        //other code for practice
        // $cipher = 'aes-128-ecb'; // AES-128 in ECB mode
        // $blockSize = openssl_cipher_iv_length($cipher);
        // //dd($blockSize);
        // $pad = $blockSize - (strlen($str) % $blockSize);
        // $str .= str_repeat(chr($pad), $pad);
        // $encryptedValue = openssl_encrypt($str, $cipher, $this->encryption_key, OPENSSL_RAW_DATA);
        // $encryptedValue = base64_encode($encryptedValue);
        // return $encryptedValue;
        //other code for practice


        // $cipher = 'aes-128-ecb'; // AES-128 in ECB mode
        // $encryptedValue = openssl_encrypt($str, $cipher, $this->encryption_key, OPENSSL_ZERO_PADDING);
        // $encryptedValue = base64_encode($encryptedValue);
        // return $encryptedValue;


        // $cipher = 'aes-128-ecb'; // AES-128 in ECB mode
        // $encryptionKey = openssl_digest($this->encryption_key, 'SHA256', true); // Generate a 256-bit key
        // $encryptedValue = openssl_encrypt($str, $cipher, $encryptionKey, OPENSSL_RAW_DATA);
        // $encryptedValue = base64_encode($encryptedValue);
        // return $encryptedValue;

        // Generate an initialization vector
        // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 128 encryption in ecb mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($str, 'aes-128-ecb', $this->encryption_key, OPENSSL_RAW_DATA);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted);
    }


   

}