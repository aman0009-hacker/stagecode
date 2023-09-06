let ext = ['jpg', 'png', 'jpeg'];
let image = "";

$.ajaxSetup(
  {
    headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }
);

var form = document.getElementById("chatForm");
var formData = new FormData(form);


setInterval(function () {
  $.ajax(

    {
      url: '/chatDataPost',
      method: 'POST',
      data: formData,
      dataType: 'JSON',
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.msg = "success") {
          $("#submitDiv").html("");

          var values = response.latestData;
          values.forEach(function (data) {
            let a = document.createElement('div');
            a.setAttribute('class', `message_body ${data.commented_by}`);
            let comment_section = data.comment.split('.').pop().toLowerCase();
            if ($.inArray(comment_section, ext) === -1) {
              image = data.comment;
            }
            else {
              image = `<img src="uploads/${data.comment}" style="width:135px;display:block">`;
            }
            a.innerHTML = `<span class="read_by">` + data.username + `</span><div class="color_message ${data.commented_by}">` + image + `<div class="timer">` + moment(data.created_at).format("MMM D, hh:mm A") + `</div></div><br/>`;
            $("#submitDiv").append(a);
          });
        }
      },
      error: function (xhr, status, error) {
        //handle error
      }
    }
  );
}, 1000);

$("#btnSubmit").on("click", function (event) {
  event.preventDefault();
  //  alert("jklkj");
  $.ajaxSetup(
    {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }
  );
  //  alert("jkkjk");
  var data = $("#textAreaMsg").val();
  //   alert(data);
  if (data) {
    var form = document.getElementById("chatForm");
    var formData = new FormData(form);

    $.ajax(

      {
        url: '/chatData',
        method: 'POST',
        data: formData,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.msg = "success") {
            $("#submitDiv").html("");
            $("#textAreaMsg").val("");
            var values = response.latestData;
            values.forEach(function (data) {
              let a = document.createElement('div');
              a.setAttribute('class', `message_body ${data.commented_by}`);
              let comment_section = data.comment.split('.').pop().toLowerCase();
              if ($.inArray(comment_section, ext) === -1) {
                image = data.comment;
              }
              else {
                image = `<img src="uploads/${data.comment}" style="width:135px;display:block">`;
              }
              a.innerHTML = `<span class="read_by">` + data.username + `</span><div class="color_message ${data.commented_by}">` + image + `<div class="timer">` + moment(data.created_at).format("MMM D, hh:mm A") + `</div></div><br/>`;
              $("#submitDiv").append(a);
            });
          }
        },
        error: function (xhr, status, error) {
          //handle error
        }
      }
    );
  }
});


$("#btnClear").on("click", function () {
  $("#textAreaMsg").val("");
});

//new Code for dropzone start
Dropzone.autoDiscover = false;
var dropzone = new Dropzone('#image-upload', {
  thumbnailWidth: 100,
  maxFilesize: 5,
  acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
  success: function (file, response) {


    file.previewElement.remove();

    swal.fire({
      title: "Your image is uploaded",
      icon: "success",
      timer: 3000,
    });







    $.ajax(

      {
        url: '/imagestore/' + response.success,
        method: 'get',
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (response) {
          console.log('data');
          if (response.msg = "success") {
            $("#submitDiv").html("");
            $("#textAreaMsg").val("");
            var values = response.latestData;
            values.forEach(function (data) {
              let a = document.createElement('div');
              a.setAttribute('class', `message_body ${data.commented_by}`);
              let comment_section = data.comment.split('.').pop().toLowerCase();
              if ($.inArray(comment_section, ext) === -1) {
                image = data.comment;
              }
              else {
                image = `<img src="uploads/${data.comment}" style="width:135px;display:block">`;
              }
              a.innerHTML = `<span class="read_by">` + data.username + `</span><div class="color_message ${data.commented_by}">` + image + `<div class="timer">` + moment(data.created_at).format("MMM D, hh:mm A") + `</div></div><br/>`;
              $("#submitDiv").append(a);
            });
          }
        },
        error: function (xhr, status, error) {
          //handle error
        }
      }
    );









  },
  error: function (file, response) {
    return false;
  }
});




 //new code for dropzone end