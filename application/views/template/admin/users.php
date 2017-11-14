<?php $this->view('template/includes/header'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ng/admin/users.js"></script>
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
                            Users List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>User Image</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                        <th>Controls</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Username</th>
                                        <th>User Image</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                        <th>Controls</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $users_list=getUserInfo();
                                    foreach ($users_list as $row ) { 
                                        ?>
                                        <tr id="user-id-<?php echo $row['userid']; ?>">
                                            <td><?= $row['username'];?></td>
                                            <td><img class="img-responsive thumbnail" ng-src="<?= imagePath($row['profile_image'],'profile',$width = 70,$height=70);?>"></td>
                                            <td><?= ucfirst($row['firstname'])." ".ucfirst($row['middlename'])." ".ucfirst($row['lastname']);?></td>
                                            <td><?= $row['email'];?></td>
                                            <td><?= $row['mobile'];?></td>
                                            <td><?= $row['status'] != '' ? $row['status']:'deactivate';?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect" ng-click="delete_user(<?php echo $row['userid']; ?>)">Delete</button>
                                                <button type="button" class="btn btn-danger waves-effect" onclick="window.open('<?= site_url(); ?>admin_users/view/<?= $row['userid']; ?>','_blank');">View</button>
                                                <button type="button" class="btn btn-danger waves-effect" ng-click="give_bonus_modal(<?php echo $row['userid']; ?>)">Give Bonus</button>
                                                
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
<div class="modal fade" id="give_bonus_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Give Bonus</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Coins : </label>
                            <input type="text" class="form-control" ng-model="coins"/>
                            <input type="hidden" class="form-control" ng-model="bonus_userid">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Description : </label>
                            <input type="text" class="form-control" ng-model="desc"/>
                        </div>
                    </div>
                </div>        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" ng-click="give_bonus();">GIVE BONUS</button>
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