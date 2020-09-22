
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>API-LOGIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admins/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{asset('admins/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admins/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admins/css/style.css')}}" rel="stylesheet" type="text/css" />

        <script src="{{asset('admins/js/modernizr.min.js')}}"></script>

    </head>

    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>API-<span>LOGIN</span></span></a>
                <h5 class="text-muted mt-0 font-600">Responsive Your Website</h5>
            </div>

        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold mb-0">Sign In</h4>
                </div>
                <br>
                @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="p-20">
                    <form class="form-horizontal m-t-20" action="{{action('ApiController\LoginController@post_login')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="name" class="form-control" type="text" required="" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="password" class="form-control" type="password" required="" placeholder="Password">
                            </div>
                        </div>

                        {{-- <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>

                            </div>
                        </div> --}}

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
{{-- 
                        <div class="form-group m-t-30 mb-0">
                            <div class="col-sm-12">
                                <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div> --}}
                    </form>

                </div>
            </div>
            <!-- end card-box-->

            {{-- <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                </div>
            </div> --}}
            
        </div>
        <!-- end wrapper page -->



        <!-- jQuery  -->
        <script src="{{asset('admins/js/jquery.min.js')}}"></script>
        <script src="{{asset('admins/js/popper.min.js')}}"></script>
        <script src="{{asset('admins/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admins/js/waves.js')}}"></script>
        <script src="{{asset('admins/js/jquery.slimscroll.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('admins/js/jquery.core.js')}}"></script>
        <script src="{{asset('admins/js/jquery.app.js')}}"></script>
	
	</body>
</html>