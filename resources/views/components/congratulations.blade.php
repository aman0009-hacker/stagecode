<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congartulations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/congratulations.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/login-signup/admin_logo_img.png') }}">
</head>

<body>
    <div class="main">
        <div class="container-fluid p-4">
            <div class="sign-up-page">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="background-image d-flex align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="user-welocme">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="welcome-text">WELCOME TO
                                                            <span class="welcome-border"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 industries-export-text">
                                                        <span>Punjab Small Industries & Export Corporation</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="state-text">(A State Government Undertaking)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none d-md-block">
                                        <div class="col-12">
                                            <div class="sign-up-footer">
                                                <div class="row align-items-baseline">
                                                    <div class="col-4">
                                                        <div class="policy-warranty-link">
                                                            <a href="#">Privacy Policy</a>
                                                            <span class="text-white"> | </span>
                                                            <a href="#">PSIEC Product Warranty</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 copy-right-section">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p class="copy-right-text">© Copyright 2023 PSIEC. All
                                                                    rights reserved.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 owners-text">
                                                                <p>All trademarks used herein are property of their
                                                                    respective owners.</p>
                                                                <p>Any use of third party trademarks is for
                                                                    identification purposes only and does not
                                                                    imply endorsement.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 user-signUp">
                        <div class="user-signUp-form process-pending-form d-block">
                            <div class="row text-center">
                                <div class="col-12">
                                    <img src="images/login-signup/doc-success.png" alt="process-pending"
                                        class="img-fluid process-pending" width="220" height="220">
                                    <h1 class="sign-up-text document-text">Woop</h1>
                                    <?php

                                    // use Illuminate/Support/Facades/Mail;
                                    ?>
                                    <?php
                  $encryptedResponse = request('encryptedResponse');
                  if(isset($encryptedResponse) && !empty($encryptedResponse)) {
                  $decryptedResponse = Illuminate\Support\Facades\Crypt::decrypt($encryptedResponse);
                  $paymentResponse = $decryptedResponse['paymentResponse'] ?? '';
                  $reference_no = $decryptedResponse['reference_no'] ?? '';
                  $transaction_id = $decryptedResponse['transaction_id'] ?? '';
               if( $paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="SUCCESS")
                 {
                  $user = App\Models\User::find(Auth::user()->id);
                  $user->member_at = \Carbon\Carbon::now();
                  $email = Auth::user()->email;
                  $details=[
                      'email' => 'Registration Fee Payment Successful',
                      'body' => 'We are pleased to inform you that your account registration fee payment has been successfully processed.',
                  ];
                    \Mail::to($email)->send(new \App\Mail\PSIECMail($details));
                   $user->save();
                 ?>
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">Payment Successful</h4>
                                        <hr>
                                        <p class="mb-0">Congratulations! Your payment has been successfully submitted.
                                        </p>
                                        <p>Payment Details:</p>
                                        <ul style="list-style:none;"
                                            <li >Amount: ₹ 10,000 (Registration Amount)
                                            </li>
                                        </ul>
                                        <p>Thank you for your payment. If you have any further questions or concerns,
                                            please don't hesitate to contact our support team. We appreciate your
                                            business!</p>
                                    </div>
                                    <?php
                 }
             else if(request('paymentResponse')!="" && request('paymentResponse')!=null && request('paymentResponse')=="FAILURE")
              {
                  ?>
                                    <?php
                 }
              }
             ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="action">
                                        <a href="/RawMaterial" class="btn continue-btn w-100">Continue</a>
                                        <!-- <button type="submit" class="btn continue-btn w-100">Continue</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-block d-md-none">
                            <div class="col-12">
                                <div class="sign-up-footer">
                                    <div class="row align-items-baseline">
                                        <div class="col-4">
                                            <div class="policy-warranty-link">
                                                <a href="#">Privacy Policy</a>
                                                <span class="text-white"> | </span>
                                                <a href="#">PSIEC Product Warranty</a>
                                            </div>
                                        </div>
                                        <div class="col-8 copy-right-section">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="copy-right-text">© Copyright 2023 PSIEC. All rights
                                                        reserved.</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 owners-text">
                                                    <p>All trademarks used herein are property of their respective
                                                        owners.</p>
                                                    <p>Any use of third party trademarks is for identification purposes
                                                        only and does not imply
                                                        endorsement.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
