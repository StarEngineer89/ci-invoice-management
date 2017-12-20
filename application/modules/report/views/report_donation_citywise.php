

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
                            <li class="active">Donation Citywise</li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Donation Citywise
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
                                        <form action="<?=base_url()?>report/rep_donation_citywise_filter" target="_blank" method="post" id="donationCitywiseReportForm" class="form-horizontal">
                                            <div class="form-group">
                                                
                                                
                                                <label class="col-md-1 control-label" for="fromDate">From</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="fromDate" id="fromDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="toDate">To</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="toDate" id="toDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div> 
                                                <label class="col-md-1 control-label" for="city">City</label>
                                                <div class="col-md-2">
                                                    <select id="city" name="city" class="form-control">
                                                        <option value="0">All</option>
                                                        <?php $city=$this->mdl_general->GetAllInfo('dn_city','city_default',array('city_active'=>"1"));
                                                        foreach($city as $row){
                                                        ?>
                                                        <option value="<?=$row['city_id']?>"><?=$row['city_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>

                                                <label class="col-md-1 control-label" for="donationType">Donation Type</label>
                                                <div class="col-md-2">
                                                    <select id="donationType" name="donationType" class="form-control">
                                                        <option value="0">All</option>
                                                        <?php $donation_type=$this->mdl_general->GetAllInfo('dn_donationtype','dt_id',array('dt_active'=>"1"));
                                                        foreach($donation_type as $row){
                                                        ?>
                                                        <option value="<?=$row['dt_id']?>"><?=$row['dt_name']?></option>
                                                        <?php }?>
                                                    </select>                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="homeCity">City is donor's Home City</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="homeCity" id="homeCity" class="form-control " value="1">
                                                </div>
                                                 <label class="col-md-2 control-label" for="fromAmount">From Amount</label>
                                                <div class="col-md-2">
                                                    <input type="number" min="0" step="0.01"  name="fromAmount" id="fromAmount" class="form-control" >
                                                </div>
                                                <label class="col-md-2 control-label" for="toAmount">To Amount</label>
                                                <div class="col-md-2">
                                                    <input type="number" min="0" step="0.01" name="toAmount" id="toAmount" class="form-control ">
                                                </div> 
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