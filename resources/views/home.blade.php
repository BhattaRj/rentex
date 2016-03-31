<!DOCTYPE html>
<html lang="en" data-ng-app="app" data-ng-controller="AppCtrl" ng-class="app.settings.htmlClass">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HamroHousing</title>
    <!-- Compressed Vendor BUNDLE
    Includes vendor (3rd party) styling such as the customized Bootstrap and other 3rd party libraries used for the current theme/module -->
    <link href="css/vendor.min.css" rel="stylesheet">
    <!-- Compressed Theme BUNDLE
Note: The bundle includes all the custom styling required for the current theme, however
it was tweaked for the current theme/module and does NOT include ALL of the standalone modules;
The bundle was generated using modern frontend development tools that are provided with the package
To learn more about the development process, please refer to the documentation. -->
    <!-- <link href="css/theme.bundle.min.css" rel="stylesheet"> -->
    <!-- Compressed Theme CORE
This variant is to be used when loading the separate styling modules -->
    <link href="css/theme-core.css" rel="stylesheet">
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->
    <link href="css/module-essentials.min.css" rel="stylesheet" />
    <link href="css/module-material.min.css" rel="stylesheet" />
    <link href="css/module-layout.min.css" rel="stylesheet" />
    <link href="css/module-sidebar.min.css" rel="stylesheet" />
    <link href="css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="css/module-navbar.min.css" rel="stylesheet" />
    <link href="css/module-messages.min.css" rel="stylesheet" />
    <link href="css/module-carousel-slick.min.css" rel="stylesheet" />
    <link href="css/module-charts.min.css" rel="stylesheet" />
    <link href="css/module-maps.min.css" rel="stylesheet" />
    <link href="css/module-colors-alerts.min.css" rel="stylesheet" />
    <link href="css/module-colors-background.min.css" rel="stylesheet" />
    <link href="css/module-colors-buttons.min.css" rel="stylesheet" />
    <link href="css/module-colors-text.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Data for for angularjs app  -->
<?php

if (!Auth::guest()) {
    $login = 'true';
    $user  = Auth::user()->toArray();
} else {
    $login = 'false';
    $user  = null;
}

?>

    <script type="text/javascript">

        var base_url    =   '<?php echo url();?>',
            user        =   <?php echo json_encode($user)?>,
            login       =   <?php echo $login?>;

    </script>

</head>
<body ng-class="app.settings.bodyClass">

    <div ng-include="'app/frontend/partials/header.html'"></div>

    <div data-ui-view class="ui-view-main"></div>

    <div ng-include="'app/frontend/partials/footer.html'"></div>

    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "angular",
        skins: {
            "default": {
                "primary-color": "#42a5f5"
            }
        }
    };
    </script>
    <!-- Separate Vendor Script Bundles -->
    <script src="js/vendor-core.min.js"></script>
    <script src="js/vendor-countdown.min.js"></script>
    <script src="js/vendor-tables.min.js"></script>
    <script src="js/vendor-forms.min.js"></script>
    <script src="js/vendor-carousel-slick.min.js"></script>
    <script src="js/vendor-player.min.js"></script>
    <script src="js/vendor-charts-flot.min.js"></script>
    <script src="js/vendor-nestable.min.js"></script>
    <script src="js/vendor-angular.min.js"></script>
    <!-- Compressed Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
    <!-- <script src="js/vendor-bundle-all.min.js"></script> -->
    <!-- Compressed App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
    <!-- <script src="js/module-bundle-main.min.js"></script> -->
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->
    <script src="js/module-essentials.min.js"></script>
    <script src="js/module-material.js"></script>
    <script src="js/module-layout.min.js"></script>
    <script src="js/module-sidebar.min.js"></script>
    <script src="js/module-carousel-slick.min.js"></script>
    <script src="js/module-player.min.js"></script>
    <script src="js/module-messages.min.js"></script>
    <script src="js/module-maps-google.min.js"></script>
    <script src="js/module-charts-flot.min.js"></script>

    <script src="app/frontend/app.js"></script>

    <!-- [angular] Core Theme Script:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        module-bundle-main.js already includes theme-core.js so this should be loaded
        ONLY when using the standalone modules; -->


    <script src="js/theme-core.js"></script>


    <!-- ================== Angular ================= -->

    <script src="{{ url('lib/angular-route.min.js')}}"></script>
    <script src="{{ url('lib/angular-ui-router.js')}}"></script>
    <script src="{{ url('lib/angular-resource.min.js')}}"></script>
    <script src="{{ url('lib/angular-messages.js')}}"></script>
    <script src="{{ url('lib/select.js')}}"></script>
    <script src="{{ url('lib/angular-sanitize.js') }}"></script>
    <script src="{{ url('lib/ui-bootstrap-tpls-0.13.1.js') }}"></script>

    <script src="{{ url('lib/moment.js') }}"></script>
    <script src="{{ url('lib/angular-moment.js') }}"></script>


    <script src="{{ url('app/common/data/dataFactory.js')}}"></script>

    <script src="{{ url('app/common/resources/flats.js')}}"></script>
    <script src="{{ url('app/common/resources/facilities.js')}}"></script>
    <script src="{{ url('app/common/resources/users.js')}}"></script>
    <script src="{{ url('app/common/resources/shortlist.js')}}"></script>
    <script src="{{ url('app/common/resources/message.js')}}"></script>
    <script src="{{ url('app/common/resources/reports.js')}}"></script>

    <script src="{{ url('app/common/directives/directives.js')}}"></script>
    <script src="{{ url('app/common/pagination/pagination.js')}}"></script>
    <script src="{{ url('app/common/filters/customeFilters.js')}}"></script>

    <script src="{{ url('app/common/component/message/message.js')}}"></script>

    <script src="{{ url('app/frontend/flat/flat.js')}}"></script>

    <script src="{{ url('app/frontend/myAccount/myAccount.js')}}"></script>
    <script src="{{ url('app/frontend/myAccount/dashboard/dashboard.js')}}"></script>
    <script src="{{ url('app/frontend/myAccount/profile/profile.js')}}"></script>
    <script src="{{ url('app/frontend/myAccount/shortlist/shortlist.js')}}"></script>
    <script src="{{ url('app/frontend/myAccount/message/message.js')}}"></script>

    <script src="{{ url('app/frontend/myAccount/myPost/myPost.js')}}"></script>
    <script src="{{ url('app/frontend/myAccount/myPost/flat/myPost-flat.js')}}"></script>

    <script src="{{ url('app/frontend/auth/auth.js')}}"></script>
    <script src="{{ url('app/frontend/partials/header.js')}}"></script>


</body>
</html>