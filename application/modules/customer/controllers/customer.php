<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/17/2017
 * Time: 9:03 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_general');
        $this->load->model('mdl_extra');

        $this->load->library('session');
        if($this->session->userdata('sess_logged_in')!=true){
            redirect('login/customer?error=4');
        }
    }

    public function index() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Customer Dashboard';

        $data['customer_order_list']=$this->mdl_extra->getCustomerOrder('','group by om.customer_id');
        $data['customer_invoice_list']=$this->mdl_extra->getInvoiceDetails('','group by om.customer_id');
        $data['customer_deliverynote_list']=$this->mdl_extra->getDeliveryNoteDetails('','group by om.customer_id');

        $this->load->module('header')->index($page_details);
        $this->load->view('dashboard',$data);
    }

    public function login() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        if($this->session->userdata('sess_logged_in')==true){
            redirect('customer/index');
        }
        $data['page_title']=$main_title->cherity_name.' | Login';
        //$data['facebook_login_url']=$this->facebook->get_login_url();
        $this->load->view('login_header',$data);
        $this->load->view('login',$data);
        $this->load->view('login_footer');
    }

    public function userInfo() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | User Information';

        $data['customer_info']=$this->mdl_general->GetInfoByRow('ims_customer_info','customer_id',array('customer_id'=>$this->session->userdata('sess_customer_id')));

        $this->load->module('header')->index($page_details);
        $this->load->view('userinfo',$data);
    }

    public function editUserDetails() {

    }

    public function orderDetails() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Order Details';

        $orderId = $this->input->get('order-id');
        $this->load->model('mdl_extra');
        $data['order_info']=$this->mdl_extra->getCustomerOrder('WHERE om.orderid = "'.$orderId.'"','group by od.album_id');

        $this->load->module('header')->index($page_details);
        $this->load->view('orderinfo',$data);
    }

    public function editOrder() {
        $form_data = array(
            'order_date' => $this->input->post('order_date'),
            'order_status' => $this->input->post('order_status'),
            'customer_id' => $this->input->post('hddCustomerid'),
            'remarks' => $this->input->post('remarks'),
            'total_order' => $this->input->post('sub_total'),
            'discount' => $this->input->post('discount'),
            'camera_required' => $this->input->post('camera_required'),
            'mixer' => $this->input->post('mixer'),
            'studio' => $this->input->post('studio'),
            'album_type' => $this->input->post('album_type'),
            'no_of_album' => $this->input->post('no_of_album')
        );
        $hddOrderID = $this->input->post('hddOrderID');
        $this->mdl_general->Manage('ims_ordermaster', $form_data, array('orderid'=>$hddOrderID),'Update');
        $this->mdl_general->Delete('ims_order_services',array('order_id'=>$hddOrderID));
        $this->mdl_general->Delete('ims_orderdetails',array('order_id'=>$hddOrderID));
        $this->mdl_general->Delete('ims_event_order_select',array('order_id'=>$hddOrderID));
        $event_type = $this->input->post('event_type');
        $event_type_date = $this->input->post('event_type_date');
        foreach ($event_type as $ev => $ev_val) {
            if(empty($ev_val)) continue;
            $form_event = array(
                'order_id' => $hddOrderID,
                'event_id' => $event_type[$ev],
                'event_date' => $event_type_date[$ev]
            );
            $this->mdl_general->SaveForm('ims_event_order_select',$form_event);
        }
        $service_id = $this->input->post('services_item');
        $service_description = $this->input->post('service_description');
        foreach ($service_id as $serviceid => $value) {
            if(empty($value)) continue;
            $form_datas = array(
                'order_id' => $hddOrderID,
                'service_id' => $value,
                'service_description' => $service_description[$serviceid]
            );

            $this->mdl_general->SaveForm('ims_order_services', $form_datas);

            $album_id = $this->input->post('services_item');
            $amount = $this->input->post('service_amount');
            $service_qty = $this->input->post('service_qty');
            $form_datad = array(
                'order_id' => $hddOrderID,
                'album_id' => $album_id[$serviceid],
                'amount' => $amount[$serviceid],
                'quantity' => $service_qty[$serviceid]
            );

            $this->mdl_general->SaveForm('ims_orderdetails',$form_datad);
        }
        $response=array(
            'status'=>'success',
            'message'=>'Customer Order Edit successfully'
        );
        $this->session->set_flashdata($response);
        redirect('customer');
    }

    public function invoiceDetails() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Invoice Details';

        $invoiceId = $this->input->get('invoice-id');
        $this->load->model('mdl_extra');
        $data['invoice_info']=$this->mdl_extra->getInvoiceDetails('WHERE im.id = "'.$invoiceId.'"','');

        $this->load->module('header')->index($page_details);
        $this->load->view('invoice-details',$data);
    }

    public function editInvoice() {
        $form_data = array(
            'invoice_date' => $this->input->post('invoice_date'),
            'invoice_no' => $this->input->post('invoice_no'),
            'invoice_status' => $this->input->post('invoice_status'),
            'order_no' => $this->input->post('order_no'),
            'receive_amount' => $this->input->post('paid_amount'),
            'balance' => $this->input->post('balance'),
            'paymentmode_id' => $this->input->post('payment_mode'),
            'remarks' => $this->input->post('remarks')
        );
        $hddId = $this->input->post('hddId');
        $this->mdl_general->Manage('ims_invoicemaster', $form_data, array('id'=>$hddId),'Update');
        $remaining_bal = $this->input->post('balance');
        if($remaining_bal < 1){
            $hddorderId = $this->input->post('hddorderId');
            $form_sta = array('balance_status' => 0);
            $this->mdl_general->Manage('ims_invoicemaster', $form_sta, array('order_no'=>$hddorderId),'Update');
        }

        $response=array(
            'status'=>'success',
            'message'=>'Invoice Updated successfully'
        );
        $this->session->set_flashdata($response);
        redirect('customer/');
    }

    public function deliveryNote() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Delivery Note';

        $deliveryId = $this->input->get('note-id');
        $data['delivery_note']=$this->mdl_extra->getDeliveryNoteDetails('WHERE dn.id = "'.$deliveryId.'"','');
        $this->load->module('header')->index($page_details);
        $this->load->view('delivery-note',$data);
    }

    public function editDeliveryNote() {
        $note_id = $this->input->post('note_id');
        $form_data = array(
            'delivery_note_no' => $this->input->post('delivery_note_no'),
            'delivery_date' => $this->input->post('delivery_date'),
            'delivery_status' => $this->input->post('delivery_status'),
            'order_no' => intval( $this->input->post('order_no') ),
            'delivery_details' => $this->input->post('delivery_details')
        );

        if (isset($_FILES['images']) && !is_null($_FILES['images'])) {
            $config['upload_path']          = './uploads/delivery_note/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;

            $this->load->library('upload');

            $name_array = array();
            $count = count($_FILES['images']['tmp_name']);

            $files = null;
            $note = $this->mdl_extra->getDeliveryNoteDetails('WHERE dn.id = "'.$note_id.'"','');

            if ( count($_FILES['images']['tmp_name']) > 0 ) {
                for($s=0; $s<=$count-1; $s++) {
                    $_FILES['image']['name'] = $_FILES['images']['name'][$s];
                    $_FILES['image']['type'] = $_FILES['images']['type'][$s];
                    $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$s];
                    $_FILES['image']['error'] = $_FILES['images']['error'][$s];
                    $_FILES['image']['size'] = $_FILES['images']['size'][$s];

                    if ($_FILES['image']['tmp_name']) {
                        $this->upload->initialize($config);

                        if ( ! $this->upload->do_upload('image'))
                        {
                            $error = array('error' => $this->upload->display_errors());

                            $response=array(
                                'status'=>'failed',
                                'message'=>'Image files was not uploaded.'
                            );
                            $this->session->set_flashdata($response);
                            redirect("transaction/delivery_note/edit/$note_id");
                        }
                        else
                        {
                            $data = array('upload_data' => $this->upload->data());

                            $files[] = "uploads/delivery_note/" . $data['upload_data']['file_name'];
                        }
                    }
                }

                if (!is_null($files)) {
                    $files = implode(';', $files);
                }

            } else {
                if ( ! $this->upload->do_upload('images'))
                {
                    $error = array('error' => $this->upload->display_errors());

                    $response=array(
                        'status'=>'failed',
                        'message'=>'Image files was not uploaded.'
                    );
                    $this->session->set_flashdata($response);
                    redirect('transaction/delivery_note/add');
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());

                    $files = "uploads/delivery_note/" . $data['upload_data']['file_name'];
                }
            }

            if (!is_null($files)) {
                $form_data['delivery_images'] = $note[0]['delivery_images'] . ";" . $files;
            }
        }

        $this->mdl_general->Manage('ims_delivery_note', $form_data, array('id' => $note_id), 1);
        $response=array(
            'status'=>'success',
            'message'=>'Delivery Note Add successfully'
        );
        $this->session->set_flashdata($response);
        redirect('customer/index');
    }
}