<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gogi - Admin and Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/media/image/favicon.png')}}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{asset('vendors/bundle.css')}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}" type="text/css">
</head>
<body class="form-membership">

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<div class="form-wrapper">

    <!-- logo -->
    <div id="logo">
        <img src="{{asset('assets/media/image/dark-logo.png')}}" alt="image">
    </div>
    <!-- ./ logo -->

    <h5>Sign in</h5>

    @yield('content')
    <!-- form -->

</div>

<!-- Plugin scripts -->
<script src="{{asset('vendors/bundle.js')}}"></script>

<!-- App scripts -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
</body>
</html>
