<?php
error_reporting(0);
if (isset($_POST) && $_POST["signin_username"] != "") {
    $signinUsername = $_POST["signin_username"];
    $signinPassword = $_POST["signin_password"];
    if ($signinUsername == "admin" && $signinPassword == "admin@1234") {
        header("location:mainpage.php");
    } else {
        $error = "Invalid username and password";
    }
}
?>
<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sign In - Info PPMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">
        <link href="../assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
        <link href="../assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">
        <style>
            #signin-demo {
                position: fixed;
                right: 0;
                bottom: 0;
                z-index: 10000;
                background: rgba(0,0,0,.6);
                padding: 6px;
                border-radius: 3px;
            }
            #signin-demo img { cursor: pointer; height: 40px; }
            #signin-demo img:hover { opacity: .5; }
            #signin-demo div {
                color: #fff;
                font-size: 10px;
                font-weight: 600;
                padding-bottom: 6px;
            }
        </style>
    </head>
    <body class="theme-default page-signin">
        <script src="assets/demo/demo.js"></script> <!-- / Demo script -->
        <div class="signin-container">
            <div class="signin-info">
                <a href="index.php" class="logo">
                    <img src="assets/demo/logo-big.png" alt="" style="margin-top: -5px;">&nbsp;
                    MJB Info HRMS
                </a> <!-- / .logo -->
                <div class="slogan">
                    Simple. Flexible. Powerful.
                    
                </div> <!-- / .slogan -->
                <ul>
                    <li><i class="fa fa-sitemap signin-icon"></i> Flexible modular structure</li>
                    <li><i class="fa fa-file-text-o signin-icon"></i> LESS &amp; SCSS source files</li>
                    <li><i class="fa fa-outdent signin-icon"></i> RTL direction support</li>
                    <li><i class="fa fa-heart signin-icon"></i> Crafted with love</li>
                </ul> <!-- / Info list -->
            </div>
            <!-- / Left side -->

            <!-- Right side -->
            <div class="signin-form">
                <p style="color: red"><?php echo $error ?></p>    
                <!-- Form -->
                <form method="post" id="signin-form_id">
                    <a href="index.php" class="logo">
                        <center><img src="../assets/demo/hrms_logo.jpg" alt=""></center>
                    </a>
                    <div class="signin-text">
                        <span>Sign In to your account</span>
                    </div> <!-- / .signin-text -->

                    <div class="form-group w-icon">
                        <input type="text" name="signin_username" id="username_id" class="form-control input-lg" placeholder="Username or email">
                        <span class="fa fa-user signin-form-icon"></span>
                    </div> <!-- / Username -->

                    <div class="form-group w-icon">
                        <input type="password" name="signin_password" id="password_id" class="form-control input-lg" placeholder="Password">
                        <span class="fa fa-lock signin-form-icon"></span>
                    </div> <!-- / Password -->

                    <div class="form-actions">
                        <input type="submit" value="SIGN IN" class="signin-btn bg-primary">
                        <a href="#" class="forgot-password" id="forgot-password-link">Forgot your password?</a>
                    </div> <!-- / .form-actions -->
                </form>
                <!-- / Form -->

                <!-- Password reset form -->
                <div class="password-reset-form" id="password-reset-form">
                    <div class="header">
                        <div class="signin-text">
                            <span>Password reset</span>
                            <div class="close">&times;</div>
                        </div> <!-- / .signin-text -->
                    </div> <!-- / .header -->

                    <!-- Form -->
                    <form action="#" id="password-reset-form_id">
                        <div class="form-group w-icon">
                            <input type="text" name="password_reset_email" id="p_email_id" class="form-control input-lg" placeholder="Enter your email">
                            <span class="fa fa-envelope signin-form-icon"></span>
                        </div> <!-- / Email -->

                        <div class="form-actions">
                            <input type="submit" value="SEND PASSWORD RESET LINK" class="signin-btn bg-primary">
                        </div> <!-- / .form-actions -->
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript"> window.jQuery || document.write('<script src="../ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">' + "<" + "/script>");</script>
        <script src="assets/javascripts/bootstrap.min.js"></script>
        <script src="assets/javascripts/pixel-admin.min.js"></script>

        <script type="text/javascript">
            // Resize BG
            init.push(function () {
                var $ph = $('#page-signin-bg'),
                        $img = $ph.find('> img');

                $(window).on('resize', function () {
                    $img.attr('style', '');
                    if ($img.height() < $ph.height()) {
                        $img.css({
                            height: '100%',
                            width: 'auto'
                        });
                    }
                });
            });

            // Show/Hide password reset form on click
            init.push(function () {
                $('#forgot-password-link').click(function () {
                    $('#password-reset-form').fadeIn(400);
                    return false;
                });
                $('#password-reset-form .close').click(function () {
                    $('#password-reset-form').fadeOut(400);
                    return false;
                });
            });

            // Setup Sign In form validation
            init.push(function () {
                $("#signin-form_id").validate({focusInvalid: true, errorPlacement: function () {}});

                // Validate username
                $("#username_id").rules("add", {
                    required: true,
                    minlength: 3
                });

                // Validate password
                $("#password_id").rules("add", {
                    required: true,
                    minlength: 6
                });
            });

            // Setup Password Reset form validation
            init.push(function () {
                $("#password-reset-form_id").validate({focusInvalid: true, errorPlacement: function () {}});

                // Validate email
                $("#p_email_id").rules("add", {
                    required: true,
                    email: true
                });
            });

            window.PixelAdmin.start(init);
        </script>

    </body>
</html>
