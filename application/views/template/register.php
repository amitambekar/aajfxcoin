<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | AajfxCOIN</title>
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
<body class="signup-page" ng-app="MyApp" ng-controller="MyController">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Aajfx<b>COIN</b></a>
            <!--<small>Admin BootStrap Based - Material Design</small>-->
        </div>
        <div class="card" id="registration_step1">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="r_username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" ng-model="r_email" placeholder="Email Address" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="r_mobile" placeholder="Mobile" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" ng-model="r_password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" ng-model="r_password1" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>-->

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="button" ng-click="register('<?= $sponserUsername; ?>','<?= $placement; ?>')">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="<?= site_url(); ?>login">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="registration_step2" style="display:none;">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" ng-model="otp" placeholder="Enter OTP" />
                        </div>
                    </div>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="button" ng-click="check_otp()">Submit</button>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="button" ng-click="resend_otp()">Resend OTP</button>
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
    <script src="<?= base_url(); ?>assets/template/js/pages/examples/sign-up.js"></script>
</body>

</html>