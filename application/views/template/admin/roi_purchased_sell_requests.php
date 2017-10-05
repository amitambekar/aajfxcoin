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
                    <div class="header bg-red">
                        <h2>
                            ROI & Purchased Coins Sell Requests
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
                                        <th>Controls</th>
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
                                        <th>Controls</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    $user_coins_requested_list=getUserCoin(0,'',array('user_coins.status'=>'Debit Request'));
                                    foreach ($user_coins_requested_list as $row ) { 
                                        ?>
                                        <tr id="row-id-<?php echo $row['user_coins_id']; ?>">
                                            <td username-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['username'];?>" coins-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['coins'];?>" coin_price-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['coin_price'];?>" amount-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['amount'];?>" payment_details-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['payment_details'];?>" payment_type-row-id-<?php echo $row['user_coins_id']; ?>="<?= $row['payment_type'];?>"><?= $row['username'];?></td>
                                            <td><?= $row['coins'];?></td>
                                            <td><?= $row['coin_price'];?></td>
                                            <td><?= $row['amount'];?></td>
                                            <td><?= $row['payment_details'];?></td>
                                            <td><?= $row['payment_type'];?></td>
                                            <td><?= $row['purchase_date'];?></td>
                                            <td>
                                                <a href="javascript:void(0);" ng-click="sell_coins_modal(<?php echo $row['user_coins_id']; ?>,<?php echo $row['userid']; ?>)">Accept</a>
                                                <a href="javascript:void(0);" class="deletePackage" ng-click="deleteUserCoinsRequest(<?php echo $row['user_coins_id']; ?>)">Delete</a>
                                            </td>
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
<!-- Large Size -->
<div class="modal fade" id="sell_coins_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Sell request for ROI coins</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Current Price : </label>
                        <span>{{current_price}}</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Number of coins to sell : </label>
                        <span>{{number_of_coins_to_sell}}</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Payment Details : </label>
                        <span>{{payment_details}}</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Payment Type : </label>
                        <span>{{payment_type}}</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Description : </label>
                            <input="hidden" ng-model="request_id"/>
                            <input type="text" class="form-control" ng-model="description"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" ng-click="sell_request_for_roi_purchased_coins()">Submit</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<?php $this->view('template/includes/footer'); ?>
<script>
$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });
});
</script>