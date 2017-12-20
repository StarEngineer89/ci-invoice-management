
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
            <a href="#">Dashboard</a>
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
                    <h3>Add User</h3>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url()?>transaction/add_new_user" method="post" id="addNewUserForm" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="name">Name</label>
                            <div class="col-md-4">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" />
                            </div>
                            <label class="col-md-2 control-label" for="logName">Log Name</label>
                            <div class="col-md-4">
                                <input type="text" id="logName" name="logName" class="form-control" placeholder="Log Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="email">Email</label>
                            <div class="col-md-4">
                                <input type="email" id="email" name="email"  class="form-control" placeholder="Email" />
                            </div>
                            <label class="col-md-2 control-label" for="password">Password</label>
                            <div class="col-md-4">
                                <input type="password" id="password" name="password"  class="form-control" placeholder="Password"/>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="remark">Remark</label>
                            <div class="col-md-4">
                                <input type="text" id="remark" name="remark"  class="form-control" placeholder="Remark" />
                            </div>
                            <label class="col-md-2 control-label" for="cell">Cell No.</label>
                            <div class="col-md-4">
                                <input type="text" id="cell" name="cell"  class="form-control" placeholder="Cell no." />
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="loginFrom">Login Date From</label>
                            <div class="col-md-4">
                                <input type="text" id="loginFrom" name="loginFrom" value="<?=date('d-m-Y')?>"  class="form-control datepicker" />
                            </div>
                            <label class="col-md-2 control-label" for="loginTo">Login Date To</label>
                            <div class="col-md-4">
                                <input type="text" id="loginTo" name="loginTo" value="<?=date('d-m-Y')?>" class="form-control datepicker" />
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="supervisor">Supervisor</label>
                            <div class="col-md-4">
                                
                                <select class="form-control" name="supervisor" id="supervisor">
                                    <?php 
                                    foreach ($user_list as $row) {?>
                                         <option value="<?=$row['u_id']?>"><?=$row['u_name']?></option>
                                    <?php }
                                    ?>
                                    
                                </select>
                                
                            </div>
                            <label class="col-md-2 control-label" for="enabled">Enabled</label>
                            <div class="col-md-4">
                                <input type="checkbox" id="enabled" value="1" name="enabled"  class="form-control" />
                            </div>
                            
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                   <input type="submit" name='submit' value="Add User" class="btn btn-primary"/>
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
        <a href="#" class="btn btn-primary btn-setting">Add New User</a>
        </div>
        <?php }
        ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Users List</h2>

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
                
                <th>Name</th>
                <th>Log name</th>
                <th>Email</th>
                <th>Supervisor</th>
                <th>Remarks</th>
                <th>Cell No</th>
                <th>Enabled</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_list as $row) {?>
            <tr>                                        
                <td class="center"><?php echo $row['u_name']?></td>
                <td class="center"><?php echo $row['u_logname']?></td>
                <td class="center"><?php echo $row['u_email']?></td>
                <td class="center">
                    <?php
                    try {
                        $supervisor_name=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_id'=>$row['su_id']))->u_name;
                    } catch (Exception $e) {
                        $supervisor_name="N/A";
                    }
                    
                    echo $supervisor_name;
                     ?>
                </td>
                <td class="center"><?php echo $row['u_remarks']?></td>
                <td class="center"><?php echo $row['u_cellno']?></td>
                <td class="center"><?php if($row['u_enabled']==1){echo "Enabled";}else{echo "Disabled";}?></td>
                <td class="center">
               <!--  <a class="btn btn-success" href="#">
                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                    View
                </a> -->
                <a class="btn btn-info" href="<?=base_url().'transaction/user/edit/'.$row['u_id']?>">
                    <i class="glyphicon glyphicon-edit icon-white"></i>
                    Edit
                </a>
                <a class="btn btn-danger" onclick="delete_user(<?=$row['u_id']?>);" href="javascript:void(0);">
                    <i class="glyphicon glyphicon-trash icon-white"></i>
                    Delete
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
function delete_user(id){
            var r = confirm("Do you want to delete this user?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id
                    },
                    type: "post",
                    url: "<?php echo base_url()?>"+"transaction/delete_user",
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

