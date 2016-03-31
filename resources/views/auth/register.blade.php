<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/register_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:50 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Register Page</title>
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
	    <!-- begin register -->
        <div class="register register-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="/assets/img/login-bg/bg-8.jpg" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Announcing the Color Admin app</h4>
                    <p>
                        As a Color Admin Apps administrator, you use the Color Admin console to manage your organization’s account, such as add new users, manage security settings, and turn on the services you want your team to access.
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin register-header -->
                <h1 class="register-header">
                    Sign Up
                    <small>Create your bhadama.com Admin Account. It’s free and always will be.</small>
                </h1>
                <!-- end register-header -->
                <!-- begin register-content -->
                <div class="register-content">

                    <form method="POST" action="/auth/register" class="margin-bottom-0">
                        {!! csrf_field() !!}

                        <label class="control-label">Full Name</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Full Name" name="username" value="{{old('name')}}" />
                            </div>
                                </div>
                        <label class="control-label">Email</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Email address" name="email" value="{{old('email')}}" />
                            </div>
                        </div>

                        <label class="control-label">Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="Password" name="password"/>
                            </div>
                        </div>

                        <label class="control-label">Re-eneter Password</label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" placeholder="Password" name="password_confirmation"/>
                            </div>
                        </div>

                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" /> By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Policy</a>, including our <a href="#">Cookie Use</a>.
                            </label>
                        </div>
                        <div class="register-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40">
                            Already a member? Click <a href="{{url('/auth/login')}}">here</a> to login.
                        </div>
                        <hr />
                        <p class="text-center text-inverse">
                            &copy; Color Admin All Right Reserved 2015
                        </p>
                    </form>
                </div>
                <!-- end register-content -->
            </div>
            <!-- end right-content -->
        </div>
        <!-- end register -->
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

<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/register_v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 11:03:52 GMT -->
</html>
