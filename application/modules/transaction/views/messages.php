<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/14/2017
 * Time: 9:18 PM
 */
?>

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
                        <a href="#">Messages</a>
                    </li>
                </ul>
            </div>
            <div class="row">

            </div><!--/row-->

            <!-- content ends -->
        </div><!--/#content.col-md-0-->
    </div><!--/fluid-row-->
    <script src="<?=base_url()?>js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        //datepicker setting
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
            format:'dd-mm-yyyy'
        });
        function delete_customer(id){
            var r = confirm("Do you want to delete this customer?");
            if(r== true){
                $.ajax({
                    data:{
                        id:id
                    },
                    type: "post",
                    url: "<?php echo base_url()?>"+"transaction/delete_customer_info",
                    success:function(data){
                        location.reload();


                    }
                });

            }else{
                return false;
            }

        }
    </script>

    <?php $this->load->module('footer')->index(); ?>

