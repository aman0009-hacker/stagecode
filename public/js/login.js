

//code for user-document
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
//code for user-document

$(document).on('click', '#passwordimg', function () {
  var clicks = $(this).data('clicks');
  if (clicks) {

      var source = "/images/login-signup/show.png";
      $('#passwordimg').prop('src', source);
      $('#password').prop('type', 'text');
      $('#userPassword').prop('type', 'text');
  } else {

      var source = "/images/login-signup/hide.png";
      $('#passwordimg').prop('src', source);
      $('#password').prop('type', 'password');
      $('#userPassword').prop('type', 'password');
      // even clicks
  }
  $(this).data("clicks", !clicks);
});
$(document).on('click', '#confirmpasswordimg', function () {
  var clicks = $(this).data('clicks');
  if (clicks) {
      var source = "/images/login-signup/show.png";
      $('#confirmpasswordimg').prop('src', source);
      $('#userconfirmPassword').prop('type', 'text');
  }
  else {
      // even clicks
      var source = "/images/login-signup/hide.png";
      $('#confirmpasswordimg').prop('src', source);
      $('#userconfirmPassword').prop('type', 'password');
  }
  $(this).data("clicks", !clicks);
});

$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
       
     }
  });
});