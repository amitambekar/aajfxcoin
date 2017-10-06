<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/user_coins.js"></script>
<section class="content">
    <div class="container-fluid">
        <!--<div class="block-header">
            <h2>PACKAGES</h2>
        </div>-->

        <!-- Tabs With Custom Animations -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            User Coins Accepted Requests
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Coins</th>
                                        <th>Coin price</th>
                                        <th>Amount</th>
                                        <th>Payment Details</th>
                                        <th>Payment Type</th>
                                        <th>Purchase Date</th>
                                        <th>Acceptance Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Coins</th>
                                        <th>Coin price</th>
                                        <th>Amount</th>
                                        <th>Payment Details</th>
                                        <th>Payment Type</th>
                                        <th>Purchase Date</th>
                                        <th>Acceptance Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php 
                                    $user_coins_list=getUserCoin(0,'',array('user_coins.status'=>'accepted'));
                                    foreach ($user_coins_list as $row ) { 
                                        ?>
                                        <tr>
                                            <td><?= $row['username'];?></td>
                                            <td><?= $row['coins'];?></td>
                                            <td><?= $row['coin_price'];?></td>
                                            <td><?= $row['amount'];?></td>
                                            <td><?= $row['payment_details'];?></td>
                                            <td><?= $row['payment_type'];?></td>
                                            <td><?= $row['purchase_date'];?></td>
                                            <td><?= $row['acceptance_date']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->view('template/includes/footer'); ?>
<script>
$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });
});
</script>