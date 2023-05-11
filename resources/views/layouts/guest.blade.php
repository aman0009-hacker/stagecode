<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}">
  <title>PSIEC</title>





  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('css/signUp.css')}}" />
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @yield('content')
</body>
</html>