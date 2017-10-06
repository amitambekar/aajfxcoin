<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/coins.js"></script>
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
                            Coin Price Master
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>New Price</label>
                                        <input type="text" ng-model="new_price" class="form-control" ng-init="new_price=0"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary waves-effect" value="Submit" ng-click="add_coin_price()"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs With Custom Animations -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            Coin price List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Coin Price</th>
                                        <th>Created Date</th>
                                        <th>Mode</th>
                                        <th>Controls</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $coin_price_list=getCoinPrice();
                                    foreach ($coin_price_list as $row ) { 
                                        ?>
                                        <tr id="row-id-<?php echo $row['coin_price_id']; ?>">
                                            <td><?= $row['coin_price'];?></td>
                                            <td><?= date("d-m-Y h:i a",strtotime($row['created_date']));?></td>
                                            <td><?= $row['mode'];?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect" ng-click="delete_coins(<?php echo $row['coin_price_id']; ?>)">Delete</button>
                                                
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Coin Price</th>
                                        <th>Created Date</th>
                                        <th>Mode</th>
                                        <th>Controls</th>
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
<?php $this->view('template/includes/footer'); ?>
<script>
/*$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });
});*/
</script>