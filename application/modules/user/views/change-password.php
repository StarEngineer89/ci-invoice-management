<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/16/2017
 * Time: 7:32 AM
 */
?>
<div class="ch-container">
    <div class="row">

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->

    <div class="row">
        <form action="<?php echo base_url()?>user/updatepassword" method="post" class="form-horizontal bv-form">
            <input type="hidden" name="email" value="<?php echo $email?>">
            <div class="form-group">
                <label class="col-lg-2 control-label">User Id</label>
                <div class="col-lg-3 has-feedback">
                    <input type="text" class="form-control" name="u_email" data-bv-field="email" value="<?php echo $email?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="password">Enter Password</label>
                <div class="col-md-3">
                    <input type="text" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="confirm">Confirm Password</label>
                <div class="col-md-3">
                    <input type="text" id="confirm" name="confirm" class="form-control" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="form-group pull-right">
                <div class="col-md-12">
                    <a href="<?php echo base_url('transaction/customer') ?>" class="btn btn-default">Cancel</a>
                    <!-- <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/> -->
                    <button type="submit" class="btn btn-primary" name="signup" value="Add Customer Information">Update Password</button>
                </div>
            </div>
        </form>
    </div><!--/row-->

    <!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

