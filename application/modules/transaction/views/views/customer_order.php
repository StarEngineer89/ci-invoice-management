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
 <div class="row">
    <?php // visible to only valid users having customer rights
        $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_url'=>$this->uri->segment(2)));
        $u_rights=$this->mdl_general->GetInfoByRow('acs_userd','u_id',array('u_id'=>$this->session->userdata('sess_user_id'),'menu_id'=>$menu->menu_id));
        if($u_rights->u_add == 1){ ?>
        <div class="col-xs-12">
        <a href="<?php echo base_url()?>transaction/customer_order/add" class="btn btn-primary">Add Customer Order</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-customer"></i> Users List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table id="mytable" class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Service/Item</th>
                <th>Amount</th>
                <!-- <th>VAT</th> -->
                <th>Order Date</th>
                <th>Order Status</th>
                <th style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>            
            <?php
            foreach ($customer_order_list as $row) {
            ?>
            <tr style="background-color: <?php echo $row['color'];?>; color:white">
                <td class="center"><?php echo $row['orderid'];?></td>
                <td class="center"><?php echo $row['complete_name'];?></td>
                <td class="center"><?php echo $row['service_description'];?></td>
                <td class="center"><?php echo number_format($row['amount'],2);?></td>
                <!-- <td class="center"><?php //echo $row['VAT'];?></td> -->
                <td class="center"><?php echo $row['order_date'];?></td>
                <td class="center"><?php echo $row['order_status'];?></td>
                <td>
                <a class="btn btn-info btn-xs" href="<?php echo base_url('transaction/customer_order/edit/'.$row['customer_id'].'')?>">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="delete_customer_order(<?php echo $row['customer_id']?>, <?php echo $row['orderid']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                </a>
                 <a class="btn btn-warning btn-xs" target="blank" title="Docs" href="<?php echo base_url('transaction/customer_order/docs/'.$row['orderid'])?>">
                    <i class="glyphicon glyphicon-book icon-white"></i>
                </a>
                <a class="btn btn-success btn-xs" target="blank" title="Email" href="javascript:void(0)">
                    <i class="glyphicon glyphicon-envelope icon-white"></i>
                </a>
                <a class="btn btn-default btn-xs" target="blank" title="Order Reports" href="<?php echo base_url('transaction/customer_order/reports/'.$row['customer_id'].'')?>">
                    <i class="glyphicon glyphicon-list-alt icon-white"></i>
                </a>
            </td>

            <?php }?>
            </tr>
        </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<script src="<?=base_url()?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
// $('#mytable').removeAttr('class');
// $('#mytable tr').removeClass("odd");
// $('.table tr').removeClass("even");
// $('.table').dataTable( {
//   "stripeClasses": []
// } );
// $.extend($.fn.dataTable.ext.classes, {
//   sStripeEven: '', sStripeOdd: ''
// });

});
//datepicker setting
$(".datepicker").datepicker({
autoclose: true,
todayHighlight: true,
format:'dd-mm-yyyy' 
});
function delete_customer_order(id, oid){
            var r = confirm("Do you want to delete this customer?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id,
                        oid:oid
                    },
                    type: "post",
                    url: "<?php echo base_url()?>"+"transaction/delete_customer_order_info",
                    success:function(data){
                        location.reload();
                        
                        
                    }
                });

            }else{
                return false;
            }

        }
</script>

<?php $this->load->module('footer')->index(); ?>

