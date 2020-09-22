<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php if(!empty($title)) echo $title; else echo "Laravel"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{asset('admins/images/favicon.ico')}}">

     <title>Adminto - Responsive Admin Dashboard Template</title>

     <!--Morris Chart CSS -->
     <link rel="stylesheet" href="{{asset('admins/plugins/morris/morris.css')}}">

     <!-- App css -->
     <link href="{{asset('admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('admins/css/icons.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('admins/css/style.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('admins/css/myCss.css')}}" rel="stylesheet" type="text/css"/>

     <script src="{{asset('admins/js/modernizr.min.js')}}"></script>


</head>
<body class="fixed-left">
    @include('admins/layouts/nav_bar')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @include('admins/layouts/footer')

     <!-- jQuery  -->
     <script src="{{asset('admins/jquery.min.js')}}"></script>
     <script src="{{asset('admins/js/popper.min.js')}}"></script>
     <script src="{{asset('admins/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('admins/js/detect.js')}}""></script>
     <script src="{{asset('admins/js/fastclick.js')}}"></script>
     <script src="{{asset('admins/js/jquery.blockUI.js')}}"></script>
     <script src="{{asset('admins/js/waves.js')}}"></script>
     <script src="{{asset('admins/js/jquery.nicescroll.js')}}"></script>
     <script src="{{asset('admins/js/jquery.slimscroll.js')}}"></script>
     <script src="{{asset('admins/js/jquery.scrollTo.min.js')}}"></script>
    

      <!-- Chart JS -->
      <script src="{{asset('admins/plugins/chart.js/Chart.bundle.min.js')}}"></script>
      <script src="{{asset('admins/pages/jquery.chartjs.init.js')}}"></script>

      <!-- App js -->
      <script src="{{asset('admins/js/jquery.core.js')}}"></script>
      <script src="{{asset('admins/js/jquery.app.js')}}"></script>

</body>
</html>