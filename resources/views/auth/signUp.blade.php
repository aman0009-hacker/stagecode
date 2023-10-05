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
            @if (Session::has('currentId'))
            <?php
                      $userCurrentId=Session::get('currentId');

                  ?>
            @endif
            <form class="sign-up-form" id="register-form" action="{{ route('register') }}" method="POST"
              autocomplete="off">
              @csrf
              <input type="hidden" name="userCurrentId" id="userCurrentId"
                value="<?php echo $userCurrentId ?? ''; ?>" />
              @if(count($errors))
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                  <li class="mt-2">{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <br>
              <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="firstName" name='name'
                  aria-describedby="firstNameHelp" placeholder="First Name ★" required
                  oninvalid="this.setCustomValidity('Enter First Name Here')" onkeypress="return onlyNumberKey(event)"
                  title="First Name" oninput="setCustomValidity('')" value="{{old('name')}}">
                <label for="name" class="form-label">First Name <span style="color:red">★</span></label>
              </div>
              <div class="mb-3 position-relative form-control-new ">
                <input type="text" class="form-control form-input bg-transparent" id="lastName" name='last_name'
                  aria-describedby="lastNameHelp" placeholder="Last Name ★" required
                  oninvalid="this.setCustomValidity('Enter Last Name Here')" value="{{old('last_name')}}"
                  onkeypress="return onlyNumberKey(event)" title="Last Name" oninput="setCustomValidity('')">
                <label for="last_name" class="form-label">Last Name <span style="color:red">★</span></label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="text" class="form-control form-input bg-transparent" id="contactNumber"
                  name='contact_number' title="Contact Number" value="{{old('contact_number')}}" maxlength="10"
                  minlength="10" onkeypress="return isNumberKey(event)" aria-describedby="contactNumberHelp"
                  placeholder="Contact Number (10 digits) ★" required
                  oninvalid="this.setCustomValidity('Enter Contact Number Here (10 digits)')"
                  oninput="setCustomValidity('')">
                <label for="contact_number" class="form-label">Contact Number (10 digits) <span
                    style="color:red">★</span></label>
              </div>
              <div class="mb-3 position-relative form-control-new">
                <input type="email" class="form-control form-input bg-transparent" id="userEmail" name="email"
                  aria-describedby="emailHelp" value="{{old('email')}}" placeholder="Email ★" required
                  oninvalid="this.setCustomValidity('Enter Email Here')" title="Email" oninput="setCustomValidity('')">
                <label for="email" class="form-label">Email <span style="color:red">★</span></label>
              </div>
              <div class="mb-3 position-relative form-control-new password">
                <input type="password" class="form-control form-input bg-transparent" name="password" id="userPassword" maxlength="12"
                  value="{{old('password')}}" aria-describedby="passwordHelp" placeholder="Password ★" required
                  oninvalid="this.setCustomValidity('Enter Password Here')" title="Password"
                  oninput="setCustomValidity('')">
                <label for="password" class="form-label">Password <span style="color:red">★</span></label>
                <img src="{{asset('images/login-signup/hide.png')}}" alt="show password" class="img-fluid eye-icon"
                  width="18" height="12" id="passwordimg">
              </div>
              <div class="mb-3 position-relative form-control-new password">
                <input type="password" class="form-control form-input bg-transparent" name="password_confirmation" maxlength="12"
                  id="userconfirmPassword" value="{{old('password_confirmation')}}"
                  aria-describedby="confirmpasswordHelp" placeholder="Confirm Password ★" required
                  oninvalid="this.setCustomValidity('Enter Confirm Password Here')" title="Confirm password"
                  oninput="setCustomValidity('')">
                <label for="password_confirmation" class="form-label">Confirm Password <span
                    style="color:red">★</span></label>
                <img src="{{asset('images/login-signup/hide.png')}}" alt="hide password" class="img-fluid eye-icon"
                  width="18" height="12" id="confirmpasswordimg">
              </div>







              <p class="password-hint">
                <span class="sign-up-note">Note :</span><span class="password-hint-text">
                  <i>Password must be 6 or more Characters ( maximum - 12 Charcaters ) long with one Number, one Upperone lower case letter and a
                    special character(@#$%^&).</i>
                  Example : Pass@2016
                </span>
              </p>


                     {{-- new code for terms and conditions --}}
                     <div class="row justify-content-center">
                      <div class="col-12">

                        <div class="mb-3 form-check ">
                          <div class="two-checkboxes">
                            <div class="firstinput d-flex"style="align-items:center;margin-bottom:11px;">
                              <input type="checkbox"  id="acceptTerms" name="accept_terms" required style="height:16px">
                              <label class="form-check-label ms-2" for="acceptTerms">I accept the <a href="{{asset('policy.pdf')}}" target="_blank">Terms and Conditions</a></label>
                            </div>
                            <div class="secondinput d-flex" style="align-items:center">
                              <input type="checkbox"  id="acceptTerms2" name="accept_terms" required style="height:16px">
                              <label class="form-check-label ms-2" for="acceptTerms">I accept the <a href="{{asset('policy.pdf')}}" target="_blank">Terms and Conditions</a></label>
                            </div>
                          </div>

                        </div>

                      </div>
                    </div>





                    {{-- new code for terms and conditions --}}

              <div class="row">
                <div class="col-12">
                  <div class="action">
                   
                    <button type="submit" class="btn continue-btn w-100 registerBtnSignUp" id="registerBtn">Register</button>
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