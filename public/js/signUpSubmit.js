$("#otpHandleBtn").on("click", function () {
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
// $(document).on('click', '#passwordimg', function () {
//     var clicks = $(this).data('clicks');
//     if (clicks) {
//         // odd clicks
//         var source = "/images/login-signup/show.png";
//         $('#passwordimg').prop('src', source);
//         $('#userPassword').prop('type', 'text');
//     } else {

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
//         var source = "/images/login-signup/show.png";
//         $('#confirmpasswordimg').prop('src', source);
//         $('#userconfirmPassword').prop('type', 'text');
//     }
//     else {
//         // even clicks
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
