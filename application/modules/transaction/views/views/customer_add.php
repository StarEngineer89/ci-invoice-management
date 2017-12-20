<!-- <link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.css"/> -->
<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrapValidator.css"/>

<!-- Include the FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
<!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />-->

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrapValidator.js"></script>
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
         <div class="container">
            <div class="row">
                <!-- form: -->
                <section>
                    <div class="col-lg-10">

                        <form action="<?php echo base_url()?>transaction/add_customer" id="defaultForm" method="post" class="form-horizontal" >
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Full name</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" />
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle name" />
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="home_address">Home Address</label>
                                 <div class="col-md-6">
                                    <input type="text" id="home_address" name="home_address" class="form-control" placeholder="Home Address"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="home_postcode" name="home_postcode" class="form-control" placeholder="Home Postcode"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-2 control-label" for="business_name">Business Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Business Name"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="office_address" name="office_address" class="form-control" placeholder="Office Address"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="office_postcode" name="office_postcode" class="form-control" placeholder="Office Postcode"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="customer_email">Email</label>
                                <div class="col-lg-6">
                                    <input type="email" id="customer_email" name="customer_email" class="form-control" placeholder="Customer Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="home_number">Home Number</label>
                                <div class="col-md-3">
                                    <input type="text" id="home_number" name="home_number" class="form-control" placeholder="Home Number"/>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Mobile"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="website">Website</label>
                                <div class="col-md-6">
                                    <input type="text" id="website" name="website" class="form-control" placeholder="http://"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="facebook">Facebook</label>
                                <div class="col-md-6">
                                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Facebook"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="twitter">Twitter</label>
                                <div class="col-md-6">
                                    <input type="text" id="twitter" name="twitter" class="form-control" placeholder="Twitter"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-6">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Retype password</label>
                                <div class="col-lg-6">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-1 control-label" for="active">Active</label>
                                <div class="col-md-3">
                                    <input type="checkbox" id="active" name="active" class="form-control" value="1" />
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                <div class="col-md-12">
                                    <a href="<?php echo base_url()?>transaction/customer" class="btn btn-default">Cancel</a>
                                    <!-- <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/> -->
                                    <button type="submit" class="btn btn-primary" name="signup" value="Add Customer Information">Sign up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- :form -->
            </div>
        </div> <!-- End Row form-->
    </div>
    </div>
   </div>
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
</div> <!-- End ch-container-->
<script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha

    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fname: {
                group: '.col-lg-3',
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            lname: {
                group: '.col-lg-3',
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            },
            customer_email: {
                validators: {
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            home_number: {
                validators: {
                    digits: {}
                }
            },
            mobile_no: {
                validators: {
                    digits: {}
                }
            },
            website: {
                validators: {
                    uri: {
                        allowLocal: true,
                        message: 'The input is not a valid URL'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'confirm_password',
                        message: 'The password and its confirm are not the same'
                    }                }
            },
            confirm_password: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

    $('#resetBtn').click(function() {
        $('#defaultForm').data('bootstrapValidator').resetForm(true);
    });
});
</script>
<?php $this->load->module('footer')->index(); ?>

