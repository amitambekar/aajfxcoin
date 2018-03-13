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
                            Referral income details
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <select class="form-control" id="referral_date">
                                    <option>All</option>
                                    <?php
                                    $date = '';//config_item('current_date'); 
                                    if(isset($_GET['date']) && $_GET['date'] != '')
                                    {
                                        $date = $_GET['date'];
                                    }
                                    $today = date("2018-01-01");
                                    for($i=0;$i<40;$i++){ 
                                    $d = date("Y-m-d", strtotime("$today +".$i." month"));
                                    if(strtotime(date("Y-m-d")) > strtotime($d))
                                    {
                                    ?>
                                    <option value="<?= $d; ?>" <?php if($date!='' && $date==$d){ echo "selected"; }?>><?= $d; ?></option> 
                                    <?php } } ?>
                                    
                                </select>
                            </li>
                            <li>
                                <button type="button" class="btn btn-primary waves-effect" ng-click="show_referral_income();">Show</button>
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
                                        <th>Remaining Coins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $details=getReferralIncomeDetails(0,$date); ?>
                                <?php 
                                $total_coins = 0;
                                $paid_coins = 0;
                                $remaining_coins = 0;
                                ?>
                                <?php foreach ($details as $row ) { 

                                    $total_coins = $total_coins+$row['Total_Coins'];
                                    $paid_coins = $paid_coins+$row['Paid_Coins'];
                                    $remaining_coins = $remaining_coins+$row['Remaining_Coins'];
                                    ?>
                                    <tr >
                                        <td><?= $row['userid'];?></td>
                                        <td><?= $row['username'];?></td>
                                        <td><?= $row['Remaining_Coins'];?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th><b>Total:</b></th>
                                        <th><?= $remaining_coins; ?></th>
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