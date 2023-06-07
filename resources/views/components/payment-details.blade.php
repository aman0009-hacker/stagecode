<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Details Page</title>
  <link href="{{asset('additional/payment.css')}}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                  <div class="row">
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
                                <p class="copy-right-text">© Copyright 2023 PSIEC. All rights reserved.</p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 owners-text">
                                <p>All trademarks used herein are property of their respective owners.</p>
                                <p>Any use of third party trademarks is for identification purposes only and does not
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
          <div class="col-12 col-md-5 user-signIn">
            <div class="user-signIn-form">
              <div class="row text-center">
                <div class="col-12">
                  <h1 class="sign-in-text">Payment Details</h1>
                </div>
              </div>
              <div class="row mt-3 mt-md-5">
                <div class="col-md-12">
                  <form class="payment-method" method="post" action="/congratulations">
                    @csrf
                    <select class="form-select form-select-lg mb-3 category-selection" aria-label="form-select-lg" required>
                      <option value="">Select Payment Option</option>
                      <option value="1">Debit Card</option>
                      <option value="1">Credit Card</option>
                      <option value="1">Mobile Payment</option>
                      <option value="1">RTGs</option>
                      <option value="1">DD</option>
                      <option value="1">Check</option>
                    </select>
                    <div class="select-selected"></div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="cardnumber" aria-describedby="cardNumbereHelp"
                        placeholder="Enter Card Number" required>
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                        placeholder="Enter your Name" required>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="date" aria-describedby="dateHelp"
                            placeholder="Expiration Date" required>
                        </div>
                        <div class="col-md-6 cvv">
                          <input type="text" class="form-control" id="cvv" aria-describedby="passwordHelp"
                            placeholder="CVV" required>


                          <img src="{{asset('images/login-signup/show.png')}}" alt="show password"
                            class="img-fluid eye-icon" width="18" height="12">


                        </div>  

                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="action">

                        {{-- <a href="congratulations-page.html" class="btn pay-btn w-100">pay</a> --}}
                        <button type="submit" value="pay" class="btn pay-btn w-100">pay</button>

                      </div>
                    </div>
                  </form>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>