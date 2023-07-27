$(document).ready(function () {
    //location.reload(true);
    $("#btnClear").on("click", function () {
        $("#textAreaMsg").val("");
    }
    );
    var form = document.getElementById("commentForms");
    var formData = new FormData(form);
    //alertify.error('Kindly fill the message');
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Retrieve CSRF token value
    setInterval(function () {
        $.ajax({
            url: '/checkurlIndex',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
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
                        let uppercomment = data.commented_by;
                        let commentres = uppercomment.charAt(0).toUpperCase() + uppercomment.slice(1);
                        let upperuser = data.username;
                        let userresul = upperuser.charAt(0).toUpperCase() + upperuser.slice(1);


                        a.innerHTML = `<span><span style="display:block"><strong>${commentres}</strong></span><span class="color_message ${data.commented_by}"><span class="read_by">${userresul}</span> :<span>${data.comment}</span> <span class="timer">${moment(data.created_at).format("MMM D, hh:mm A")} </span></span> </span><br>`

                        $("#submitDiv").append(a);
                    });

                }
            },
            error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
            }
        });
    }, 15000);
    $('#btnSubmit').on("click", function (event) {
        event.preventDefault();
        var value = ($("#textAreaMsg").val());
        // alertify.error('Kindly fill the message');
        if (value.length <= 0) {
            alertify.error('Kindly fill the message');
            return;
        }
        var form = document.getElementById("commentForms");
        var formData = new FormData(form);
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Retrieve CSRF token value
        $.ajax({
            url: '/checkurl',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
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
                        let uppercomment = data.commented_by;
                        let commentres = uppercomment.charAt(0).toUpperCase() + uppercomment.slice(1);
                        let upperuser = data.username;
                        let userresul = upperuser.charAt(0).toUpperCase() + upperuser.slice(1);
                      
                        a.innerHTML = `<span><span style="display:block"><strong>${commentres}</strong></span><span class="color_message ${data.commented_by}"><span class="read_by">${userresul}</span> :<span>${data.comment}</span> <span class="timer">${moment(data.created_at).format("MMM D, hh:mm A")} </span></span> </span><br>`
                        $("#submitDiv").append(a);
                    });
                }
            },
            error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
            }
        });
    });
});