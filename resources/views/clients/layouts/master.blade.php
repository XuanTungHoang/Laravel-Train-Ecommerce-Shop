<!DOCTYPE html>
<html lang="zxx">
<head>
        <meta charset="UTF-8">
        <meta name="description" content="Fashi Template">
        <meta name="keywords" content="Fashi, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Fashi | Template</title>
    
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    
        <!-- Css Styles -->
        <link rel="stylesheet" href="{{asset('clients/css/bootstrap.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/font-awesome.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/themify-icons.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/elegant-icons.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/owl.carousel.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/nice-select.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/jquery-ui.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/slicknav.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('clients/css/style.css')}}" type="text/css">
</head>
<body>
    @include('clients/layouts/header')
    @include('clients/layouts/nav_bar')
    <div class="content">
        @yield('content')
    </div>
    @include('clients/layouts/footer')

</body>

 <!-- Js Plugins -->
 <script src="{{asset('clients/js/jquery-3.3.1.min.js')}}"></script>
 <script src="{{asset('clients/js/bootstrap.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery-ui.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery.countdown.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery.nice-select.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery.zoom.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery.dd.min.js')}}"></script>
 <script src="{{asset('clients/js/jquery.slicknav.js')}}"></script>
 <script src="{{asset('clients/js/owl.carousel.min.js')}}"></script>
 <script src="{{asset('clients/js/main.js')}}"></script>
</html>