<!-- Large Size -->
<div class="modal fade" id="error_log" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h4 class="modal-title modal_msg" id="largeModalLabel"></h4>
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
<!-- Large Size -->
<div class="modal fade" id="timeout" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <h4 class="modal-title" id="largeModalLabel">Session About To Timeout</h4>
            </div>
            <div class="modal-body">
                <p>You will be automatically logged out in 1 minute.<br/>
                To remain logged in move your mouse over this window.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
    $("body").addClass('theme-blue');
});

// Set timeout variables.
var timoutWarning = 1200000;
var timoutNow = 1800000;
var logoutUrl = '<?= site_url(); ?>logout'; // URL to logout page.

var warningTimer;
var timeoutTimer;

// Start timers.
function StartTimers() {
    warningTimer = setTimeout("IdleWarning()", timoutWarning);
    timeoutTimer = setTimeout("IdleTimeout()", timoutNow);
}

// Reset timers.
function ResetTimers() {
    clearTimeout(warningTimer);
    clearTimeout(timeoutTimer);
    StartTimers();
    $("#timeout").modal('hide');
}

// Show idle timeout warning dialog.
function IdleWarning() {
    $("#timeout").modal('show');
}

// Logout the user.
function IdleTimeout() {
    window.location = logoutUrl;
}
</script>

<!-- Bootstrap Core Js -->
<script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!--<script src="<?= base_url(); ?>assets/template/plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

<!-- Slimscroll Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/template/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url(); ?>assets/template/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>

<!-- Autosize Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?= base_url(); ?>assets/template/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?= base_url(); ?>assets/template/js/admin.js"></script>

<!-- Demo Js -->
<script src="<?= base_url(); ?>assets/template/js/demo.js"></script>


<script>
$(function () {
    //Textare auto growth
    autosize($('textarea.auto-growth'));
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });
    $(".slimScrollBar").css('width','10px');
    $(".slimScrollBar").css('opacity','1');
    $(".slimScrollBar").css('background','#2196f3');
});
</script>    
</body>

</html>