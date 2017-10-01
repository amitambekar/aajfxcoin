<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | AajfxCOIN</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url(); ?>assets/template/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url(); ?>assets/template/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url(); ?>assets/template/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= base_url(); ?>assets/template/css/style.css" rel="stylesheet">
</head>
<script type="text/javascript">
        window._site_url = '<?php echo site_url(); ?>';
</script>
<body class="login-page" ng-app="MyApp" ng-controller="MyController" style="background-image: url(<?= base_url(); ?>assets/template/images/coin/background.jpg);background-repeat:no;">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Aajfx<b>COIN</b></a>
            <!--<small>Admin BootStrap Based - Material Design</small>-->
        </div>
        <div class="card" id="login_cart">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="login_username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" ng-model="login_password" placeholder="Password" />
                        </div>
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
                </form>
            </div>
        </div>

        <div class="card" id="otp_cart" style="display:none;">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Verification</div>
                    <div class="input-group" style="display:none;">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="r_username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="otp" placeholder="OTP" />
                        </div>
                    </div>
                    <button class="btn btn-primary bg-pink waves-effect" type="button" ng-click="check_otp()">Check OTP</button>
                    <button class="btn btn-success bg-pink waves-effect" type="button" ng-click="resend_otp()">Resend OTP</button>
                </form>
            </div>
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

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?= base_url(); ?>assets/template/js/admin.js"></script>
    <script src="<?= base_url(); ?>assets/template/js/pages/examples/sign-in.js"></script>
</body>

</html>