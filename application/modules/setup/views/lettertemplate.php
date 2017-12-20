
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
            <a href="#">Letter Template</a>
        </li>
    </ul>
</div>
<!-- <a href="#" class="btn btn-info btn-setting">Click for dialog</a> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 id="modalTitle">Add Letter Template</h3>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url()?>setup/add_new_template" method="post" id="addNewUserForm" class="form-horizontal" autocomplete="off">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltSubject">Subject</label>
                            <div class="col-md-10">
                                <input type="text" id="ltSubject" name="ltSubject" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltHeader">Header</label>
                            <div class="col-md-10">
                                <input type="text" id="ltHeader" name="ltHeader" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltBody">Body</label>
                            <div class="col-md-10">
                                <textarea rows="10" id="ltBody" name="ltBody" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltFooter1">Footer 1</label>
                            <div class="col-md-10">
                                <input type="text" id="ltFooter1" name="ltFooter1" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltFooter2">Footer 2</label>
                            <div class="col-md-10">
                                <input type="text" id="ltFooter2" name="ltFooter2" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltSignatureImage">Signature Image</label>
                            <div class="col-md-4">
                                <input type="file" id="ltSignatureImage" name="ltSignatureImage" class="form-control" />
                            </div>
                            <label class="col-md-2 control-label" for="ltDesignation">Designation</label>
                            <div class="col-md-4">
                                <select id="ltDesignation" name="ltDesignation" class="form-control" >
                                    <?php $designation=$this->mdl_general->GetAllInfo('ims_designation','desig_id');
                                    foreach ($designation as $row) { ?>
                                       <option value="<?=$row['desig_id']?>"><?=$row['desig_name']?></option>
                                   <?php  }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="ltFooter1Active">Footer 1 Active</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="ltFooter1Active" name="ltFooter1Active" class="form-control" value="1"/>
                            </div>
                            <label class="col-md-2 control-label" for="ltFooter2Active">Footer 2 Active</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="ltFooter2Active" name="ltFooter2Active" class="form-control" value="1"/>
                            </div>
                            <label class="col-md-2 control-label" for="ltActive">Active</label>
                            <div class="col-md-2">
                                <input type="checkbox" id="ltActive" name="ltActive" class="form-control" value="1"/>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                   <input type="submit" name='btn_photographic_package' id="btn_photographic_package" value="Add Letter Template" class="btn btn-primary"/>
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
        <a href="#" class="btn btn-primary btn-setting" onclick="add_data()">Add Letter Template</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Letter Template List</h2>

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
                <th>Letter template</th>
                <th>Letter template subject</th>
                <th>Letter template body</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?foreach ($template_list as $row) {?>
            <tr>
                    
                <td class="center"><?php echo $row['lt_name']?></td>
                <td class="center"><?php echo $row['lt_sub']?></td>
                <td class="center"><?php echo $row['lt_body']?></td>
                <td class="center"><?php if($row['lt_active']==1){echo "Active";}else{echo "Inactive";}?></td>
                <td class="center">
                    <?php if($u_rights->u_edit == 1){?>
                    <a class="btn btn-info btn-setting" href="<?php echo base_url().'setup/template/edit/'.$row['lt_id']?>"><i class="glyphicon glyphicon-edit icon-white"></i>
                    </a>
                    <?php } ?>
                     <?php if($u_rights->u_del == '1'){?>
                    <a class="btn btn-danger" onclick="delete_template(<?php echo $row['lt_id']?>);" href="javascript:void(0);"><i class="glyphicon glyphicon-trash icon-white"></i></a>
                    <?}?>
                </td>

            </tr>
            <?php }?>
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
function delete_template(id){
            var r = confirm("Do you want to delete this letter template?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id
                    },
                    type: "post",
                    url: base_url+"setup/delete_template",
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

