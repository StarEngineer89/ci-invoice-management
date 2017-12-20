

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
                            <li class="active">Donor Donation Summary</li>
                        </ul><!-- /.breadcrumb -->

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            <h1>
                                Donor Donation Summary
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
                                        <form action="<?=base_url()?>report/rep_donor_donation_filter" target="_blank" method="post" id="textAlertReportForm" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="donorCity">City</label>
                                                <div class="col-md-2">
                                                    <select name="donorCity" id="donorCity" class="form-control ">
                                                        <option value="0">All</option>
                                                        <?php $city=$this->mdl_general->GetAllInfo('dn_city','city_default',array('city_active'=>"1"));
                                                        foreach($city as $row){
                                                        ?>
                                                        <option value="<?=$row['city_id']?>"><?=$row['city_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <label class="col-md-2 control-label" for="homeCity">City is donor's Home City</label>
                                                <div class="col-md-2">
                                                    <input type="checkbox" name="homeCity" id="homeCity" class="form-control " value="1">
                                                </div>
                                                <label class="col-md-2 control-label" for="donorType">Donor Type</label>
                                                <div class="col-md-2">
                                                    <select name="donorType" id="donorType" class="form-control ">
                                                        <option value="0">All</option>
                                                        <?php $city=$this->mdl_general->GetAllInfo('dn_donortype','donortype_id',array('donortype_active'=>"1"));
                                                        foreach($city as $row){
                                                        ?>
                                                        <option value="<?=$row['donortype_id']?>"><?=$row['donortype_name']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="donorName">Donor Name</label>
                                                <div class="col-md-10">
                                                    <input  type="text" id="donorName" name="donorName" class="form-control" autocomplete="off" />
                                                    <ul class="dropdown-menu txtDonor" style="margin-left:15px;margin-right:0px;overflow-y: auto;height: 300px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownDonorName">
                                                    </ul>
                                                    <input type="hidden" id="hdnDonorId" name="hdnDonorId" >
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
            <script>
            $("#donorName").keyup(function() {
                $.ajax({
                type: "POST",
                url: base_url+"report/get_donor_detail",
                async:false,
                data: {
                    name: $("#donorName").val()
                },
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#DropdownDonorName').empty();
                        $('#donorName').attr("data-toggle", "dropdown");
                        $('#DropdownDonorName').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#donorName').attr("data-toggle", "");
                    }
                    jQuery.each(data, function(key, value) {
                        if (data.length >= 0)
                            $('#DropdownDonorName').append('<li role="presentation" ><a role="menuitem dropdownnameli" class="dropdownlivalue" donor_id="'+value['donor_id']+'" donor_name="'+value['donor_namef']+' '+value['donor_namem']+' '+value['donor_namel']+'"  >'+ value['donor_id'] +' - ' + value['donor_namef'] +' '+value['donor_namem']+' '+value['donor_namel']+' - '+ value['donorhome_address']+ '</a></li>');
                    });

                }
        });
    });
    $('ul.txtDonor').on('click', 'li a', function() {
        $('#donorName').val($(this).attr('donor_name'));
        $('#hdnDonorId').val($(this).attr('donor_id'));
        $('#donorEmail').val($(this).attr('donor_email'));

    });
            </script>
            
    </body>
</html>