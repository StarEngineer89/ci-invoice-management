

       <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <?php $this->load->module('sidebar')->index();?>

            
            <div class="main-content">
                <div class="main-content-inner">
                    <!-- #section:basics/content.breadcrumbs -->
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="<?=base_url()?>dashboard">Dashboard</a>
                            </li>
                            <li >Report</li>
                            <li class="active">Top Donation </li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Top Donation
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    Report
                                </small>
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-12">
                                        <form action="<?=base_url()?>report/rep_top_donation_filter" target="_blank" method="post" id="topDonationReportForm" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-1 control-label" for="fromDate">From</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="fromDate" id="fromDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="toDate">To</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="toDate" id="toDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div> 
                                                <label class="col-md-1 control-label" for="donorCity">City</label>
                                                <div class="col-md-2">
                                                    <select name="city" id="city" class="form-control">
                                                        <option value="0">ALL</option>?>
                                                        <?php $city=$this->mdl_general->GetAllInfo('dn_city','city_default',array('city_active'=>'1'));
                                                        foreach($city as $row){
                                                        ?>
                                                        <option value="<?=$row['city_id']?>"><?=$row['city_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <label class="col-md-1 control-label" for="donorType">Donor Type</label>
                                                <div class="col-md-2">
                                                    <select name="donorType" id="donorType" class="form-control">
                                                        <option value="0">ALL</option>
                                                        <?php $donor_type=$this->mdl_general->GetAllInfo('dn_donortype','donortype_id',array('donortype_active'=>'1'));
                                                        foreach($donor_type as $row){
                                                        ?>
                                                        <option value="<?=$row['donortype_id']?>"><?=$row['donortype_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="homeCity">City is donor's Home City</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="homeCity" id="homeCity" class="form-control " value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="event">Event</label>
                                                <div class="col-md-2">
                                                    <select name="event" id="event" class="form-control">
                                                        <option value="0">ALL</option>
                                                        <?php $events=$this->mdl_general->GetAllInfo('dn_events','event_default',array('event_active'=>'1'));
                                                        foreach($events as $row){
                                                        ?>
                                                        <option value="<?=$row['event_id']?>"><?=$row['event_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <label class="col-md-2 control-label" for="donationNo">Top Donation</label>
                                                <div class="col-md-1">
                                                    <input type="number" step="1" min="1"  name="donationNo" id="donationNo" class="form-control ">
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <div class="form-group pull-right">
                                                <div class="col-md-12">
                                                    <input type="submit" name='pdf' value="PDF" class="btn btn-primary"/>
                                                    <input type="submit" name='xls' value="XLS" class="btn btn-primary"/>
                                                    <input type="submit" name='show' value="Show" class="btn btn-primary"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <?php $this->load->module('footer')->index(); ?>
            <script src="<?=base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
            <script>
            $(".datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                format:'dd-mm-yyyy' 
            });
            </script>
            
    </body>
</html>