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
            <a href="#">Customer Order</a>
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
        <h2><i class="glyphicon glyphicon-user"></i> Edit Customer Order</h2>

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
                // echo "<pre>";
                // print_r($customer_list);
                // echo "</pre>";
                ?>
                <section>
                    <div class="col-lg-10">
                        <form action="<?php echo base_url()?>transaction/edit_customer_order" id="defaultForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Order Date:</label>
                                <div class="col-lg-3">
                                    <input type="hidden" name="hddOrderID" id="hddOrderID" value="<?php echo $customer_list[0]['orderid']?>">
                                    <input type="text" class="form-control" name="order_date" id="order_date" value="<?php echo $customer_list[0]['order_date'];?>" />
                                </div>
                                <label class="col-lg-2 control-label">Order Status:</label>
                                <div class="col-lg-2">
                                    <select name="order_status" id="order_status" class="form-control">
                                        <option>Select</option>
                                        <?php $order_status = $this->mdl_general->GetAllInfoSorting('ims_status','status_id', 'statud_id');
                                            foreach ($order_status as $stat) { ?>
                                            <option value="<?php echo $stat['status_id']?>" <?php echo ($customer_list[0]['status_id'] == $stat['status_id']) ? 'selected' : '' ;?> ><?php echo $stat['description']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="donorNameView">
                                <label class="col-md-2 control-label" for="CustomerName">Customer Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="CustomerName" name="CustomerName" class="form-control" autocomplete="off" value="<?php echo @$customer_list[0]['complete_name'];?>" />
                                    <ul class="dropdown-menu txtCustomer" style="margin-left:15px;margin-right:0px;overflow-y: auto; height: 300px;" role="menu" aria-labelledby="dropdownMenu"  id="DropDownCustomerName">
                                    </ul>
                                    <input type="hidden" id="hddCustomerid" name="hddCustomerid" value="<?php echo @$customer_list[0]['customer_id']?>">
                                </div>
                                <label class="col-md-2 control-label" for="home_address">Address</label>
                                 <div class="col-md-2">
                                    <?php $home_address = explode('-',@$customer_list[0]['home_address']);?>
                                    <input type="text" id="home_address" name="home_address" class="form-control" value="<?php echo @$home_address[0]?>" />
                                </div>
                                <label class="col-md-1 control-label" for="home_postcode">Postcode</label>
                                <div class="col-md-2">
                                    <input type="text" id="home_postcode" name="home_postcode" class="form-control" value="<?php echo @$home_address[1]?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <?php $business_address = explode('-',@$customer_list[0]['office_address']);?>
                                <label class="col-md-2 control-label" for="business_name">Business Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="business_name" name="business_name" class="form-control" value="<?php echo @$customer_list[0]['business_name']?>" />
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
                                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="<?php echo @$customer_list[0]['mobile_no']?>" />
                                </div>
                                <label class="col-md-2 control-label" for="customer_email">Email</label>
                                <div class="col-lg-2">
                                    <input type="email" id="customer_email" name="customer_email" class="form-control" value="<?php echo @$customer_list[0]['customer_email']?>" />
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
                                    <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$customer_list[0]['camera_required'] == 1) ? 'checked' : ''?> value="1">1</label>
                                    <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$customer_list[0]['camera_required'] == 2) ? 'checked' : ''?> value="2">2</label>
                                    <label class="radio-inline"><input type="radio" name="camera_required" <?php echo (@$customer_list[0]['camera_required'] == 3) ? 'checked' : ''?> value="3">3</label>
                                </div>
                                <label class="col-lg-2 control-label">Mixer:</label>
                                <div class="col-lg-2">
                                    <label class="radio-inline"><input type="radio" name="mixer" <?php echo (@$customer_list[0]['mixer'] == 'Yes') ? 'checked' : ''?> value="Yes">Yes</label>
                                    <label class="radio-inline"><input type="radio" name="mixer" <?php echo (@$customer_list[0]['mixer'] == 'No') ? 'checked' : ''?> value="No">No</label>
                                </div>
                                <label class="col-lg-2 control-label">Studio:</label>
                                <div class="col-lg-2">
                                    <label class="radio-inline"><input type="radio" name="studio" <?php echo (@$customer_list[0]['studio'] == 'Yes') ? 'checked' : ''?> value="Yes">Yes</label>
                                    <label class="radio-inline"><input type="radio" name="studio" <?php echo (@$customer_list[0]['studio'] == 'No') ? 'checked' : ''?> value="No">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                            
                                 <label class="col-md-2 control-label" for="remarks">Album Type</label>
                                <div class="col-md-3">
                                    <input type="text" name="album_type" id="album_type" class="form-control" value="<?php echo @$customer_list[0]['album_type']?>">
                                </div>
                                <label class="col-md-2 control-label" for="remarks">No of Album</label>
                                <div class="col-md-3">
                                    <input type="text" name="no_of_album" id="no_of_album" class="form-control" value="<?php echo @$customer_list[0]['no_of_album']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                 <label class="col-md-2 control-label" for="remarks">Remarks</label>
                                <div class="col-md-10">
                                    <textarea name="remarks" id="remarks" class="form-control" rows="3"><?php echo @$customer_list[0]['remarks']?></textarea>
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
                                        <?php foreach($customer_list as $row1){
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
                                    if(!empty($customer_list)){
                                        $subtotal = $customer_list[0]['total_order'];
                                        $vat_percent = $customer_list[0]['vat_percent'];;
                                        // $total_vat = $customer_list[0]['VAT'];;
                                        $discount = $customer_list[0]['discount'];
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
                                    <a href="<?php echo base_url()?>transaction/customer_order" class="btn btn-default">Cancel</a>
                                    <!-- <input type="submit" name='submit' value="Add Customer Information" class="btn btn-primary"/> -->
                                    <button type="submit" class="btn btn-primary" name="Save" >Update</button>
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
<script src="<?=base_url()?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
//datepicker setting
$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    format:'yyyy-mm-dd' 
});
function service_amount_event(){
    var _service_amount = $("#service_amount").val();
    var _service_qty = $("#service_qty").val();
    // var _vat_percent = $("#service_vat").val();
    // if(_vat_percent.substr(-1) == '%'){
    //     vat_percent1 = _vat_percent.substr(0,2);
    // }else{
    //     vat_percent1 = _vat_percent;
    // }
    // var _service_vat = vat_percent1 / 100;
    var _service_total = (_service_amount * _service_qty);
    var _total_service = _service_total.toFixed(2);
    $("#service_total").val(_total_service);
    totalServicesPerItem();
    totalVATPerItem();
    total_discount();
}
var base_url = "<?php echo base_url()?>";
 $(".add_field_button").on('click', function(){
    if($("#services_item").val() == ""){
        alert("Empty Service/Item");
        return false;
    }
    var _services_itemVal = $("#services_item").find("option:selected").val();
    var _services_itemText = $("#services_item").find("option:selected").text();
    var _services_item = '<option value="'+_services_itemVal+'" selected>'+_services_itemText+'</option';
    var _service_qty = $('#service_qty').val();
    var _service_amount = $("#service_amount").val();
    // var _service_vat = $("#service_vat").val();
    var _service_total = $("#service_total").val();
    var divV = $(".add_more_fields_div");
        tbl = "<tr>";
        tbl += "<td><select name='services_item[]' id='services_item' class='form-control'>"+_services_item+"</select><input type='hidden' name='service_description[]' id='service_description' value='"+_services_itemText+"'></td>";
        tbl += "<td><input type='text' readonly='readonly' name='service_qty[]' id='service_qty' style='text-align:right;' value="+_service_qty+" class='form-control .service_qty' onkeyup='service_amount_event()'></td>";
        tbl += "<td><input type='number' name='service_amount[]'' id='service_amount' value='"+_service_amount+"' class='form-control' style='text-align:right;'></td>";
        // tbl += "<td><input type='text' name='service_vat[]' id='service_vat' value='"+_service_vat+"' class='form-control serviceVAT' style='text-align:right;' onchange='totalVATPerItem()'></td>";
        tbl += "<td><input type='number' name='service_total[]' id='service_total' value='"+_service_total+"' class='form-control total_service' onchange='totalServicesPerItem()' style='text-align:right;'></td>";
        tbl += "<td>";
        tbl += "<a class='add_field_button add_field_button btn btn-primary btn-xs me_add_delete_btn'><i class='glyphicon glyphicon-plus icon-white'></i></a> ";
        tbl += '<a class="remove_field btn btn-danger btn-xs me_add_delete_btn" ><i class="glyphicon glyphicon-trash iconsn-white"></i></a>';
        tbl += "</td>"
        tbl += "</tr>";
    divV.append(tbl);
    $("#services_item").val("");
    $("#service_amount").val("");
    // $("#service_vat").val("");
    $("#service_total").val("");
 });
 var wrapper = $(".add_more_fields_div");
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    $(this).parent('td').parent('tr').remove();
    totalServicesPerItem();
    // totalVATPerItem();
    total_discount();
});
 $("#CustomerName").keyup(function() {
    
    $.ajax({
        type: "POST",
        url: base_url+"transaction/get_customer_detail",
        data: {
            name: $("#CustomerName").val()
        },
        dataType: "json",
        success: function(data) {
            if (data.length > 0) {
                $('#DropDownCustomerName').empty();
                $('#CustomerName').attr("data-toggle", "dropdown");
                $('#DropDownCustomerName').dropdown('toggle');
            }
            else if (data.length == 0) {
                $('#CustomerName').attr("data-toggle", "");
            }
            jQuery.each(data, function(key, value) {
                if (data.length >= 0)
                    $('#DropDownCustomerName').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" customer_id="'+value['customer_id']+'" customer_name="' + value['fname'] +' '+value['mname']+' '+value['lname']+'" home_address="'+value['home_address']+'" home_postcode="'+value['home_postcode']+'" business_name="'+value['business_name']+'" business_address="'+value['office_address']+'" business_postcode="'+value['office_postcode']+'" mobile_no="'+value['mobile_no']+'" customer_email="'+value['customer_email']+'" >'+ value['customer_id'] +' - ' + value['fname'] +' '+value['mname']+' '+value['lname']+' - '+ value['home_address']+ '</a></li>');
            });

        }
    });
});


