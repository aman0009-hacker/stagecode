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
                <div class="row d-none d-md-block">
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
                <img src="./resources/images/login-signup/document-process.png" alt="document-process"
                  class="img-fluid document-process" width="117" height="160">
                <h1 class="sign-up-text document-text">Document Process</h1>
              </div>
            </div>
            <form class="upload-document-form">
              <div class="row mb-4">
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <div class="file-wrapper">
                      <input type="file" id="myFile" name="upload-img" hidden accept="pdf/*">
                      <div class="close-btn">×</div>
                      <label for="myFile" class="">
                        <div class="row text-center">
                          <div class="col-12">
                            <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                              id="uploaded-image" class="img-fluid upload-icon" width="25" height="18">
                            <p class="upload-text" id="uploaded-content">Upload GST No.<br> Certificate</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <input type="file" id="myFile" name="filename" hidden>
                    <label for="myFile" class="upload-files">
                      <div class="row text-center">
                        <div class="col-12">
                          <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                            class="img-fluid upload-icon" width="25" height="18">
                          <p class="upload-text">Upload MSME <br>Certificate</p>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <input type="file" id="myFile" name="filename" hidden>
                    <label for="myFile" class="upload-files">
                      <div class="row text-center">
                        <div class="col-12">
                          <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                            class="img-fluid upload-icon" width="25" height="18">
                          <p class="upload-text">Upload ITR <br> Certificate</p>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <input type="file" id="myFile" name="filename" hidden>
                    <label for="myFile" class="upload-files">
                      <div class="row text-center">
                        <div class="col-12">
                          <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                            class="img-fluid upload-icon" width="25" height="18">
                          <p class="upload-text">Upload Aadhaar<br> Card</p>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <input type="file" id="myFile" name="filename" hidden>
                    <label for="myFile" class="upload-files">
                      <div class="row text-center">
                        <div class="col-12">
                          <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                            class="img-fluid upload-icon" width="25" height="18">
                          <p class="upload-text">Upload Pan <br>Card</p>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 text-lg-end text-center">
                  <div class="mb-3">
                    <input type="file" id="myFile" name="filename" hidden>
                    <label for="myFile" class="upload-files">
                      <div class="row text-center">
                        <div class="col-12">
                          <img src="./resources/images/login-signup/upload-icon.png" alt="upload file"
                            class="img-fluid upload-icon" width="25" height="18">
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
                    <a href="./updated-documents.html" class="btn continue-btn w-100">Continue</a>
                    <!-- <button type="submit" class="btn continue-btn w-100">Continue</button> -->
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="row d-block d-md-none">
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
                        <p>Any use of third party trademarks is for identification purposes only and does not imply
                          endorsement.</p>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function(){ 
$('input[name="upload-img"]').on('change', function(){
  readURL(this, $('.file-wrapper'));  //Change the image
});

$('.close-btn').on('click', function(){ //Unset the image
   let file = $('input[name="upload-img"]');
   $('.file-wrapper').css('background-image', 'unset');
   $('.file-wrapper').removeClass('file-set');
   file.replaceWith( file = file.clone( true ) );
});

//FILE
function readURL(input, obj){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      obj.css('background-image' , 'url('+e.target.result+')');
      obj.addClass('file-set');
     $('#uploaded-image').remove();
     $('#uploaded-content').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
};
});
  </script>
  <style>
    .file-wrapper {
      background: #FFFFFF;
      border: 1px solid #F5F5F5;
      box-shadow: 0px 4px 11px rgba(0, 0, 0, 0.03);
      border-radius: 6px;
      padding: 10px;
      width: 80%;
      cursor: pointer;
      min-height: 129px;
      position: relative;
      margin: auto;

    }

    .file-wrapper .upload-icon {
      position: absolute;
      top: 0;
      bottom: 22px;
      left: 0;
      right: 0;
      margin: auto;
      width: max-content;
      height: max-content;
      display: block;
    }

    .file-wrapper.file-set {
      background-repeat: no-repeat;
    }

    .file-wrapper p {
      display: block;
      position: absolute;
      left: 0;
      right: 0;
      margin: auto;
      bottom: 0px;
      color: #8B8B8B;
      font-weight: 400;
      font-size: 12px;
      margin-top: 14px;
      padding: 10px;

    }

    .file-wrapper .close-btn {
      display: none;
    }

    input[type="file"] {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0;
      z-index: 99999;
      cursor: pointer;
    }

    .file-set {
      background-size: contain;
      background-repeat: no-repeat;
      color: transparent;
      padding: 10px;
      border-width: 0px;
      background-position: center center;

    }

    .file-set:hover {
      transition: all 0.5s ease-out;
      filter: brightness(110%);
    }

    .file-set:before {
      color: transparent;
    }

    .file-set:after {
      color: transparent;
    }

    .file-set .close-btn {
      position: absolute;
      width: 35px;
      height: 35px;
      display: block;
      background: #000;
      color: #fff;
      top: 0;
      right: 0;
      font-size: 25px;
      text-align: center;
      line-height: 1.5;
      cursor: pointer;
      opacity: 0.8;
    }

    .file-set>input {
      pointer-events: none;
    }
  </style>
  </body>
  @endsection