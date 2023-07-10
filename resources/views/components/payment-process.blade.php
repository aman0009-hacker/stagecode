<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/congratulations.css')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}">
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
                                                                    identification purposes only and does not imply
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
                    <div class="col-12 col-md-5 user-signUp">
                        <div class="user-signUp-form process-pending-form d-block">
                            <?php
                                $encryptedResponse = request('encryptedResponse');
                                if(isset($encryptedResponse) && !empty($encryptedResponse)) {
                                $decryptedResponse = Illuminate\Support\Facades\Crypt::decrypt($encryptedResponse);
                                $paymentResponse = $decryptedResponse['paymentResponse'] ?? '';
                                $reference_no = $decryptedResponse['reference_no'] ?? '';
                                $transaction_id = $decryptedResponse['transaction_id'] ?? '';
                             if( $paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="SUCCESS")
                               {
                                // $GLOBALUSERID=Session::get('GLOBALUSERID') ?? '';
                                // if(isset($GLOBALUSERID) && !empty($GLOBALUSERID))
                                // {
                                //     $affectedRows=App\Models\PaymentDataHandling::where('reference_no', $reference_no)
                                //     ->when($transaction_id, function ($query) use ($transaction_id) {
                                //         $query->where('transaction_id', $transaction_id);
                                //     })
                                //     ->update(['user_id' => $GLOBALUSERID, 'data'=>"Registration_Amount"]);
                                //     //dd($affectedRows);
                                //     if(isset($affectedRows) && $affectedRows>0)
                                //     {
                                //         $user=App\Models\User::find($GLOBALUSERID);
                                //         $user->comment="verified";
                                //         $user->save();
                               ?>
                            {{-- <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="successModalLabel">Payment Successful</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Payment has been successfully done.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('RawMaterial') }}" class="btn btn-primary">OK</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                window.addEventListener('DOMContentLoaded', function() {
                                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                    successModal.show();
                                });
                            </script> --}}
                            <?php
                            //    }
                            //    }
                             }
                            
                            else if(request('paymentResponse')!="" && request('paymentResponse')!=null && request('paymentResponse')=="FAILURE")
                               {
                                ?>
                            <div class="alert alert-warning" role="alert">
                                <p>Payment has not verified. Kindly try again or contact system administrator for
                                    further process.</p>
                            </div>
                            <?php
                               }
                            }
                           ?>
                            <form method="post" action="{{route('payment.process.data')}}">
                                @csrf
                                <div class="row text-center">
                                    <div class="col-12">
                                        <img src="{{asset('images/login-signup/doc-success.png')}}"
                                            alt="process-pending" class="img-fluid process-pending" width="220"
                                            height="220">
                                        <h1 class="sign-up-text document-text">Payment Process</h1>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" class="form-control" placeholder="Enter amount"
                                                aria-label="Amount" value="10000" name="amount" id="amount" readonly>
                                            <span class="input-group-text">.00</span>
                                            <input type="hidden" name="amountValue" value="10000">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="action">
                                            <button type="submit" class="btn continue-btn w-100">Pay Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                                        only and does not imply endorsement.</p>
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