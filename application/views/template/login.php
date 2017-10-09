<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | AajFxCoin</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core Css -->
    <link href="<?= base_url(); ?>assets/template/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/css/login-soft.css" rel="stylesheet" type="text/css"/>
</head>
<script type="text/javascript">
        window._site_url = '<?php echo site_url(); ?>';
</script>
<body class="login" ng-app="MyApp" ng-controller="MyController" style="background-color:#76889e;">
    <div class="logo">
        <h2 style="color: #eee;">AAJFX<span style="color:#c51048;">COIN</span></h2>
    </div>
    <div class="content">
        <div class="login-form" id="login_cart">
            <h3 class="form-title">Login to your account</h3>
            <div class="form-group">
                <input type="text" class="form-control" ng-model="login_username" placeholder="Username" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" ng-model="login_password" placeholder="Password" />
            </div>
            <button class="btn btn-block bg-pink waves-effect" type="button" ng-click="login()">SIGN IN</button>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-6">
                    <a href="<?= site_url(); ?>register">Register Now!</a>
                </div>
                <div class="col-xs-6 align-right">
                    <a href="<?= site_url(); ?>login/forgot_password">Forgot Password?</a>
                </div>
            </div>
        </div>

        <div class="login-form" id="otp_cart" style="display:none;">
            <h3 class="form-title">Login Verification</h3>
            <div class="from-group" style="display:none;">
                <input type="text" class="form-control" ng-model="r_username" placeholder="Username" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" ng-model="otp" placeholder="OTP" />
            </div>
            <button class="btn btn-primary bg-pink waves-effect" type="button" ng-click="check_otp()">Check OTP</button>
            <button class="btn btn-success bg-pink waves-effect" type="button" ng-click="resend_otp()">Resend OTP</button>
        </div>
    </div>
    <!-- Large Size -->
    <div class="modal fade" id="error_log" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h4 class="modal-title" id="largeModalLabel">Errors</h4>
                </div>
                <div class="modal-body">
                    <span id="errors"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/angular.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/libs/functions.js"></script>
    <script src="<?= base_url(); ?>assets/js/ng/login_register.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.backstretch.min.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {     
       $.backstretch(["<?= imagePath('assets/template/images/coin/1.jpg','',1100,0); ?>","<?= imagePath('assets/template/images/coin/2.jpg','',1100,0); ?>"], {
          fade: 1000,
          duration: 8000
    }
);
});
</script>
</body>
</html>