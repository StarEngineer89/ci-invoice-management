

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
                            <li class="active">Project Child Payment</li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Project Child Payment
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
                                        <form action="<?=base_url()?>report/rep_project_child_filter_payment" target="_blank" method="post" id="activeBoxCollectionSummaryReportForm" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="payment_projectsite">Project</label>
                                                <div class="col-md-2">
                                                    <select id="payment_projectsite" name="payment_projectsite" class="form-control">
                                                        <?php
                                                        $projectsitelist=$this->mdl_general->GetAllInfo('dn_project_site','psite_id',array('psite_status'=>'1'));
                                                        foreach($projectsitelist as $row){
                                                         ?>
                                                        <option value="<?php echo $row['psite_id']?>"><?php echo $row['psite_name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="orphanChildName">Child</label>
                                                <div class="col-md-2">
                                                    <select class="form-control" id="orphanChildName" name="orphanChildName">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="fromDate">From Date</label>
                                                <div class="col-md-2">
                                                    <input name="fromDate" id="fromDate" class="form-control datepicker" value="<?=date('d-m-Y')?>">
                                                </div>
                                                <label class="col-md-1 control-label" for="toDate">To Date</label>
                                                <div class="col-md-2">
                                                    <input name="toDate" id="toDate" class="form-control datepicker" value="<?=date('d-m-Y')?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="">&nbsp;</label>
                                                <div class="col-md-6">
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
            $("#payment_projectsite").change(function(){
                    // alert($(this).val());
                    var _param = {
                        'orphan_projectsite_id': $(this).val()
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>report/getOrphanChildNamelist",
                        data: _param,
                        dataType: "JSON",
                        success: function(data) {
                            var all_data = '';
                                for(i=0;i < data.length;i++){
                                    all_data += "<option value='"+data[i]['orphan_id']+"'>"+data[i]['orphanChildName']+"</option>";
                                }
                          $("#orphanChildName").html(all_data);
                          
                        }
                    });
                   
            });
            </script>
            
    </body>
</html>