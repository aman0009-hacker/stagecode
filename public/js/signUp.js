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
// $(document).on('click', '#passwordimg', function () {
//     var clicks = $(this).data('clicks');
//     if (clicks) {
//         // odd clicks
//         // var source = "{!! asset('images/login-signup/show.png') !!}";
//         var source = "/images/login-signup/show.png";
//         $('#passwordimg').prop('src', source);
//         $('#userPassword').prop('type', 'text');
//     } else {

//         //var source = "{!! asset('images/login-signup/hide.png') !!}";
//         var source = "/images/login-signup/hide.png";
//         $('#passwordimg').prop('src', source);
//         $('#userPassword').prop('type', 'password');
//         // even clicks
//     }
//     $(this).data("clicks", !clicks);
// });
// $(document).on('click', '#confirmpasswordimg', function () {
//     var clicks = $(this).data('clicks');
//     if (clicks) {
//         //var source = "{!! asset('images/login-signup/show.png') !!}";
//         var source = "/images/login-signup/show.png";
//         $('#confirmpasswordimg').prop('src', source);
//         $('#userconfirmPassword').prop('type', 'text');
//     }
//     else {
//         // even clicks
//         //var source = "{!! asset('images/login-signup/hide.png') !!}";
//         var source = "/images/login-signup/hide.png";
//         $('#confirmpasswordimg').prop('src', source);
//         $('#userconfirmPassword').prop('type', 'password');
//     }
//     $(this).data("clicks", !clicks);

// });
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#continueBtn").click(function (e) {
    e.preventDefault();
    var userOtp = $("#userOtp").val();
    if (userOtp == "1234") {

        $.ajax({
            type: 'POST',
            url: "{{  route('ajaxRequest.post') }}",
            data: { userOtp: userOtp },
            success: function (data) {
                //alert(data.success);
                if (data.success == "1234") {
                    window.location.href = "/userDocument?id=" + $("#userCurrentId").val();
                }
                else {
                    $('#userOtp').css('border-color', 'red');
                }
            }
        });
        //window.location.href = "/userDocument";
    }
});


$(document).ready(function() {
    $('.registerBtnSignUp').prop('disabled', true);
    // Listen for change event on the checkbox
    $('#acceptTerms').change(function() {
      // Check if the checkbox is checked
      if ($(this).is(':checked')) {
        // Enable the "Register" button
        $('.registerBtnSignUp').prop('disabled', false);
      } else {
        // Disable the "Register" button
        $('.registerBtnSignUp').prop('disabled', true);
      }
    });
  });
