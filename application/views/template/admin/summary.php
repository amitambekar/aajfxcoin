<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/bonus.js"></script>
<section class="content">
        <div class="container-fluid">
            <?php $this->view('template/includes/slider'); ?>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                Summary
                            </h2>
                        </div>
                        <?php 
                        $remaining_coins_data = getRemainingCoins(); 
                        //dump($remaining_coins_data);
                        $total_coins = round($remaining_coins_data['total_coins'],2);
                        $total_used_coins = round($remaining_coins_data['total_used_coins'],2);
                        $remaining_coins = round($remaining_coins_data['remaining_coins'],2);
                        $total_debit_from_amitjain = round($remaining_coins_data['referral_coins_data']['total_debit_from_amitjain'],2);
                        ?>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL COINS</div>
                                            <div class="number" ><?= $total_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL USED COINS</div>
                                            <div class="number" ><?= $total_used_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-purple">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL REMAINING COINS</div>
                                            <div class="number" ><?= $remaining_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-pink">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL DEBITED COINS FROM AMITJAIN</div>
                                            <div class="number" ><?= $total_debit_from_amitjain; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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