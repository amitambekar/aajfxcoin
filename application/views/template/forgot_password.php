<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Forgot Password | AajFxCoin</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core Css -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
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
        <div class="body">
            <div id="forgot_password" class="login-form">
                <div class="msg">
                    Enter your username that you used to register. We'll send you an email with your username and a
                    link to reset your password.
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" ng-model="forgot_username" placeholder="Username" />
                </div>
                <button class="btn btn-block bg-pink waves-effect" type="button" ng-click="forgot_password()">RESET MY PASSWORD</button>

                <button class="btn btn-block bg-pink waves-effect" type="button" onclick="window.location.href='<?= site_url(); ?>login'">Sign In</button>
                
            </div>
        </div>
    </div>
    <!-- Large Size -->
    <div class="modal fade" id="error_log" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h4 class="modal-title modal_msg" id="largeModalLabel">Errors</h4>
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