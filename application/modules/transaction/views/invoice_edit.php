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
            <a href="#">Invoice</a>
        </li>
         <li>
            <a href="#">Edit</a>
        </li>
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
        <h2><i class="glyphicon glyphicon-user"></i> Edit Invoice</h2>

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
                $inv = $invoice_edit[0];?>
                <section>
                    <div class="col-lg-10">

                        <form action="<?php echo base_url()?>transaction/edit_invoice" id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Invoice No:</label>
                                <div class="col-lg-3">
                                    <input type="hidden" name="hddorderId" value="<?php echo $inv['order_no'] ;?>">
                                    <input type="hidden" class="form-control" name="hddId" id="hddId" value="<?php echo $inv['id'] ?>" />
                                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $inv['invoice_no'] ?>" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Payment Date:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="invoice_date" id="invoice_date" value="<?php echo $inv['invoice_date'] ?>" />
                                </div>
                                <label class="col-lg-2 control-label">Invoice Status:</label>
                                <div class="col-lg-3">
                                    <select name="invoice_status" id="invoice_status" class="form-control">
                                        <?php $invoice_status = $this->mdl_general->GetAllInfoSorting('ims_status','status_id', 'status_id');
                                            foreach ($invoice_status as $stat) { ?>
                                            <option value="<?php echo $stat['status_id']?>" <?php echo ($inv['invoice_status'] == $stat['status_id']) ? 'selected' : ''?> ><?php echo $stat['description']?></option>
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
                                            <option value="<?php echo $o['orderid']?>" <?php echo ($inv['order_no'] == $o['orderid']) ? 'selected' : '' ?> ><?php echo $o['orderid']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="amount">Amount</label>
                                <div class="col-md-3">
                                    <input type="number" id="amount" name="amount" onkeyup="total_paid_amount()" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="CustomerName">Customer Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="CustomerName" name="CustomerName" class="form-control" />
                                </div>
                                <label class="col-md-2 control-label" for="home_address">Address</label>
                                 <div class="col-md-3">
                                    <input type="text" id="home_address" name="home_address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="postcode">PostCode</label>
                                <div class="col-md-3">
                                    <input type="text" id="postcode" name="postcode" class="form-control" />
                                </div>
                                <label class="col-md-2 control-label" for="mobile_no">Contact No</label>
                                <div class="col-md-3">
                                    <input type="number" id="mobile_no" name="mobile_no" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="paid_amount">Paid Amount</label>
                                <div class="col-md-3">
                                    <input type="number" id="paid_amount" onkeyup="total_paid_amount()" name="paid_amount" class="form-control" value="<?php echo $inv['receive_amount'] ?>" />
                                </div>
                                <label class="col-lg-2 control-label">Payment Mode:</label>
                                <div class="col-lg-3">
                                    <select name="payment_mode" id="payment_mode" class="form-control">
                                        <?php $payment_mode = $this->mdl_general->GetAllInfoSorting('ims_paymentmode','paymentmode_id', 'paymentmode_id');
                                            foreach ($payment_mode as $mode) { ?>
                                            <option value="<?php echo $mode['paymentmode_id']?>" <?php echo ($inv['paymentmode_id'] == $mode['paymentmode_id']) ? 'selected' : ''; ?> ><?php echo $mode['description']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-md-2 control-label" for="balance">Balance</label>
                                <div class="col-md-3">
                                    <input type="number" name="balance" id="balance" class="form-control" value="<?php echo $inv['balance'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-md-2 control-label" for="remarks">Remarks</label>
                                <div class="col-md-10">
                                    <textarea name="remarks" id="remarks" class="form-control" rows="3"><?php echo $inv['remarks']?></textarea>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <div class="col-md-12">
                                    <a href="<?php echo base_url()?>transaction/invoice" class="btn btn-default">Cancel</a>
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
            $('#mobile_no').val(data[0]['mobile_no']);
            $('#amount').val(amount.toFixed(2));
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
            $('#mobile_no').val(data[0]['mobile_no']);
            $('#amount').val(amount.toFixed(2));
        }
    });
});
function total_paid_amount(){
    var _amount =  parseFloat($("#amount").val());
    var _paid_amount = parseFloat($("#paid_amount").val());
    var _total = 0;
        
        if(_paid_amount > _amount){
            _total = 0;
            $("#paid_amount").val("");
        }else{
            _total = (_amount-_paid_amount);
        }
        
        $("#balance").val(_total.toFixed(2));
}
</script>
<?php $this->load->module('footer')->index(); ?>

