
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
            <a href="#">Delivery Note</a>
        </li>
    </ul>
</div>
 <div class="row">
    <?php // visible to only valid users having customer rights
        $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_url'=>$this->uri->segment(2)));
        $u_rights=$this->mdl_general->GetInfoByRow('acs_userd','u_id',array('u_id'=>$this->session->userdata('sess_user_id'),'menu_id'=>$menu->menu_id));
        if($u_rights->u_add == 1){ ?>
        <div class="col-xs-12">
        <a href="<?php echo base_url()?>transaction/delivery_note/add" class="btn btn-primary">Add Delivery Note</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-customer"></i> Delivery Note List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
            <tr>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Delivery Note No</th>
                <th>Delivery Note Date</th>
                <th>Customer Name</th>
                <th>Delivery Details</th>
                <th>Delivery Status</th>
                <th class="center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cnt=0;
            foreach ($delivery_note_list as $row) {
                if($cnt%2==0){
                    $txtcolor = 'block';
                }else{
                    $txtcolor = 'white';
                }
                $cnt++;
            ?>
            <tr>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['order_no'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['order_date'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['delivery_note_no'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['delivery_date'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['complete_name'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['delivery_details'];?></td>
                <td class="center" style="background-color: <?php echo $row['color'];?>; color:white"><?php echo $row['description'];?></td>
                <td class="center">
                <a class="btn btn-info btn-xs" href="<?php echo base_url('transaction/delivery_note/edit/'.$row['id'].'')?>">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="delete_customer_order(<?php echo $row['id']?>, <?php echo $row['delivery_note_no']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                </a>
                <a class="btn btn-danger btn-xs" target="blank" title="Docs" href="<?php echo base_url('transaction/delivery_note/docs/'.$row['id'])?>">
                    <i class="glyphicon glyphicon-book icon-white"></i>
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

