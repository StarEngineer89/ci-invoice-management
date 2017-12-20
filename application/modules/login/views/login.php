
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to (IMS)</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
        	<?php
					if($this->input->get('error')){
						if($this->input->get('error') == 1){
							echo'<div class="alert alert-danger">Username or Password is wrong</div>';
						}else if($this->input->get('error') == 2){
							echo'<div class="alert alert-warning">Account is disabled.</div>';
						}else if($this->input->get('error') == 3){
							echo'<div class="alert alert-danger">Login date is beyond the assigned date</div>';
						}elseif ($this->input->get('error') == 4) {
							echo'<div class="alert alert-danger">Please login to access</div>';
						}
					}else{
						echo "<div class='alert alert-info'>Please login with your Username and Password.</div>";
					}
				?>
            
            <form class="form-horizontal" action="<?php echo base_url()?>login/do_login" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="user_logname" type="text" class="form-control" maxlength="100" class="input username" placeholder="Username" required>
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input name="user_pass"  type="password" class="form-control" maxlength="100" class="input password" placeholder="Password" required>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <input type="submit" class="btn btn-primary" value="Login" />
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->
