<!-- left menu starts -->
<?php
$this->load->model('sidebar/mdl_extra_sidebar','sidebar_model');
?>
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="<?php echo base_url('customer')?>"><i class="glyphicon glyphicon-home"></i><span>Customer Dashboard</span></a>
                        </li>
                        <li><a class="ajax-link" href="<?php echo base_url('customer/userInfo')?>"><i class="glyphicon glyphicon-list-alt"></i><span>User Info</span></a>
                        </li>
                        <li class="accordion" <?php if($this->uri->segment(1)=='report') echo 'class="active"' ;?>>
                            <a href="#"><i class="glyphicon glyphicon-edit"></i><span> Reports</span></a>
                            <?php 
							//getting menu items for reports =3
							$menu=$this->sidebar_model->GetPermittedMenuItem('3',$this->session->userdata('sess_user_id'));
							if(count($menu)>0){
							foreach($menu as $row){
								 ?>
								 <ul class="nav nav-pills nav-stacked">
	                                <li  <?php if($this->uri->segment(2)== $row['menu_url']) echo 'class="active"' ;?>>
	                                	<a href="<?php echo base_url().'report/'.$row['menu_url']?>"><?php echo $row['menu_name']?></a>
	                                </li>
	                            </ul>

							<?php

							}
						}else{?>
								<ul class="nav nav-pills nav-stacked">
	                                <li><a href="#">No menu Item</a></li>
	                            </ul>
						<?php }
							?>
                            
                        </li>
                    </ul>
                    <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->


        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>