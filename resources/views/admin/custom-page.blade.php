<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
  <title>Document</title>
</head>

<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
  integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <a href="/admin/auth/user" class="btn btn-outline-primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
      viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M9.354 1.646a.5.5 0 0 0-.708 0l-7 7a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708L3.707 8l5.647-5.646a.5.5 0 0 0 0-.708z" />
    </svg>
    Go To User Page <b>Click Me</b>
  </a>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Admin</h5>
            <div id="admin-chat-messages">
              <!-- Admin chat messages will be displayed here -->
            </div>
            <form id="admin-chat-form">
              @csrf
              <div class="form-group">
                <input type="text" name="adminTxt" id="adminTxt" class="form-control" placeholder="Type your message">
              </div>
              <div class="form-group">
                <textarea class="form-control" id="admin-message" rows="3" name="admin-message"
                  placeholder="Admin Message Show Here" readonly></textarea>
              </div>


              <button type="submit" class="btn btn-primary" id="buttonSend">Send</button>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">User</h5>
            <div id="user-chat-messages">
              <!-- User chat messages will be displayed here -->
            </div>

            <div class="form-group">
              <textarea class="form-control" id="user-message"  rows="3" placeholder="User Message Show Here" name="user-message" readonly></textarea>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Send</button> --}}

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Download Files</h3>
        <ul class="list-group">
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              {{-- <span>File 1</span> --}}
              {{-- <a href="/path/to/file1.pdf" download class="btn btn-primary">Download</a> --}}
              <input type="button" class="btn btn-primary" value="Download" id="btnDownload"/>
            </div>
          </li>
          <!-- Add more list items for additional files -->
        </ul>
      </div>
    </div>
    </form>
  </div>


  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
  

   $("#buttonSend").on("click",function(e){
     e.preventDefault();
    
     var adminMsg=$("#adminTxt").val();
    //  alert(adminMsg);
     if(adminMsg)
     {
      var form = document.getElementById("admin-chat-form"); // Replace "myForm" with the actual ID of your form
    var formData = new FormData(form);
      $.ajax({
        url:"{{route('adminMsgHandling')}}",
        method:'POST',
        data:formData,
        dataType:'JSON',
        processData: false,
      contentType: false,
        success:function(response)
        {
          // var existingValue = $('#admin-message').val();
          // var newData = response.adminMsg;
          // var updatedValue = existingValue + '\n' + newData+'\n';
          // $('#admin-message').val(updatedValue);
          var textarea = $('#admin-message');
          textarea.val("");
          var previousAdmin=response.previousAdmin;
          previousAdmin.forEach(function(user) {
          textarea.val(textarea.val() + user.comment + '\n');
         });
          //alert(response.success); admin-message
        

          console.log(response.previousAdmin);
        }
      }
      );
     }
   });


   $("#btnDownload").on("click",function(){
     $.ajax({
       url:"{{route('adminDownload')}}",
       type:"POST",
       dataType:'JSON',
       success:function(response)
       {
        alert(response.success);
       }
     });
   });


  </script>





</body>

</html>