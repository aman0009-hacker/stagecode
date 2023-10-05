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

    }
});


$(document).ready(function() {


    $('.registerBtnSignUp').prop('disabled', true);
    // Listen for change event on the checkbox
    $('#acceptTerms').change(function() {
      // Check if the checkbox is checked

      if ($(this).is(':checked')) {
        if($('#acceptTerms2').is(':checked'))
        {

            $('.registerBtnSignUp').prop('disabled', false);
        }
        else
        {
            $('.registerBtnSignUp').prop('disabled', true);
        }
               // Enable the "Register" button
      } else {
        // Disable the "Register" button
        $('.registerBtnSignUp').prop('disabled', true);
      }
    });




    $('#acceptTerms2').change(function() {
      // Check if the checkbox is checked

      if ($(this).is(':checked')) {
        if($('#acceptTerms').is(':checked'))
        {

            $('.registerBtnSignUp').prop('disabled', false);
        }
        else
        {
            $('.registerBtnSignUp').prop('disabled', true);
        }
               // Enable the "Register" button
      } else {
        // Disable the "Register" button
        $('.registerBtnSignUp').prop('disabled', true);
      }
    });







  });
