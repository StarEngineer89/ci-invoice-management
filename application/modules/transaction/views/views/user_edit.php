
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

 <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Edit User</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
                <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="col-xs-12">
                <form action="<?php echo base_url()?>transaction/user_edit" method="post" id="editUserForm" class="form-horizontal">
                <div class="form-group">
                <label class="col-md-2 control-label" for="name">Name</label>
                <div class="col-md-4">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?php echo $user->u_name?>" />
                </div>
                <label class="col-md-2 control-label" for="logName">Log Name</label>
                <div class="col-md-4">
                <input type="text" id="logName" name="logName" class="form-control" placeholder="Log Name" value="<?php echo $user->u_logname?>" />
                </div>
                </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="email">Email</label>
                <div class="col-md-4">
                <input type="email" id="email" name="email"  class="form-control" placeholder="Email" value="<?php echo $user->u_email?>" />
                </div>
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-4">
                <input type="password" id="password" name="password"  class="form-control" placeholder="Password" value="<?php echo $user->u_password?>"/>
                </div>

                </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="remark">Remark</label>
                <div class="col-md-4">
                <input type="text" id="remark" name="remark"  class="form-control" placeholder="Remark" value="<?php echo $user->u_remarks?>" />
                </div>
                <label class="col-md-2 control-label" for="cell">Cell No.</label>
                <div class="col-md-4">
                <input type="text" id="cell" name="cell"  class="form-control" placeholder="Cell no." value="<?php echo $user->u_cellno?>" />
                </div>

                </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="loginFrom">Login Date From</label>
                <div class="col-md-4">
                <input type="text" id="loginFrom" name="loginFrom"  class="form-control datepicker" value="<?=date('d-m-Y',strtotime($user->u_loginfdate))?>"/>
                </div>
                <label class="col-md-2 control-label" for="loginTo">Login Date To</label>
                <div class="col-md-4">
                <input type="text" id="loginTo" name="loginTo"  class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($user->u_logintodate))?>"/>
                </div>

                </div>
                <div class="form-group">
                <label class="col-md-2 control-label" for="supervisor">Supervisor</label>
                <div class="col-md-4">

                <select class="form-control" name="supervisor" id="supervisor">
                <?php
                try {
                $supervisor=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_id'=>$user->su_id));
                } catch (Exception $e) {
                $supervisor=new stdClass();
                $supervisor->u_id="0";
                $supervisor->u_name="N/A";
                } 


                ?>
                <option value="<?=$supervisor->u_id?>"><?php echo $supervisor->u_name?></option>
                <?php 
                foreach ($user_list as $row) {?>
                <option value="<?php echo $row['u_id']?>"><?php echo $row['u_name']?></option>
                <?php }
                ?>

                </select>

                </div>
                <label class="col-md-2 control-label" for="enabled">Enabled</label>
                <div class="col-md-4">
                <input type="checkbox" id="enabled" value="1" name="enabled"  <?php if($user->u_enabled =='1') echo "checked='checked'"?>  class="form-control" />
                </div>

                </div>                                     
                <!-- <div class="form-group">
                <div class="example">
                <div class="example-title">Header Background</div>

                <div class="example-content well">
                <div class="example-content-widget">
                <input id="cp1" type="text" name="header_bg" class="form-control" value="<?php echo $user->header_bg?>"/>
                </div>
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="example">
                <div class="example-title">Footer Background</div>

                <div class="example-content well">
                <div class="example-content-widget">
                <input id="cp2" type="text" name="footer_bg" class="form-control" value="<?php echo $user->footer_bg?>"/>
                </div>
                </div>
                </div>
                </div> -->

                <div class="form-group pull-right">
                <div class="col-md-12">
                <input type="submit" name='submit' value="Edit User" class="btn btn-primary"/>
                <input type="hidden" name="hdnUserId" id="hdnUserId" value="<?php echo $user->u_id?>">
                </div>
                </div>
                </form>
                <br>
                <br>
                <legend>User Permissions</legend>
                <form class="form-inline" id="userPermissionForm" action="" method="post">
                <div class="form-group">
                <label class="control-label" for="menu_id">Menu name</label>


                <select class="form-control" name="menu_id" id="menu_id">
                <?php 
                $menu=$this->mdl_general->GetAllInfo('acs_menu','menu_id');
                foreach ($menu as $row) {?>
                <option value="<?php echo $row['menu_id']?>"><?php echo $row['menu_name']?></option>
                <?php }
                ?>

                </select>


                </div>
                <div class="form-group">
                <label class="control-label" for="menu_add">Add</label>

                <input type="checkbox" id="menu_add" value="1" name="menu_add" class="form-control" />

                </div>
                <div class="form-group">
                <label class="control-label" for="menu_edit">Edit</label>

                <input type="checkbox" id="menu_edit" value="1" name="menu_edit" class="form-control" />

                </div>

                <div class="form-group">
                <label class="control-label" for="menu_del">Del</label>

                <input type="checkbox" id="menu_del" value="1" name="menu_del" class="form-control" />

                </div>
                <div class="form-group">
                <label class="control-label" for="menu_view">View</label>

                <input type="checkbox" id="menu_view" value="1" name="menu_view" class="form-control" />

                </div>
                <div class="form-group">
                <input type="hidden" name="hdnUserId" id="hdnUserId" value="<?php echo $user->u_id?>">
                <input type="submit"  value="Add" name="submit_menu"  class="btn-primary btn btn-sm" />

                </div>


                </form>
                <br>
                <br>

                <table class="table table-striped  table-hover" id="userPermissionTable">
                <thead>
                <tr>

                <th>Menu name</th>
                <th>Add</th>
                <th>Edit</th>
                <th>View</th>
                <th>Delete</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($permissions as $row){

                ?>
                <tr>
                <td>
                    <?php
                    try {
                         $menu=$this->mdl_general->GetInfoByRow('acs_menu','menu_id',array('menu_id'=>$row['menu_id']))->menu_name;
                     } catch (Exception $e) {
                         $menu="N/A";
                     } 
                    
                    echo $menu; ?>
                </td>
                <td>
                    <input type="checkbox"  value="1"  <?php if($row['u_add'] =='1') echo "checked='checked'"?>  menu_id="<?php echo $row['menu_id']?>" user_id="<?php echo $row['u_id']?>" class="form-control checkbox_add" />
                </td>
                <td>
                    <input type="checkbox"  value="1"   <?php if($row['u_edit'] =='1') echo "checked='checked'"?> menu_id="<?php echo $row['menu_id']?>" user_id="<?php echo $row['u_id']?>"   class="form-control checkbox_edit" />
                </td>
                <td>
                    <input type="checkbox" value="1"   <?php if($row['u_view'] =='1') echo "checked='checked'"?> menu_id="<?php echo $row['menu_id']?>" user_id="<?php echo $row['u_id']?>"   class="form-control checkbox_view" />
                </td>
                <td>
                    <input type="checkbox"  value="1"  <?php if($row['u_del'] =='1') echo "checked='checked'"?>  menu_id="<?php echo $row['menu_id']?>" user_id="<?php echo $row['u_id']?>"  class="form-control checkbox_del" />
                </td>
                <td>
                    <a href=" <?php echo base_url().'transaction/delete_user_permission/'.$row['u_id'].'/'.$row['menu_id']?>" class="red"><i class="fa fa-trash fa-2x"></i></a>
                </td>
                </tr>
                <?php  }?>
                </tbody>

                </table>




                </div>
                <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
                </div><!-- /.row -->
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
 
            url= "<?=base_url()?>";
            $("#userPermissionForm").submit(function(event) {
                 event.preventDefault();
                 $.ajax({
                    data:$("#userPermissionForm").serialize(),
                    type: "post",
                    url: url+"transaction/insert_user_permission",
                    dataType: 'json',
                    success: function(data){
                        
                        if(data){
                            alert(data['message']);
                            location.reload();
                        }

                    }
                 });
            });

            $("#userPermissionTable").on('click','.checkbox_add',function(){
                var menu_id= $(this).attr('menu_id');
                var user_id= $(this).attr('user_id');
                var type='add';
                var check= $(this).is(":checked") ;
                if(check==true){
                    var value='1';
                }else{
                    var value='0';
                }
                $.ajax({
                    data:{
                        menu_id:menu_id,
                        user_id:user_id,
                        type:type,
                        value:value
                    },
                    type:"POST",
                    dataType:"JSON",
                    url:url+"transaction/change_user_permission",
                    success:function(data){
                        alert("User permission changed");

                    }
                });

            });
            $("#userPermissionTable").on('click','.checkbox_edit',function(){
                var menu_id= $(this).attr('menu_id');
                var user_id= $(this).attr('user_id');
                var type='edit';
                var check= $(this).is(":checked") ;
                if(check==true){
                    var value='1';
                }else{
                    var value='0';
                }
                $.ajax({
                    data:{
                        menu_id:menu_id,
                        user_id:user_id,
                        type:type,
                        value:value
                    },
                    type:"POST",
                    dataType:"JSON",
                    url:url+"transaction/change_user_permission",
                    success:function(data){
                        alert("User permission changed");
                        
                    }
                });
                
            });
            $("#userPermissionTable").on('click','.checkbox_view',function(){
                var menu_id= $(this).attr('menu_id');
                var user_id= $(this).attr('user_id');
                var type='view';
                var check= $(this).is(":checked") ;
                if(check==true){
                    var value='1';
                }else{
                    var value='0';
                }
                $.ajax({
                    data:{
                        menu_id:menu_id,
                        user_id:user_id,
                        type:type,
                        value:value
                    },
                    type:"POST",
                    dataType:"JSON",
                    url:url+"transaction/change_user_permission",
                    success:function(data){
                        alert("User permission changed");
                        
                    }
                });
            });
            $("#userPermissionTable").on('click','.checkbox_del',function(){
                var menu_id= $(this).attr('menu_id');
                var user_id= $(this).attr('user_id');
                var type='del';
                var check= $(this).is(":checked") ;
                if(check==true){
                    var value='1';
                }else{
                    var value='0';
                }
                $.ajax({
                    data:{
                        menu_id:menu_id,
                        user_id:user_id,
                        type:type,
                        value:value
                    },
                    type:"POST",
                    dataType:"JSON",
                    url:url+"transaction/change_user_permission",
                    success:function(data){
                        alert("User permission changed");
                        
                    }
                });
            });
</script>

<?php $this->load->module('footer')->index(); ?>

