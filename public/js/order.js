$(document).ready(function()
{
 $(".bookingUserStatusOrder").on("click",function(event)
 {
    event.preventDefault();
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //alert("khkhjk");
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var status = $(this).data('status');
    var form = document.getElementById("userBookingFormData");
    var formData = new FormData(form);
    $.ajax(
        {
            url:'/verifyAdminStatusOrder',
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
                // if(data.orderStatus=="Approved")
                // {
                //     $('#makepaymentnModal').modal('show');
                // }
                if(data.orderStatus=="Dispatched")
                {
                    $('#makepaymentnModals').modal('show');
                }
                else if(data.orderStatus=="Payment_Done")
                {
                    $('#alreadyPaidTotalAmount').modal('show');
                }
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