$('ul.txtCustomer').on('click', 'li a', function() {
    $('#CustomerName').val($(this).attr('customer_name'));
    $('#hddCustomerid').val($(this).attr('customer_id'));
    $('#home_address').val($(this).attr('home_address'));
    $('#home_postcode').val($(this).attr('home_postcode'));
    $('#business_name').val($(this).attr('business_name'));
    $('#business_address').val($(this).attr('business_address'));
    $('#business_postcode').val($(this).attr('business_postcode'));
    $('#mobile_no').val($(this).attr('mobile_no'));
    $('#customer_email').val($(this).attr('customer_email'));
    // $('#officePhone').val($(this).attr('phone'));
    // $('#homePhone').val($(this).attr('home_phone'));
    // $('#homeAddress').val($(this).attr('home_address'));
    // $('#donorType').val($(this).attr('donor_type'));
    // $('#hdnDonorTypeId').val($(this).attr('donor_type_id'));

});
$("#services_item").change(function(){

    $.ajax({
        type: "POST",
        url: base_url+"transaction/get_services_detail",
        data: {
            service_id: $(this).val()
        },
        dataType: "json",
        success: function(data) {
            $("#service_amount").val(data['price']);
            $("#service_description").val(data['description']);
            // var _vat_percent = $("#service_vat").val();
            // if(_vat_percent.substr(-1) == '%'){
            //     vat_percent1 = _vat_percent.substr(0,2);
            // }else{
            //     vat_percent1 = _vat_percent;
            // }
            // var _service_vat = vat_percent1 / 100;
            var _service_qty = $("#service_qty").val();
            
            var _service_total = (data['price'] * _service_qty);
            // if(_service_qty != ''){
            //     _service_total = (data['price'] * _service_qty);
            // }else{
            //     _service_total = (data['price'] * 1);
            // }
            
            var _total_service = _service_total.toFixed(2);
            $("#service_total").val(_total_service);
            totalServicesPerItem();
            // totalVATPerItem();
            total_discount();
        }
    });
});
function totalServicesPerItem(){
    var _totalservice =0;
    $('.total_service').each(function(){
         _totalservice = _totalservice + parseFloat($(this).val()) || 0;
    })
    var total = _totalservice.toFixed(2);
    $('#sub_total').val(total);
}
// function totalVATPerItem(){
//     var _totalvat =0;
//     $('.serviceVAT').each(function(){
//          _totalvat = _totalvat + parseFloat($(this).val()) || 0;
//     })
//     var total = _totalvat.toFixed(2);
//     $('#total_vat').val(total);
// }
function total_discount(){
    // alert('test');
    var _subtotal = parseFloat($("#sub_total").val()) || 0;
    // var _totalvat = parseFloat($("#total_vat").val()) || 0;
    // var _vat_percent = (_totalvat / 100);
    var _discount = parseFloat($("#discount").val()) || 0;
    var _grandTotal = (_subtotal - _discount);
    $("#grand_total").val(_grandTotal.toFixed(2));
}
$(document).ready(function(){
    // var _service_amount = $(".serviceamount").val();
    // var _vat_percent = $("#service_vat").val();
    // $('.serviceamount').each(function(){
        
    //     if(_vat_percent.substr(-1) == '%'){
    //         vat_percent1 = _vat_percent.substr(0,2);
    //     }else{
    //         vat_percent1 = _vat_percent;
    //     }
    //     var _service_vat = vat_percent1 / 100;
    //     var _service_total = ($(this).val() * _service_vat);
    //     var _total_service = _service_total.toFixed(2);
    //     $(".total_service").val(_total_service);
    // });
    // var _vat_percent = $("#service_vat").val();
    // if(_vat_percent.substr(-1) == '%'){
    //     vat_percent1 = _vat_percent.substr(0,2);
    // }else{
    //     vat_percent1 = _vat_percent;
    // }
    // var _service_vat = vat_percent1 / 100;
    // var _service_total = (data['price'] * _service_vat);
    // var _total_service = _service_total.toFixed(2);
    // $("#service_total").val(_total_service);
})
</script>
<?php $this->load->module('footer')->index(); ?>

