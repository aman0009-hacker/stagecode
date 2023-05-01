@extends('layouts.guest')
 @section('content')
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
                                <p>Any use of third party trademarks is for identification purposes only and does not imply endorsement.</p>
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
            <div class="user-signUp-form">
              <div class="row text-center">
                <div class="col-12">
                  <h1 class="sign-up-text">Sign Up</h1>
                  <p class="details-text">Please enter your details to Sign Up</p>
                </div>
              </div>
              <form class="sign-up-form">
                <div class="mb-3">
                  <input type="text" class="form-control" id="firstName" aria-describedby="firstNameHelp" placeholder="First Name">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="lastName" aria-describedby="lastNameHelp" placeholder="Last Name">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="contactNumber" aria-describedby="contactNumberHelp" placeholder="Contact Number">
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="mb-3 password">
                  <input type="password" class="form-control" id="userPassword" aria-describedby="passwordHelp" placeholder="Password">
                  <img src="{{asset('images/login-signup/show.png')}}" alt="show password" class="img-fluid eye-icon" width="18" height="12">
                </div>
                <div class="mb-3 password">
                  <input type="password" class="form-control" id="userconfirmPassword" aria-describedby="confirmpasswordHelp" placeholder="Confirm Password">
                  <img src="{{asset('images/login-signup/hide.png')}}" alt="hide password" class="img-fluid eye-icon" width="18" height="12">
                </div>
                <p class="password-hint">
                  <span class="sign-up-note">Note :</span><span class="password-hint-text">
                    <i>Password must be 6 or more Characters long with one Number,<br> one Upperone lower case letter and a special character(@#$%^&).<br></i>
                    Example : Pass@2016
                  </span>
                </p>
                <div class="row g-3 align-items-center mb-3 send-otp">
                  <div class="col-7">
                    <input type="password" id="userOtp" class="form-control" aria-describedby="otpHelpInline" placeholder="Enter OTP">
                  </div>
                  <div class="col-5">
                    <span id="otpHelpInline" class="form-text">
                      OTP WILL BE SHARED BY SMS
                    </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="action">
                      <a href="./user-document.html" class="btn send-otp-btn w-100">
                        <!-- <button type="submit" class="btn send-otp-btn w-100"> -->
                          Send OTP
                        <!-- </button> -->
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row d-none">
                  <div class="col-12">
                    <div class="action">
                      <button type="submit" class="btn continue-btn w-100">Continue</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
