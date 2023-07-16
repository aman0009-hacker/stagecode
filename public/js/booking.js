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
    var form = document.getElementById("userBookingFormData");
    var currentOrderIDValue=$(this).data('order-id');
    if(currentOrderIDValue)
    {
        $("#txtOrderGlobalModalID").val(currentOrderIDValue); 
    }
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
            success:function(data)
            {
                //alert(data.orderStatus);
                if(data.orderStatus=="Approved")
                {
                    $('#makepaymentnModal').modal('show');
                }
                else if(data.orderStatus == "Rejected")
                {
                    // $('#makepaymentnModalRejection').modal('show');
                }
                // else if(data.orderStatus=="Dispatched")
                // {
                //     $('#makepaymentnModals').modal('show');
                // }
                else if(data.orderStatus=="New")
                {
                    $('#confirmationModal').modal('show');
                    
                }
              
            },
            error: function(error) {
                console.error(error);
            }
        }
       );
 });
});