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
        <div class="col-12 col-md-5 user-signUp">
          <div class="user-signUp-form">
            <div class="row text-center">
              <div class="col-12">
                <h1 class="sign-up-text">Reset Password</h1>
                <p class="details-text">Please enter your details to reset password</p>
              </div>
            </div>
            <form action="{{ route('reset.password.post') }}" method="POST">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="form-group row">
                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                {{-- <div class="col-md-6">
                  <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div> --}}
              </div>
              <div class="form-group row pt-2">
                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                  @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>
              <div class="form-group row pt-2">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                <div class="col-md-6">
                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                    required autofocus>
                  @if ($errors->has('password_confirmation'))
                  <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                  @endif
                </div>
              </div>

              <div class="col-md-6 offset-md-4 pt-2">
                <button type="submit" class="btn btn-primary">
                  Reset Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection