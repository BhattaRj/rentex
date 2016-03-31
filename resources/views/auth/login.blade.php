<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/login_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:48 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/css/animate.min.css" rel="stylesheet" />
    <link href="/assets/css/style.min.css" rel="stylesheet" />
    <link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="/assets/img/login-bg/bg-7.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> Announcing the Color Admin app</h4>
                    <p>
                        Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> भाडामा.कम
                        <small>Login to post your items.</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">

                    <form method="POST" action="/auth/login" class="margin-bottom-0">
                        {!! csrf_field() !!}
                        <div class="form-group m-b-15">
                            <input type="text" class="form-control input-lg" placeholder="Email Address" name ="email" value="{{old('email')}}"/>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" class="form-control input-lg" placeholder="Password" name="password"/>
                        </div>
                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" name="remember"/> Remember Me
                            </label>
                        </div>
                        <div class="login-buttons">

                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                            <br>
                            <p>OR Login with<p>
                            <br>
                            <a href="{{url('login/facebook')}}"><button type="button" class="btn btn-primary btn-block btn-lg"><i class='fa fa-facebook'></i> Facebook</button></a>
                            <br>

                            <a href="{{url('login/google')}}"><button type="button" class="btn btn-danger btn-block btn-lg"><i class='fa fa-google'></i> Google</button></a>
                            <br>

                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Not a member yet? Click <a href="{{url('auth/register')}}" class="text-success">here</a> to register.
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Kativo All Right Reserved 2015
                        </p>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/login_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:50 GMT -->
</html>
