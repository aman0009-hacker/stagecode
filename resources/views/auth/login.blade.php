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
        <div class="col-12 col-md-5 user-signIn">
          <div class="user-signIn-form">
            <div class="row text-center">
              <div class="col-12">
                <h1 class="sign-in-text">Welcome</h1>
                <p class="details-text">Please enter your details to Log In</p>
              </div>
            </div>
            @php
            if(Auth::check())
            {
            if(Auth::user()->state==1)
            {
            header("Location: " . URL::to('/signUpSubmit'), true, 302);
            session(['state' => '1']);
            exit();
            }
            else if(Auth::user()->state==2)
            {
            header("Location: " . URL::to('/userDocument'), true, 302);
            exit();
            }
            else if(Auth::user()->state==3 )
            {
            header("Location: " . URL::to('/documentProcess'), true, 302);
            session(['state' => '3']);
            exit();
            }
            else
            {
            header("Location: " . URL::to('/home'), true, 302);
            exit();
            }
            }
            @endphp
            @if (Session::has('status'))
            <div class="alert alert-success" id="successmsg">
              {{-- <strong>Great!</strong> Reset Password mail has <b>successfully</b> send to
              the registered <b>email id</b>. --}}
            </div>
            @endif
            @if(count($errors))
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <br>
            {{-- <form class="sign-in-form" method="post" action="{{ route('login.post') }}"> --}}
              <form class="sign-in-form" method="post" action="/login" autocomplete="off">
                @csrf
                <div class="mb-3 position-relative form-control-new">
                  <input type="email" class="form-control form-input bg-transparent" id="email" name="email"
                    aria-describedby="nameHelp" placeholder="Email" value="{{old('email')}}" required
                    oninvalid="this.setCustomValidity('Enter Email Here')" oninput="setCustomValidity('')">
                  <label for="email" class="form-label">Email <span style="color:red">★</span></label>
                </div>
                <div class="mb-3 password position-relative form-control-new">
                  <input type="password" class="form-control form-input bg-transparent" id="password"
                    aria-describedby="passwordHelp" placeholder="Password" name="password" required
                    oninvalid="this.setCustomValidity('Enter Password Here')" oninput="setCustomValidity('')"
                    value="{{old('password')}}">
                  <img src="{{asset('images/login-signup/hide.png')}}" alt="show password" class="img-fluid eye-icon"
                    width="18" height="12" id="passwordimg">
                  <label for="email" class="form-label">Password <span style="color:red">★</span></label>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <div class="forgot-password-link">
                      <a href="/forgot-password">Forgot Password?</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="action">
                      {{-- <a href="./index.html" class="btn login-btn w-100">Log In</a> --}}
                      <button type="submit" class="btn login-btn w-100">Log In</button>
                    </div>
                  </div>
                </div>
                <div class="row mt-1">
                  <div class="col-8">
                   
                     <small> For New User Kindly <a href="{{route('signUp')}}" class="link-success text-small" style="text-decoration: none">Sign Up</a> </small>   
                    
                  </div>
                  <div class="col-4">
              
                     
                     
                  
                  </div>
                </div>
                
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection