
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
            <a href="#">Customer</a>
        </li>
    </ul>
</div>
 <div class="row">
    <?php // visible to only valid users having customer rights
        $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_url'=>$this->uri->segment(2)));
        $u_rights=$this->mdl_general->GetInfoByRow('acs_userd','u_id',array('u_id'=>$this->session->userdata('sess_user_id'),'menu_id'=>$menu->menu_id));
        if($u_rights->u_add == 1){ ?>
        <div class="col-xs-12">
        <a href="<?php echo base_url()?>transaction/customer/add" class="btn btn-primary">Add New Customer</a>
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
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
            <tr>
                <th class="center">Customer ID</th>
                <th class="center">Name</th>
                <th class="center">Home Address</th>
                <th class="center">Office Address</th>
                <th class="center">Email</th>
                <th class="center">Mobile#</th>
                <th class="center">Active</th>
                <th colspan="3" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($customer_list as $row) {
                if($row['active'] == 1){
                    $status = '<span class="label-success label label-default">Active</span>';
                }else{
                    $status = '<span class="label-default label">Inactive</span>';
                }
            ?>
            <tr>                                        
                <td class="center"><?php echo $row['customer_id'];?></td>
                <td class="center"><?php echo $row['fname'].' '. $row['mname'] .' '. $row['lname'];?></td>
                <td class="center"><?php echo $row['home_address'] .' - '. $row['home_postcode'];?></td>
                <td class="center"><?php echo $row['office_address'].' - '. $row['office_postcode'];?></td>
                <td class="center"><?php echo $row['customer_email'];?></td>
                <td class="center"><?php echo $row['mobile_no'];?></td>
                <td class="center"><?php echo $status;?></td>
                <td class="center">
                <a class="btn btn-info btn-xs" href="<?php echo base_url('transaction/customer/edit/'.$row['customer_id'].'')?>">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                </a>
                </td>
                <td>
                <a class="btn btn-danger btn-xs" onclick="delete_customer(<?php echo $row['customer_id']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                </a>
                </td>
                <td>
                <a class="btn btn-success btn-xs" target="blank" title="Docs" href="<?php echo base_url('transaction/customer/docs/'.$row['customer_id'])?>">
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
function delete_customer(id){
            var r = confirm("Do you want to delete this customer?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id
                    },
                    type: "post",
                    url: "<?php echo base_url()?>"+"transaction/delete_customer_info",
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

