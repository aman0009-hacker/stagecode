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
            <div class="user-signUp-form user-document-form">
              <div class="row text-center">
                <div class="col-12">
                  <img src="{{asset('images/login-signup/document-process.png')}}" alt="document-process" class="img-fluid document-process" width="117" height="160">
                  <h1 class="sign-up-text document-text">Document Process</h1>
                </div>
              </div>
              <form class="document-process-form">
                <div class="mb-3">
                  <input type="text" class="form-control" id="gstNumber" aria-describedby="gstNumberHelp" placeholder="Enter your GST Number">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="msmeNumber" aria-describedby="msmeNumberHelp" placeholder="Enter your MSME Number">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="itrNumber" aria-describedby="itrNumberHelp" placeholder="Enter your ITR Number">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="adharCardNumber" aria-describedby="adharCardNumberHelp" placeholder="Enter Adhaar Card Number*">
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="panCardNumber" aria-describedby="panCardNumberHelp" placeholder="Enter Pan Card Number*">
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="action">
                        <a href="./document-process.html"  class="btn continue-btn w-100">
                      <!-- <button type="submit" class="btn continue-btn w-100"> -->
                        Continue
                    <!-- </button> -->
                    </a>
                    </div>
                  </div>
                </div>
              </form>
              <form class="upload-document-form d-none">
                <div class="row mb-4">
                  <div class="col-4 text-end">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload GST No.<br> Certificate</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-4 text-center">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload MSME <br>Certificate</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload ITR <br> Certificate</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4 text-end">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload Aadhaar<br> Card</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-4 text-center">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload Pan <br>Card</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-3">
                      <input type="file" id="myFile" name="filename" hidden>
                      <label for="myFile" class="upload-files">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text">Upload Utility <br> Certificate</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <p class="format-text text-center">Choose any Format (JPG, PNG, PDF max. 50KB)</p>
                  </div>
                </div>
                <div class="row">
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
  @endsection
