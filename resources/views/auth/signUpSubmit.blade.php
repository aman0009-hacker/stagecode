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
                <h1 class="sign-up-text">Sign Up</h1>
                <p class="details-text">Please enter your details to Sign Up</p>
              </div>
            </div>
            @if (Auth::check())
            <?php 
              if(isset(Auth::user()->state))
              {
               Session::put('currentId', Auth::user()->id );
               Session::put('contact_number', Auth::user()->contact_number );
               $contact_number=Session::get('contact_number');
               $userCurrentId=Session::get('currentId');
              }
            ?>
            @else
            @if (Session::has('contact_number') && Session::has('currentId') && Session::get('contact_number')!="" &&
            !empty(Session::get('contact_number')) && !empty(Session::get('currentId')) )
            <div class="alert alert-success" id="successmsg">
              <strong>Great!</strong> Your information has saved successfully. Kindly fill the <b>OTP</b> to complete
              the <b>Registration</b>.
            </div>
            @else
            <script>
              window.location.href="/signup";
            </script>
            @endif
            @endif
            @if (Session::has('contact_number'))
            <?php
                    $contact_number=Session::get('contact_number');
                    //echo $contact_number;
                ?>
            @endif
            @if (Session::has('currentId'))
            <?php
                  $userCurrentId=Session::get('currentId');
                  //echo $userCurrentId;
              ?>
            @endif
            @if (Session::has('data'))
            @if (Session::get('data')=="notsuccess")
            <div class="alert alert-warning" id="wrongotpmsg">
              <strong>Oops!</strong> OTP is <b>wrong</b>.
            </div>
            <script>
              $("#successmsg").hide();
            </script>
            @endif
            @endif
            <form class="sign-up-form" id="register-form-submit" action="{{ route('store') }}" method="POST"
              autocomplete="off">
              @csrf
              {{-- error logic implemented by mohan --}}
              @if(count($errors))
              <div class="alert alert-danger">
                {{-- <strong>Whoops!</strong> There were some problems with your input. --}}
                {{-- <br /> --}}
                <ul>
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <br>
              <input type="hidden" name="id" id="id" value="{{  $userCurrentId ?? '' }}" />
              <div class="mb-3 position-relative form-control-new">
                {{-- <span class="ms-2" class="form-label"> Contact Number </span> --}}
                {{-- <label for="contactNumber" class="form-label">First Name <span style="color:red">★</span></label>
                --}}
                <input type="text" class="form-control form-input bg-transparent" id="contactNumber"
                  name='contact_number' title="Contact Number" maxlength="10" minlength="10"
                  onkeypress="return isNumberKey(event)" readonly aria-describedby="contactNumberHelp"
                  placeholder="Contact Number (10 digits)" required
                  oninvalid="this.setCustomValidity('Enter Contact Number Here (10 digits)')"
                  oninput="setCustomValidity('')" value="{{ $contact_number ?? ''}}">
                <label for="contact_number" class="form-label">Contact Number</span></label>
              </div>
              <div class="row g-3 align-items-center mb-3 send-otp" id="otp_div">
                <div class="col-6">
                  <div class="position-relative form-control-new">
                    <input type="text" id="userOtp" class="form-control  form-input bg-transparent"
                      aria-describedby="otpHelpInline" placeholder="Enter OTP ★" required name="userOtp"
                      oninvalid="this.setCustomValidity('Enter the required OTP')" title="Enter OTP"
                      oninput="setCustomValidity('')" maxlength="10">
                    <label for="userOtp" class="form-label">Enter OTP <span style="color:red">★</span></span></label>
                  </div>
                </div>
                <div class="col-6">
                  <span id="otpHelpInline" class="form-text">
                    <button type="button" class="btn btn-link btn-sm" id="otpHandleBtn" class="ms-4">Resend
                      OTP</button>
                    {{-- <a href="" id="otpHandleBtn">Resend OTP</a> --}}
                    <span id="msg" style="display:none"><b>OTP WILL BE SHARED BY SMS</b></span>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="action">
                    {{-- <button type="submit" class="btn continue-btn w-100"> Send OTP</button> --}}
                    <button type="submit" class="btn continue-btn w-100" id="registerBtn">Validate</button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="action">
                  </div>
                </div>
              </div>
            </form>
            <script>
              $("#otpHandleBtn").on("click",function()
{
 $("#otpHandleBtn").hide();
 $("#msg").show();
});
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
                          function onlyNumberKey(evt) {
                             // Only ASCII character in that range allowed
                              var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                              if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                                  return true;
                              return false;
                          }
             $(document).on('click','#passwordimg',function(){
              var clicks = $(this).data('clicks');
              if (clicks) {
                // odd clicks
                var source = "{!! asset('images/login-signup/show.png') !!}";
                        $('#passwordimg').prop('src', source);
                        $('#userPassword').prop('type', 'text');
              } else {

              var source = "{!! asset('images/login-signup/hide.png') !!}";
                        $('#passwordimg').prop('src', source);
                        $('#userPassword').prop('type', 'password');
                // even clicks
              }
              $(this).data("clicks", !clicks);
             });
             $(document).on('click','#confirmpasswordimg',function(){
              var clicks = $(this).data('clicks');
              if (clicks) {
              var source = "{!! asset('images/login-signup/show.png') !!}";
                        $('#confirmpasswordimg').prop('src', source);
                        $('#userconfirmPassword').prop('type', 'text');
              }
              else {
                // even clicks
                var source = "{!! asset('images/login-signup/hide.png') !!}";
                        $('#confirmpasswordimg').prop('src', source);
                        $('#userconfirmPassword').prop('type', 'password');
              }
              $(this).data("clicks", !clicks);
             });
              $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection