<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/bonus.js"></script>
<section class="content">
        <div class="container-fluid">
            <?php $this->view('template/includes/slider'); ?>
            <!--<div class="block-header">
                <h2>DASHBOARD</h2>
            </div>-->

            <?php 
                $userid = $session_data['logged_in']['userid'];
                //$roi_details =  getROIIncomeDetails($userid);
                //$bonus_details = getBonusIncomeDetails($userid);
                $referral_details = getReferralIncomeDetails($userid);
            ?>
            <!-- Widgets -->
            <div class="row clearfix">          
                <div class="col-sm-4">
                    <div class="info-box-3 bg-blue hover-expand-effect">
                        <div class="icon">
                            <div class="chart chart-bar">4,6,-3,-1,2,-2,4,6</div>
                        </div>
                        <div class="content">
                            <div class="text">Referral income total</div>
                            <div class="number"><?= "₹ ".sprintf("%02d", (isset($referral_details['Total_Coins']) ? $referral_details['Total_Coins'] : 0) ); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box-3 bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance</i>
                        </div>
                        <div class="content">
                            <div class="text">Referral income paid</div>
                            <div class="number"><?= "₹ ".sprintf("%02d", (isset($referral_details['Paid_Coins']) ? $referral_details['Paid_Coins'] : 0) ); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="info-box-3 bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance</i>
                        </div>
                        <div class="content">
                            <div class="text">Referral income remaining</div>
                            <div class="number"><?= "₹ ".sprintf("%02d", (isset($referral_details['Remaining_Coins']) ? $referral_details['Remaining_Coins'] : 0) ); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->view('template/includes/footer'); ?>
    <!-- Jquery CountTo Plugin Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery-countto/jquery.countTo.js"></script>
    <!-- Sparkline Chart Plugin Js -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script>
    $(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar:not(.reverse)').sparkline(undefined, {
        type: 'bar',
        barColor: 'rgba(0, 0, 0, 0.15)',
        negBarColor: 'rgba(0, 0, 0, 0.15)',
        barWidth: '8px',
        height: '34px'
    });

    //Chart Bar Reverse
    $('.chart.chart-bar.reverse').sparkline(undefined, {
        type: 'bar',
        barColor: 'rgba(255, 255, 255, 0.15)',
        negBarColor: 'rgba(255, 255, 255, 0.15)',
        barWidth: '8px',
        height: '34px'
    });

    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(0,0,0,0.10)', 'rgba(0,0,0,0.15)', 'rgba(0,0,0,0.20)', 'rgba(0,0,0,0.25)']
    });

    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: 'rgba(0, 0, 0, 0.15)',
        lineWidth: 2,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(0, 0, 0, 0.15)',
        maxSpotColor: 'rgba(0, 0, 0, 0.15)',
        minSpotColor: 'rgba(0, 0, 0, 0.15)',
        spotRadius: 3,
        highlightSpotColor: 'rgba(0, 0, 0, 0.15)'
    });
}
    </script>