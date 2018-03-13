<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/user_payment_details.js"></script>
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
                            User Coins income details
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button type="button" class="btn btn-primary waves-effect" onclick="window.location.href='<?php echo base_url(); ?>admin_user_payment_details/user_coins_income_excel'">Export to Excel</button>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Purchased Coins</th>
                                        <th>Purchased Amount</th>
                                        <th>Debited Coins</th>
                                        <th>Debited Amount</th>
                                        <th>Remaining Coins</th>
                                        <th>Remaining Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $details=getUserCoinsDetails(); ?>
                                <?php 
                                $purchased_coins = 0;
                                $purchased_amount = 0;
                                $debited_coins = 0;
                                $debited_amount = 0;
                                $remaining_coins = 0;
                                $remaining_amount = 0;
                                ?>
                                <?php foreach ($details as $row ) { 
                                    if($row['Purchased_Coins'] > 0) {

                                    $purchased_coins = $purchased_coins+$row['Purchased_Coins'];
                                    $purchased_amount = $purchased_amount+$row['Purchased_Amount'];
                                    $debited_coins = $debited_coins+$row['Debited_Coins'];
                                    $debited_amount = $debited_amount+$row['Debited_Amount'];
                                    $remaining_coins = $remaining_coins+$row['Remaining_Coins'];
                                    $remaining_amount = $remaining_amount+$row['Remaining_Amount'];     
                                    ?>
                                    <tr>
                                        <td><?= $row['userid'];?></td>
                                        <td><?= $row['username'];?></td>
                                        <td><?= $row['Purchased_Coins'];?></td>
                                        <td><?= $row['Purchased_Amount'];?></td>
                                        <td><?= $row['Debited_Coins'];?></td>
                                        <td><?= $row['Debited_Amount'];?></td>
                                        <td><?= $row['Remaining_Coins'];?></td>
                                        <td><?= $row['Remaining_Amount'];?></td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td><b>Total : </b></td>
                                        <td><b><?= $purchased_coins;?></b></td>
                                        <td><b><?= $purchased_amount;?></b></td>
                                        <td><b><?= $debited_coins;?></b></td>
                                        <td><b><?= $debited_amount;?></b></td>
                                        <td><b><?= $remaining_coins;?></b></td>
                                        <td><b><?= $remaining_amount;?></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Large Size -->
<div class="modal fade" id="release_payment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Release Payment</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Username : </label>
                            <input type="text" class="form-control" ng-model="rp_username" disabled="disabled" />
                            <input type="hidden" class="form-control" ng-model="rp_userid">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Total Amount : </label>
                            <input type="text" class="form-control" ng-model="rp_total_amount" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Amount Paid : </label>
                            <input type="text" class="form-control" ng-model="rp_amount_paid" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Amount Remaining : </label>
                            <input type="text" class="form-control" ng-model="rp_amount_remaining" disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Payment Description : </label>
                            <textarea cols="" rows=""  class="form-control" ng-model="rp_payment_desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Release Amount : </label>
                            <input type="text" class="form-control" ng-model="rp_release_amount"/>
                        </div>
                    </div>
                </div>        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" ng-click="release_payment('referral_income')">SAVE CHANGES</button>
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