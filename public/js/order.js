$(document).ready(function () {
    $(".bookingUserStatusOrder").on("click", function (event) {
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
        var currentOrderIDsValue = $(this).data('order-ids');
        if (currentOrderIDsValue) {
            $("#txtOrderGlobalModalCompleteID").val(currentOrderIDsValue);
        }
        var formData = new FormData(form);
        $.ajax(
            {
                url: '/verifyAdminStatusOrder',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                data: { adminStatus: status },
                dataType: 'JSON',
                // processData: false,
                // contentType: false,
                success: function (data) {
                    
                    console.log(data);
                    if ((data.orderStatus[0]["status"] == "Dispatched" || data.orderStatus[0]["status"] == "Payment_Done") && data.orderStatus[0]["final_payment_status"] == "verified") {
                        $('#makepaymentnModalRejectionAdmin').modal('show');

                        //Code for "download invoice" start

                        //Code for "download invoice" complete


                    }
                    else if (data.orderStatus[0]["status"] == "Dispatched") {
                        //alert("jkjklfffffffj");
                        $('#makepaymentnModals').modal('show');
                    }
                    else if (data.orderStatus[0]["status"] == "Payment_Done") {
                        //alert("jkjklfffvvvvvvvvvvvvffffj");
                        $('#alreadyPaidTotalAmount').modal('show');
                    }
                    else if (data.orderStatus[0]["status"] == "Rejected") {
                        $('#makepaymentnModalRejection').modal('show');
                        //$(".bookingUserStatusOrder").hide();
                    }
                    else if (data.orderStatus[0]["status"] == "Delivered") {
                        //$(".bookingUserStatusOrder").hide();
                    }
                    // else
                    // {
                    //     $('#confirmationModal').modal('show');

                    // }
                },
                error: function (error) {
                    console.error(error);
                }
            }
        );
    });
});