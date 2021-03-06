<?php $this->view('template/includes/header'); ?>
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
                    <div class="header bg-blue">
                        <h2>
                            Referral Income
                        </h2>
                        <!--<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button type="button" class="btn btn-success waves-effect" ng-click="sell_referral_coins_modal();">SELL COINS</button>
                                <button type="button" class="btn btn-danger waves-effect" ng-click="wallet_transfer_modal();">WALLET TRANSFER</button>
                            </li>
                        </ul>-->
                    </div>
                    <div class="body">
                        <?php
                        $userid = $session_data['logged_in']['userid']; 
                        $referral_coin_details = getReferralCoinDetails($userid);
                        $coin_price = 2;
                        
                        $number_of_coins = $referral_coin_details['number_of_coins'];
                        $number_of_debited_coins = $referral_coin_details['number_of_debited_coins'];
                        
                        $total_withdraw_amount = $referral_coin_details["total_withdraw_amount"];
                        $total_amount = $referral_coin_details["total_amount"];

                        $get_referral_coin_data = $referral_coin_details["get_referral_coin_data"];
                        ?>
                        <div class="row clearfix">
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
                                <div class="info-box bg-green">
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
                                <div class="info-box bg-green">
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
                                <div class="info-box bg-red">
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
                                <div class="info-box bg-red">
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
                                        <th>Username</th>
                                        <th>Coins</th>
                                        <th>Amount</th>
                                        <th>From</th>
                                        <th>Payment Details</th>
                                        <th>Payment Type</th>
                                        <th>Payment Description</th>
                                        <th>Payment status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $coin_price = 2;
                                ?>
                                <?php foreach ($get_referral_coin_data as $row ) {  
                                    if($row['payment_status'] == 'Debit' || $row['payment_status'] == 'Debit Request')
                                    {
                                        $amount = $row['coins']*$row['coin_price'];    
                                    }else
                                    {
                                        $amount = $row['coins']*$coin_price;
                                    }

                                    $description = '';
                                    if($row['description'] == 'Wallet Transfer' && $row['payment_status'] == 'Credit')
                                    {
                                        $description=$row['description'].' from '.$row['transfer_username'];
                                    }elseif ($row['description'] == 'Wallet Transfer' && $row['payment_status'] == 'Debit') {
                                        $description=$row['description'].' to '.$row['transfer_username'];
                                    }else
                                    {
                                        $description = $row['description'];
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td><?= $row['username'];?></td>
                                        <td><?= $row['coins'];?></td>
                                        <td><?= $amount; ?></td>
                                        <td><?= $row['transfer_username'];?></td>
                                        <td><?= ($row['payment_details']) ? $row['payment_details'] : '-';?></td>
                                        <td><?= ($row['payment_type']) ? $row['payment_type'] : '-';?></td>
                                        <td><?= ($row['description'] !='') ? $description : '-'; ?></td>
                                        <td><?= $row['payment_status']; ?></td>
                                        <td><?= date("d-M-Y g:i:s A",strtotime($row['referral_created_date']));?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <th>Username</th>
                                    <th>Coins</th>
                                    <th>Amount</th>
                                    <th>From</th>
                                    <th>Payment Details</th>
                                    <th>Payment Type</th>
                                    <th>Payment Description</th>
                                    <th>Payment status</th>
                                    <th>Date</th>
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
<div class="modal fade" id="sell_referral_coins_modal" tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-primary waves-effect" ng-click="sell_referral_coins()">Submit</button>
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
                            <label>Coins Earned: </label>
                            <input type="text" class="form-control" ng-model="coins_earned" disabled/>
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