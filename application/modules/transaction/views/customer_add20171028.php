
<div class="ch-container">
    <div class="row">
        <?php $this->load->module('sidebar')->index();?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Customer Add</a>
        </li>
    </ul>
</div>

 <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Add Customer</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form action="<?php echo site_url()?>transaction/add_customer" method="post" id="editUserForm" class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-1 control-label" for="fname">First Name</label>
                    <div class="col-md-3">
                        <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name"/>
                    </div>
                    <label class="col-md-1 control-label" for="mname">Middle Name</label>
                    <div class="col-md-3">
                        <input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name"/>
                    </div>
                    <label class="col-md-1 control-label" for="lname">Last Name</label>
                    <div class="col-md-3">
                        <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="home_address">Home Address</label>
                    <div class="col-md-3">
                        <input type="text" id="home_address" name="home_address" class="form-control" placeholder="Home Address"/>
                    </div>
                    <label class="col-md-1 control-label" for="home_postcode">Home Postcode</label>
                    <div class="col-md-3">
                        <input type="text" id="home_postcode" name="home_postcode" class="form-control" placeholder="Home Postcode"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="office_address">Office Address</label>
                    <div class="col-md-3">
                        <input type="text" id="office_address" name="office_address" class="form-control" placeholder="Office Address"/>
                    </div>
                    <label class="col-md-1 control-label" for="office_postcode">Office Postcode</label>
                    <div class="col-md-3">
                        <input type="text" id="office_postcode" name="office_postcode" class="form-control" placeholder="Office Postcode"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="customer_email">Customer Email</label>
                    <div class="col-md-3">
                        <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Customer Email"/>
                    </div>
                    <label class="col-md-1 control-label" for="home_number">Home Number</label>
                    <div class="col-md-3">
                        <input type="text" id="home_number" name="home_number" class="form-control" placeholder="Home Number"/>
                    </div>
                    <label class="col-md-1 control-label" for="mobile_no">Mobile</label>
                    <div class="col-md-3">
                        <input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Mobile"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="website">Website</label>
                    <div class="col-md-3">
                        <input type="text" id="website" name="website" class="form-control" placeholder="http://"/>
                    </div>
                    <label class="col-md-1 control-label" for="facebook">Facebook</label>
                    <div class="col-md-3">
                        <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook"/>
                    </div>
                    <label class="col-md-1 control-label" for="twitter">Twitter</label>
                    <div class="col-md-3">
                        <input type="text" id="twitter" name="twitter" class="form-control" placeholder="Twitter"/>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-1 control-label" for="password">Password</label>
                    <div class="col-md-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <label class="col-md-1 control-label" for="confirm_password">Confirm Password</label>
                    <div class="col-md-3">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password"/>
                    </div>
                    <label class="col-md-1 control-label" for="active">Active</label>
                    <div class="col-md-3">
                        <input type="checkbox" id="active" name="active" class="form-control" value="1" />
                    </div>
                </div>
                <div class="form-group pull-right">
                    <div class="col-md-12">
                        <a href="<?php echo base_url()?>transaction/customer" class="btn btn-default">Cancel</a>
                        <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/>
                    </div>
                </div>

            </form>
            <br>
            <br>

            <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    </div>
   </div>
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<?php $this->load->module('footer')->index(); ?>

