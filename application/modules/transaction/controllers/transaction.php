<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MX_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        $this->load->library('session');
        if($this->session->userdata('sess_logged_in')!=true){
                redirect('login/index?error=4');
        }

        $this->settings = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=> 1));
    }


    function user($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
            $page_details['page_title']= $main_title->cherity_name.' | User Edit';
            $data['user']=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_id'=>$id));
            $data['user_list']=$this->mdl_general->GetAllInfo('acs_user','u_id');
            $data['permissions']=$this->mdl_general->GetAllInfo('acs_userd','u_id',array('u_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('user_edit',$data);

        }else{
            $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
            $page_details['page_title']= $main_title->cherity_name.' | Users';
            $data['user_list']=$this->mdl_general->GetAllInfo('acs_user','u_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('user',$data);
        }

    }

    function delete_user(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('acs_user',array('u_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function add_new_user(){
        $enabled=$this->input->post('enabled');
        $supervisor_id=$this->input->post('supervisor');
        $password = trim($this->input->post('password'));
        $form_data=array(
            'u_name'=>$this->input->post('name'),
            'u_email'=>$this->input->post('email'),
            'u_logname'=>$this->input->post('logName'),
            'u_password'=>sha1($password),
			'psite_id'=>$this->input->post('psite_id'),
			'country_id'=>$this->input->post('country_id'),
            'u_remarks'=>$this->input->post('remark'),
            'u_cellno'=>$this->input->post('cell'),
            'u_loginfdate'=>date('Y-m-d',strtotime($this->input->post('loginFrom'))),
            'u_logintodate'=>date('Y-m-d',strtotime($this->input->post('loginTo'))),
            'su_id'=>( $supervisor_id ? $supervisor_id :'0'),
            'u_enabled'=>( $enabled ? $enabled :'0'),
            'skin_id'=>( '0'),
            'source'=>( '0'),
            'header_bg'=>( '0'),
            'footer_bg'=>( '0'),

//            'u_fname' => $this->input->post('fname'),
//            'u_mname' => $this->input->post('fname'),
//            'u_lname' => $this->input->post('lname'),
//            'address' => $this->input->post('address'),
//            'city' => $this->input->post('city'),
//            'postcode' => $this->input->post('postcode'),
        );
        $box_id=$this->mdl_general->SaveForm('acs_user',$form_data);

        if ($this->settings->registration_email) {
//            $data = array(
//                'title_name' => "Your account was created successfully!",
//                'first_name' =>$form_data['u_fname'],
//                'middle_name' => $form_data['u_mname'],
//                'last_name' => $form_data['u_lname'],
//                'email' => $form_data['u_email'],
//                'address' => $form_data['address'],
//                'city' => $form_data['city'],
//                'postcode' => $form_data['postcode'],
//                'customer_id' => $box_id
//            );

            $data = array(
                'email' => $form_data['u_email'],
                'logname' => $form_data['u_logname'],
                'password' => $password
            );

            $this->sendMail($this->settings->emailsenderaddress, $this->settings->emailsendername, $form_data['u_email'], "User Created", "user_create", $data);
        }

        $response=array(
            'status'=>'success',
            'message'=>'User added successfully' 
        );

        $this->session->set_flashdata($response);

        redirect('transaction/user');
    }

    function user_edit(){
        $enabled=$this->input->post('enabled');
        $supervisor_id=$this->input->post('supervisor');
        $id=$this->input->post('hdnUserId');
        $form_data=array(
            'u_name'=>$this->input->post('name'),
            'u_email'=>$this->input->post('email'),
            'u_logname'=>$this->input->post('logName'),
			   'psite_id'=>$this->input->post('psite_id'),
			   'country_id'=>$this->input->post('country_id'),
            'u_password'=>$this->input->post('password'),
            'u_remarks'=>$this->input->post('remark'),
            'u_cellno'=>$this->input->post('cell'),
            'u_loginfdate'=>date('Y-m-d',strtotime($this->input->post('loginFrom'))),
            'u_logintodate'=>date('Y-m-d',strtotime($this->input->post('loginTo'))),
            'su_id'=>( $supervisor_id ? $supervisor_id :'0'),
            'u_enabled'=>( $enabled ? $enabled :'0'),
            'header_bg'=>$this->input->post('header_bg'),
            'footer_bg'=>$this->input->post('footer_bg')
        );
        $box_id=$this->mdl_general->Manage('acs_user',$form_data,array('u_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'User updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/user');
    }

    function insert_user_permission(){
        $form_data=array(
            'menu_id'=>$this->input->post('menu_id'),
            'u_add'=>$this->input->post('menu_add'),
            'u_edit'=>$this->input->post('menu_edit'),
            'u_del'=>$this->input->post('menu_del'),
            'u_view'=>$this->input->post('menu_view'),
            'u_id'=>$this->input->post('hdnUserId'),
            );
        $this->mdl_general->SaveForm('acs_userd',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'User permission added successfully'
            );
        echo json_encode($response);
    }

    function  get_user_permissions(){
        $id=$this->input->post('user_id');
        $permissions=$this->mdl_general->GetAllInfo('acs_userd','u_id',array('u_id'=>$id));
        echo json_encode($permissions);
    }

    function delete_user_permission($user_id,$menu_id){

        $this->mdl_general->Delete('acs_userd',array('u_id'=>$user_id,'menu_id'=>$menu_id));
        $response=array(
            'status'=>'success',
            'message'=>'User permission deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/user/edit/'.$user_id);
    }

    function change_user_permission(){
        $type=$this->input->post('type');
        $menu_id=$this->input->post('menu_id');
        $user_id=$this->input->post('user_id');
        $value=$this->input->post('value');
        if($type=='add'){
            $this->mdl_general->Manage('acs_userd',array('u_add'=>$value),array('menu_id'=>$menu_id,'u_id'=>$user_id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'User permission updated successfully'
            );
            echo json_encode($response);

        }elseif($type=='edit'){
            $this->mdl_general->Manage('acs_userd',array('u_edit'=>$value),array('menu_id'=>$menu_id,'u_id'=>$user_id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'User permission updated successfully'
            );
            echo json_encode($response);

        }elseif($type=='view'){
            $this->mdl_general->Manage('acs_userd',array('u_view'=>$value),array('menu_id'=>$menu_id,'u_id'=>$user_id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'User permission updated successfully'
            );
            echo json_encode($response);

        }elseif($type=='del'){
            $this->mdl_general->Manage('acs_userd',array('u_del'=>$value),array('menu_id'=>$menu_id,'u_id'=>$user_id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'User permission updated successfully'
            );
            echo json_encode($response);

        }
    }
    function customer($edit=null,$id=null){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        switch (strtoupper($edit)) {
            case 'ADD':
                
                $page_details['page_title']= $main_title->cherity_name.' | Customer Add';
                $data = array();
                $this->load->module('header')->index($page_details);
                $this->load->view('customer_add',$data);
                break;
            case 'EDIT':
                $page_details['page_title']= $main_title->cherity_name.' | Customer Edit';
                $data['customer_list']=$this->mdl_general->GetInfoByRow('ims_customer_info','customer_id', array('customer_id' => $id));
                $this->load->module('header')->index($page_details);
                $this->load->view('customer_edit',$data);
                break;
            case 'DOCS':
                $data['page_title']= $main_title->cherity_name.' | Customer Docs';
                $data['customer_list']=$this->mdl_general->GetInfoByRow('ims_customer_info','customer_id', array('customer_id' => $id));
                $data['customer_template'] = $this->mdl_general->GetInfoByRow('ims_document_template','doc_id', array('d_letter_type' => 'customer'));
                $data['configuration_details'] = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
                // $this->load->module('header')->index($page_details);
                $this->load->view('customer_docs',$data);
                break;
            default:
                $page_details['page_title']= $main_title->cherity_name.' | Customer';
                $data['customer_list']=$this->mdl_general->GetAllInfo('ims_customer_info','customer_id');
                $this->load->module('header')->index($page_details);
                $this->load->view('customer',$data);
                break;
        }
    }
    function add_customer(){
        $form_data = array(
            'fname' => $this->input->post("fname"),
            'mname' => $this->input->post("mname"),
            'lname' => $this->input->post("lname"),
            'home_address' => $this->input->post("home_address"),
            'home_postcode' => $this->input->post("home_postcode"),
            'business_name' => $this->input->post("business_name"),
            'office_address' => $this->input->post("office_address"),
            'office_postcode' => $this->input->post("office_postcode"),
            'customer_email' => $this->input->post("customer_email"),
            'home_number' => $this->input->post("home_number"),
            'mobile_no' => $this->input->post("mobile_no"),
            'website' => $this->input->post("website"),
            'facebook' => $this->input->post("facebook"),
            'twitter' => $this->input->post("twitter"),
            'password' => sha1($this->input->post("password")),
            'confirm_password' => sha1($this->input->post("confirm_password")),
            'active' => $this->input->post("active")
        );
        $box_id=$this->mdl_general->SaveForm('ims_customer_info',$form_data);

        if ($this->settings->registration_email) {
            $data = array(
                'title_name' => "Your account was created successfully!",
                'first_name' =>$form_data['fname'],
                'middle_name' => $form_data['mname'],
                'last_name' => $form_data['lname'],
                'email' => $form_data['customer_email'],
                'password' => $form_data['password'],
                'address' => $form_data['office_address'],
                'postcode' => $form_data['office_postcode'],
                'customer_id' => $form_data['customer_email']
            );

            $this->sendMail($this->settings->emailsenderaddress, $this->settings->emailsendername, $form_data['customer_email'], "Your account was Created", "customer_create", $data);
        }

        $response=array(
            'status'=>'success',
            'message'=>'Customer added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/customer');
    }
    function edit_customer(){
        $active = $this->input->post('active');
        $form_data = array(
            'fname' => $this->input->post("fname"),
            'mname' => $this->input->post("mname"),
            'lname' => $this->input->post("lname"),
            'home_address' => $this->input->post("home_address"),
            'home_postcode' => $this->input->post("home_postcode"),
            'business_name' => $this->input->post("business_name"),
            'office_address' => $this->input->post("office_address"),
            'office_postcode' => $this->input->post("office_postcode"),
            'customer_email' => $this->input->post("customer_email"),
            'home_number' => $this->input->post("home_number"),
            'mobile_no' => $this->input->post("mobile_no"),
            'website' => $this->input->post("website"),
            'facebook' => $this->input->post("facebook"),
            'twitter' => $this->input->post("twitter"),
            'password' => sha1($this->input->post("password")),
            'confirm_password' => sha1($this->input->post("confirm_password")),
            'active' => ($active == 1) ? 1 : 0
        );

        $hddcustomer_id = $this->input->post("hddcustomer_id");

        $result_update = $this->mdl_general->Manage('ims_customer_info', $form_data, array('customer_id'=>$hddcustomer_id),'Update');
        error_log($result_update, 3, 'debug.log');

        $client_name = $this->input->post("customer_email");
        $configuration_details=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        
        $subject="Inventory Management System[IMS] Client account";
        // $emailtext=$configuration_details->donationemailtext;
        $email_details = "<p>This is your temporary account.To login please click the link <a href='".base_url('customer/login')."/".$hddcustomer_id."'>Account</a><br/>";
        $email_details .="<b>Username :</b>". $this->input->post("customer_email"). "<br/>";
        $email_details .="<b>Password :</b>". $this->input->post("password"). "<br/></p>";
        $emailtext= "Dear {title}{customernamefirst} {customernamemiddle}{customernamelast} </br> {emailbody} </br> With best Regards </br> {regards} </br> Inventory Management System(IMS)";
        $emailtext = str_replace("{title}",' ',$emailtext);
        $emailtext = str_replace("{customernamefirst}",$this->input->post("fname"),$emailtext);
        $emailtext = str_replace("{customernamemiddle}",$this->input->post("mname") ,$emailtext);  
        $emailtext = str_replace("{customernamelast}",' '. $this->input->post("lname"),$emailtext);
        $emailtext = str_replace("{emailbody}",' '. $email_details,$emailtext);
        $emailtext = str_replace("{regards}",' '. $this->session->userdata('sess_user_name'),$emailtext);
        $message =$emailtext;
            
        if(!empty($client_name)){
            $config['useragent']  = "CodeIgniter";
            $config['mailpath']  = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
            $config['protocol']   = "sendmail";
            $config['mailtype'] = 'html';
            $config['charset']  = 'utf-8';
            $config['newline']  = "\r\n";
            $config['wordwrap'] = FALSE; 
            $config['validate']=TRUE;

            $this->load->library('email');

            $this->email->from("$configuration_details->email", "$configuration_details->emailsendername");
            $this->email->to("$client_name");

            $this->email->subject("$subject");
            $this->email->message($message);

            $this->email->send();
        }
        
        $response=array(
            'status'=>'success',
            'message'=>'Customer Updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/customer');
    }
    function delete_customer_info($user_id,$menu_id){
        $this->mdl_general->Delete('ims_customer_info',array('customer_id'=>$this->input->post('id')));
        $response=array(
            'status'=>'success',
            'message'=>'Customer deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/customer');
    }
    function customer_order($edit=null,$id=null){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        switch (strtoupper($edit)) {
            case 'ADD':
                
                $page_details['page_title']= $main_title->cherity_name.' | Customer Order Add';
                $data = array();
                $this->load->module('header')->index($page_details);
                $this->load->view('customer_order_add',$data);
                break;
            case 'EDIT':
                $page_details['page_title']= $main_title->cherity_name.' | Customer Order Edit';
                $data['customer_list']=$this->mdl_extra->getCustomerOrder('WHERE om.customer_id = "'.$id.'"','group by od.album_id');
                $this->load->module('header')->index($page_details);
                $this->load->view('customer_order_edit',$data);
                break;
            case 'DOCS':
                $data['page_title']= $main_title->cherity_name.' | Customer Order Docs';
                $data['customer_order_list']=$this->mdl_general->GetInfoByRow('ims_ordermaster','orderid', array('orderid' => $id));
                $data['customer_template'] = $this->mdl_general->GetInfoByRow('ims_document_template','doc_id', array('d_letter_type' => 'customer_order'));
                $data['configuration_details'] = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
                // $this->load->module('header')->index($page_details);
                $this->load->view('customer_order_docs',$data);
                break;
            case 'REPORTS':
                $data['page_title']= $main_title->cherity_name.' | Customer Order Docs';
                // $data['customer_order_list']=$this->mdl_general->GetInfoByRow('ims_ordermaster','orderid', array('orderid' => $id));
                // $data['customer_template'] = $this->mdl_general->GetInfoByRow('ims_document_template','doc_id', array('d_letter_type' => 'customer_order'));
                // $data['configuration_details'] = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
                // $this->load->module('header')->index($page_details);
                $this->load->view('customer_order_reports_pdf',$data);
                break;
            default:
                // $this->mdl_extra->truncate_table('ims_order_services');
                $page_details['page_title']= $main_title->cherity_name.' | Customer Order';
                $data['customer_order_list']=$this->mdl_extra->getCustomerOrder('','group by om.customer_id');
                $this->load->module('header')->index($page_details);
                $this->load->view('customer_order',$data);
                break;
        }
    }
    function get_customer_detail(){
        $this->load->model('mdl_extra');
        $data=$this->mdl_extra->get_customer_detail($this->input->post('name'));        
        echo json_encode($data);
    }
    function get_services_detail(){
        $service_id = $this->input->post('service_id');
        $services_details=$this->mdl_general->GetInfoByRow('ims_required_services','service_id', array('service_id' => $service_id));
        echo json_encode($services_details);
    }
    function add_customer_order(){
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
        $order_id=$this->mdl_general->SaveForm('ims_ordermaster',$form_data);
        $event_type = $this->input->post('event_type');
        $event_type_date = $this->input->post('event_type_date');
        foreach ($event_type as $ev => $ev_val) {
            if(empty($ev_val)) continue;
            $form_event = array(
                'order_id' => $order_id,
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
                'order_id' => $order_id,
                'service_id' => $value,
                'service_description' => $service_description[$serviceid]
            );
            $this->mdl_general->SaveForm('ims_order_services', $form_datas);
            
            $album_id = $this->input->post('services_item');
            $amount = $this->input->post('service_amount');
            $service_qty = $this->input->post('service_qty');
            $form_datad = array(
                'order_id' => $order_id,
                'album_id' => $album_id[$serviceid],
                'amount' => $amount[$serviceid],
                'quantity' => $service_qty[$serviceid]
            );

            $this->mdl_general->SaveForm('ims_orderdetails',$form_datad); 
        }
        $response=array(
            'status'=>'success',
            'message'=>'Customer Order Add successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/customer_order');
    }
    
    public function edit_customer_order(){
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
        redirect('transaction/customer_order');
    }
    function delete_customer_order_info($user_id,$menu_id){
        
        $this->mdl_general->Delete('ims_ordermaster',array('customer_id'=>$this->input->post('id')));
        $this->mdl_general->Delete('ims_order_services',array('order_id'=>$this->input->post('oid')));
        $this->mdl_general->Delete('ims_orderdetails',array('order_id'=>$this->input->post('oid')));
        $response=array(
            'status'=>'success',
            'message'=>'Customer deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/customer_order');
    }
    function invoice($edit=null,$id=null){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        switch (strtoupper($edit)) {
            case 'ADD':
                
                $page_details['page_title']= $main_title->cherity_name.' | Invoice Add';
                $data['getMaxInvoice'] = $this->AutoInvoice();
                $data['getOrderNoforInvoice'] = $this->mdl_extra->getOrderNoforInvoice();
                $this->load->module('header')->index($page_details);
                $this->load->view('invoice_add',$data);
                break;
            case 'EDIT':
                $page_details['page_title']= $main_title->cherity_name.' | Invoice Edit';
                $data['invoice_edit']=$this->mdl_extra->getInvoiceDetails('WHERE im.id = "'.$id.'"','');
                $this->load->module('header')->index($page_details);
                $this->load->view('invoice_edit',$data);
                break;
            case 'DOCS':
                $data['page_title']= $main_title->cherity_name.' | Invoice';
                $data['invoice_list']=$this->mdl_general->GetInfoByRow('ims_invoicemaster','id', array('id' => $id));
                $data['customer_template'] = $this->mdl_general->GetInfoByRow('ims_document_template','doc_id', array('d_letter_type' => 'invoice'));
                $data['configuration_details'] = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
                // $this->load->module('header')->index($page_details);
                $this->load->view('invoice_docs',$data);
                break;
            default:
                $page_details['page_title']= $main_title->cherity_name.' | Invoice Order';
                $data['invoice_list']= $this->mdl_extra->getInvoiceDetails('', '');
                $this->load->module('header')->index($page_details);
                $this->load->view('invoice',$data);
                break;
        }
    }
    function AutoInvoice(){
        $invoiceNo = date('y-m').'-';
        $data = $this->mdl_extra->getMaxDetails('ims_invoicemaster', 'id');
        $lastExt= $data['id'];
        $invoiceNo .= str_pad($lastExt+1,5,"0",STR_PAD_LEFT);
      return $invoiceNo;
    }
    function add_invoice(){
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

        $order_id=$this->mdl_general->SaveForm('ims_invoicemaster',$form_data);
        
        $response=array(
            'status'=>'success',
            'message'=>'Invoice Add successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/invoice');
    }
    function edit_invoice(){
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
        redirect('transaction/invoice');
    }
    function getOrderDetails(){
        $this->load->model('mdl_extra');
        $id = $this->input->post('id');
        $data=$this->mdl_extra->getCustomerOrder('WHERE om.orderid = "'.$id.'"','group by od.album_id');
        echo json_encode($data);
    }
    function delivery_note($edit=null,$id=null){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        switch (strtoupper($edit)) {
            case 'ADD':
                
                $page_details['page_title']= $main_title->cherity_name.' | Delivery Note Add';
                $data = array();
                $this->load->module('header')->index($page_details);
                $this->load->view('delivery_note_add',$data);
                break;
            case 'EDIT':
                $page_details['page_title']= $main_title->cherity_name.' | Delivery Note Edit';
                $data['delivery_note_edit']=$this->mdl_extra->getDeliveryNoteDetails('WHERE dn.id = "'.$id.'"','');
                $this->load->module('header')->index($page_details);
                $this->load->view('delivery_note_edit',$data);
                break;
            case 'DOCS':
                $data['page_title']= $main_title->cherity_name.' | Invoice';
                $data['delivery_note_list']=$this->mdl_general->GetInfoByRow('ims_delivery_note','id', array('id' => $id));
                $data['customer_template'] = $this->mdl_general->GetInfoByRow('ims_document_template','doc_id', array('d_letter_type' => 'delivery_note'));
                $data['configuration_details'] = $this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
                // $this->load->module('header')->index($page_details);
                $this->load->view('delivery_note_docs',$data);
                break;
            default:
                $page_details['page_title']= $main_title->cherity_name.' | Delivery Note';
                $data['delivery_note_list']= $this->mdl_extra->getDeliveryNoteDetails('', '');
                $this->load->module('header')->index($page_details);
                $this->load->view('delivery_note',$data);
                break;
        }
    }
    public function add_delivery_note(){
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

            if ( count($_FILES['images']['tmp_name']) > 0 ) {
                for($s=0; $s<=$count-1; $s++) {
                    $_FILES['image']['name'] = $_FILES['images']['name'][$s];
                    $_FILES['image']['type'] = $_FILES['images']['type'][$s];
                    $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$s];
                    $_FILES['image']['error'] = $_FILES['images']['error'][$s];
                    $_FILES['image']['size'] = $_FILES['images']['size'][$s];

                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('image'))
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

                        $files[] = "uploads/delivery_note/" . $data['upload_data']['file_name'];
                    }
                }

                $files = implode(';', $files);
            } else {
                $this->upload->initialize($config);
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
                $form_data['delivery_images'] = $files;
            }
        }

        $this->mdl_general->SaveForm('ims_delivery_note',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Delivery Note Add successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/delivery_note');
        
    }
    public function edit_delivery_note(){
        $this->load->model('mdl_extra');

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
        redirect('transaction/delivery_note');
    }
    function document_template($edit=null,$id=null){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        switch (strtoupper($edit)) {
            case 'ADD':
                
                $page_details['page_title']= $main_title->cherity_name.' | Document Template Add';
                // $data['doc_type'] =$this->mdl_general->GetAllInfoSorting('acs_menu','menu_id', 'ASC',array('mt_id'=>2));
                $data['data'] = array();
                $this->load->module('header')->index($page_details);
                $this->load->view('document_template_add',$data);
                break;
            case 'EDIT':
                $page_details['page_title']= $main_title->cherity_name.' | Document Template Edit';
                $data['document_template_list']= $this->mdl_general->GetInfoByRow('ims_document_template','doc_id',array('doc_id'=>$id));
                $data['doc_type'] =$this->mdl_general->GetAllInfoSorting('acs_menu','menu_id', 'ASC',array('mt_id'=>2));
                $this->load->module('header')->index($page_details);
                $this->load->view('document_template_edit',$data);
                break;
            default:
                $page_details['page_title']= $main_title->cherity_name.' | Document Template';
                $data['document_template_list']= $this->mdl_general->GetAllInfo('ims_document_template', 'doc_id', array());
                $this->load->module('header')->index($page_details);
                $this->load->view('document_template',$data);
                break;
        }
    }
    public function add_document_template(){
         $form_data = array(
            'd_letter_type' => $this->input->post('doc_type'),
            'd_table_name' => $this->input->post('doc_table_name'),
            'd_letter_template_name' => $this->input->post('doc_letter_template'),
            'd_subject' => $this->input->post('doc_subject'),
            'd_header' => $this->input->post('doc_header'),
            'd_body' => $this->input->post('doc_body'),
            'd_footer' => $this->input->post('doc_footer')
        );
        $this->mdl_general->SaveForm('ims_document_template',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Document Template Add successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/document_template');
    }
    public function edit_document_template(){
        $form_data = array(
            'd_letter_type' => $this->input->post('doc_type'),
            'd_table_name' => $this->input->post('doc_table_name'),
            'd_letter_template_name' => $this->input->post('doc_letter_template'),
            'd_subject' => $this->input->post('doc_subject'),
            'd_header' => $this->input->post('doc_header'),
            'd_body' => $this->input->post('doc_body'),
            'd_footer' => $this->input->post('doc_footer')
        );
        $hddDocId = $this->input->post("hddDocId");
        $this->mdl_general->Manage('ims_document_template', $form_data, array('doc_id'=>$hddDocId),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Document Template Edit successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('transaction/document_template');
    }
    public function getFieldsPerTable(){
        $this->load->model('mdl_extra');
        $table_name = $this->input->post('table_name');
        $array_tbl = array($table_name, 'acs_configration');
        foreach ($array_tbl as $tableN) {
            $data[$tableN] = $this->mdl_extra->get_field($tableN);
        }
        echo json_encode($data);
    }
    private function debug($msg="", $exit = false)
    {
        $today = date("Y-m-d H:i:s");

        if (is_array($msg) || is_object($msg))
        {
            echo "<hr>DEBUG ::[".$today."]<pre>\n";
            print_r($msg);
            echo "\n</pre><hr>";
        }
        else
        {
            echo "<hr>DEBUG ::[".$today."] $msg <hr>\n";
        }

        if ($exit) {
            $this->load->library('profiler');
            echo $this->profiler->run();
            exit;
        }
    }

    public function messages() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Messages';
        $data = array();
        $this->load->module('header')->index($page_details);
        $this->load->view('messages');
    }

    private function sendMail($from, $fromName, $to, $subject, $type, $data) {
        $config['useragent']  = "CodeIgniter";
        $config['mailpath']  = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']   = "sendmail";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = FALSE;
        $config['validate']=TRUE;

        $this->load->library('email');
        $this->email->set_newline("\r\n");

        switch ($type) {
            case 'customer_create':
                $emailtext = $this->settings->dnregistrationemailtext;
                $emailtext = str_replace("{title}", $data['title_name'], $emailtext);
                $emailtext = str_replace("{customernamefirst}", $data['first_name'], $emailtext);
                $emailtext = str_replace("{fname}",$data['middle_name'], $emailtext);
                $emailtext = str_replace("{customernamelast}", $data['last_name'], $emailtext);
                $emailtext = str_replace("{customeraddress}",$data['address'],$emailtext);
                $emailtext = str_replace("{postcode}",$data['postcode'],$emailtext);
                $emailtext = str_replace("{customer_id}",$data['customer_id'],$emailtext);
                $emailtext = str_replace("{password}",$data['password'],$emailtext);
                $message = $emailtext;
                break;
            case 'user_create':
                $emailAddrr = $data['email'];
                $emailtext = 'Your account was created. ' . "\r\n";
                $emailtext .= "Login User is " . $data['logname'] . "\r\n";
                $emailtext .= "Password is " . $data['password'] . "\r\n";
                $emailtext .= "Please update your password Clicking Here : " . base_url("user/changepassword?email=$emailAddrr");

                $message = $emailtext;
                break;
            default:
                $message = '';
                break;
        }

        $this->email->from($from, $fromName);
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($message);

        $result = $this->email->send();

        return $result;
    }
}