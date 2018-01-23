<?php $this->view('template/includes/header'); ?>
<script src="<?php echo base_url(); ?>assets/js/ng/coins.js"></script>
<section class="content">
    <div class="container-fluid">
        <?php $this->view('template/includes/slider'); ?>
        <!--<div class="block-header">
            <h2>PACKAGES</h2>
        </div>-->
        <!-- Tabs With Custom Animations -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            Purchased Coins
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button type="button" class="btn btn-primary waves-effect" ng-click="buy_coin_modal();">BUY COINS</button>
                                <button type="button" class="btn btn-success waves-effect" ng-click="sell_coin_modal();">SELL COINS</button>
                                <button type="button" class="btn btn-danger waves-effect" ng-click="wallet_transfer_modal();">WALLET TRANSFER</button>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php
                        $userid = $session_data['logged_in']['userid']; 
                        $coin_details = getCoinsDetails($userid);
                        $coin_price = $coin_details['coin_price'];
                        
                        $number_of_debited_coins = $coin_details['number_of_debited_coins'];
                        $total_withdraw_amount = $coin_details['total_withdraw_amount'];
                        
                        $number_of_coins = $coin_details["number_of_coins"];
                        $total_amount = $coin_details["total_amount"];

                        $number_of_released_coins = $coin_details["number_of_released_coins"];
                        $total_released_amount = $coin_details["total_released_amount"];
                        $get_user_coin_data = $coin_details["get_user_coin_data"];

                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-3">
                                <div class="info-box bg-pink">
                                    <div class="icon">
                                        <i class="material-icons">work</i>
                                    </div>
                                    <div class="content">
                                        <div class="text">1 COIN</div>
                                        <div class="number" ><?= "₹ ".round($coin_price,2); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-blue">
                                    <!--<div class="icon">
                                        <i class="material-icons">store</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">TOTAL COINS</div>
                                        <div class="number" ><?= $number_of_coins; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-blue">
                                    <!--<div class="icon">
                                        <i class="material-icons">account_balance_wallet</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">TOTAL AMOUNT</div>
                                        <div class="number" ><?= $total_amount; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-green">
                                    <!--<div class="icon">
                                        <i class="material-icons">store</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">TOTAL RELEASED COINS</div>
                                        <div class="number" ><?= $number_of_released_coins; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-green">
                                    <!--<div class="icon">
                                        <i class="material-icons">store</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">TOTAL RELEASED AMOUNT</div>
                                        <div class="number" ><?= $total_released_amount; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-orange">
                                    <!--<div class="icon">
                                        <i class="material-icons">store</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">WITHDRAW COINS</div>
                                        <div class="number" ><?= $number_of_debited_coins; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-box bg-orange">
                                    <!--<div class="icon">
                                        <i class="material-icons">store</i>
                                    </div>-->
                                    <div class="content">
                                        <div class="text">WITHDRAW AMOUNT</div>
                                        <div class="number" ><?= $total_withdraw_amount; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Coins</th>
                                        <th>Coin Price</th>
                                        <th>Actual Amount</th>
                                        <th>Current Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Acceptance Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Coins</th>
                                        <th>Coin Price</th>
                                        <th>Actual Amount</th>
                                        <th>Current Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Acceptance Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    foreach($get_user_coin_data as $row1){ 
                                        $description = '';
                                        if($row1['description'] == 'Wallet Transfer' && $row1['user_coins_status'] == 'Credit')
                                        {
                                            $description=$row1['description'].' from '.$row1['transfer_username'];
                                        }elseif ($row1['description'] == 'Wallet Transfer' && $row1['user_coins_status'] == 'Debit') {
                                            $description=$row1['description'].' to '.$row1['transfer_username'];
                                        }else
                                        {
                                            $description = $row1['description'];
                                        }

                                        ?>
                                    <tr>
                                      <td><?= $row1['coins']; ?></td>
                                      <td><?= $row1['coin_price']; ?></td>
                                      <td><?= $row1['amount']; ?></td>
                                      <td><?= ($row1['user_coins_status'] == 'requested' || $row1['user_coins_status'] == 'Debit')? '-' : $row1['coins']*$coin_price; ?></td>
                                      <td><?= $description; ?></td>
                                      <td><?= $row1['user_coins_status']; ?></td>
                                      <td><?= ($row1['acceptance_date'] != '0000-00-00 00:00:00') ? date("d-m-Y H:i a",strtotime($row1['acceptance_date'])) : '-'; ?></td>
                                        
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
<div class="modal fade" id="buy_coins_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Buy Coins</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Current Price : </label>
                            <input type="text" class="form-control" ng-model="current_price" disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Number of coins : </label>
                            <input type="text" class="form-control" ng-model="number_of_coins" ng-change="calculate_amount()" ng-init="number_of_coins=0"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Amount : </label>
                            <input type="text" class="form-control" ng-model="amount" ng-init="amount=0" ng-change="calculate_coins()"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Payment Details : </label>
                            <input type="text" class="form-control" ng-model="payment_details"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Payment Type : </label>
                            <select class="form-control" ng-model="payment_type">
                                <option value="">Select</option>
                                <option value="Neteller">Neteller</option>
                                <option value="Bank">Bank</option>
                                <option value="BTC">BTC</option>
                            </select>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" ng-click="buy_coins()">Submit</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!-- Large Size -->
<div class="modal fade" id="sell_coins_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Sell Coins</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Current Price : </label>
                            <input type="text" class="form-control" ng-model="current_price" disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Number of coins : </label>
                            <input type="text" class="form-control" ng-model="number_of_coins" ng-change="calculate_amount()" ng-init="number_of_coins=0"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Amount : </label>
                            <input type="text" class="form-control" ng-model="amount" ng-init="amount=0" ng-change="calculate_coins()"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Payment Details : </label>
                            <input type="text" class="form-control" ng-model="payment_details"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Payment Type : </label>
                            <select class="form-control" ng-model="payment_type">
                                <option value="">Select</option>
                                <option value="Neteller">Neteller</option>
                                <option value="Bank">Bank</option>
                                <option value="BTC">BTC</option>
                            </select>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" ng-click="sell_coins()">Submit</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!-- Large Size -->
<div class="modal fade" id="wallet_transfer_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Wallet Transfer</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Released Coins : </label>
                            <input type="text" class="form-control" ng-model="released_coins" disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Current Price : </label>
                            <input type="text" class="form-control" ng-model="current_price" disabled/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Username : </label>
                            <input type="text" class="form-control" ng-model="transfer_username"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Number of coins to transfer: </label>
                            <input type="text" class="form-control" ng-model="number_of_coins" ng-change="calculate_amount()" ng-init="number_of_coins=0"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Amount to be transfer : </label>
                            <input type="text" class="form-control" ng-model="amount" ng-init="amount=0" ng-change="calculate_coins()"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" ng-click="wallet_transfer()">Submit</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!-- Large Size -->
<div class="modal fade" id="wallet_transfer_otp_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Wallet Transfer OTP</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>OTP : </label>
                            <input type="text" class="form-control" ng-model="transfer_otp"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" ng-click="wallet_transfer_otp()">Submit</button>
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

    $('.count-to').countTo();
});
</script>