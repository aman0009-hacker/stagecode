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
          <div class="user-signUp-form user-document-form">
            <div class="row text-center">
              <div class="col-12">
                <img src="{{asset('images/login-signup/document-process.png')}}" alt="document-process"
                  class="img-fluid document-process" width="117" height="160">
                <h1 class="sign-up-text document-text">Document Process</h1>
              </div>
            </div>
            <div class="alert alert-danger" style="display: none" id="successmsgdocument" style="display: none">
              <strong>Oops!</strong> Something went <b>wrong</b>.
            </div>
            @if (Auth::check())
            <?php 
                 if(isset(Auth::user()->state))
                 {
                  Session::put('currentId', Auth::user()->id );
                  $userCurrentId=Session::get('currentId');
                 }
               ?>
            @else
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
            @endif
            <form class="document-process-form" id="userDocumentForm" method="post" autocomplete="off"
              action="{{ route('ajaxRequest.postdocument')}}">
              @csrf
              <input type="hidden" name="txtID" id="txtID" value="{{ $userCurrentId ?? ''}}" />
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent " id="gstNumber" name="gstNumber"
                  aria-describedby="gstNumberHelp" placeholder="Enter your GST Number (15 digit)"
                  title="GST No (15 digit)" oninvalid="this.setCustomValidity('Enter your GST Number (15 digit)')"
                  oninput="setCustomValidity('')" minlength="15" maxlength="15" value="{{old('gstNumber')}}">
                <label for="gstNumber" class="form-label">Enter your GST Number (15 digit)</label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="msmeNumber" name="msmeNumber"
                  aria-describedby="msmeNumberHelp" placeholder="Enter your MSME Number (12 digit)" required
                  oninvalid="this.setCustomValidity('Enter your MSME Number (12 digit)')" title="MSME No (12 digit)"
                  oninput="setCustomValidity('')" minlength="12" maxlength="12" value="{{old('msmeNumber')}}">
                <label for="msmeNumber" class="form-label">Enter your MSME/Udyam Number (12 digit) </label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="itrNumber" name="itrNumber"
                  aria-describedby="itrNumberHelp" placeholder="Enter your ITR Number (20 digit)"
                  title="ITR No (20 digit)" oninvalid="this.setCustomValidity('Enter your ITR Number (20 digit)')"
                  oninput="setCustomValidity('')" minlength="20" maxlength="20" value="{{old('itrNumber')}}">
                <label for="itrNumber" class="form-label">Enter your ITR Number (20 digit)</label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="adharCardNumber"
                  name="adharCardNumber" aria-describedby="adharCardNumberHelp"
                  placeholder="Enter Adhaar Card Number ★ (12 digit)" required title="Adhaar No (12 digit)"
                  oninvalid="this.setCustomValidity('Enter Adhaar Card Number')" oninput="setCustomValidity('')"
                  minlength="12" maxlength="12" onkeypress="return isNumberKey(event)"
                  value="{{old('adharCardNumber')}}">
                <label for="adharCardNumber" class="form-label">Enter Adhaar Card Number <span
                    style="color:red">★</span> (12 digit)</label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="panCardNumber"
                  name="panCardNumber" aria-describedby="panCardNumberHelp"
                  placeholder="Enter Pan Card Number ★ (10 digit)" required title="Pan No (10 digit)"
                  oninvalid="this.setCustomValidity('Enter Pan Card Number')" oninput="setCustomValidity('')"
                  minlength="10" maxlength="10" value="{{old('panCardNumber')}}">
                <label for="panCardNumber" class="form-label">Enter Pan Card Number <span style="color:red">★</span> (10
                  digit)</label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="utilityCardNumber"
                  name="utilityCardNumber" aria-describedby="utilityCardNumberHelp"
                  placeholder="Enter Capacity Card Number" title="Capacity No"
                  oninvalid="this.setCustomValidity('Enter Capacity Card Number')" oninput="setCustomValidity('')"
                  maxlength="10" value="{{old('utilityCardNumber')}}">
                <label for="utilityCardNumber" class="form-label">Enter Capacity Card Number</label>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="action">
                    <button class="btn continue-btn w-100" type="submit">Continue</button>
                    <!-- </button> -->
                    </a>
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