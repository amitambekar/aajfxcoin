<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/home.js"></script>
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
                            Payout
                        </h2>
                    </div>
                    <div class="body">
                        <button type="button" class="btn btn-primary waves-effect" ng-click="released_monthly_payout('Credit')">Release Monthly Payout to all</button>
                        <button type="button" class="btn btn-primary waves-effect" ng-click="released_monthly_payout('Debit')">Give Release Monthly Payout to all</button>
                        <button type="button" class="btn btn-danger waves-effect" ng-click="referral_income_payout()">Give Referral Income to all</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->view('template/includes/footer'); ?>