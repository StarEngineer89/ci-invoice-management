
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
            <a href="#">Document Template</a>
        </li>
    </ul>
</div>
 <div class="row">
    <?php // visible to only valid users having customer rights
        $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_url'=>$this->uri->segment(2)));
        $u_rights=$this->mdl_general->GetInfoByRow('acs_userd','u_id',array('u_id'=>$this->session->userdata('sess_user_id'),'menu_id'=>$menu->menu_id));
        if($u_rights->u_add == 1){ ?>
        <div class="col-xs-12">
        <a href="<?php echo base_url()?>transaction/document_template/add" class="btn btn-primary">Add Document Template</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-customer"></i> Document Template List</h2>

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
                <th>Doc No.</th>
                <th>Letter Template Name</th>
                <th>Letter Template Subject</th>
                <th>Letter Template Body</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($document_template_list as $row) { ?>
            <tr>
                <td class="center"><?php echo $row['doc_id'];?></td>
                <td class="center"><?php echo $row['d_letter_template_name'];?></td>
                <td class="center"><?php echo $row['d_subject'];?></td>
                <td class="center"><?php echo rawurldecode($row['d_body']);?></td>
                <td>
                <a class="btn btn-info btn-xs" href="<?php echo base_url('transaction/document_template/edit/'.$row['doc_id'].'')?>">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                </a>
                <a class="btn btn-danger btn-xs" onclick="delete_data(<?php echo $row['doc_id']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
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
function delete_data(id, oid){
            var r = confirm("Do you want to delete this customer?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id,
                        oid:oid
                    },
                    type: "post",
                    url: "<?php echo base_url()?>"+"transaction/delete_data_info",
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

