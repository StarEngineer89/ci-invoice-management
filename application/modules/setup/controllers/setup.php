<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends MX_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        if($this->session->userdata('sess_logged_in')!=true){
                redirect('login/index?error=4');
        }
        
    }

    //for configuration
    //default=1
    function configuration($id='1'){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Configuration Edit";
        $data['configuration']=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>$id));
        $this->load->module('header')->index($page_details);
        $this->load->view('configuration_edit',$data);
    }

    function configuration_edit(){
            $registration_email=$this->input->post('dnRegistrationEmail');
            $registration_sms=$this->input->post('dnRegistrationSMS');
            $donation_email=$this->input->post('donationEmail');
            $donation_sms=$this->input->post('donationSMS');
            $event_email=$this->input->post('eventEmail');
            $event_sms=$this->input->post('eventSMS');
            $pledges_email=$this->input->post('pledgeEmail');
            $pledges_sms=$this->input->post('pledgeSMS');
            $approval_disabled=$this->input->post('charityApprovalDisabled');
            $id=$this->input->post('hdnConfigurationId');
            
            if(@$_FILES['charitySignatureImage']['name'] != ""){
                $config['upload_path'] = FCPATH . 'assets/image/setUpwindow/';
                    $config['allowed_types'] = 'jpeg|png|jpg|PNG|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    
                    $this->upload_file($config,'charitySignatureImage');
                    $this->mdl_general->Manage('acs_configration',array('signatureimage' => $_FILES['charitySignatureImage']['name']), array('config_id' => $id), 'update');


            }
            if(@$_FILES['charityLogo']['name'] != ""){
                    $config['upload_path'] = FCPATH . 'assets/image/setUpwindow/';
                    $config['allowed_types'] = 'jpeg|png|PNG|jpg|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    $this->upload_file($config,'charityLogo');
                    $this->mdl_general->Manage('acs_configration',array('logo' => $_FILES['charityLogo']['name']), array('config_id' => $id), 'update');

            }

        
        $form_data=array(
            'cherity_name'=>$this->input->post('charityName'),
            'address'=>$this->input->post('charityAddress'),
            'phone'=>$this->input->post('charityPhone'),
            'fax'=>$this->input->post('charityFax'),
            'email'=>$this->input->post('charityEmail'),
            'website'=>$this->input->post('charityWebsite'),
            'smsuser'=>$this->input->post('charitySMSUser'),
            'smspass'=>$this->input->post('charitySMSPassword'),
            'emailsendername'=>$this->input->post('charityEmailSenderName'),
            'emailsenderaddress'=>$this->input->post('charityEmailSenderID'),
            'opcashbalance'=>$this->input->post('charityOpeningBalanceCash'),
            'opbankbalance'=>$this->input->post('charityOpeningBalanceBank'),
            'signaturetext'=>$this->input->post('charitySignatureText'),
            'dnregistrationemailtext'=>$this->input->post('dnRegistrationEmailText'),
            'dnregistrationsmstext'=>$this->input->post('dnRegistrationSMSText'),
            'eventemailtext'=>$this->input->post('eventEmailText'),
            'eventsmstext'=>$this->input->post('eventSMSText'),
            'donationemailtext'=>$this->input->post('donationEmailText'),
            'donationsmstext'=>$this->input->post('donationSMSText'),
            'pledgeemailtext'=>$this->input->post('pledgeEmailText'),
            'pledgesmstext'=>$this->input->post('pledgeSMSText'),
            'receipttext'=>$this->input->post('receiptText'),
            'registration_email'=>($registration_email ? $registration_email :'0'),
            'registration_sms'=>($registration_sms ? $registration_sms :'0'),
            'donation_email'=>($donation_email ? $donation_email :'0'),
            'donation_sms'=>($donation_sms ? $donation_sms :'0'),
            'event_email'=>($event_email ? $event_email :'0'),
            'event_sms'=>($event_sms ? $event_sms :'0'),
            'pledges_email'=>($pledges_email ? $pledges_email :'0'),
            'pledges_sms'=>($pledges_sms ? $pledges_sms :'0'),
            'approval_disabled'=>($approval_disabled ? $approval_disabled :'0'),
            'vat_percent' => $this->input->post('vat_percent'),
            'vat_no' => $this->input->post('vat_no')
        );
        $this->mdl_general->Manage('acs_configration',$form_data,array('config_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Configuration updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/configuration');
        
    }

    function upload_file($config, $fieldname) {
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($fieldname);
    }

    function event_type(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Event Type";
        $data['event_type_list']=$this->mdl_general->GetAllInfo('ims_event_type','event_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('event_type',$data);
    }

    function add_event_type(){
        // btn_event_submit
        $btn_event_submit = $this->input->post('btn_event_submit');
        $active=$this->input->post('inpt_active');
        $default = $this->input->post('inpt_default');
        if($btn_event_submit == 'Add Event Type'){
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->SaveForm('ims_event_type',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Event Type added successfully' 
            );
        }else{
            $id = $this->input->post('hddevent_type_id');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->Manage('ims_event_type',$form_data,array('event_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Eventy Type updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/event_type');

    }
    function  get_event_type_edit(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_event_type','event_id',array('event_id'=>$id));
        echo json_encode($data);
    }
    function delete_event_type(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_event_type',array('event_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'Event Type deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/event_type');
    }
    function required_services(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Required Services";
        $data['event_type_list']=$this->mdl_general->GetAllInfo('ims_required_services','service_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('required_services',$data);
    }
    function add_required_services(){
        $btn_required_services = $this->input->post('btn_required_services');
        if($btn_required_services == 'Add Required Services'){
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'price'=> $this->input->post('inpt_price'),
            'vat'=> $this->input->post('inpt_vat'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->SaveForm('ims_required_services',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Required Services added successfully' 
            );
        }else{
            $id = $this->input->post('hddservice_id');
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'price'=> $this->input->post('inpt_price'),
            'vat'=> $this->input->post('inpt_vat'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->Manage('ims_required_services',$form_data,array('service_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Required Services updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/required_services');

    }
    function  get_required_services(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_required_services','service_id',array('service_id'=>$id));
        echo json_encode($data);
    }
    function delete_required_services(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_required_services',array('service_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'Required Services deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/required_services');
    }
    function photographic_package(){
           $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Photographic Package";
        $data['photographic_package_list']=$this->mdl_general->GetAllInfo('ims_photographic_package','package_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('photographic_package',$data);
    }
    function add_photographic_package(){
        $btn_photographic_package = $this->input->post('btn_photographic_package');
        if($btn_photographic_package == 'Add Photographic Package'){
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'no_of_picture'=> $this->input->post('inpt_no_of_pic'),
            'price'=> $this->input->post('inpt_price'),
            'vat'=> $this->input->post('inpt_vat'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->SaveForm('ims_photographic_package',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Photographic Package added successfully' 
            );
        }else{
            $id = $this->input->post('hddpackage_id');
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'no_of_picture'=> $this->input->post('inpt_no_of_pic'),
            'price'=> $this->input->post('inpt_price'),
            'vat'=> $this->input->post('inpt_vat'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->Manage('ims_photographic_package',$form_data,array('package_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Photographic Package updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/photographic_package');
    }
     function  get_photographic_package(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_photographic_package','package_id',array('package_id'=>$id));
        echo json_encode($data);
    }
    function delete_photographic_package(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_photographic_package',array('package_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'Photographic Package deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/required_services');
    }
    function album_type(){
           $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Album Type";
        $data['album_type_list']=$this->mdl_general->GetAllInfo('ims_album_type','album_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('album_type',$data);
    }
    function add_album_type(){
        $btn_album_type = $this->input->post('btn_album_type');
        if($btn_album_type == 'Add Album Type'){
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'price'=> $this->input->post('inpt_price'),
            'no_of_picture'=> $this->input->post('inpt_no_of_pic'),
            'album_design'=> $this->input->post('inpt_album_design')
            // 'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->SaveForm('ims_album_type',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Album Type added successfully' 
            );
        }else{
            $id = $this->input->post('hddalbum_id');
            $active=$this->input->post('inpt_active');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'price'=> $this->input->post('inpt_price'),
            'no_of_picture'=> $this->input->post('inpt_no_of_pic'),
            'album_design'=> $this->input->post('inpt_album_design')
            // 'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->Manage('ims_album_type',$form_data,array('album_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Album Type updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/album_type');
    }
    function  get_album_type(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_album_type','album_id',array('album_id'=>$id));
        echo json_encode($data);
    }
    function delete_album_type(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_album_type',array('album_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'Album Type deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/required_services');
    }
    function country(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Country";
        $data['country_list']=$this->mdl_general->GetAllInfo('ims_country','country_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('country',$data);
    }
    function add_country(){
        $btn_add = $this->input->post('btn_add');
        $active=$this->input->post('inpt_active');
        if($btn_add == 'Add Country'){
            $form_data=array(
            'country_name'=>$this->input->post('inpt_country_name'),
            'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->SaveForm('ims_country',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Country added successfully' 
            );
        }else{
            $id = $this->input->post('hddcountry_id');
             $form_data=array(
            'country_name'=>$this->input->post('inpt_country_name'),
            'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->Manage('ims_country',$form_data,array('country_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Country updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/country');
    }
    function  get_country_list(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_country','country_id',array('country_id'=>$id));
        echo json_encode($data);
    }
    function delete_country_list(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_country',array('country_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'Country deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/country');
    }
    function city(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | City";
        $data['city_list']=$this->mdl_extra->getCityList('');
        $data['country_list']=$this->mdl_general->GetAllInfo('ims_country','country_id', array('active' => 1));
        $this->load->module('header')->index($page_details);
        $this->load->view('city',$data);
    }
    function add_city(){
        $btn_add = $this->input->post('btn_add');
        $active=$this->input->post('inpt_active');
        if($btn_add == 'Add City'){
            $form_data=array(
            'city_name'=>$this->input->post('inpt_city_name'),
            'country_id'=>$this->input->post('inpt_country_name'),
            'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->SaveForm('ims_city',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'City added successfully' 
            );
        }else{
            $id = $this->input->post('hddcity_id');
             $form_data=array(
            'city_name'=>$this->input->post('inpt_city_name'),
            'country_id'=>$this->input->post('inpt_country_name'),
            'active'=>( $active ? $active :'0')
            );
            $this->mdl_general->Manage('ims_city',$form_data,array('city_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'City updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/city');
    }
    function  get_city_list(){
        $this->load->model('mdl_extra');
        $id=$this->input->post('id');
        $where = " WHERE ct.city_id=".$id;
        $data=$this->mdl_extra->getCityList($where);
        echo json_encode($data);
    }
    function delete_city_list(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_city',array('city_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'City deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/country');
    }
    function status(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Status";
        $data['status_list']=$this->mdl_general->GetAllInfo('ims_status','status_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('status',$data);
    }

    function add_status(){
        // btn_event_submit
        $btn_event_submit = $this->input->post('btn_event_submit');
        $active=$this->input->post('inpt_active');
        $default = $this->input->post('inpt_default');
        if($btn_event_submit == 'Add Status'){
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'color'=>$this->input->post('color'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->SaveForm('ims_status',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Event Type added successfully' 
            );
        }else{
            $id = $this->input->post('hddstatus_id');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'color'=>$this->input->post('color'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->Manage('ims_status',$form_data,array('status_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Status updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/status');
    }
    function  get_status_edit(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_status','status_id',array('status_id'=>$id));
        echo json_encode($data);
    }
    function delete_status(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_status',array('status_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'City deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/status');
    }
    function payment_mode(){
        $this->load->model('mdl_extra');
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']=$main_title->cherity_name." | Status";
        $data['paymentmode_list']=$this->mdl_general->GetAllInfo('ims_paymentmode','paymentmode_id', array());
        $this->load->module('header')->index($page_details);
        $this->load->view('payment_mode',$data);
    }

    function add_payment_mode(){
        // btn_event_submit
        $btn_event_submit = $this->input->post('btn_event_submit');
        $active=$this->input->post('inpt_active');
        $default = $this->input->post('inpt_default');
        if($btn_event_submit == 'Add Payment Mode'){
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->SaveForm('ims_paymentmode',$form_data);
            $response=array(
            'status'=>'success',
            'message'=>'Payment Mode added successfully' 
            );
        }else{
            $id = $this->input->post('hddstatus_id');
            $form_data=array(
            'description'=>$this->input->post('inpt_description'),
            'default'=> ( $default ? $default :'0'),
            'active'=>( $active ? $active :'0'));
            $this->mdl_general->Manage('ims_paymentmode',$form_data,array('paymentmode_id'=>$id),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Payment Mode updated successfully' 
                );
        }
        
        $this->session->set_flashdata($response);
        redirect('setup/payment_mode');
    }
    function  get_payment_mode_edit(){
        $id=$this->input->post('id');
        $data=$this->mdl_general->GetAllInfo('ims_paymentmode','paymentmode_id',array('paymentmode_id'=>$id));
        echo json_encode($data);
    }
    function delete_payment_mode(){
        $id = $this->input->post('id');
        $this->mdl_general->Delete('ims_paymentmode',array('paymentmode_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'City deleted successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/status');
    }
    function letter_template($edit=null,$id=null){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']= $main_title->cherity_name." | Letter template edit";
            $data['template']=$this->mdl_general->GetInfoByRow('ims_lettertemplate','lt_id',array('lt_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('lettertemplate_edit',$data);

        }else{
            $page_details['page_title']=$main_title->cherity_name." | Letter template";
            $data['template_list']=$this->mdl_general->GetAllInfo('ims_lettertemplate','lt_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('lettertemplate',$data);
        }
    }

    function add_new_template(){
        $lt_footer1active=$this->input->post('ltFooter1Active');
        $lt_footer2active=$this->input->post('ltFooter2Active');
        $lt_active=$this->input->post('ltActive');

        $form_data=array(
            'lt_name'=>$this->input->post('ltHeader'),
            'lt_sub'=>$this->input->post('ltSubject'),
            'lt_body'=>$this->input->post('ltBody'),
            'lt_footer1'=>$this->input->post('ltFooter1'),
            'lt_footer2'=>$this->input->post('ltFooter2'),
            'lt_footer1active'=>($lt_footer1active ? $lt_footer1active :'0'),
            'lt_footer2active'=>($lt_footer2active ? $lt_footer2active :'0'),
            'lt_active'=>($lt_active ? $lt_active :'0'),
            'desig_id'=>$this->input->post('ltDesignation')           
        );
        $template_id=$this->mdl_general->SaveForm('ims_lettertemplate',$form_data);

        if(@$_FILES['ltSignatureImage']['name'] != ""){
                    $config['upload_path'] = FCPATH . 'assets/image/letterTemplate';
                    $config['allowed_types'] = 'jpeg|png|PNG|jpg|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    $this->upload_file($config,'ltSignatureImage');
                    $this->mdl_general->Manage('ims_lettertemplate',array('signatureimage' => $_FILES['ltSignatureImage']['name']), array('lt_id' => $template_id), 'Update');

        }

        $response=array(
            'status'=>'success',
            'message'=>'Letter template added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/letter_template');


    }

    function template_edit(){
        $lt_footer1active=$this->input->post('ltFooter1Active');
        $lt_footer2active=$this->input->post('ltFooter2Active');
        $lt_active=$this->input->post('ltActive');
        $id=$this->input->post('hdnLetterTemplateId');

        $form_data=array(
            'lt_name'=>$this->input->post('ltHeader'),
            'lt_sub'=>$this->input->post('ltSubject'),
            'lt_body'=>$this->input->post('ltBody'),
            'lt_footer1'=>$this->input->post('ltFooter1'),
            'lt_footer2'=>$this->input->post('ltFooter2'),
            'lt_footer1active'=>($lt_footer1active ? $lt_footer1active :'0'),
            'lt_footer2active'=>($lt_footer2active ? $lt_footer2active :'0'),
            'lt_active'=>($lt_active ? $lt_active :'0'),
            'desig_id'=>$this->input->post('ltDesignation')           
        );
        $this->mdl_general->Manage('ims_lettertemplate',$form_data,array('lt_id'=>$id),'Update');

        if(@$_FILES['ltSignatureImage']['name'] != ""){
                    $config['upload_path'] = FCPATH . 'assets/image/letterTemplate';
                    $config['allowed_types'] = 'jpeg|png|PNG|jpg|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    $this->upload_file($config,'ltSignatureImage');
                    $this->mdl_general->Manage('ims_lettertemplate',array('signatureimage' => $_FILES['ltSignatureImage']['name']), array('lt_id' => $id), 'Update');
                    
        }

        $response=array(
            'status'=>'success',
            'message'=>'Letter template updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/letter_template');


    }

    

    function delete_template(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('ims_lettertemplate',array('lt_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }
}