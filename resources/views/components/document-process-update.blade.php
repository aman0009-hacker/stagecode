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
                <h1 class="sign-up-text document-text">Document Update</h1>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">User</h5>
                      <div id="admin-chat-messages">
                      </div>
                      <form id="admin-chat-form" enctype="multipart/form-data" class="dropzone">
                        @csrf
                        <div class="form-group mt-2">
                          <input type="text" name="userTxt" id="userTxt" class="form-control"
                            placeholder="Type your message">
                        </div>
                        <div class="form-group mt-2">
                          <textarea class="form-control" id="user-message" rows="3" name="admin-message"
                            placeholder="User Message Show Here" readonly></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" id="buttonSend">Send</button>
                    </div>
                  </div>
                </div>
              </form>
                <div class="col-md-12 mt-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Admin <button type="button" class="btn btn-primary ms-2"
                          id="adminMsgData">Refresh</button></h5>
                      <div id="user-chat-messages">
                    </div>
                      <div class="form-group">
                        <textarea class="form-control" id="admin-message" rows="3" placeholder="User Message Show Here"
                          name="user-message" readonly></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-12 mt-2">
                  <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                    id="image-upload" class="dropzone">
                    @csrf
                    <div>
                      <h4>Upload Multiple Documents By Click On Box</h4>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
   //new Code for dropzone start
   Dropzone.autoDiscover = false;
   var dropzone = new Dropzone('#image-upload', {
        thumbnailWidth: 200,
        maxFilesize: 4,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf"
      });
   //new code for dropzone end
   $("#buttonSend").on("click",function(event)
    {
     event.preventDefault();
     $userMsg=$("#userTxt").val();
    //  alert($userMsg); 
    if(($userMsg))
    {
      var form=document.getElementById("admin-chat-form");
      var formData=new FormData(form);
      $.ajax({
        url:"{{route('userMsgHandling')}}",
        type:"POST",
        data:formData,
        dataType:'JSON',
        processData: false,
        contentType: false,
      success:function(response)
      {
        // alert(response.userMsg+"\n"+response.userData+"\n"+response.adminData);
        var textArea=$("#user-message");
        textArea.val("");
        var previousUSer=response.previousUSer;
        previousUSer.forEach(function(user) {
          textArea.val(textArea.val() + user.comment + '\n');
         });
      }
      });
    }
    });
    $("#adminMsgData").on("click",function()
    {
      var form=document.getElementById("admin-chat-form");
      var formData=new FormData(form);
     $.ajax({
     
       url:"{{route('adminReturnMsg')}}",
       type:"POST",
       data:formData,
        dataType:'JSON',
        processData: false,
        contentType: false,
        success:function(response)
        {
        var textArea=$("#admin-message");
        textArea.val("");
        var adminResponse=response.adminResponse;
        adminResponse.forEach(function(user)
        {
         textArea.val(textArea.val()+user.comment+'\n');  
        });
        }
     });
    });
   </script>

  </div>
  @endsection