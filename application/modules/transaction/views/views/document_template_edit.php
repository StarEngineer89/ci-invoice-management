<script src="<?php echo base_url('js/editor.js')?>"></script>
<script>
    $(document).ready(function() {
        $("#doc_body").Editor();
    });
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/editor.css')?>">
<div class="ch-container">
    <div class="row">
        <?php $this->load->module('sidebar')->index();?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="<?php echo base_url("transaction/document_template")?>">Document Template</a></li>
        <li><a href="<?php echo base_url("transaction/document_template/Edit")?>">Edit</a></li>
    </ul>
    </div>
<style type="text/css">
    input[type='text']{
        color: #178acc;
    }
    input[type='email']{
        color: #178acc;
    }
    select.form-control{
        color: #178acc;
    }
    textarea.form-control{
        color: #178acc;   
    }
</style>
 <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Edit Document Template</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
         <div class="container">
            <div class="row">
                <?php
                $row = $document_template_list;
                ?>
                <!-- form: -->
                <section>
                    <div class="col-lg-10">
                        <form action="<?php echo base_url()?>transaction/edit_document_template" id="defaultForm" method="post"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label id="lablefortablename"></label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="hddDocId" value="<?php echo $row->doc_id ?>">
                                <label class="col-lg-3 control-label">Document Type:</label>
                                <select name="doc_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="customer" <?php echo ($row->d_letter_type == 'customer') ? 'selected' : '' ?> >For Customer</option>
                                    <option value="customer_order" <?php echo ($row->d_letter_type == 'customer_order') ? 'selected' : '' ?> >For Order</option>
                                    <option value="invoice" <?php echo ($row->d_letter_type == 'invoice') ? 'selected' : '' ?> >For Invoice</option>
                                    <option value="delivery_note" <?php echo ($row->d_letter_type == 'delivery_note') ? 'selected' : '' ?> >For Delivery</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                <label class="col-lg-3 control-label">Table Name:</label>
                                <select name="doc_table_name" id="doc_table_name" class="form-control">
                                    <option value="">Select Table Name</option>
                                    <option value="ims_customer_info" <?php echo ($row->d_table_name == 'ims_customer_info') ? 'selected' : '' ?>>Customer</option>
                                    <option value="ims_ordermaster" <?php echo ($row->d_table_name == 'ims_ordermaster') ? 'selected' : '' ?>>Order</option>
                                    <option value="ims_invoicemaster" <?php echo ($row->d_table_name == 'ims_invoicemaster') ? 'selected' : '' ?>>Invoice</option>
                                    <option value="ims_delivery_note" <?php echo ($row->d_table_name == 'ims_delivery_note') ? 'selected' : '' ?>>Delivery</option>
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Letter Template Name:</label>
                                <input type="text" name="doc_letter_template" class="form-control" value="<?php echo $row->d_letter_template_name ?>" placeholder="Letter Template Name">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Subject:</label>
                                <input type="text" name="doc_subject" class="form-control" value="<?php echo $row->d_subject ?>" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Header:</label>
                                <input type="text" name="doc_header" class="form-control" value="<?php echo $row->d_header ?>" placeholder="Header">
                            </div>
                           <div class="form-group" >
                                <label class="col-md-3" for="doc_body">Body</label>
                                <div class="col-md-12">
                                    <textarea id="doc_body" name="doc_body"><?php echo $row->d_body ?></textarea> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Footer:</label>
                                <input type="text" name="doc_footer" class="form-control" value="<?php echo $row->d_footer ?>" placeholder="Footer">
                            </div>
                            <br/>
                            <div class="form-group pull-right">
                                <div class="col-md-12">
                                    <a href="<?php echo base_url()?>transaction/document_template" class="btn btn-default">Cancel</a>
                                    <button type="submit" id="btn_doc_tem" class="btn btn-primary" name="Save" >Save</button>
                                </div>
                            </div>
                </section>
                <!-- :form -->
            </div>
        </div> <!-- End Row form-->
    </div>
    </div>
   </div>
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
</div> <!-- End ch-container-->
<script type="text/javascript">
var base_url = "<?php echo base_url()?>";

$('#btn_doc_tem').click(function(){
    var a = {};
    var b = 0;
    $('.Editor-editor').each(function() {
        a[b] = $(this).html();
        b++;
    });
    $('#doc_body').val(escape(a[0]));
   });
$(document).ready(function(){
    var _dbody = $('#doc_body').val();
    // alert(_dbody);
    $('.Editor-editor').html(unescape(_dbody));
    // 
    var _doc_table_name = $("#doc_table_name").val();
    $.ajax({
        type: "POST",
        url: base_url+"transaction/getFieldsPerTable",
        data: {
            table_name: _doc_table_name
        },
        dataType: "json",
        success: function(data) {
            var _labeltxt = '';
            jQuery.each(data, function(key, value) {
                _labeltxt += '<label><font color="red" >' + key + "</font></label><br/>";
                _labeltxt += data[key] + '</br></br>';
                $("#lablefortablename").html(_labeltxt);
            });

        }
    });
});
$('#doc_table_name').on('change',function(){
     $.ajax({
        type: "POST",
        url: base_url+"transaction/getFieldsPerTable",
        data: {
            table_name: $(this).val()
        },
        dataType: "json",
        success: function(data) {
            var _labeltxt = '';
            jQuery.each(data, function(key, value) {
                _labeltxt += '<label><font color="red" >' + key + "</font></label><br/>";
                _labeltxt += data[key] + '</br></br>';
                $("#lablefortablename").html(_labeltxt);
            });

        }
    });
})
</script>
<?php $this->load->module('footer')->index(); ?>

