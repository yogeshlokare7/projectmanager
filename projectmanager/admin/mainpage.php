<?php
error_reporting(0);
session_start();
ob_start();

include '../MysqlConnection.php';

$pagename = $_GET["pagename"];
$explode = explode("_", $pagename);
$include = "";
$module = "";
$page = "";
if (count($explode) >= 2) {
    $include = $explode[1] . "/" . $pagename;
    $module = $explode[1];
    $page = $explode[0] . " " . $explode[1];
} else {
    $include = "dashboard";
    $module = "Home";
    $page = "Dashboard";
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Dashboard - PPMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">
    <link href="../assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">
    <script>
        function chkNumericKey(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode >= 48 && charCode <= 57) || charCode == 46 || charCode == 45) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>
<body class="theme-default main-menu-animated">
    <script>var init = [];</script>
    <script src="assets/demo/demo.js"></script>
    <div id="main-wrapper">
        <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
            <!-- Main menu toggle -->
            <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
            <div class="navbar-inner">
                <!-- Main navbar header -->
                <div class="navbar-header">
                    <!-- Logo -->
                    <a href="mainpage.php" class="navbar-brand">
                        <div><img alt="MJB Admin" src="../assets/images/pixel-admin/images.png"></div>
                        Welcome to MJB
                    </a>
                    <!-- Main navbar toggle -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
                </div> 
                <!-- / .navbar-header -->
                <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
                    <div>
                        <ul class="nav navbar-nav">
                            <li><a href="mainpage.php?pagename=updateprofile"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a></li>
                            <li><a href="mainpage.php?pagename=updateaccount"><i class="fa fa-money"></i>&nbsp;&nbsp;Account</a></li>
                            <li><a href="mainpage.php?pagename=updatepassword"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
                            <li><a href="mainpage.php?pagename=do_logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                        </ul> <!-- / .navbar-nav -->
                    </div>
                </div> <!-- / #main-navbar-collapse -->
            </div> <!-- / .navbar-inner -->
        </div> <!-- / #main-navbar -->
        <div id="main-menu" role="navigation">
            <?php include './leftnavigation.php'; ?>
        </div> <!-- / #main-menu -->
        <div id="content-wrapper">
            <ul class="breadcrumb breadcrumb-page" style="text-transform: capitalize">
                <div class="breadcrumb-label text-light-gray">You are here: </div>
                <li><a href="#"><?php echo $module ?></a></li>
                <li class="active"><a href="#"><?php echo $page ?></a></li>
            </ul>
            <?php include '' . $include . ".php"; ?>
        </div> <!-- / #content-wrapper -->
        <div id="main-menu-bg"></div>
    </div> <!-- / #main-wrapper -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="../ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">' + "<" + "/script>");</script>
    <script src="../assets/javascripts/bootstrap.min.js"></script>
    <script src="../assets/javascripts/pixel-admin.min.js"></script>
    <script type="text/javascript">
        init.push(function () {
            // Javascript code here
        })
        window.PixelAdmin.start(init);
    </script>
</body>
</html>