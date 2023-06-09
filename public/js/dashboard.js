$(document).ready(function () {
    function checkStatus() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Retrieve CSRF token value
        $.ajax({
            url: '/checkStatus',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.hasRecord === true) {
                    window.location.href = "/chat";
                }
            } 
        });
    }
    // Call the function initially
    checkStatus();
    // Call the function every 10 seconds
    setInterval(checkStatus, 10000);
});
//code to check approval status