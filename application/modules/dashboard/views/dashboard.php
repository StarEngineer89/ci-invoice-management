
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
<div class=" row">

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $customer_total=count($this->mdl_general->GetAllInfo('ims_customer_info','customer_id',array('active'=>"1")));
        ?>
        <a data-toggle="tooltip" title="<?php echo $customer_total;?>" class="well top-block" href="<?php echo base_url("transaction/customer")?>">
            <i class="glyphicon glyphicon-user blue"></i>
            
            <div>Total Customer</div>
            <div><?php echo $customer_total; ?></div>
            <span class="notification"><?php echo $customer_total; ?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $order_total=count($this->mdl_general->GetAllInfo('ims_ordermaster','orderid',array()));?>
        <a data-toggle="tooltip" title="<?php echo $order_total?>" class="well top-block" href="<?php echo base_url("transaction/customer_order")?>">
            <i class="glyphicon glyphicon-star green"></i>
            
            <div>Total Orders</div>
            <div><?php echo $order_total?></div>
            <span class="notification green"><?php echo $order_total?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>

            <div>Sales</div>
            <div>&#163;13320</div>
            <span class="notification yellow">&#163;34</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="<?php echo base_url("transaction/messages")?>">
            <i class="glyphicon glyphicon-envelope red"></i>

            <div>Messages</div>
            <div>25</div>
            <span class="notification red">12</span>
        </a>
    </div>
</div>
<div class="row">

    <!--<div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Chart with points</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="sincos" class="center" style="height:300px"></div>
                <p id="hoverdata">Mouse position at (<span id="x">0</span>, <span id="y">0</span>). <span
                        id="clickdata"></span></p>
            </div>
        </div>
    </div>-->

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Flot</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="flotchart" class="center" style="height:300px"></div>
            </div>
        </div>
    </div>

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Stack Example</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="stackchart" class="center" style="height:300px;"></div>

                <p class="stackControls center">
                    <input class="btn btn-default" type="button" value="With stacking">
                    <input class="btn btn-default" type="button" value="Without stacking">
                </p>

                <p class="graphControls center">
                    <input class="btn btn-primary" type="button" value="Number order per week">
                    <input class="btn btn-primary" type="button" value="Number of invoices generated per week">
                    <input class="btn btn-primary" type="button" value="Number of deliver been done per week">
                </p>
            </div>
        </div>
    </div>

</div><!--/row-->

<?php $this->load->module('footer')->index(); ?>
<!-- chart libraries start -->
<!-- <script src="<?php //echo base_url()?>bower_components/flot/excanvas.min.js"></script> -->
<script src="<?php echo base_url()?>bower_components/flot/jquery.flot.js"></script>
<!-- <script src="<?php //echo base_url()?>bower_components/flot/jquery.flot.pie.js"></script> -->
<!-- <script src="<?php //echo base_url()?>bower_components/flot/jquery.flot.stack.js"></script> -->
<!-- <script src="<?php //echo base_url()?>bower_components/flot/jquery.flot.resize.js"></script> -->
<!-- chart libraries end -->
<script src="<?php echo base_url()?>js/init-chart.js"></script>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

