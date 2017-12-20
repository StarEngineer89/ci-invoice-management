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
        <li><a href="#">Home</a></li>
        <li><a href="#">Delivery Note</a></li>
        <li><a href="#">Add</a></li>
    </ul>
    </div>
<style type="text/css">
    input[type='text']{
        color: #178acc;
    }
    input[type='email']{
        color: #178acc;
    }
    select.form-control{
        color: #178acc;
    }
    textarea.form-control{
        color: #178acc;   
    }
</style>
 <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Add Delivery Note</h2>

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
                <?php
                $drow = $delivery_note_edit[0];
                ?>
                <section>
                    <div class="col-lg-10">

                        <form action="<?php echo base_url()?>transaction/edit_delivery_note" id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Delivery Note No:</label>
                                <div class="col-lg-3">
                                    <input type="hidden" class="form-control" name="hddId" id="hddId" value="<?php echo $drow['id']?>" />
                                    <input type="text" class="form-control" name="delivery_note_no" id="delivery_note_no" value="<?php echo $drow['delivery_note_no']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Delivery Date:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="delivery_date" id="delivery_date" value="<?php echo $drow['delivery_date']?>" />
                                </div>
                                <label class="col-lg-2 control-label">Delivery Status:</label>
                                <div class="col-lg-3">
                                    <select name="delivery_status" id="delivery_status" class="form-control">
                                        <?php $delivery_status = $this->mdl_general->GetAllInfoSorting('ims_status','status_id', 'status_id');
                                            foreach ($delivery_status as $stat) { ?>
                                            <option value="<?php echo $stat['status_id']?>" <?php echo ($drow['delivery_note_no'] == $stat['status_id']) ? 'selected' : '' ?> ><?php echo $stat['description']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Order No.:</label>
                                <div class="col-lg-3">
                                    <select name="order_no" id="order_no" class="form-control">
                                        <option value="">Select</option>
                                        <?php $orderno = $this->mdl_general->GetAllInfoSorting('ims_ordermaster','orderid', 'orderid');
                                            foreach ($orderno as $o) { ?>
                                            <option value="<?php echo $o['orderid']?>" <?php echo ($drow['order_no'] == $o['orderid']) ? 'selected' : '' ?> ><?php echo $o['orderid']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="CustomerName">Customer Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="CustomerName" name="CustomerName" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="home_address">Address</label>
                                 <div class="col-md-3">
                                    <input type="text" id="home_address" name="home_address" class="form-control" />
                                </div>
                                <label class="col-md-2 control-label" for="postcode">PostCode</label>
                                <div class="col-md-3">
                                    <input type="text" id="postcode" name="postcode" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <label class="col-md-2 control-label" for="email">Email</label>
                                <div class="col-md-3">
                                    <input type="email" id="email" name="email" class="form-control" />
                                </div>
                                <label class="col-md-2 control-label" for="mobile_no">Contact No</label>
                                <div class="col-md-3">
                                    <input type="number" id="mobile_no" name="mobile_no" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-md-2 control-label" for="delivery_details">Delivery Details</label>
                                <div class="col-md-10">
                                    <textarea name="delivery_details" id="delivery_details" class="form-control" rows="5"><?php echo $drow['delivery_details']?></textarea>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <div class="col-md-12">
                                    <a href="<?php echo base_url()?>transaction/delivery_note" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-primary" name="Update" >Update</button>
                                </div>
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
var base_url = "<?php echo base_url()?>";
 $(document).ready(function(){
    $.ajax({
        type: "POST",
        url: base_url+"transaction/getOrderDetails",
        data: {
            id: $("#order_no").val()
        },
        dataType: "json",
        success: function(data) {
            var home_add = data[0]['home_address'].split('-');
            var amount = parseFloat(data[0]['total_order']);
            $('#CustomerName').val(data[0]['complete_name']);
            $('#home_address').val(home_add[0]);
            $('#postcode').val(home_add[1]);
            $('#email').val(data[0]['customer_email']);
            $('#mobile_no').val(data[0]['mobile_no']);
        }
    });
 });
 $("#order_no").change(function() {
    $.ajax({
        type: "POST",
        url: base_url+"transaction/getOrderDetails",
        data: {
            id: $(this).val()
        },
        dataType: "json",
        success: function(data) {
            var home_add = data[0]['home_address'].split('-');
            var amount = parseFloat(data[0]['total_order']);
            $('#CustomerName').val(data[0]['complete_name']);
            $('#home_address').val(home_add[0]);
            $('#postcode').val(home_add[1]);
            $('#email').val(data[0]['customer_email']);
            $('#mobile_no').val(data[0]['mobile_no']);
        }
    });
});
</script>
<?php $this->load->module('footer')->index(); ?>

