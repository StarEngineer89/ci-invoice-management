<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/19/2017
 * Time: 12:12 PM
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
                        <a href="<?php echo base_url('customer/invoiceDetails') ?>">Invoice Details</a>
                    </li>
                </ul>
            </div>

            <div class="row">

                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2><i class="glyphicon glyphicon-list-alt"></i> Invoice Details</h2>

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
                                    <?php $invoice_info = $invoice_info[0] ?>
                                    <form action="<?php echo base_url('customer/editInvoice')?>" id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Invoice No:</label>
                                            <div class="col-lg-3">
                                                <input type="hidden" name="hddorderId" value="<?php echo $invoice_info['order_no'] ?>">
                                                <input type="hidden" class="form-control" name="hddId" id="hddId" value="<?php echo $invoice_info['id'] ?>" />
                                                <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $invoice_info['invoice_no'] ?>" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Payment Date:</label>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" name="invoice_date" id="invoice_date" value="<?php echo $invoice_info['invoice_date'] ?>" />
                                            </div>
                                            <label class="col-lg-2 control-label">Invoice Status:</label>
                                            <div class="col-lg-3">
                                                <select name="invoice_status" id="invoice_status" class="form-control">
                                                    <?php $invoice_status = $this->mdl_general->GetAllInfoSorting('ims_status','status_id', 'status_id');
                                                    foreach ($invoice_status as $stat) { ?>
                                                        <option value="<?php echo $stat['status_id']?>" <?php echo ($invoice_info['invoice_status'] == $stat['status_id']) ? 'selected' : ''?> ><?php echo $stat['description']?></option>
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
                                                        <option value="<?php echo $o['orderid']?>" <?php echo ($invoice_info['order_no'] == $o['orderid']) ? 'selected' : '' ?> ><?php echo $o['orderid']?></option>
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
                                                <input type="number" id="paid_amount" onkeyup="total_paid_amount()" name="paid_amount" class="form-control" value="<?php echo $invoice_info['receive_amount'] ?>" />
                                            </div>
                                            <label class="col-lg-2 control-label">Payment Mode:</label>
                                            <div class="col-lg-3">
                                                <select name="payment_mode" id="payment_mode" class="form-control">
                                                    <?php $payment_mode = $this->mdl_general->GetAllInfoSorting('ims_paymentmode','paymentmode_id', 'paymentmode_id');
                                                    foreach ($payment_mode as $mode) { ?>
                                                        <option value="<?php echo $mode['paymentmode_id']?>" <?php echo ($invoice_info['paymentmode_id'] == $mode['paymentmode_id']) ? 'selected' : ''; ?> ><?php echo $mode['description']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="balance">Balance</label>
                                            <div class="col-md-3">
                                                <input type="number" name="balance" id="balance" class="form-control" value="<?php echo $invoice_info['balance'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="remarks">Remarks</label>
                                            <div class="col-md-10">
                                                <textarea name="remarks" id="remarks" class="form-control" rows="3"><?php echo $invoice_info['remarks']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group pull-right">
                                            <div class="col-md-12">
                                                <a href="<?php echo base_url('customer/')?>" class="btn btn-default">Cancel</a>
                                                <button type="submit" class="btn btn-primary" name="Update" >Update</button>
                                            </div>
                                        </div>
                                        </section>
                                    </form>
                                    <!-- :form -->
                                </div>
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

