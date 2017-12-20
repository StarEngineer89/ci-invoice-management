<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/19/2017
 * Time: 11:57 AM
 */
?>

<div class="ch-container">
    <div class="row">
        <?php $this->load->module('sidebar')->customer();?>

<div id="content" class="col-lg-10 col-sm-10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url('customer/index') ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('customer/userinfo') ?>">User Information</a>
            </li>
        </ul>
    </div>

    <div class="row">

        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="glyphicon glyphicon-list-alt"></i> Customer Information</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="container">
                        <div class="row">
                            <!-- form: -->
                            <form action="<?php echo base_url('customer/editUserDetails')?>" id="defaultForm" method="post" class="form-horizontal" >
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Full name</label>
                                    <div class="col-lg-3">
                                        <input type="hidden" name="hddcustomer_id" value="<?php echo $customer_info->customer_id ;?>">
                                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $customer_info->fname ;?>" placeholder="First name" />
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="mname" id="mname" value="<?php echo $customer_info->mname ;?>" placeholder="Middle name" />
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $customer_info->lname ;?>" placeholder="Last name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="home_address">Home Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="home_address" name="home_address" class="form-control" value="<?php echo $customer_info->home_address ;?>" placeholder="Home Address"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="home_postcode" name="home_postcode" class="form-control" value="<?php echo $customer_info->home_postcode ;?>" placeholder="Home Postcode"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="business_name">Business Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="business_name" name="business_name" class="form-control" value="<?php echo $customer_info->business_name ;?>" placeholder="Business Name"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="office_address" name="office_address" class="form-control" value="<?php echo $customer_info->office_address ;?>" placeholder="Office Address"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="office_postcode" name="office_postcode" class="form-control" value="<?php echo $customer_info->office_postcode ;?>" placeholder="Office Postcode"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="customer_email">Email</label>
                                    <div class="col-lg-6">
                                        <input type="email" id="customer_email" name="customer_email" class="form-control" value="<?php echo $customer_info->customer_email ;?>" placeholder="Customer Email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="home_number">Home Number</label>
                                    <div class="col-md-3">
                                        <input type="text" id="home_number" name="home_number" class="form-control" value="<?php echo $customer_info->home_number ;?>" placeholder="Home Number"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="<?php echo $customer_info->mobile_no ;?>" placeholder="Mobile"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="website">Website</label>
                                    <div class="col-md-6">
                                        <input type="text" id="website" name="website" class="form-control" value="<?php echo $customer_info->website ;?>" placeholder="http://"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="facebook">Facebook</label>
                                    <div class="col-md-6">
                                        <input type="text" id="facebook" name="facebook" class="form-control" value="<?php echo $customer_info->facebook ;?>" placeholder="Facebook"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="twitter">Twitter</label>
                                    <div class="col-md-6">
                                        <input type="text" id="twitter" name="twitter" class="form-control" value="<?php echo $customer_info->twitter ;?>" placeholder="Twitter"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-6">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Retype password</label>
                                    <div class="col-lg-6">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" value=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label" for="active">Active</label>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="active" name="active" class="form-control" value="1" <?php echo ($customer_info->active) == 1 ? 'checked' : '' ;?> />
                                    </div>
                                </div>

                                <div class="form-group pull-right">
                                    <div class="col-md-12">
                                        <a href="<?php echo base_url()?>transaction/customer" class="btn btn-default">Cancel</a>
                                        <!-- <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/> -->
                                        <button type="submit" class="btn btn-primary" name="signup">Update Customer Information</button>
                                    </div>
                                </div>
                            </form>
                            <!-- :form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/row-->
    <!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

<?php $this->load->module('footer')->index(); ?>
