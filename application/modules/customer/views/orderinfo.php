<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/19/2017
 * Time: 12:11 PM
 */
?>
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
                    <a href="<?php echo base_url('customer/userinfo') ?>">Order Details</a>
                </li>
            </ul>
        </div>

        <div class="row">

            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                        <h2><i class="glyphicon glyphicon-list-alt"></i> Order Details</h2>

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
                                <form action="<?php echo base_url('customer/editorder')?>" id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Order Date:</label>
                                        <div class="col-lg-3">
                                            <input type="hidden" name="hddOrderID" id="hddOrderID" value="<?php echo $order_info[0]['orderid']?>">
                                            <input type="text" class="form-control" name="order_date" id="order_date" value="<?php echo $order_info[0]['order_date'];?>" />
                                        </div>
                                        <label class="col-lg-2 control-label">Order Status:</label>
                                        <div class="col-lg-2">
                                            <select name="order_status" id="order_status" class="form-control">
                                                <option>Select</option>
                                                <?php $order_status = $this->mdl_general->GetAllInfoSorting('ims_status','status_id', 'statud_id');
                                                foreach ($order_status as $stat) { ?>
                                                    <option value="<?php echo $stat['status_id']?>" <?php echo ($order_info[0]['status_id'] == $stat['status_id']) ? 'selected' : '' ;?> ><?php echo $stat['description']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="donorNameView">
                                        <label class="col-md-2 control-label" for="CustomerName">Customer Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="CustomerName" name="CustomerName" class="form-control" autocomplete="off" value="<?php echo @$order_info[0]['complete_name'];?>" />
                                            <ul class="dropdown-menu txtCustomer" style="margin-left:15px;margin-right:0px;overflow-y: auto; height: 300px;" role="menu" aria-labelledby="dropdownMenu"  id="DropDownCustomerName">
                                            </ul>
                                            <input type="hidden" id="hddCustomerid" name="hddCustomerid" value="<?php echo @$order_info[0]['customer_id']?>">
                                        </div>
                                        <label class="col-md-2 control-label" for="home_address">Address</label>
                                        <div class="col-md-2">
                                            <?php $home_address = explode('-',@$order_info[0]['home_address']);?>
                                            <input type="text" id="home_address" name="home_address" class="form-control" value="<?php echo @$home_address[0]?>" />
                                        </div>
                                        <label class="col-md-1 control-label" for="home_postcode">Postcode</label>
                                        <div class="col-md-2">
                                            <input type="text" id="home_postcode" name="home_postcode" class="form-control" value="<?php echo @$home_address[1]?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php $business_address = explode('-',@$order_info[0]['office_address']);?>
                                        <label class="col-md-2 control-label" for="business_name">Business Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="business_name" name="business_name" class="form-control" value="<?php echo @$order_info[0]['business_name']?>" />
                                        </div>
                                        <label class="col-md-2 control-label" for="business_address">Business Address</label>
                                        <div class="col-md-2">
                                            <input type="text" id="business_address" name="business_address" class="form-control"  value="<?php echo @$business_address[0]?>" />
                                        </div>
                                        <label class="col-md-1 control-label" for="business_postcode">Business PostCode</label>
                                        <div class="col-md-2">
                                            <input type="text" id="business_postcode" name="business_postcode" class="form-control" value="<?php echo @$business_address[1]?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="mobile_no">Mobile</label>
                                        <div class="col-md-3">
                                            <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="<?php echo @$order_info[0]['mobile_no']?>" />
                                        </div>
                                        <label class="col-md-2 control-label" for="customer_email">Email</label>
                                        <div class="col-lg-2">
                                            <input type="email" id="customer_email" name="customer_email" class="form-control" value="<?php echo @$order_info[0]['customer_email']?>" />
                                        </div>
                                        <label class="col-md-1 control-label" for="order_picture">Order Picture</label>
                                        <div class="col-lg-2">
                                            <input type="file" id="order_picture" name="order_picture" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Event Type:</label>
                                        <div class="col-lg-8">
                                            <?php $ims_event_type = $this->mdl_general->GetAllInfoSorting('ims_event_type','event_id', 'event_id');
                                            foreach ($ims_event_type as $ev) { ?>
                                                <table border="0">
                                                    <tr>
                                                        <td style="width: 250px;">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" name="event_type[]" value="<?php echo $ev['event_id']?>"><?php echo $ev['description']?></label>
                                                            </div>
                                                        </td>
                                                        <td><div class="checkbox">
                                                                <label>Date:<input type="input" name="event_type_date[]" class="datepicker" value="<?php echo date('Y-m-d')?>"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Camera Required:</label>
                                        <div class="col-lg-2">
                                            <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$order_info[0]['camera_required'] == 1) ? 'checked' : ''?> value="1">1</label>
                                            <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$order_info[0]['camera_required'] == 2) ? 'checked' : ''?> value="2">2</label>
                                            <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$order_info[0]['camera_required'] == 3) ? 'checked' : ''?> value="3">3</label>
                                        </div>
                                        <label class="col-lg-2 control-label">Mixer:</label>
                                        <div class="col-lg-2">
                                            <label class="radio-inline"><input type="radio" name="mixer" <?php echo (@$order_info[0]['mixer'] == 'Yes') ? 'checked' : ''?> value="Yes">Yes</label>
                                            <label class="radio-inline"><input type="radio" name="mixer" <?php echo (@$order_info[0]['mixer'] == 'No') ? 'checked' : ''?> value="No">No</label>
                                        </div>
                                        <label class="col-lg-2 control-label">Studio:</label>
                                        <div class="col-lg-2">
                                            <label class="radio-inline"><input type="radio" name="studio" <?php echo (@$order_info[0]['studio'] == 'Yes') ? 'checked' : ''?> value="Yes">Yes</label>
                                            <label class="radio-inline"><input type="radio" name="studio" <?php echo (@$order_info[0]['studio'] == 'No') ? 'checked' : ''?> value="No">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label class="col-md-2 control-label" for="remarks">Album Type</label>
                                        <div class="col-md-3">
                                            <input type="text" name="album_type" id="album_type" class="form-control" value="<?php echo @$order_info[0]['album_type']?>">
                                        </div>
                                        <label class="col-md-2 control-label" for="remarks">No of Album</label>
                                        <div class="col-md-3">
                                            <input type="text" name="no_of_album" id="no_of_album" class="form-control" value="<?php echo @$order_info[0]['no_of_album']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="remarks">Remarks</label>
                                        <div class="col-md-10">
                                            <textarea name="remarks" id="remarks" class="form-control" rows="3"><?php echo @$order_info[0]['remarks']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <table class="navbar navbar-default" role="navigation" border="1" style="width: 90%;margin: auto; margin-left: 9%; border-bottom: 0; border-left: 0; border-right: 0">
                                            <thead style="padding: 8px; text-align: center">
                                            <th class="col-md-4">Service/Item</th>
                                            <th style="padding: 10px;">Quantity</th>
                                            <th style="padding: 10px;">Amount</th>
                                            <!-- <th style="padding: 10px;">VAT</th> -->
                                            <th style="padding: 10px;">TOTAL</th>
                                            <th class="col-md-2"></th>
                                            <!-- <th style="padding: 10px;"></th> -->
                                            </thead>
                                            <tbody class='add_more_fields_div'>
                                            <tr>
                                                <td>
                                                    <select name="services_item[]" id="services_item" class="form-control serviceitem">
                                                        <option value="">Select</option>
                                                        <?php $services = $this->mdl_general->GetAllInfo("ims_required_services","service_id");
                                                        foreach ($services as $serv) { ?>
                                                            <option value="<?php echo $serv["service_id"]?>"><?php echo $serv["description"]?></option>
                                                        <?php }?>
                                                    </select>
                                                    <input type="hidden" name="service_description[]" id="service_description">
                                                </td>
                                                <td>
                                                    <input type="text"  name="service_qty[]" id="service_qty" style='text-align:right;' class="form-control .service_qty" onkeyup="service_amount_event()" value="1">
                                                </td>
                                                <td>
                                                    <input type="text" name="service_amount[]" id="service_amount" style='text-align:right;' class="form-control" onkeyup="service_amount_event()">
                                                </td>
                                                <td>
                                                    <input type="text" name="service_total[]" id="service_total" style='text-align:right;' class="form-control total_service" onchange="totalServicesPerItem()">
                                                </td>
                                                <td>
                                                    <a  class="add_field_button add_field_button btn btn-primary btn-xs me_add_delete_btn"><i class="glyphicon glyphicon-plus icon-white"></i></a>
                                                    <a class="remove_field btn btn-danger btn-xs me_add_delete_btn" ><i class="glyphicon glyphicon-trash icon-white"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php foreach($order_info as $row1){
                                                $vat_percent2 = $row1['vat_percent'];
                                                if(empty($row1['service_id']) || empty($row1['album_id'])) continue;
                                                $service_total = $row1['amount'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <select name="services_item[]" id="services_item" class="form-control serviceitem">
                                                            <option value="">Select</option>
                                                            <?php $services = $this->mdl_general->GetAllInfo("ims_required_services","service_id");
                                                            foreach ($services as $serv) { ?>
                                                                <option value="<?php echo $serv["service_id"]?>" <?php echo ($serv['service_id'] == $row1['service_id']) ? 'selected' : ''?> ><?php echo $serv["description"]?></option>
                                                            <?php }?>
                                                        </select>
                                                        <input type="hidden" name="service_description[]" id="service_description" value="<?php echo $row1['service_description']?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" readonly="readonly" name="service_qty[]" id="service_qty" style='text-align:right;' value="<?php echo $row1['quantity']?>" class="form-control .service_qty" onkeyup="service_amount_event()">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="service_amount[]" id="service_amount" style='text-align:right;'  class="form-control serviceamount" value="<?php echo $row1['amount']?>" >
                                                    </td>

                                                    <td>
                                                        <input type="text" name="service_total[]" id="service_total" value = "<?php echo $service_total; ?>" style='text-align:right;' class="form-control total_service" onload="totalServicesPerItem()">
                                                    </td>
                                                    <td>
                                                        <a  class="add_field_button add_field_button btn btn-primary btn-xs me_add_delete_btn"><i class="glyphicon glyphicon-plus icon-white"></i></a>
                                                        <a class="remove_field btn btn-danger btn-xs me_add_delete_btn" ><i class="glyphicon glyphicon-trash icon-white"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                            <?php
                                            $subtotal = 0.00;
                                            // $total_vat = 0.00;
                                            $discount = 0.00;
                                            $grand_total = 0.00;
                                            if(!empty($order_info)){
                                                $subtotal = $order_info[0]['total_order'];
                                                $vat_percent = $order_info[0]['vat_percent'];;
                                                // $total_vat = $order_info[0]['VAT'];;
                                                $discount = $order_info[0]['discount'];
                                                $grand_total = ($subtotal-$discount);
                                            }
                                            ?>
                                            <tr  style="border-left: 0; border-right: 0; border-top: 0; border-bottom: 0; ">
                                                <td colspan="3" style="text-align: right; ">
                                                    <b>Sub Total :  </b>  &nbsp;
                                                </td>
                                                <td><input type="text" id="sub_total" name="sub_total" value="<?php echo $subtotal?>" class="form-control" onchange="totalServicesPerItem()" style="text-align: right; font-weight: bold; color: #178acc" />

                                                </td>
                                                <td width="33%" colspan="4"></td>
                                            </tr>
                                            <tr  style="border-left: 0; border-right: 0; border-top: 0; border-bottom: 0">
                                                <td colspan="3" style="text-align: right; ">
                                                    <b>Discount :  </b>  &nbsp;
                                                </td>
                                                <td><input type="text" id="discount" name="discount" value="<?php echo $discount?>" class="form-control" style="text-align: right; font-weight: bold; color: #178acc" onkeyup="total_discount()" />

                                                </td>
                                                <td width="33%" colspan="4"></td>
                                            </tr>
                                            <tr  style="border-left: 0; border-right: 0; border-top: 0; border-bottom: 0">
                                                <td colspan="3" style="text-align: right; ">
                                                    <b>Grand Total :  </b>  &nbsp;
                                                </td>
                                                <td><input type="text" id="grand_total" name="grand_total" value="<?php echo $grand_total?>" class="form-control" style="text-align: right; font-weight: bold; color: #178acc" />

                                                </td>
                                                <td width="33%" colspan="4"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group pull-right">
                                        <div class="col-md-12">
                                            <a href="<?php echo base_url('customer')?>" class="btn btn-default">Cancel</a>
                                            <!-- <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/> -->
                                            <button type="submit" class="btn btn-primary" name="Save" >Update</button>
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


