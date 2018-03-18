<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/user_payment_details.js"></script>
<script>
function show_data()
{
    var show_date = $("#show_date").val() || '';
    if(show_date == '')
    {
        alert("please select date.");
        return false;
    }
    window.location.href = window._site_url+"admin_user_payment_details/user_coins_income?date="+show_date;
}
</script>
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
                                <select class="form-control" id="show_date">
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
                                <button type="button" class="btn btn-primary waves-effect" onclick="show_data();">Show</button>
                            </li>
                            <!--<li class="dropdown">
                                <button type="button" class="btn btn-primary waves-effect" onclick="window.location.href='<?php echo base_url(); ?>admin_user_payment_details/user_coins_income_excel'">Export to Excel</button>
                            </li>-->
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
                                        <th>Coins</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $details=getUserCoinsDetails(0,$date); ?>
                                <?php 
                                $purchased_coins = 0;
                                $purchased_amount = 0;
                                $debited_coins = 0;
                                $debited_amount = 0;
                                ?>
                                <?php foreach ($details as $row ) { 
                                    if($row['Purchased_Coins'] > 0) {

                                    $purchased_coins = $purchased_coins+$row['Purchased_Coins'];
                                    $purchased_amount = $purchased_amount+$row['Purchased_Amount'];
                                    $debited_coins = $debited_coins+$row['Debited_Coins'];
                                    $debited_amount = $debited_amount+$row['Debited_Amount'];   
                                    ?>
                                    <tr>
                                        <td><?= $row['userid'];?></td>
                                        <td><?= $row['username'];?></td>
                                        <td><?= $row['Purchased_Coins'];?></td>
                                        <td><?= $row['Purchased_Amount'];?></td>
                                        <td><?= $row['Debited_Coins'];?></td>
                                        <td><?= $row['Debited_Amount'];?></td>
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
$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });
});
</script>