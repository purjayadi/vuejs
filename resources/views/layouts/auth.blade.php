<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('assets/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('assets/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

     <!-- Waves Effect Plugin Js -->
     <script src="{{ asset('assets/plugins/node-waves/waves.js')}}"></script>

     <!-- Validation Plugin Js -->
     <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>

     <!-- Custom Js -->
     <script src="{{ asset('assets/js/admin.js')}}"></script>
     <script src="{{ asset('assets/js/pages/examples/sign-up.js')}}"></script>
     <script src="{{ asset('assets/js/pages/examples/sign-in.js')}}"></script>
     <script src="{{ asset('assets/js/pages/examples/forgot-password.js')}}"></script>
</body>
</html>
