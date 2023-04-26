<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PSIEC</title>
        <link
          href="{{asset('css/bootstrap.min.css')}}"
          rel="stylesheet"
        />
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <link
          rel="stylesheet"
          type="text/css"
          href="{{asset('css/font-awesome.min.css')}}"
        />
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/booking.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/payment.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/category.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/raw-material.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/total-payment.css')}}" />
      </head>
<body>
<div class="main">
@include('includes.header')
@yield('content')
@include('includes.footer')
</div>
</body>
</html>
