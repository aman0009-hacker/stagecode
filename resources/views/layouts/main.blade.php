<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}">
    <title>PSIEC</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" type="text/css"
        href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/booking.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/payment.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/raw-material.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/total-payment.css') }}" />
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="main">
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
    </div>
</body>

</html>