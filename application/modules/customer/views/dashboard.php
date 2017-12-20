<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/17/2017
 * Time: 9:12 PM
 */
?>

<div class="ch-container">
    <div class="row">
        <?php $this->load->module('sidebar')->customer();?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url('customer/index') ?>">Home</a>
                    </li>
                </ul>
            </div>

            <div class="row">

                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2><i class="glyphicon glyphicon-list-alt"></i> Customer Order</h2>

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
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" id="DataTables_Table_0">
                                <thead>
                                <tr>
                                    <th class="center sorting_asc"></th>
                                    <th class="center sorting">Order Id</th>
                                    <th class="center sorting">Order Date</th>
                                    <th class="center sorting">Order Status</th>
                                    <th class="center sorting">Order Amount</th>
                                    <th class="center sorting">Order Details</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php foreach ($customer_order_list as $order): ?>
                                    <tr>
                                        <td class="center">8</td>
                                        <td class="center"><?php echo $order['orderid'] ?></td>
                                        <td class="center"><?php echo $order['order_date'] ?></td>
                                        <td class="center"><?php echo $order['order_status'] ?></td>
                                        <td class="center"><?php echo number_format($order['amount'],2) ?></td>
                                        <td class="center"><?php echo $order['service_description'] ?></td>
                                        <td class=" ">
                                            <a class="btn btn-info btn-xs" href="<?php echo base_url('customer/orderDetails?order-id=' . $order['orderid']) ?>">
                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs" onclick="delete_customer_order(7, 4);" href="javascript:void(0);">
                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                            </a>
                                            <a class="btn btn-warning btn-xs" target="blank" title="Docs" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/docs/4">
                                                <i class="glyphicon glyphicon-book icon-white"></i>
                                            </a>
                                            <a class="btn btn-success btn-xs" target="blank" title="Email" href="javascript:void(0)">
                                                <i class="glyphicon glyphicon-envelope icon-white"></i>
                                            </a>
                                            <a class="btn btn-default btn-xs" target="blank" title="Order Reports" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/reports/7">
                                                <i class="glyphicon glyphicon-list-alt icon-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2><i class="glyphicon glyphicon-list-alt"></i> Customer Invoices</h2>

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
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" id="DataTables_Table_0">
                                <thead>
                                <tr>
                                    <th class="center sorting_asc"></th>
                                    <th class="center sorting">Order Id</th>
                                    <th class="center sorting">Invoice Id</th>
                                    <th class="center sorting">Invoice Date</th>
                                    <th class="center sorting">Total Amount</th>
                                    <th class="center sorting">Received</th>
                                    <th class="center sorting">Balance</th>
                                    <th class="center sorting">Payment Mode</th>
                                    <th class="center sorting">Invoice Details</th>
                                    <th class="center sorting">Actions</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php foreach ($customer_invoice_list as $invoice): ?>
                                    <tr>
                                        <td class="center"><input type="checkbox" name="invoice_check"></td>
                                        <td class="center"><?php echo $invoice['order_no'] ?></td>
                                        <td class="center"><?php echo $invoice['id'] ?></td>
                                        <td class="center"><?php echo $invoice['invoice_date'] ?></td>
                                        <td class="center"><?php echo number_format($invoice['total_order'],2) ?></td>
                                        <td class="center"><?php echo number_format($invoice['receive_amount'],2) ?></td>
                                        <td class="center"><?php echo number_format($invoice['balance'],2) ?></td>
                                        <td class="center"><?php echo $invoice['paymentmode'] ?></td>
                                        <td class="center"><?php echo $invoice['description'] ?></td>
                                        <td class=" ">
                                            <a class="btn btn-info btn-xs" href="<?php echo base_url('customer/invoicedetails?invoice-id=' . $invoice['id']) ?>">
                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs" onclick="delete_customer_order(<?php echo $invoice['id'] ?>, 4);" href="javascript:void(0);">
                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                            </a>
                                            <a class="btn btn-warning btn-xs" target="blank" title="Docs" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/docs/4">
                                                <i class="glyphicon glyphicon-book icon-white"></i>
                                            </a>
                                            <a class="btn btn-success btn-xs" target="blank" title="Email" href="javascript:void(0)">
                                                <i class="glyphicon glyphicon-envelope icon-white"></i>
                                            </a>
                                            <a class="btn btn-default btn-xs" target="blank" title="Order Reports" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/reports/7">
                                                <i class="glyphicon glyphicon-list-alt icon-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                            <h2><i class="glyphicon glyphicon-list-alt"></i> Customer Delivery</h2>

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
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable" id="DataTables_Table_0">
                                <thead>
                                <tr>
                                    <th class="center sorting_asc"></th>
                                    <th class="center sorting">Order Id</th>
                                    <th class="center sorting">Delivery Id</th>
                                    <th class="center sorting">Delivery Date</th>
                                    <th class="center sorting">Delivery Status</th>
                                    <th class="center sorting">View Delivery Details</th>
                                    <th class="center">Actions</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php foreach ($customer_deliverynote_list as $note): ?>
                                    <tr>
                                        <td class="center"><input type="checkbox" name="delivery_check"></td>
                                        <td class="center"><?php echo $note['order_no'] ?></td>
                                        <td class="center"><?php echo $note['id'] ?></td>
                                        <td class="center"><?php echo $note['delivery_date'] ?></td>
                                        <td class="center"><?php echo $note['delivery_status'] ?></td>
                                        <td class="center"><?php echo $note['delivery_details'] ?></td>
                                        <td class=" ">
                                            <a class="btn btn-info btn-xs" href="<?php echo base_url('customer/deliverynote?note-id=' . $note['id']) ?>">
                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs" onclick="delete_customer_order(<?php echo $note['id'] ?>, 4);" href="javascript:void(0);">
                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                            </a>
                                            <a class="btn btn-warning btn-xs" target="blank" title="Docs" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/docs/4">
                                                <i class="glyphicon glyphicon-book icon-white"></i>
                                            </a>
                                            <a class="btn btn-success btn-xs" target="blank" title="Email" href="javascript:void(0)">
                                                <i class="glyphicon glyphicon-envelope icon-white"></i>
                                            </a>
                                            <a class="btn btn-default btn-xs" target="blank" title="Order Reports" href="http://www.onyxprojects.xyz/grafx/transaction/customer_order/reports/7">
                                                <i class="glyphicon glyphicon-list-alt icon-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--/row-->
            <!-- content ends -->
        </div><!--/#content.col-md-0-->
    </div><!--/fluid-row-->

    <?php $this->load->module('footer')->index(); ?>
