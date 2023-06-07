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
        @if (Session::has('currentId'))
        <?php
                      $userCurrentId=Session::get('currentId');
                      //echo $userCurrentId;
                  ?>
        @else
        <script>
          window.location.href="/signup";
        </script>
        @endif
        <div class="col-12 col-md-5 user-signUp">
          <div class="user-signUp-form process-pending-form d-block">
            <div class="row text-center">
              <div class="col-12">
                <img src="{{asset('images/login-signup/doc-success.png')}}" alt="process-pending"
                  class="img-fluid process-pending" width="220" height="220">
                <h1 class="sign-up-text document-text">Document Process</h1>
                <p class="sign-up-text process-pending-text">Your Registration is Pending for<br> approval within 7
                  days. After <br>approval you can pay the <br>Registration fee Rupees 10,000/-</p>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <form method="post" action="{{route('documentOutput')}}">
                  @csrf
                  <div class="action">
                    {{-- <a href="/home" class="btn continue-btn w-100">Continue</a> --}}
                    <input type="hidden" name="txtCurrentIdValue" value="{{$userCurrentId ?? ''}}">
                    <button type="submit" class="btn continue-btn w-100">Continue</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection