$(document).ready(function()
{
 $(".bookingUserStatus").on("click",function(event)
 {
    event.preventDefault();
    //alert("kjhjhkhkjh");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var status = $(this).data('status');
    // alert(status);
    // var orderId = $(this).data('order-id');
    // var adminStatus = $("#adminStatus" + orderId).val();
    // alert(adminStatus);
    var form = document.getElementById("userBookingFormData");
    var formData = new FormData(form);
    $.ajax(
        {
            url:'/verifyAdminStatus',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            data: { adminStatus:status },
            dataType: 'JSON',
            // processData: false,
            // contentType: false,
            success:function(data)
            {
                //alert(data.orderStatus);
                if(data.orderStatus=="Approved")
                {
                    $('#makepaymentnModal').modal('show');
                }
                // else if(data.orderStatus=="Dispatched")
                // {
                //     $('#makepaymentnModals').modal('show');
                // }
                else 
                {
                    $('#confirmationModal').modal('show');
                    
                }

                //alert(data.msg);
                // $.each(data, function(key, value) {
                //     if (value !== null) {
                //         var option = $('<option>').val(key).text(value);
                //         $("#entity").append(option);
                //     }
                // });
            },
            error: function(error) {
                console.error(error);
            }
        }
       );
 });
});