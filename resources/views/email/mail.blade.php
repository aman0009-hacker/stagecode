
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>PSIEC Admin Panel</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="" title="PSIEC" target="_blank">
                                <img width="130" src="{{asset('images/home-page/logo-psiec.png')}}"
                                    title="logo" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1
                                            style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                                            </h1>
                                            <h1>{{ $details['email'] }}</h1>
                                            <p>{!! $details['body'] !!}</p>
                                            @if (  isset($details['status']) && $details['status'] == 'account approved')
                                            <p>To proceed with the next steps, kindly click on the following link:</p>
                                            <a href="{{ env('APP_URL') }}PaymentDetails/{{$details['encryptedID']}}">click here</a>
                                            @endif
                                            @if ( isset($details['status']) && $details['status']=="OrderApprove")
                                            <p>To facilitate the booking payment process, please click the following link:</p>
                                            <a href="{{ env('APP_URL') }}paymentdetailsorder/{{$details['encryptedID']}}/{{$details['status']}}">click here</a>
                                            @endif
                                            @if ( isset($details['status']) && $details['status']=="OrderPayment")
                                            <a href="{{ env('APP_URL') }}PaymentDetailsOrder/{{$details['encryptedID']}}/{{$details['status']}}">click here</a>
                                            @endif
                                            @if(isset($details['status']) && $details['status']==='Dispatched')
                                            <a href="{{ env('APP_URL') }}payment/complete/process/{{$details['encryptedID']}}/{{$details['status']}}">click here</a>
                                            @endif
                                            @if(isset($details['status']) && $details['status']==='Invalidcheque')
                                            <a href="{{ env('APP_URL') }}process/invalid/cheque/{{$details['orderid']}}">click here</a>
                                            @endif
                                            <p>Thank you once again for choosing our services.</p>
                                            <p>Best regards,</p>
                                            <p>PSIEC Admin Panel</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <strong>PSIEC</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>
