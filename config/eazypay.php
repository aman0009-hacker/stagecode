<?php

return [
    'merchant_id' => env('EAZYPAY_MERCHANT_ID'),
    'encryption_key' => env('EAZYPAY_ENCRYPTION_KEY'),
    'return_url' => env('EAZYPAY_RETURN_URL'),
    'sub_merchant_id' => env('EAZYPAY_SUB_MERCHANT_ID'),
    // 'merchant_reference_no' => env('EAZYPAY_MERCHANT_REFERENCE_NO'),
    'paymode' => env('EAZYPAY_PAYMODE', 9),
];

?>