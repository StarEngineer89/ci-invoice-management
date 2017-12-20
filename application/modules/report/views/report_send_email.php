
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
                            <li class="active">Send Email </li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Send Email
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
                                        <form action="<?=base_url()?>report/rep_send_email_filter" method="post" id="sendEmailReportForm" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-md-1 control-label" for="donorCity">City</label>
                                                <div class="col-md-3">
                                                    <select name="donorCity" id="donorCity" class="form-control">
                                                        <option value="0">ALL</option>
                                                        <?php $city=$this->mdl_general->GetAllInfo('dn_city','city_default',array('city_active'=>'1'));
                                                        foreach($city as $row){
                                                        ?>
                                                        <option value="<?=$row['city_id']?>"><?=$row['city_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <label class="col-md-1 control-label" for="donorEvent">Event</label>
                                                <div class="col-md-3">
                                                    <select name="donorEvent" id="donorEvent" class="form-control">
                                                        <option value="0">ALL</option>
                                                        <?php $event=$this->mdl_general->GetAllInfo('dn_events','event_default',array('event_active'=>'1'));
                                                        foreach($event as $row){
                                                        ?>
                                                        <option value="<?=$row['event_id']?>"><?=$row['event_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <label class="col-md-1 control-label" for="donorType">Donor Type</label>
                                                <div class="col-md-3">
                                                    <select name="donorType" id="donorType" class="form-control">
                                                        <option value="0">ALL</option>
                                                        <?php $donor_type=$this->mdl_general->GetAllInfo('dn_donortype','donortype_id',array('donortype_active'=>1));
                                                        foreach($donor_type as $row){
                                                        ?>
                                                        <option value="<?=$row['donortype_id']?>"><?=$row['donortype_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="homeCity">City is donor's home city </label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="homeCity" id="homeCity" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorVIP">VIP</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorVIP" id="donorVIP" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorCommittee">Committee</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorCommittee" id="donorCommittee" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorCardSend">Card Send</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorCardSend" id="donorCardSend" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-2 control-label" for="donorMailOfficeAddress">Mailing Address Office</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorMailOfficeAddress" id="donorMailOfficeAddress" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-1 control-label" for="donorEmail">Email</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorEmail" id="donorEmail" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorTextAlert">Text Alert</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorTextAlert" id="donorTextAlert" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorBoxDonor">Box Donor</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorBoxDonor" id="donorBoxDonor" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorMuslim">Muslim</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorMuslim" id="donorMuslim" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorNews">News</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorNews" id="donorNews" class="form-control" value="1">
                                                </div>
                                                <label class="col-md-1 control-label" for="donorDataSharing">Data Sharing</label>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="donorDataSharing" id="donorDataSharing" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label class="col-md-1 control-label" for="fromDate">From Date</label>
                                                <div class="col-md-2">
                                                    <input name="fromDate" id="fromDate" class="form-control datepicker" value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="toDate">To Date</label>
                                                <div class="col-md-2">
                                                    <input name="toDate" id="toDate" class="form-control datepicker" value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="fromAmount">From Amount</label>
                                                <div class="col-md-2">
                                                    <input type="number" step="0.01" min="0" name="fromAmount" id="fromAmount" class="form-control" value="0">
                                                </div>
                                                <label class="col-md-1 control-label" for="toAmount">To Amount</label>
                                                <div class="col-md-2">
                                                    <input type="number" step="0.01" min="0" name="toAmount" id="toAmount" class="form-control" value="100000">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="headerEmail">Header</label>
                                                <div class="col-md-10">
                                                    <input name="headerEmail" id="headerEmail" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="bodyEmail">Body</label>
                                                <div class="col-md-10">
                                                    <textarea rows="20" name="bodyEmail" id="bodyEmail" class="form-control"></textarea>
                                                    <b>{title} {donornamefirst} {donornamemiddle} {donornamelast} {donoraddress} {city} {postcode} {cellnumber} {phone} {email} {event}</b>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="imageEmail">Attach Email</label>
                                                <div class="col-md-10">
                                                    <input type="file" name="imageEmail" id="imageEmail" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group pull-right">
                                                <div class="col-md-12">
                                                    <input type="submit" name="send" value="Send Email" class="btn btn-primary"/>
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
        </div>
            
    </body>
</html>