<?php $this->view('template/includes/header'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ng/referral_income.js"></script>
<section class="content">
    <div class="container-fluid">
        <?php $this->view('template/includes/slider'); ?>
        <!--<div class="block-header">
            <h2>PACKAGES</h2>
        </div>-->
        <!-- Tabs With Custom Animations -->
        <?php //dump(getReferralIncome(1)); ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-red">
                        <h2>
                            Referral Income
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Coins</th>
                                        <th>Amount</th>
                                        <th>Payment Description</th>
                                        <th>Payment status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_coins = 0;
                                $total_amount = 0; 
                                $coin_price_data = getCoinPrice(true);
                                $coin_price = ($coin_price_data['coin_price'] ? $coin_price_data['coin_price'] : 0);
                                $details = getReferralIncome($session_data['logged_in']['userid']); ?>
                                <?php foreach ($details as $row ) {  
                                    $total_coins = $total_coins + $row['coins'];
                                    $amount = $row['coins']*$coin_price;
                                    $total_amount = $total_amount + $amount;
                                    ?>
                                    <tr>
                                        <td><?= $row['username'];?></td>
                                        <td><?= $row['coins'];?></td>
                                        <td><?= $amount; ?></td>
                                        <td><?= ($row['description'] !='') ? $row['description'] : '-'; ?></td>
                                        <td><?= $row['payment_status']; ?></td>
                                        <td><?= date("d-M-Y g:i:s A",strtotime($row['created_date']));?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <th></th>
                                    <th>Total coins : <?= $total_coins; ?></th>
                                    <th>Total amount : <?= $total_amount; ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>
<?php $this->view('template/includes/footer'); ?>