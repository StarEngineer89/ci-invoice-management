<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends MX_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        if($this->session->userdata('sess_logged_in')!=true){
                redirect('login/index?error=4');
        }
        
    }

    /*function index(){
        $data['page_title']='Ucare Foundation | Setup';
    }*/

    //for zone setup

    function zone($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Zone edit";
            $data['zone_details']=$this->mdl_general->GetInfoByRow('dn_zone','zone_id',array('zone_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('zone_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Zone";
            $data['zone_list']=$this->mdl_general->GetAllInfo('dn_zone','zone_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('zone',$data);
        }
        
    }

    function add_new_zone(){
        $zone=$this->input->post('zoneName');
        $active=$this->input->post('zoneActive');
        $form_data=array(
            'zone_name'=>$zone,
            'zone_active'=>( $active ? $active :'0')
            );
        $this->mdl_general->SaveForm('dn_zone',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Zone added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/zone');
    }

    function zone_edit(){
        $zone=$this->input->post('zoneName');
        $active=$this->input->post('zoneActive');
        $id=$this->input->post('hdnZoneId');
        $form_data=array(
            'zone_name'=>$zone,
            'zone_active'=>( $active ? $active :'0')
            );
        $this->mdl_general->Manage('dn_zone',$form_data,array('zone_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Zone Updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/zone');
        
    }

    function delete_zone(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_zone',array('zone_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    //for bank setup

    function bank($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Bank edit";
            $data['bank_details']=$this->mdl_general->GetInfoByRow('dn_bank','bank_id',array('bank_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('bank_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Bank";
            $data['bank_list']=$this->mdl_general->GetAllInfo('dn_bank','bank_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('bank',$data);
        }
    }

    function add_new_bank(){
        $active=$this->input->post('bankActive');
        $form_data=array(
            'bank_name'=>$this->input->post('bankName'),
            'bank_actitle'=>$this->input->post('bankAccountTitle'),
            'bank_acnum'=>$this->input->post('bankAccountNumber'),
            'bank_sortcode'=>$this->input->post('bankSortCode'),
            'bank_address'=>$this->input->post('bankAdress'),
            'bank_postcode'=>$this->input->post('bankPostCode'),
            'city_id'=>$this->input->post('bankCity'),
            'bank_active'=>( $active ? $active :'0')

        );
        $this->mdl_general->SaveForm('dn_bank',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Bank added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/bank');

    }

    function delete_bank(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_bank',array('bank_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function bank_edit(){
        $id=$this->input->post('hdnBankId');
        $active=$this->input->post('bankActive');
        $form_data=array(
            'bank_name'=>$this->input->post('bankName'),
            'bank_actitle'=>$this->input->post('bankAccountTitle'),
            'bank_acnum'=>$this->input->post('bankAccountNumber'),
            'bank_sortcode'=>$this->input->post('bankSortCode'),
            'bank_address'=>$this->input->post('bankAdress'),
            'bank_postcode'=>$this->input->post('bankPostCode'),
            'city_id'=>$this->input->post('bankCity'),
            'bank_active'=>( $active ? $active :'0')

        );
        $this->mdl_general->Manage('dn_bank',$form_data,array('bank_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Bank updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/bank');

    }

    //for city setup
    function city($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | City edit";
            $data['city_details']=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('city_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | City";
        $data['city_list']=$this->mdl_general->GetAllInfo('dn_city','city_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('city',$data);
    }
    }

    function add_new_city(){
        $active=$this->input->post('cityActive');
        $form_data=array(
            'country_id'=>$this->input->post('countryName'),
            'city_name'=>$this->input->post('cityName'),
            'city_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_city',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'City added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/city');

    }
    function delete_city(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_city',array('city_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function city_edit(){
        $active=$this->input->post('cityActive');
        $id=$this->input->post('hdnCityId');
        $form_data=array(
            'country_id'=>$this->input->post('countryName'),
            'city_name'=>$this->input->post('cityName'),
            'city_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_city',$form_data,array('city_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'City updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/city');

    }

    //for country setup

    function country($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Country edit";
            $data['country_details']=$this->mdl_general->GetInfoByRow('dn_country','country_id',array('country_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('country_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Country";
        $data['country_list']=$this->mdl_general->GetAllInfo('dn_country','country_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('country',$data);
        }
        
    }

    function add_new_country(){
        $active=$this->input->post('countryActive');
        $form_data=array(
            
            'country_name'=>$this->input->post('countryName'),
            'country_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_country',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Country added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/country');


    }

    function delete_country(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_country',array('country_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function country_edit(){
        $active=$this->input->post('countryActive');
        $id=$this->input->post('hdnCountryId');
        $form_data=array(
            
            'country_name'=>$this->input->post('countryName'),
            'country_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_country',$form_data,array('country_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Country updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/country');
    }

    //for currecy setup

    function currencies($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Currency edit";
            $data['currency_details']=$this->mdl_general->GetInfoByRow('dn_currency','currency_id',array('currency_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('currency_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Currency";
        $data['currency_list']=$this->mdl_general->GetAllInfo('dn_currency','currency_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('currency',$data);
        }
        
    }

    function add_new_currency(){
        $active=$this->input->post('currencyActive');
        $form_data=array(
            
            'currency_name'=>$this->input->post('currencyName'),
            'currency_symbol'=>$this->input->post('currencySymbol'),
            'currency_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_currency',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Currency added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/currencies');

    }

    function delete_currency(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_currency',array('currency_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function currency_edit(){
        $active=$this->input->post('currencyActive');
        $id=$this->input->post('hdnCurrencyId');
        $form_data=array(
            
            'currency_name'=>$this->input->post('currencyName'),
            'currency_symbol'=>$this->input->post('currencySymbol'),
            'currency_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_currency',$form_data,array('currency_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Currency updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/currencies');

    }

    //for donation type

    function donationtype($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Donation type edit";
            $data['donation_type_details']=$this->mdl_general->GetInfoByRow('dn_donationtype','dt_id',array('dt_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('donation_type_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Donation Type";
        $data['donation_type_list']=$this->mdl_general->GetAllInfo('dn_donationtype','dt_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('donation_type',$data);
        }
        
    }

    function add_new_donationtype(){
        $active=$this->input->post('donationTypeActive');
        $form_data=array(
            
            'dt_name'=>$this->input->post('donationTypeName'),
            'incometype'=>$this->input->post('donationIncomeType'),
            'dt_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_donationtype',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Donation type added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/donationtype');

    }

    function delete_donationtype(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_donationtype',array('dt_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function donationtype_edit(){
        $active=$this->input->post('donationTypeActive');
        $id=$this->input->post('hdnDonationTypeId');
        $form_data=array(
            
            'dt_name'=>$this->input->post('donationTypeName'),
            'incometype'=>$this->input->post('donationIncomeType'),
            'dt_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_donationtype',$form_data,array('dt_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Donation type updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/donationtype');
    }


    //for pledge type 
    function pledgetype($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Pledge type edit";
            $data['pledge_type_details']=$this->mdl_general->GetInfoByRow('dn_pledgetype','pt_id',array('pt_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('pledge_type_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Pledge Type";
        $data['pledge_type_list']=$this->mdl_general->GetAllInfo('dn_pledgetype','pt_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('pledge_type',$data);
        }

        
    }

    function add_new_pledge_type(){
        $active=$this->input->post('pledgeTypeActive');
        $form_data=array(
            
            'pt_name'=>$this->input->post('pledgeTypeName'),
            'pt_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_pledgetype',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Pledge type added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/pledgetype');

        
    }

    function delete_pledgetype(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_pledgetype',array('pt_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function pledgetype_edit(){
        $active=$this->input->post('pledgeTypeActive');
        $id=$this->input->post('hdnPledgeTypeId');
        $form_data=array(
            
            'pt_name'=>$this->input->post('pledgeTypeName'),
            'pt_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_pledgetype',$form_data,array('pt_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Pledge type updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/pledgetype');
    }

    //for donortype

    function donortype($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Pledge type edit";
            $data['donor_type_details']=$this->mdl_general->GetInfoByRow('dn_donortype','donortype_id',array('donortype_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('donor_type_edit',$data);

        }else{

        $page_details['page_title']="Ucare Foundation | Donor Type";
        $data['donor_type_list']=$this->mdl_general->GetAllInfo('dn_donortype','donortype_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('donor_type',$data);
    }
    }

    function add_new_donortype(){
        $active=$this->input->post('donorTypeActive');
        $form_data=array(
            
            'donortype_name'=>$this->input->post('donorTypeName'),
            'donortype_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_donortype',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Donor type added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/donortype');

    }

    function delete_donortype(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_donortype',array('donortype_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function donortype_edit(){
        $active=$this->input->post('donorTypeActive');
        $id=$this->input->post('hdnDonorTypeId');
        $form_data=array(
            
            'donortype_name'=>$this->input->post('donorTypeName'),
            'donortype_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_donortype',$form_data,array('donortype_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Donor type updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/donortype');
    }

    //for paymentmode

    function paymentmode($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Payment mode edit";
            $data['payment_mode_details']=$this->mdl_general->GetInfoByRow('dn_paymentmode','pm_id',array('pm_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('payment_mode_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Payment mode";
        $data['payment_mode_list']=$this->mdl_general->GetAllInfo('dn_paymentmode','pm_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('payment_mode',$data);
    }
    }

    function add_new_paymentmode(){
        $active=$this->input->post('paymentModeActive');
        $form_data=array(
            
            'pm_name'=>$this->input->post('paymentModeName'),
            'pm_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_paymentmode',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Payment mode added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/paymentmode');

    }

    function delete_paymentmode(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_paymentmode',array('pm_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }

    function paymentmode_edit(){
        $active=$this->input->post('paymentModeActive');
        $id=$this->input->post('hdnPaymentModeId');
        $form_data=array(
            
            'pm_name'=>$this->input->post('paymentModeName'),
            'pm_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_paymentmode',$form_data,array('pm_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Payment mode updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/paymentmode');

    }

    //for expensehead

    function expensehead($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Expense head edit";
            $data['expense_head_details']=$this->mdl_general->GetInfoByRow('dn_expensehead','eh_id',array('eh_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('expense_head_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Expense Head";
        $data['expense_head_list']=$this->mdl_general->GetAllInfo('dn_expensehead','eh_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('expense_head',$data);
    }
    }

    function add_new_expensehead(){
        $active=$this->input->post('expenseHeadActive');
        $form_data=array(
            
            'eh_name'=>$this->input->post('expenseHeadName'),
            'eh_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_expensehead',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Expensehead added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/expensehead');

    }

    function delete_expensehead(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_expensehead',array('eh_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function expensehead_edit(){
        $active=$this->input->post('expenseHeadActive');
        $id=$this->input->post('hdnExpenseHeadId');
        $form_data=array(
            
            'eh_name'=>$this->input->post('expenseHeadName'),
            'eh_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_expensehead',$form_data,array('eh_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Expensehead updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/expensehead');

    }

    //for events 

    function events($edit=null,$id=null){
        $this->load->model('mdl_extra');
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Event edit";
            $data['event_details']=$this->mdl_extra->getEventlistWhere($id);
            // $data['event_details']=$this->mdl_general->GetInfoByRow('dn_events','event_id',array('event_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('events_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Events";
        $data['event_list']=$this->mdl_extra->getEventlist();
        $this->load->module('header')->index($page_details);
        $this->load->view('events',$data);
    }
    }

    function add_new_event(){
        $active=$this->input->post('eventActive');
        $form_data=array(
            
            'event_name'=>$this->input->post('eventName'),
            'event_datefrom'=>date('Y-m-d', strtotime($this->input->post('eventFromDate'))),
            'event_dateto'=>date('Y-m-d', strtotime($this->input->post('eventToDate'))),
            'event_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_events',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Event added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/events');


    }

    function delete_event(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_events',array('event_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function events_edit(){
        $active=$this->input->post('eventActive');
        $id=$this->input->post('hdnEventId');
        $form_data=array(
            
            'event_name'=>$this->input->post('eventName'),
            'event_datefrom'=>date('Y-m-d', strtotime($this->input->post('eventFromDate'))),
            'event_dateto'=>date('Y-m-d', strtotime($this->input->post('eventToDate'))),
            'donation_target' => $this->input->post('donation_target'),
            'event_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_events',$form_data,array('event_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Event updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/events');

    }

    //for month
    
    function month($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Month edit";
            $data['month_details']=$this->mdl_general->GetInfoByRow('dn_monthes','month_id',array('month_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('month_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Month";
            $data['month_list']=$this->mdl_general->GetAllInfo('dn_monthes','month_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('month',$data);
    }   
    }

    function add_new_month(){
        $close=$this->input->post('monthClose');
        $form_data=array(
            
            'month_name'=>$this->input->post('monthName'),
            'month_datefrom'=>date('Y-m-d', strtotime($this->input->post('monthFromDate'))),
            'month_dateto'=>date('Y-m-d', strtotime($this->input->post('monthToDate'))),
            'month_close'=>( $close ? $close :'0')
        );
        $this->mdl_general->SaveForm('dn_monthes',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Month added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/month');

    }

    function delete_month(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_monthes',array('month_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function month_edit(){
        $close=$this->input->post('monthClose');
        $id=$this->input->post('hdnMonthId');
        $form_data=array(
            
            'month_name'=>$this->input->post('monthName'),
            'month_datefrom'=>date('Y-m-d', strtotime($this->input->post('monthFromDate'))),
            'month_dateto'=>date('Y-m-d', strtotime($this->input->post('monthToDate'))),
            'month_close'=>( $close ? $close :'0')
        );
        $this->mdl_general->Manage('dn_monthes',$form_data,array('month_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Month updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/month');

    }

    //for root 

    function root($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Route edit";
            $data['root_details']=$this->mdl_general->GetInfoByRow('dn_root','root_id',array('root_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('root_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Route";
        $data['root_list']=$this->mdl_general->GetAllInfo('dn_root','root_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('root',$data);
    }
    }

    function add_new_root(){
        $active=$this->input->post('routeActive');
        $form_data=array(
            
            'root_name'=>$this->input->post('routeName'),
            'root_schedualdays'=>$this->input->post('routeCycleDays'),
            'root_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_root',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Route added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/root');

    }

    function delete_root(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_root',array('root_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function root_edit(){
        $active=$this->input->post('routeActive');
        $id=$this->input->post('hdnRouteId');
        $form_data=array(
            
            'root_name'=>$this->input->post('routeName'),
            'root_schedualdays'=>$this->input->post('routeCycleDays'),
            'root_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_root',$form_data,array('root_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Route updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/root');

    }

    //for supplier 

    function supplier($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Supplier edit";
            $data['supplier_details']=$this->mdl_general->GetInfoByRow('dn_supplier','sup_id',array('sup_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('supplier_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Supplier";
        $data['supplier_list']=$this->mdl_general->GetAllInfo('dn_supplier','sup_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('supplier',$data);
    }

    }

    function add_new_supplier(){
        $active=$this->input->post('supplierActive');
        $form_data=array(
            'sup_name'=>$this->input->post('supplierName'),
            'sup_address'=>$this->input->post('supplierAddress'),
            'sup_email'=>$this->input->post('supplierEmail'),
            'sup_contactnum'=>$this->input->post('supplierContactNo'),
            'sup_postcode'=>$this->input->post('supplierPostCode'),
            'city_id'=>$this->input->post('supplierCity'),
            'sup_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_supplier',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Supplier added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/supplier');


    }

    function delete_supplier(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_supplier',array('sup_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function supplier_edit(){
        $active=$this->input->post('supplierActive');
        $id=$this->input->post('hdnSupplierId');
        $form_data=array(
            'sup_name'=>$this->input->post('supplierName'),
            'sup_address'=>$this->input->post('supplierAddress'),
            'sup_email'=>$this->input->post('supplierEmail'),
            'sup_contactnum'=>$this->input->post('supplierContactNo'),
            'sup_postcode'=>$this->input->post('supplierPostCode'),
            'city_id'=>$this->input->post('supplierCity'),
            'sup_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_supplier',$form_data,array('sup_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Supplier updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/supplier');

    }

    //for title

    function title($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Title edit";
            $data['title_details']=$this->mdl_general->GetInfoByRow('dn_title','title_id',array('title_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('title_edit',$data);

        }else{

        $page_details['page_title']="Ucare Foundation | Title";
        $data['title_list']=$this->mdl_general->GetAllInfo('dn_title','title_id');
        $this->load->module('header')->index($page_details);
        $this->load->view('title',$data);
    }
    }

    function add_new_title(){
        $active=$this->input->post('titleActive');
        $form_data=array(
            
            'title_name'=>$this->input->post('titleName'),
            'title_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_title',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Title added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/title');

    }

    function delete_title(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_title',array('title_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function title_edit(){
        $active=$this->input->post('titleActive');
        $id=$this->input->post('hdnTitleId');
        $form_data=array(
            
            'title_name'=>$this->input->post('titleName'),
            'title_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_title',$form_data,array('title_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Title updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/title');

    }

    //for donation approval 

    function donationapproval(){
        $this->load->model('mdl_extra');
        $page_details['page_title']="Ucare Foundation | Donation Approval";
        //$data['donation_list']=$this->mdl_extra->GetDonationForApproval();
        //var_dump($data);
        $data['donation_list']=$this->mdl_general->GetAllInfo('dn_donation','donation_id',array('dn_approved'=>'0','box_id'=>'0'));
        $this->load->module('header')->index($page_details);
        $this->load->view('donation_approval',$data);
    }

    function approve_donation($id){
        $this->mdl_general->Manage('dn_donation',array('dn_approved'=>'1'),array('donation_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Donation approved successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/donationapproval');

    }

    //for gift aid consent rate 
    function giftaid($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Gift Aid Consent Rate edit";
            $data['giftaid_details']=$this->mdl_general->GetInfoByRow('dn_giftaid','gif_id',array('gif_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('gift_aid_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Gift Aid Consent Rate";
            $data['giftaid_list']=$this->mdl_general->GetAllInfo('dn_giftaid','gif_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('gift_aid',$data);
        }
    }

    function add_new_giftaid(){
        $active=$this->input->post('giftActive');
        $form_data=array(
            
            'gif_rate'=>$this->input->post('giftPercentage'),
            'gif_date'=>date('Y-m-d',strtotime($this->input->post('giftDate'))),
            'gif_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_giftaid',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Giftaid added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/giftaid');

    }

    function delete_giftaid(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_giftaid',array('gif_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function giftaid_edit(){
        $active=$this->input->post('giftActive');
        $id=$this->input->post('hdnGiftAidId');
        $form_data=array(
            
            'gif_rate'=>$this->input->post('giftPercentage'),
            'gif_date'=>date('Y-m-d',strtotime($this->input->post('giftDate'))),
            'gif_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_giftaid',$form_data,array('gif_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Giftaid updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/giftaid');

    }

    function get_donor_detail(){
        $this->load->model('mdl_extra');
        $data=$this->mdl_extra->get_matching_donor($this->input->post('name'));        
        echo json_encode($data);
    }


    //for configuration
    //default=1
    function configuration($id='1'){
            $page_details['page_title']="Ucare Foundation | Configuration Edit";
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
            'approval_disabled'=>($approval_disabled ? $approval_disabled :'0')
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



    //for labletemplate

    function labeltemplate($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Label template edit";
            $data['template']=$this->mdl_general->GetInfoByRow('labelmeasurements','lb_id',array('lb_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('labeltemplate_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Label template";
            $data['template_list']=$this->mdl_general->GetAllInfo('labelmeasurements','lb_id');
            $this->load->module('header')->index($page_details);
            $this->load->view('labeltemplate',$data);
        }
    }

    function add_new_labeltemplate(){
        $form_data=array(

            'lb_width'=>$this->input->post('labelWidth'),
            'lb_height'=>$this->input->post('labelHeight'),
            'lb_leftmargin'=>$this->input->post('labelLeftMargin'),
            'lb_topmargin'=>$this->input->post('labelTopMargin'),
            'lb_leftpadding'=>$this->input->post('labelLeftDistance'),
            'lb_toppadding'=>$this->input->post('labelTopDistance'),
            'lb_vspace'=>$this->input->post('labelVerticalSpace'),
            'lb_hspace'=>$this->input->post('labelHorizontalSpace'),
            'lb_text'=>$this->input->post('labelText'),
            'lb_name'=>$this->input->post('labelName'),
            'lb_lineheight'=>$this->input->post('labelBwLineDistance'),
            'pagebreakheight'=>$this->input->post('labelPageBreakHeight'),
            'pageheight'=>$this->input->post('labelPageHeight'),
            'pagewidth'=>$this->input->post('labelPageWidth'),
            'pagequality'=>$this->input->post('labelPage')
        );
        $this->mdl_general->SaveForm('labelmeasurements',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Label template added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/labeltemplate');

    }

    function labeltemplate_edit(){
        $id=$this->input->post('hdnLabelTemplateId');
        $form_data=array(

            'lb_width'=>$this->input->post('labelWidth'),
            'lb_height'=>$this->input->post('labelHeight'),
            'lb_leftmargin'=>$this->input->post('labelLeftMargin'),
            'lb_topmargin'=>$this->input->post('labelTopMargin'),
            'lb_leftpadding'=>$this->input->post('labelLeftDistance'),
            'lb_toppadding'=>$this->input->post('labelTopDistance'),
            'lb_vspace'=>$this->input->post('labelVerticalSpace'),
            'lb_hspace'=>$this->input->post('labelHorizontalSpace'),
            'lb_text'=>$this->input->post('labelText'),
            'lb_name'=>$this->input->post('labelName'),
            'lb_lineheight'=>$this->input->post('labelBwLineDistance'),
            'pagebreakheight'=>$this->input->post('labelPageBreakHeight'),
            'pageheight'=>$this->input->post('labelPageHeight'),
            'pagewidth'=>$this->input->post('labelPageWidth'),
            'pagequality'=>$this->input->post('labelPage')
        );
        $this->mdl_general->Manage('labelmeasurements',$form_data,array('lb_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Label template updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/labeltemplate');

    }

    function delete_labeltemplate(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('labelmeasurements',array('lb_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }


    //for letter template
    function template($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Letter template edit";
            $data['template']=$this->mdl_general->GetInfoByRow('dn_lettertemplate','lt_id',array('lt_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('lettertemplate_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Letter template";
            $data['template_list']=$this->mdl_general->GetAllInfo('dn_lettertemplate','lt_id');
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
        $template_id=$this->mdl_general->SaveForm('dn_lettertemplate',$form_data);

        if(@$_FILES['ltSignatureImage']['name'] != ""){
                    $config['upload_path'] = FCPATH . 'assets/image/letterTemplate';
                    $config['allowed_types'] = 'jpeg|png|PNG|jpg|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    $this->upload_file($config,'ltSignatureImage');
                    $this->mdl_general->Manage('dn_lettertemplate',array('signatureimage' => $_FILES['ltSignatureImage']['name']), array('lt_id' => $template_id), 'Update');

        }

        $response=array(
            'status'=>'success',
            'message'=>'Letter template added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/template');


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
        $this->mdl_general->Manage('dn_lettertemplate',$form_data,array('lt_id'=>$id),'Update');

        if(@$_FILES['ltSignatureImage']['name'] != ""){
                    $config['upload_path'] = FCPATH . 'assets/image/letterTemplate';
                    $config['allowed_types'] = 'jpeg|png|PNG|jpg|JPG|bmp|BMP';
                    $config['encrypt_name'] = FALSE;
                    $config['remove_spaces'] = FALSE;
                    $config['max_size'] = '2048';
                    $this->upload_file($config,'ltSignatureImage');
                    $this->mdl_general->Manage('dn_lettertemplate',array('signatureimage' => $_FILES['ltSignatureImage']['name']), array('lt_id' => $id), 'Update');
                    
        }

        $response=array(
            'status'=>'success',
            'message'=>'Letter template updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/template');


    }

    

    function delete_template(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_lettertemplate',array('lt_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function project_site($edit=null,$id=null){
        $this->load->model("mdl_extra");
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Project Site edit";
            $data['project_site_list']=$this->mdl_general->GetInfoByRow('dn_project_site','psite_id',array('psite_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('projectsite_edit',$data);

        }else{
        $page_details['page_title']="Ucare Foundation | Project Site";
        $data['project_site_list']=$this->mdl_extra->getProjectSiteList();
        $this->load->module('header')->index($page_details);
        $this->load->view('projectsite',$data);
        }
        
    }
    public function add_new_projectsite(){
        $status = $this->input->post('active');
        $form_data=array(
            'psite_name'=>$this->input->post('projectSiteName'),
            'psite_org_name'=>$this->input->post('project_orgname'),
            'psite_address'=>$this->input->post('project_address'),
            'psite_website'=>$this->input->post('project_website'),
            'psite_facebook'=>$this->input->post('project_facebook'),
            'psite_twitter'=>$this->input->post('project_twitter'),
            'country_id'=>$this->input->post('project_country'),
            'city_id'=>$this->input->post('project_city'),
            'psite_openingdate'=>$this->input->post('opening_date'),
            'psite_incharge'=>$this->input->post('site_incharge'),
            'psite_contactno'=>$this->input->post('project_contact_no'),
            'psite_email'=>$this->input->post('project_email_address'),
            'psite_remarks'=>$this->input->post('project_remarks'),
            'psite_status'=> ($status == 1) ? 1 : 0
        );
        $this->mdl_general->SaveForm('dn_project_site',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Project Site added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/project_site');
    }
     function edit_projectsite(){
        $status = $this->input->post('active');
        $id=$this->input->post('hddProjectSiteID');
        $form_data=array(
            'psite_name'=>$this->input->post('projectSiteName'),
            'psite_org_name'=>$this->input->post('project_orgname'),
            'psite_address'=>$this->input->post('project_address'),
            'psite_website'=>$this->input->post('project_website'),
            'psite_facebook'=>$this->input->post('project_facebook'),
            'psite_twitter'=>$this->input->post('project_twitter'),
            'country_id'=>$this->input->post('project_country'),
            'city_id'=>$this->input->post('project_city'),
            'psite_openingdate'=>$this->input->post('opening_date'),
            'psite_incharge'=>$this->input->post('site_incharge'),
            'psite_contactno'=>$this->input->post('project_contact_no'),
            'psite_email'=>$this->input->post('project_email_address'),
            'psite_remarks'=>$this->input->post('project_remarks'),
            'psite_status'=> ($status == 1) ? 1 : 0
        );
        $this->mdl_general->Manage('dn_project_site',$form_data,array('psite_id'=>$id), 'Update');
        $response=array(
            'status'=>'success',
            'message'=>'Project Site updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/project_site');

    }

    function delete_project_site(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_project_site',array('psite_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);

    }

    function orphan_registration($edit=null,$id=null){
        $this->load->model("mdl_extra");
        if($edit == 'add'){
            $page_details['page_title']="Ucare Foundation | Orphan Registration";
            // $data['orphan_details']=$this->mdl_general->GetInfoByRow('dn_country','country_id',array('country_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('orphanregistration_add');
        }elseif($edit == 'edit' && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Orphan Edit";
            $data['orphan_details']=$this->mdl_extra->getOrphanRegistrationWhere($id);
            $this->load->module('header')->index($page_details);
            $this->load->view('orphanregistration_edit', $data);

        }else{
        $page_details['page_title']="Ucare Foundation | Orphan List";
        $data['orphan_list']= $this->mdl_extra->getOrphanRegistration();
        $this->load->module('header')->index($page_details);
        $this->load->view('orphanregistration',$data);
        }
        
    }
    function getProjectCityInOrphan(){
        $data=$this->mdl_general->GetInfoByRow('dn_project_site','psite_id',array('psite_id'=>$this->input->post('orphan_projectsite_id')));
        echo json_encode($data);
    }
    function getOrphanDetailEditor(){
        $this->load->model("mdl_extra");
        $data=$this->mdl_extra->getOrphanRegistrationWhere($this->input->post('orphan_id'));
        echo json_encode($data);
    }
    public function add_orphan(){
        $form_data = array(
            'registration_date' => $this->input->post('registration_date'),
            'orphan_status' => $this->input->post('orphan_status'),
            'support_office' => $this->input->post('support_office'),
            'orphan_caterogy' => $this->input->post('orphan_caterogy'),
            'orphan_title' => $this->input->post('orphan_title'),
            'orphan_fname' => $this->input->post('orphan_fname'),
            'orphan_mname' => $this->input->post('orphan_mname'),
            'orphan_lname' => $this->input->post('orphan_lname'),
            'orphan_nationality' => $this->input->post('orphan_nationality'),
            'orphan_city' => $this->input->post('orphan_city'),
            'orphan_projectsite' => $this->input->post('orphan_projectsite'),
            'orphan_age' => $this->input->post('orphan_age'),
            'orphan_gender' => $this->input->post('orphan_gender'),
            'orphan_datebirth' => $this->input->post('orphan_datebirth'),
            'orphan_guardian' => $this->input->post('orphan_guardian'),
            'orphan_address' => $this->input->post('orphan_address'),
            'orphan_family_cim' => $this->input->post('orphan_fam_cim'),
            'orphan_otherSupport' => $this->input->post('orphan_otherSupp'),
            'orphan_specialNeeded' =>  $this->input->post('orphan_sNeed'),
            'orphan_medicalSituation' => $this->input->post('orphan_MedSit'),
            'orphan_schoolSituation' => $this->input->post('orphan_schoolSit'),
            'orphan_requiredSupport' => $this->input->post('orphan_rSupport')
        );
        $this->mdl_general->SaveForm('dn_orphanregistration',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Orphan added successfully' 
            );
        echo json_encode($response);
        // $this->session->set_flashdata($response);
        // redirect('setup/orphan_registration');
    }
    public function update_orphan($id=null){
        $form_data = array(
            'registration_date' => $this->input->post('registration_date'),
            'orphan_status' => $this->input->post('orphan_status'),
            'support_office' => $this->input->post('support_office'),
            'orphan_caterogy' => $this->input->post('orphan_caterogy'),
            'orphan_title' => $this->input->post('orphan_title'),
            'orphan_fname' => $this->input->post('orphan_fname'),
            'orphan_mname' => $this->input->post('orphan_mname'),
            'orphan_lname' => $this->input->post('orphan_lname'),
            'orphan_nationality' => $this->input->post('orphan_nationality'),
            'orphan_city' => $this->input->post('orphan_city'),
            'orphan_projectsite' => $this->input->post('orphan_projectsite'),
            'orphan_age' => $this->input->post('orphan_age'),
            'orphan_gender' => $this->input->post('orphan_gender'),
            'orphan_datebirth' => $this->input->post('orphan_datebirth'),
            'orphan_guardian' => $this->input->post('orphan_guardian'),
            'orphan_address' => $this->input->post('orphan_address'),
            'orphan_family_cim' => $this->input->post('orphan_fam_cim'),
            'orphan_otherSupport' => $this->input->post('orphan_otherSupp'),
            'orphan_specialNeeded' =>  $this->input->post('orphan_sNeed'),
            'orphan_medicalSituation' => $this->input->post('orphan_MedSit'),
            'orphan_schoolSituation' => $this->input->post('orphan_schoolSit'),
            'orphan_requiredSupport' => $this->input->post('orphan_rSupport')
        );
        $id = $this->input->post('hddOrphanID');
        $this->mdl_general->Manage('dn_orphanregistration',$form_data,array('orphan_id'=>$id),'Update');
        // $this->mdl_general->SaveForm('dn_orphanregistration',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Orphan Update successfully' 
            );
        echo json_encode($response);
        // $this->session->set_flashdata($response);
        // redirect('setup/orphan_registration');

    }
    function delete_orphan(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_orphanregistration',array('orphan_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }
    
    function getcitylistperCountry(){
        $this->load->model('mdl_extra');
        $id=$this->input->post('pc_id');
        $data=$this->mdl_extra->getCityListPerCountry($id);
        echo json_encode($data);
    }

    function orphan_category($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Orphan Category Edit";
            $data['orphan_category_list']=$this->mdl_general->GetInfoByRow('dn_category','category_id',array('category_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('orphan_category_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Orphan Category";
        $data['orphan_category_list']=$this->mdl_general->GetAllInfo('dn_category','category_id');;
        $this->load->module('header')->index($page_details);
        $this->load->view('orphan_category',$data);
        }
        
    }
     function add_new_category(){
        $active=$this->input->post('categoryActive');
        $form_data=array(
            
            'category_name'=>$this->input->post('categoryName'),
            'category_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_category',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Catergory added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/orphan_category');


    }
    function category_edit(){
        $active=$this->input->post('categoryActive');
        $id=$this->input->post('hdncategoryId');
        $form_data=array(
            
            'category_name'=>$this->input->post('categoryName'),
            'category_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_category',$form_data,array('category_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'category updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/orphan_category');
    }
    function delete_category(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_category',array('category_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
    }
    function orphan_status($edit=null,$id=null){
        if(!is_null($edit) && !is_null($id)){
            $page_details['page_title']="Ucare Foundation | Orphan Status Edit";
            $data['orphan_status_list']=$this->mdl_general->GetInfoByRow('dn_status','stat_id',array('stat_id'=>$id));
            $this->load->module('header')->index($page_details);
            $this->load->view('orphan_status_edit',$data);

        }else{
            $page_details['page_title']="Ucare Foundation | Orphan Status";
        $data['orphan_status_list']=$this->mdl_general->GetAllInfo('dn_status','stat_id');;
        $this->load->module('header')->index($page_details);
        $this->load->view('orphan_status',$data);
        }
        
    }
    function add_new_status(){
        $active=$this->input->post('statusActive');
        $form_data=array(
            
            'stat_name'=>$this->input->post('statusName'),
            'stat_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->SaveForm('dn_status',$form_data);
        $response=array(
            'status'=>'success',
            'message'=>'Catergory added successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/orphan_status');


    }
    function status_edit(){
        $active=$this->input->post('statusActive');
        $id=$this->input->post('hdnstatusId');
        $form_data=array(
            
            'stat_name'=>$this->input->post('statusName'),
            'stat_active'=>( $active ? $active :'0')
        );
        $this->mdl_general->Manage('dn_status',$form_data,array('stat_id'=>$id),'Update');
        $response=array(
            'status'=>'success',
            'message'=>'status updated successfully' 
            );
        $this->session->set_flashdata($response);
        redirect('setup/orphan_status');
    }
    function delete_status(){
        $id=$this->input->post('id');
        $this->mdl_general->Delete('dn_status',array('stat_id'=>$id));
        $response=array(
            'status'=>'success',
            'message'=>'deleted successfully'
            );
        echo json_encode($response);
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
}