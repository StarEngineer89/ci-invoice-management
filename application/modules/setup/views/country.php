
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
            <a href="#">Country</a>
        </li>
    </ul>
</div>
<!-- <a href="#" class="btn btn-info btn-setting">Click for dialog</a> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id="modalTitle">Add Country</h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url()?>setup/add_country" method="post" id="addNewUserForm" class="form-horizontal" autocomplete="off">
                        <input type="hidden" name="hddcountry_id" id="hddcountry_id">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inpt_country_name">Country Name</label>
                            <div class="col-md-4">
                                <input type="text" id="inpt_country_name" name="inpt_country_name" class="form-control" placeholder="Country name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inpt_active">Active</label>
                            <div class="col-md-4">
                                <input type="checkbox" id="inpt_active" value="1" name="inpt_active"  class="form-control" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                   <input type="submit" name='btn_add' id="btn_add" value="Add Country" class="btn btn-primary"/>
                </div>
                </form> 
            </div>
        </div>
    </div>

 <div class="row">
    <?php // visible to only valid users having user rights
        $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_url'=>$this->uri->segment(2)));
        $u_rights=$this->mdl_general->GetInfoByRow('acs_userd','u_id',array('u_id'=>$this->session->userdata('sess_user_id'),'menu_id'=>$menu->menu_id));
        if($u_rights->u_add == 1){ ?>
        <div class="col-xs-12">
        <a href="#" class="btn btn-primary btn-setting" onclick="add_album_type()">Add Country</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Country List</h2>

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
                <th>Country ID#</th>
                <th>Country Name</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($country_list as $row) {
            if($row['active'] == 1){
                $status = '<span class="label-success label label-default">Active</span>';
            }else{
                $status = '<span class="label-default label">Inactive</span>';
            }
        ?>
            <tr>                                        
                <td class="center"><?php echo $row['country_id']?></td>
                <td class="center"><?php echo $row['country_name']?></td>
                 <td class="center"><?php echo $status?></td>
                <td class="center">
                <a class="btn btn-info btn-setting" href="javascript:void(0)" onclick="edit_data('<?php echo $row["country_id"]?>')">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                    Edit
                </a>
                <a class="btn btn-danger" onclick="delete_data(<?php echo $row['country_id']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Delete
                </a>
            </td>
            </tr>
        <?php } ?>
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
function delete_data(id){
    var r = confirm("Do you want to delete this record?");
    if(r== true){
        $.ajax({
            data:{
                id:id
            },
            type: "post",
            url: "<?php echo base_url()?>"+"setup/delete_country_list",
            success:function(data){
                location.reload();
                
                
            }
        });

    }else{
        return false;
    }
}
function add_album_type(){
    $("#modalTitle").text('Add Country');
    $("#btn_add").val('Add Country');
    $("#inpt_country_name").val("");
    $('#inpt_active').prop('checked', false);
    $("#hddcountry_id").val("");
}
function edit_data(id){
    // alert(id);
    $("#modalTitle").text('Edit Country');
    $("#btn_add").val('Update Country');
    $.ajax({
        data:{
        id:id
        },
        type: "post",
        url: "<?php echo base_url()?>"+"setup/get_country_list",
        dataType: "json",
        success: function(data) {
            jQuery.each(data, function(key, list) {
                // alert(list['no_of_picture']);
                $("#inpt_country_name").val(list['country_name']);
                if(list['active'] == 1){
                    $('#inpt_active').prop('checked', true);
                }else{
                    $('#inpt_active').prop('checked', false);
                }
                $("#hddcountry_id").val(id);
            });
        }
    });
}
</script>

<?php $this->load->module('footer')->index(); ?>

