

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
                            <li class="active">Expense Summary</li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Expense Summary
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
                                        <form action="<?=base_url()?>report/rep_expense_summary_filter" target="_blank" method="post" id="textAlertReportForm" class="form-horizontal">
                                            <div class="form-group">
                                                
                                                <label class="col-md-1 control-label" for="fromDate">From</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="fromDate" id="fromDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="toDate">To</label>
                                                <div class="col-md-2">
                                                    <input type="text" name="toDate" id="toDate" class="form-control datepicker " value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="fromDate">Supplier</label>
                                                <div class="col-md-2">
                                                    <select id="supplier" name="supplier" class="form-control">
                                                        <option value="0">All</option>
                                                        <?php $supplier=$this->mdl_general->GetAllInfo('dn_supplier','sup_id',array('sup_active'=>"1"));
                                                        foreach($supplier as $row){?>
                                                            <option value="<?=$row['sup_id']?>"><?=$row['sup_name']?></option>
                                                        <?php }?>
                                                    </select>
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