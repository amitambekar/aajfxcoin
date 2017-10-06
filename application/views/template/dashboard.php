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
            $coin_price_data = getCoinPrice(true);
            $coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
            
            $number_of_referral_coins = 0;
            $number_of_referral_debited_coins = 0;
            $total_referral_coins = 0;
            
            $total_referral_amount = 0;
            $total_referral_withdraw_amount = 0;
            $get_user_coin_data = getReferralIncome($userid);
            foreach ($get_user_coin_data as $row) {
                if($row['payment_status'] == 'Credit')
                {
                    $number_of_referral_coins = $number_of_referral_coins + $row['coins'];
                    $total_referral_coins = $total_referral_coins + $row['coins'];
                }

                if($row['payment_status'] == 'Debit' || $row['payment_status'] == 'Debit Request')
                {
                    $number_of_referral_debited_coins = $number_of_referral_debited_coins + $row['coins'];
                    $total_referral_withdraw_amount = $total_referral_withdraw_amount + $row['coins']*$row['coin_price'];
                }
            }

            $number_of_referral_coins = $number_of_referral_coins - $number_of_referral_debited_coins;
            $total_referral_amount = $number_of_referral_coins*$coin_price;
            ?>
            <!-- Widgets -->
            <div class="col-lg-3">
                <div class="info-box bg-pink">
                    <div class="icon">
                        <i class="material-icons">work</i>
                    </div>
                    <div class="content">
                        <div class="text">1 COIN</div>
                        <div class="number" ><?= "₹ ".str_replace('.0000', '', $coin_price); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="info-box bg-purple">
                    <div class="icon">
                        <i class="material-icons">shopping_cart</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL EARN COINS</div>
                        <div class="number" ><?= str_replace('.0000', '', $total_referral_coins); ?></div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                Referral Income
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL COINS</div>
                                            <div class="number" ><?= $number_of_referral_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <!--<div class="icon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL AMOUNT</div>
                                            <div class="number" ><?= $total_referral_amount; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL WITHDRAW COINS</div>
                                            <div class="number" ><?= $number_of_referral_debited_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL WITHDRAW AMOUNT</div>
                                            <div class="number" ><?= $total_referral_withdraw_amount; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $number_of_roi_coins = 0;
            $number_of_roi_released_coins = 0;
            $number_of_roi_debited_coins = 0;
            
            $total_roi_amount = 0;
            $total_roi_released_amount = 0;
            $total_roi_withdraw_amount = 0;
            $get_user_coin_data = getUserCoin($userid);
            foreach ($get_user_coin_data as $row) {
                if($row['user_coins_status'] == 'accepted')
                {
                    $number_of_roi_coins = $number_of_roi_coins + $row['coins'];
                }

                if($row['user_coins_status'] == 'Bonus')
                {
                    $number_of_roi_coins = $number_of_roi_coins + $row['coins'];
                }

                if($row['user_coins_status'] == 'Credit')
                {
                    $number_of_roi_released_coins = $number_of_roi_released_coins + $row['coins'];
                }

                if($row['user_coins_status'] == 'Debit' || $row['user_coins_status'] == 'Debit Request')
                {
                    $number_of_roi_debited_coins = $number_of_roi_debited_coins + $row['coins'];
                    $total_roi_withdraw_amount = $total_roi_withdraw_amount + $row['coins']*$row['coin_price'];
                }
            }

            $number_of_roi_coins = $number_of_roi_coins - $number_of_roi_released_coins;
            $total_roi_amount = $number_of_roi_coins*$coin_price;

            $number_of_roi_released_coins = $number_of_roi_released_coins - $number_of_roi_debited_coins;
            $total_roi_released_amount = $number_of_roi_released_coins*$coin_price;


            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                ROI Income
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL COINS</div>
                                            <div class="number" ><?= $number_of_roi_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <!--<div class="icon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL AMOUNT</div>
                                            <div class="number" ><?= $total_roi_amount; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-purple">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL RELEASED COINS</div>
                                            <div class="number" ><?= $number_of_roi_released_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-purple">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL RELEASED AMOUNT</div>
                                            <div class="number" ><?= $total_roi_released_amount; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL WITHDRAW COINS</div>
                                            <div class="number" ><?= $number_of_roi_debited_coins; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <!--<div class="icon">
                                            <i class="material-icons">store</i>
                                        </div>-->
                                        <div class="content">
                                            <div class="text">TOTAL WITHDRAW AMOUNT</div>
                                            <div class="number" ><?= $total_roi_withdraw_amount; ?></div>
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