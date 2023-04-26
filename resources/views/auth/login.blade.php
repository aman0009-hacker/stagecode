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
            <div class="col-12 col-md-5 user-signIn">
                <div class="user-signIn-form">
                  <div class="row text-center">
                    <div class="col-12">
                      <h1 class="sign-in-text">Welcome</h1>
                      <p class="details-text">Please enter your details to Log In</p>
                    </div>
                  </div>
                  <form class="sign-in-form">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="userName" aria-describedby="nameHelp" placeholder="Name">
                    </div>
                    <div class="mb-3 password">
                      <input type="password" class="form-control" id="userPassword" aria-describedby="passwordHelp" placeholder="Password">
                      <img src="{{asset('images/login-signup/hide.png')}}" alt="show password" class="img-fluid eye-icon" width="18" height="12">
                    </div>
                    <div class="row mb-3">
                      <div class="col-12">
                        <div class="forgot-password-link">
                          <a href="#">Forgot Password?</a>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="action">
                          <a href="./index.html" class="btn login-btn w-100">Log In</a>
                          <!-- <button type="submit" class="btn login-btn w-100">Log In</button> -->
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>

      </div>
    </div>
  </div>
@endsection
