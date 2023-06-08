<!DOCTYPE html>
<html>
<head>
    <title>PSIEC Admin Panel</title>
</head>
<body>
    <h1>{{ $details['email'] }}</h1>
    <p>{{ $details['body'] }}</p>
    {{-- @if ($details['body']=="Congratulations!!! Your account has successfully verified.")
        Kindly <a href="http://localhost:8000/PaymentDetails">Click Here</a> for payment
    @endif --}}
    @if ($details['body'] =="Congratulations!!! Your account has successfully verified.")
    <a href="{{ env('APP_URL') }}PaymentDetails/{{$details['encryptedID']}}">click here</a>
    {{-- <a href="http://localhost:8000/PaymentDetails/{{$details['encryptedID']}}">click here</a> --}}
@endif
    <p>Thank you</p>
</body>
</html>