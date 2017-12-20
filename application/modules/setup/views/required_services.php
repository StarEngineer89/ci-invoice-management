
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
            <a href="#">Required Services</a>
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
                    <h3 id="modalTitle">Add Required Services</h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url()?>setup/add_required_services" method="post" id="addNewUserForm" class="form-horizontal">
                        <input type="hidden" name="hddservice_id" id="hddservice_id">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inpt_description">Description</label>
                            <div class="col-md-4">
                                <input type="text" id="inpt_description" name="inpt_description" class="form-control" placeholder="Description" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inpt_price">Price</label>
                            <div class="col-md-4">
                                <input type="number" id="inpt_price" name="inpt_price" class="form-control" placeholder="Price" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inpt_vat">VAT</label>
                            <div class="col-md-4">
                                <select name="inpt_vat" id="inpt_vat" class="form-control">
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inpt_active">Active</label>
                            <div class="col-md-4">
                                <input type="checkbox" id="inpt_active" value="1" name="inpt_active"  class="form-control" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                   <input type="submit" name='btn_required_services' id="btn_required_services" value="Add Required Services" class="btn btn-primary"/>
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
        <a href="#" class="btn btn-primary btn-setting" onclick="add_required_services()">Add Required Services</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Required Services List</h2>

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
                <th>Required Services ID#</th>
                <th>Description</th>
                <th>Price</th>
                <th>VAT</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($event_type_list as $row) {
            if($row['active'] == 1){
                $status = '<span class="label-success label label-default">Active</span>';
            }else{
                $status = '<span class="label-default label">Inactive</span>';
            }
        ?>
            <tr>                                        
                <td class="center"><?php echo $row['service_id']?></td>
                <td class="center"><?php echo $row['description']?></td>
                <td class="center"><?php echo $row['price']?></td>
                <td class="center"><?php echo $row['vat']?></td>
                <td class="center"><?php echo $status?></td>
                <td class="center">
                <a class="btn btn-info btn-setting" href="javascript:void(0)" onclick="edit_required_services('<?php echo $row["service_id"]?>')">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                    Edit
                </a>
                <a class="btn btn-danger" onclick="delete_required_services(<?php echo $row['service_id']?>);" href="javascript:void(0);">
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
function delete_required_services(id){
    var r = confirm("Do you want to delete this record?");
    if(r== true){
        $.ajax({
            data:{
                id:id
            },
            type: "post",
            url: "<?php echo base_url()?>"+"setup/delete_required_services",
            success:function(data){
                location.reload();
                
                
            }
        });

    }else{
        return false;
    }
}
function add_required_services(){
    $("#modalTitle").text('Add Required Services');
    $("#btn_required_services").val('Add Required Services');
    $("#inpt_description").val("");
    $("#inpt_price").val("");    
    $('#inpt_active').prop('checked', false);
    $("#hddservice_id").val("");
}
function edit_required_services(id){
    // alert(id);
    $("#modalTitle").text('Edit Required Services');
    $("#btn_required_services").val('Update Required Services');
    $.ajax({
        data:{
        id:id
        },
        type: "post",
        url: "<?php echo base_url()?>"+"setup/get_required_services",
        dataType: "json",
        success: function(data) {
            jQuery.each(data, function(key, list) {
                $("#inpt_description").val(list['description']);
                $("#inpt_price").val(list['price']);
                $('#inpt_vat option:contains('+list['vat']+')').prop('selected', true);
                if(list['active'] == 1){
                    $('#inpt_active').prop('checked', true);
                }else{
                    $('#inpt_active').prop('checked', false);
                }
                $("#hddservice_id").val(id);
            });
        }
    });
}
</script>

<?php $this->load->module('footer')->index(); ?>

