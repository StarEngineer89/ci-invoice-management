<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MX_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        if($this->session->userdata('sess_logged_in')!=true){
                redirect('login/index?error=4');
        }
    }

    //for lable report
    function rep_lable(){
        $page_details['page_title']="Ucare Foundation | Lable";
        $this->load->module('header')->index($page_details);
        //$this->load->view('report_income_expenditure');
    }

    //for income expenditure 

    function rep_incomeExpenditure(){
        $page_details['page_title']="Ucare Foundation | Income Expenditure";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_income_expenditure');
    }

    function rep_income_expenditure_filter(){
        $this->load->model('mdl_extra_report');
        $month_id=$this->input->post('month');
        if($this->input->post('show')){
            $data['month_id']=$month_id;
            $this->load->view('report_income_expenditure_result',$data);
        }elseif($this->input->post('pdf')){
            $data['month_id']=$month_id;
            $this->load->view('report_income_expenditure_pdf',$data);
        }
    }

    //for sending sms

    // function sendSms($status=null){
    //     if($status=="success"){
    //         $page_details['page_title']="Ucare Foundation | Send Email";
    //         $this->load->module('header')->index($page_details);
    //         $this->load->view('report_send_sms_success');
    //     }else{
    //         $page_details['page_title']="Ucare Foundation | Send Email";
    //         $this->load->module('header')->index($page_details);
    //         $this->load->view('report_send_sms');
    //     }
    // }

    // function rep_send_sms_filter(){
    //     $this->load->model('mdl_extra_report');
    //     $donation_sms=$this->input->post('bodySMS');
    //     //$top_donation=$this->input->post('topDonation');
    //     ($this->input->post('donorEmail') ? $donor_email="1" : $donor_email="donor_sendmail");
    //     ($this->input->post('donorTextAlert') ? $donor_text_alert="1" : $donor_text_alert="donor_textalert");
    //     ($this->input->post('donorBoxDonor') ? $donor_box_donor="1" : $donor_box_donor="donor_box");
    //     ($this->input->post('donorVIP') ? $donor_vip="1" : $donor_vip="donor_vip");
    //     ($this->input->post('donorCardSend') ? $donor_card_send="1" : $donor_card_send="donor_cardsend");
    //     ($this->input->post('donorNews') ? $donor_news="1" : $donor_news="donor_sendnews");
    //     ($this->input->post('donorDataSharing') ? $donor_data_sharing="1" : $donor_data_sharing="donor_sharedata");
    //     ($this->input->post('donorMuslim') ? $donor_muslim="1" : $donor_muslim="donor_muslim");
    //     ($this->input->post('donorCommittee') ? $donor_committee="1" : $donor_committee="donor_committee");
    //     ($this->input->post('donorMailOfficeAddress') ? $donor_mail_office="1" : $donor_mail_office="donor_homeletter");
    //     $donor_city=$this->input->post('donorCity');
    //     if($this->input->post('fromAmount') ==""){
    //         $from_amount="dnd.donation_amount";
    //     }else{
    //         $from_amount=$this->input->post('fromAmount');
    //     }
    //     if($this->input->post('toAmount') ==""){
    //         $to_amount="dnd.donation_amount";
    //     }else{
    //         $to_amount=$this->input->post('toAmount');
    //     }

    //     if($this->input->post('fromDate')){
    //         $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
    //     }else{
    //         $from_date="dn.donation_date";
    //     }
    //     if($this->input->post('toDate')){
    //         $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
    //     }else{
    //         $to_date="dn.donation_date";
    //     }

    //     if($this->input->post('homeCity')){
    //         if($donor_city =="0"){
    //             $donor_city="d.donor_homecityid";
    //             $city_name="All";
    //         }
    //         $donor_city="d.donor_homecityid=".$donor_city;
            
    //     }else{
    //         if($donor_city =="0"){
    //             $donor_city="d.donor_officecity";
    //             $city_name="All";
    //         }
    //         $donor_city="d.donor_officecity=".$donor_city;
            
    //     }

    //     if($this->input->post('save')){
    //         $this->mdl_general->Manage('acs_configration',array('donationsmstext'=>$donation_sms),array('config_id'=>"1"),'Update');
    //         $this->session->set_flashdata('sms_status','Configuration has been updated successfully.');
    //         redirect('report/sendSms/success');

    //     }elseif($this->input->post('send')){
    //         $data['list']=$this->mdl_extra_report->GetDonorForSMS($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_amount,$to_amount,$from_date,$to_date,$donor_city);
    //         $delivered_sms = "";
    //         foreach($data['list'] as $row){
    //             if($this->input->post('homeCity')){
    //                 $address = $row['donorhome_address'];
    //                 $city = $row['homecity'];
    //                 $phone = $row['donor_homephone'];
    //                 $postcode = $row['donor_postcode'];
    //             }else{
    //                 $address = $row['donor_officeaddress'];
    //                 $city = $row['officecity'];
    //                 $phone = $row['donor_officephone'];
    //                 $postcode = $row['donor_officepostcode'];
    //             }
    //             $sms = str_replace("{donorid}",$row['donor_id'],$donation_sms);
    //             $sms = str_replace("{donationamount}",$row['donation_amount'],$sms);
    //             $sms = str_replace("{donornamefirst}",$row['donor_namef'],$sms);
    //             $sms = str_replace("{donornamemiddle}",$row['donor_namem'],$sms);
    //             $sms = str_replace("{donornamelast}",$row['donor_namel'],$sms);
    //             $sms = str_replace("{donoraddress}",$address,$sms);
    //             $sms = str_replace("{city}",$city,$sms);
    //             $sms = str_replace("{postcode}",$postcode,$sms);
    //             $sms = str_replace("{cellnumber}",$row['donor_mobile'],$sms);
    //             $sms = str_replace("{phone}",$phone,$sms);
    //             $sms = str_replace("{title}",$row['title_name'],$sms);
    //             $sms = str_replace("{email}",$row['donor_email'],$sms);
    //             $sms = str_replace("{donationid}",$row['donation_id'],$sms);
    //             if($row['donor_mobile']!=""){
    //                 $url = "http://www.voodoosms.com/vapi/server/sendSMS?";
    //                  //Post variable names should be same as mentioned below example and its case sensitive as well
    //                 $message=urlencode($sms);
    //                 $url .='dest=44'.$row['donor_mobile'];
    //                 $url .='&orig=Ucare';
    //                 $url .='&msg='.$message;
    //                 $url .='&uid=ucarefoundation';
    //                 $url .='&pass=3qo4w7d';
    //                 $url .='&validity=1';
    //                 $url .='&format=php';
    //                 $to=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'];
                    
    //                 $ch = curl_init($url);
    //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //                 $response = curl_exec($ch);
    //                 curl_close($ch);
    //                 $delivered_sms.="SMS has been sent to:".$to." - status : ".$response['resultText']."  <br />";
    //             }
                
    //         }
    //         $this->session->set_flashdata('sms_status',$delivered_sms);
    //         redirect('report/sendSms/success');

            
    //     }
    // }


    // //for sending email
    //  function sendEmail($status=null){
    //     if($status=="success"){
    //         $page_details['page_title']="Ucare Foundation | Send Email";
    //         $this->load->module('header')->index($page_details);
    //         $this->load->view('report_send_email_success');
    //     }else{
    //         $page_details['page_title']="Ucare Foundation | Send Email";
    //         $this->load->module('header')->index($page_details);
    //         $this->load->view('report_send_email');
    //     }
    //  }

    //  function rep_send_email_filter(){
    //     $this->load->model('mdl_extra_report');
    //     ($this->input->post('donorEmail') ? $donor_email="1" : $donor_email="donor_sendmail");
    //     ($this->input->post('donorTextAlert') ? $donor_text_alert="1" : $donor_text_alert="donor_textalert");
    //     ($this->input->post('donorBoxDonor') ? $donor_box_donor="1" : $donor_box_donor="donor_box");
    //     ($this->input->post('donorVIP') ? $donor_vip="1" : $donor_vip="donor_vip");
    //     ($this->input->post('donorCardSend') ? $donor_card_send="1" : $donor_card_send="donor_cardsend");
    //     ($this->input->post('donorNews') ? $donor_news="1" : $donor_news="donor_sendnews");
    //     ($this->input->post('donorDataSharing') ? $donor_data_sharing="1" : $donor_data_sharing="donor_sharedata");
    //     ($this->input->post('donorMuslim') ? $donor_muslim="1" : $donor_muslim="donor_muslim");
    //     ($this->input->post('donorCommittee') ? $donor_committee="1" : $donor_committee="donor_committee");
    //     ($this->input->post('donorMailOfficeAddress') ? $donor_mail_office="1" : $donor_mail_office="donor_homeletter");
    //     $donor_city=$this->input->post('donorCity');
    //     $donor_type=$this->input->post('donorType');
    //     $donor_event=$this->input->post('donorEvent');
    //     if($this->input->post('fromAmount') ==""){
    //         $from_amount="dnd.donation_amount";
    //     }else{
    //         $from_amount=$this->input->post('fromAmount');
    //     }
    //     if($this->input->post('toAmount') ==""){
    //         $to_amount="dnd.donation_amount";
    //     }else{
    //         $to_amount=$this->input->post('toAmount');
    //     }

    //     if($this->input->post('fromDate')){
    //         $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
    //     }else{
    //         $from_date="dn.donation_date";
    //     }
    //     if($this->input->post('toDate')){
    //         $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
    //     }else{
    //         $to_date="dn.donation_date";
    //     }

    //     if($this->input->post('homeCity')){
    //         if($donor_city =="0"){
    //             $donor_city="d.donor_homecityid";
    //             $city_name="All";
    //         }
    //         $donor_city="d.donor_homecityid=".$donor_city;
            
    //     }else{
    //         if($donor_city =="0"){
    //             $donor_city="d.donor_officecity";
    //             $city_name="All";
    //         }
    //         $donor_city="d.donor_officecity=".$donor_city;
            
    //     }
    //     if($donor_type=="0"){
    //         $donor_type = "d.donortype_id";
    //         $donor_type_name="All";
    //     }

    //     if($donor_event =="0"){
    //         $donor_event="dnd.event_id";
    //         $event_name="All";
    //     }
    //     $image="";
    //     if(@$_FILES['imageEmail']['name'] != ""){
    //         $config['upload_path'] = FCPATH . 'assets/image/email_images/';
    //         $config['allowed_types'] = 'jpeg|png|jpg|PNG|JPG|bmp|BMP';
    //         $config['encrypt_name'] = FALSE;
    //         $config['remove_spaces'] = FALSE;
    //         $config['max_size'] = '2048';
    //         $this->upload_file($config,'imageEmail');
    //         $image=$_FILES['imageEmail']['name'];    
    //     }


    //     $deliveryStatus = "";
    //     $emailtext = str_replace(chr(10), '<br>', $this->input->post('bodyEmail'));
    //     $data['list']=$this->mdl_extra_report->GetDonorForEmail($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_amount,$to_amount,$from_date,$to_date,$donor_city,$donor_type,$donor_event);
    //     $sender=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));
    //     $this->load->library('email');
    //     $subject=$this->input->post('headerEmail');
    //     foreach($data['list'] as $row){
    //         if($this->input->post('homeCity')){
    //             $address = $row['donorhome_address'];
    //             $city = $row['hcity'];
    //             $phone = $row['donor_homephone'];
    //             $postcode = $row['donor_postcode'];
    //         }else{
    //             $address = $row['donor_officeaddress'];
    //             $city = $row['ofcity'];
    //             $phone = $row['donor_officephone'];
    //             $postcode = $row['donor_officepostcode'];
    //         }
    //         $emailtext = str_replace("{title}",$row['title_name'],$emailtext);
    //         $emailtext = str_replace("{donornamefirst}",$row['donor_namef'],$emailtext);
    //         $emailtext = str_replace("{donornamemiddle}",$row['donor_namem'],$emailtext);  
    //         $emailtext = str_replace("{donornamelast}",$row['donor_namel'],$emailtext);
    //         $emailtext = str_replace("{donoraddress}",$address,$emailtext);
    //         $emailtext = str_replace("{city}",$city,$emailtext);
    //         $emailtext = str_replace("{postcode}",$postcode,$emailtext);
    //         $emailtext = str_replace("{cellnumber}",$row['donor_mobile'],$emailtext);
    //         $emailtext = str_replace("{phone}",$phone,$emailtext);
    //         $emailtext = str_replace("{email}",$row['donor_email'],$emailtext);
    //         $emailtext = str_replace("{event}",$row['event_name'],$emailtext);
    //         $message ='<html><head></head><body><p>'.$emailtext.'</p>';
            
    //         if($image!=""){
    //             $message.='<p><img src="'.base_url().'assets/image/email_images/'.$image.'" /></p><br/>';
    //         }
    //         $message.='<p>'.str_replace(chr(10), '<br>', $sender->signaturetext).'</p><p><img width="160px" src="'.base_url().'assets/image/setUpwindow/'.$sender->signatureimage.'" /></p></body></html>';
    //         $to=$row['donor_email'];
            
    //         $config['useragent']  = "CodeIgniter";
    //         $config['mailpath']  = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
    //         $config['protocol']   = "sendmail";
    //         $config['mailtype'] = 'html';
    //         $config['charset']  = 'utf-8';
    //         $config['newline']  = "\r\n";
    //         $config['wordwrap'] = TRUE; 
    //         $config['validate']=TRUE;
    //         $this->email->initialize($config);
    //         $this->email->from($sender->emailsenderaddress,$sender->emailsendername);
    //         $this->email->to($row['donor_email']);
    //         $this->email->subject($subject);
    //         $this->email->message($message);
            
    //         if($this->email->send()){
    //             $deliveryStatus.="Email has been sent to:".$to."<br />";
    //         }
    //         $this->email->clear();

    //     }
    //     $this->session->set_flashdata('email_status',$deliveryStatus);
    //     redirect('report/sendEmail/success');
        
    //  }

    function upload_file($config, $fieldname) {
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($fieldname);
    }


    //for box collection detail
    function rep_boxCollectionDetail(){
        $page_details['page_title']="Ucare Foundation | Box Collection Detail";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_box_collection');
    }

    function rep_box_collection_filter(){
        $this->load->model('mdl_extra_report');
        $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        $route_id=$this->input->post('route');
        if($route_id =="0"){
            $route = "r.root_id=r.root_id";
            
        }else{
            $route = "r.root_id=".$route_id."";
        }
        if($this->input->post('show')){
            $data['list']=$this->mdl_extra_report->GetBoxCollection($from_date,$to_date,$route);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $this->load->view('report_box_collection_result',$data);
        }elseif ($this->input->post('pdf')) {
            $data['list']=$this->mdl_extra_report->GetBoxCollection($from_date,$to_date,$route);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $this->load->view('report_box_collection_pdf',$data);
        }elseif ($this->input->post('xls')) {
            $data['list']=$this->mdl_extra_report->GetBoxCollection($from_date,$to_date,$route);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $this->load->view('report_box_collection_xls',$data);
        }
    }

    //for city wise Donation
    function rep_citywiseDonationtype(){
        $page_details['page_title']="Ucare Foundation | Donation Type report";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_citywise_donationtype');
    }

    function rep_citywise_donation_type_filter(){
        $this->load->model('mdl_extra_report');
        ($this->input->post('homeCity') ? $home_city="1" : $home_city="0");
        if($home_city=="1"){
            $cityname="d.donor_homecityid, c.city_name";
            $cityid = "d.donor_homecityid";
            $ordercity="d.donor_homecityid";
        }else{
            $cityname="d.donor_officecity, c.city_name";
            $cityid = "d.donor_officecity";
            $ordercity="d.donor_officecity";
        }
        
        if($this->input->post('show')){
            $data['home_city']=$home_city;
            $data['list']=$this->mdl_extra_report->GetCitywiseDonationType($cityname,$cityid,$ordercity);
            $this->load->view('report_citywise_donationtype_result',$data);
        }elseif ($this->input->post('pdf')) {
            $data['home_city']=$home_city;
            $data['list']=$this->mdl_extra_report->GetCitywiseDonationType($cityname,$cityid,$ordercity);
            $this->load->view('report_citywise_donationtype_pdf',$data);
        }elseif ($this->input->post('xls')) {
            $data['home_city']=$home_city;
            $data['list']=$this->mdl_extra_report->GetCitywiseDonationType($cityname,$cityid,$ordercity);
            $this->load->view('report_citywise_donationtype_xls',$data);
        }
    }

    //for donorwise Donation
    function rep_donorwiseDonation(){
        $page_details['page_title']="Ucare Foundation | Donorwise Donation";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_donorwise_donation');
    }

    function rep_donor_donation_filter(){
        $this->load->model('mdl_extra_report');
        $city=$this->input->post('donorCity');
        $donor_type=$this->input->post('donorType');
        $donor_id=$this->input->post('hdnDonorId');
        ($this->input->post('homeCity') ? $donor_home_city="1" : $donor_home_city="0");
        if($this->input->post('homeCity')){
            if($city=="0"){
                $city="d.donor_homecityid";
                $city_name="All";
            }else{
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
            }
            $city="d.donor_homecityid=".$city;
            $ordercity="d.donor_homecityid";
        }else{
            if($city=="0"){
                $city="d.donor_officecity";
                $city_name="All";
            }else{
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
            }
            $city="d.donor_officecity=".$city;
            $ordercity="d.donor_officecity";
        }
        if($donor_type=="0"){
            $donor_type="d.donortype_id";
            $donor_type_name="All";
        }else{
            try {
                $donor_type_name=$this->mdl_general->GetInfoByRow('dn_donortype','donortype_id',array('donortype_id'=>$donor_type))->donortype_name;
            } catch (Exception $e) {
                $donor_type_name="N/A";
            }
        }
        if($donor_id ==""){
            $donor_id="d.donor_id";
            $donor_name="All";
        }else{
            try {
                $donor=$this->mdl_general->GetInfoByRow('dn_donor','donor_id',array('donor_id'=>$donor_id));
                $donor_name=$donor->donor_namef.' '.$donor->donor_namem.' '.$donor->donor_namel;
            } catch (Exception $e) {
                $donor_name="N/A";
            }
        }
        
        
        if($this->input->post('show')){
            $data['city']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['donor_name']=$donor_name;
            $data['list']=$this->mdl_extra_report->GetDonorDonation($donor_id,$donor_type,$city,$ordercity);
            $data['home_city']=$donor_home_city;
            //var_dump($data);
            $this->load->view('report_donorwise_donation_result',$data);

        }elseif($this->input->post('pdf')){
            $data['city']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['donor_name']=$donor_name;
            $data['list']=$this->mdl_extra_report->GetDonorDonation($donor_id,$donor_type,$city,$ordercity);
            $data['home_city']=$donor_home_city;
            $this->load->view('report_donorwise_donation_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['city']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['donor_name']=$donor_name;
            $data['list']=$this->mdl_extra_report->GetDonorDonation($donor_id,$donor_type,$city,$ordercity);
            $data['home_city']=$donor_home_city;
            $this->load->view('report_donorwise_donation_xls',$data);
        }


    }

    function get_donor_detail(){
        $this->load->model('mdl_extra_report');
        $data=$this->mdl_extra_report->get_matching_donor($this->input->post('name'));        
        echo json_encode($data);
    }

    //for top donation 
    function rep_toptwentyDonation(){
        $page_details['page_title']="Ucare Foundation | Top N Donation";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_top_donation');
    }

    function rep_top_donation_filter(){
        $this->load->model('mdl_extra_report');
        ($this->input->post('homeCity') ? $donor_home_city="1" : $donor_home_city="0");
        $city=$this->input->post('city');
        $donor_type=$this->input->post('donorType');
        $event=$this->input->post('event');
        $donation_no=$this->input->post('donationNo');
        $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        if($this->input->post('homeCity')){
            if($city=="0"){
                $city="d.donor_homecityid";
                $city_name="All";
            }else{
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
            }
            $city="d.donor_homecityid=".$city;
            $ordercity="d.donor_homecityid";
        }else{
            if($city=="0"){
                $city="d.donor_officecity";
                $city_name="All";
            }else{
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
            }
            $city="d.donor_officecity=".$city;
            $ordercity="d.donor_officecity";
        }
        if($donor_type=="0"){
            $donor_type="d.donortype_id";
            $donor_type_name="All";
        }else{
            try {
                $donor_type_name=$this->mdl_general->GetInfoByRow('dn_donortype','donortype_id',array('donortype_id'=>$donor_type))->donortype_name;
            } catch (Exception $e) {
                $donor_type_name="N/A";
            }
        }
        if($event =="0"){
            $event="dnd.event_id";
            $event_name="All";
        }else{
            try {
                $event_name=$this->mdl_general->GetInfoByRow('dn_events','event_id',array('event_id'=>$event))->event_name;
            } catch (Exception $e) {
                $event_name="N/A";
            }
        }
        if($donation_no==""){
            $donation_no=100000;
        }
        

        if($this->input->post('show')){
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['city_name']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['event']=$event_name;
            $data['list']=$this->mdl_extra_report->GetTopDonation($from_date,$to_date,$city,$ordercity,$donor_type,$event,$donation_no);
            $data['home_city']=$donor_home_city;
            $this->load->view('report_top_donation_result',$data);

        }elseif($this->input->post('pdf')){
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['city_name']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['event']=$event_name;
            $data['list']=$this->mdl_extra_report->GetTopDonation($from_date,$to_date,$city,$ordercity,$donor_type,$event,$donation_no);
            $data['home_city']=$donor_home_city;
            $this->load->view('report_top_donation_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['city_name']=$city_name;
            $data['donor_type_name']=$donor_type_name;
            $data['event']=$event_name;
            $data['list']=$this->mdl_extra_report->GetTopDonation($from_date,$to_date,$city,$ordercity,$donor_type,$event,$donation_no);
            $data['home_city']=$donor_home_city;
            $this->load->view('report_top_donation_xls',$data);
        }
    }

    //for donation citywise

    function rep_donationcitywise(){

        $page_details['page_title']="Ucare Foundation | Report Donation Citywise";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_donation_citywise');
    }

    function rep_donation_citywise_filter(){
        $this->load->model('mdl_extra_report');
        ($this->input->post('homeCity') ? $donor_home_city="1" : $donor_home_city="0");
        $city=$this->input->post('city');
        $donation_type=$this->input->post('donationType');
        $from_amount=$this->input->post('fromAmount');
        $to_amount=$this->input->post('toAmount');
        if($this->input->post('fromDate')!=""){
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        }else{
            $from_date="dn.donation_date";
        }
        if($this->input->post('toDate')){
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        }else{
            $to_date="dn.donation_date";
        }
        
        
        if($this->input->post('homeCity')){
                if($city=="0"){
                    $city="d.donor_homecityid";
                    $city_name="All";
                }else{
                    try {
                        $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                    } catch (Exception $e) {
                        $city_name="N/A";
                    }
                }
                $city="d.donor_homecityid=".$city;
                $ordercity="d.donor_homecityid";
        }else{
                if($city=="0"){
                    $city="d.donor_officecity";
                    $city_name="All";
                }else{
                    try {
                        $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$city))->city_name;
                    } catch (Exception $e) {
                        $city_name="N/A";
                    }
                }
                $city="d.donor_officecity=".$city;
                $ordercity="d.donor_officecity";
        }
        
        if($donation_type =="0"){
            $donation_type="dnd.dt_id";
            $donation_type_name="All";
        }else{
            try {
                $donation_type_name=$this->mdl_general->GetInfoByRow('dn_donationtype','dt_id',array('dt_id'=>$donation_type))->dt_name;
            } catch (Exception $e) {
                $donation_type_name="N/A";
            }
        }
        
        if($from_amount==""){
            $from_amount="dnd.donation_amount";
        }
        
        if($to_amount ==""){
            $to_amount="dnd.donation_amount";
        }
        
        if($this->input->post('show')){
            $data['list']=$this->mdl_extra_report->GetDonationCitywiseReport($from_date,$to_date,$city,$ordercity,$donation_type,$from_amount,$to_amount);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['from_amount']=$this->input->post('fromAmount');
            $data['to_amount']=$this->input->post('toAmount');
            $data['city']=$city_name;
            $data['donation_type']=$donation_type_name;
            $this->load->view('report_donation_citywise_result',$data);

        }elseif($this->input->post('pdf')){
            $data['list']=$this->mdl_extra_report->GetDonationCitywiseReport($from_date,$to_date,$city,$ordercity,$donation_type,$from_amount,$to_amount);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['from_amount']=$this->input->post('fromAmount');
            $data['to_amount']=$this->input->post('toAmount');
            $data['city']=$city_name;
            $data['donation_type']=$donation_type_name;
            $data['home_city']=$donor_home_city;
            $this->load->view('report_donation_citywise_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['list']=$this->mdl_extra_report->GetDonationCitywiseReport($from_date,$to_date,$city,$ordercity,$donation_type,$from_amount,$to_amount);
            $data['from_date']=$this->input->post('fromDate');
            $data['to_date']=$this->input->post('toDate');
            $data['from_amount']=$this->input->post('fromAmount');
            $data['to_amount']=$this->input->post('toAmount');
            $data['city']=$city_name;
            $data['donation_type']=$donation_type_name;
            $data['home_city']=$donor_home_city;
            $this->load->view('report_donation_citywise_xls',$data);
        }

    }

    //for report active box collection summary 
    function rep_activeboxCollectionSummery(){
        $page_details['page_title']="Ucare Foundation | Report Active Box Collection Summary";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_active_box_collection');
    }

    function rep_active_box_collection_summary_filter(){
        $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        $city_id=$this->input->post('city');
        $this->load->model('mdl_extra_report');
        if($from_date==""){
            $from_date="r.donation_date";
        }
        if($to_date==""){
            $to_date="r.donation_date";
        }
        if($city_id=="0"){
            $city="r.donor_officecity= r.donor_officecity";
        }else{
            $city="r.donor_officecity=".$city_id;
        }


        if($this->input->post('show')){
            $data['list']=$this->mdl_extra_report->GetActiveBoxCollection($from_date,$to_date,$city);
            var_dump($data);
            $this->load->view('report_textalert_result',$data);

        }elseif($this->input->post('pdf')){
            
            $this->load->view('report_textalert_pdf',$data);

        }elseif($this->input->post('xls')){
            
            $this->load->view('report_textalert_xls',$data);
        }

    }


    //for test alert report 

    function rep_textAlert(){
        $page_details['page_title']="Ucare Foundation | Report Text alert";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_textalert');
    }

    function rep_text_alert_filter(){
        $this->load->model('mdl_extra_report');
        if($this->input->post('show')){
            ($this->input->post('homeCity') ? $home_city="1" : $home_city="0");
            $data['list']=$this->mdl_extra_report->GetTextAlertReport($home_city);
            $this->load->view('report_textalert_result',$data);

        }elseif($this->input->post('pdf')){
            ($this->input->post('homeCity') ? $home_city="1" : $home_city="0");
            $data['list']=$this->mdl_extra_report->GetTextAlertReport($home_city);
            $this->load->view('report_textalert_pdf',$data);

        }elseif($this->input->post('xls')){
            ($this->input->post('homeCity') ? $home_city="1" : $home_city="0");
            $data['list']=$this->mdl_extra_report->GetTextAlertReport($home_city);
            $this->load->view('report_textalert_xls',$data);
        }
    }


    //for pledge summary report
    function pledgesummary (){
        $page_details['page_title']="Ucare Foundation | Report Pledge Summary";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_pledgesummary');
    }

    function rep_pledgesummary_filter(){
        $this->load->model('mdl_extra_report');
        ($this->input->post('donorEmail') ? $donor_email="1" : $donor_email="donor_sendmail");
        ($this->input->post('donorTextAlert') ? $donor_text_alert="1" : $donor_text_alert="donor_textalert");
        ($this->input->post('donorBoxDonor') ? $donor_box_donor="1" : $donor_box_donor="donor_box");
        ($this->input->post('donorVIP') ? $donor_vip="1" : $donor_vip="donor_vip");
        ($this->input->post('donorCardSend') ? $donor_card_send="1" : $donor_card_send="donor_cardsend");
        ($this->input->post('donorNews') ? $donor_news="1" : $donor_news="donor_sendnews");
        ($this->input->post('donorDataSharing') ? $donor_data_sharing="1" : $donor_data_sharing="donor_sharedata");
        ($this->input->post('donorMuslim') ? $donor_muslim="1" : $donor_muslim="donor_muslim");
        ($this->input->post('donorCommittee') ? $donor_committee="1" : $donor_committee="donor_committee");
        ($this->input->post('donorMailOfficeAddress') ? $donor_mail_office="1" : $donor_mail_office="donor_homeletter");
        $pledge_city=$this->input->post('pledgeCity');
        $pledge_donor_type=$this->input->post('pledgeDonorType');
        $pledge_event=$this->input->post('pledgeEvent');
        $pledge_paid=$this->input->post('pledgePaid');//0=all ,1 =unpaid ,2=paid
        if($this->input->post('fromDate')){
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        }else{
            $from_date="dn.dp_date";
        }
        if($this->input->post('toDate')){
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        }else{
            $to_date="dp.dp_date";
        }
        if($this->input->post('donorCity')){
            if($pledge_city =="0"){
                $pledge_city="d.donor_homecityid";
                $city_name="All";
            }
            $pledge_city="d.donor_homecityid=".$pledge_city;
            try {
                $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$pledge_city))->city_name;
            } catch (Exception $e) {
                $city_name="N/A";
            }
        }else{
            if($pledge_city =="0"){
                $pledge_city="d.donor_officecity";
                $city_name="All";
            }
            $pledge_city="d.donor_officecity=".$pledge_city;
            try {
                $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$pledge_city))->city_name;
            } catch (Exception $e) {
                $city_name="N/A";
            }
        }
        if($pledge_donor_type=="0"){
            $pledge_donor_type = "d.donortype_id=d.donortype_id";
            $donor_type_name="All";
        }else{
            $pledge_donor_type="d.donortype_id=".$pledge_donor_type;
            try {
                $donor_type_name=$this->mdl_general->GetInfoByRow('dn_donortype','donortype_id',array('donortype_id'=>$pledge_donor_type))->donortype_name;
            } catch (Exception $e) {
                $donor_type_name="N/A";
            }
        }
        if($pledge_event =="0"){
            $pledge_event="dnd.event_id=dnd.event_id";
            $event_name="All";
        }else{
            $pledge_event="dnd.event_id=".$pledge_event;
            try {
                $event_name=$this->mdl_general->GetInfoByRow('dn_events','event_id',array('event_id'=>$pledge_event))->event_name;
            } catch (Exception $e) {
                $event_name="N/A";
            }
        }
        
        
        //var_dump($data);

        if($this->input->post('show')){
            $data['pledge_paid']=$pledge_paid;
            $data['city']=$city_name;
            $data['event']=$event_name;
            $data['donor_type']=$donor_type_name;
            $data['to_date']=$this->input->post('toDate');
            $data['from_date']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetPledgeReport($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_date,$to_date,$pledge_city,$pledge_donor_type,$pledge_event);
            $this->load->view('report_pledgesummary_result',$data);

        }elseif($this->input->post('pdf')){
            $data['pledge_paid']=$pledge_paid;
            $data['city']=$city_name;
            $data['event']=$event_name;
            $data['donor_type']=$donor_type_name;
            $data['to_date']=$this->input->post('toDate');
            $data['from_date']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetPledgeReport($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_date,$to_date,$pledge_city,$pledge_donor_type,$pledge_event);
            $this->load->view('report_pledgesummary_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['pledge_paid']=$pledge_paid;
            $data['city']=$city_name;
            $data['event']=$event_name;
            $data['donor_type']=$donor_type_name;
            $data['to_date']=$this->input->post('toDate');
            $data['from_date']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetPledgeReport($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_date,$to_date,$pledge_city,$pledge_donor_type,$pledge_event);
            $this->load->view('report_pledgesummary_xls',$data);
        }
        
        
    }

    //for income summary

    function rep_incomesummary(){
        $page_details['page_title']="Ucare Foundation | Report income summary";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_income_summary');
    }

    function rep_income_summary_filter(){
        $this->load->model('mdl_extra_report');
        
        if($this->input->post('fromDate')!=""){
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        }else{
            $from_date="oti.date";
        }
        if($this->input->post('toDate')){
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        }else{
            $to_date="oti.date";
        }
        if($this->input->post('show')){
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetIncomeReport($from_date,$to_date);
            $this->load->view('report_income_summary_result',$data);

        }elseif($this->input->post('pdf')){
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetIncomeReport($from_date,$to_date);
            $this->load->view('report_income_summary_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetIncomeReport($from_date,$to_date);
            $this->load->view('report_income_summary_xls',$data);
        }
    }


    //for giftaid consent report
    function rep_giftaidconsent(){
        $page_details['page_title']="Ucare Foundation | Report route";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_giftaid');
    }

    function rep_giftaidconsent_filter(){
        $this->load->model('mdl_extra_report');
        if($this->input->post('show')){
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
            $data['list']=$this->mdl_extra_report->GetGiftAidReport($from_date,$to_date);

            $this->load->view('report_giftaid_result',$data);

        }elseif($this->input->post('pdf')){
            ini_set('memory_limit', '-1');
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
            $data['list']=$this->mdl_extra_report->GetGiftAidReport($from_date,$to_date);
            $this->load->view('report_giftaid_result_pdf',$data);

        }elseif($this->input->post('xls')){
            $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
            $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
            $data['list']=$this->mdl_extra_report->GetGiftAidReport($from_date,$to_date);
            $this->load->view('report_giftaid_result_xls',$data);
        }
    }



    //for route report
    function rep_route(){
        $page_details['page_title']="Ucare Foundation | Report route";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_route');
    }

    function rep_route_filter(){
        if($this->input->post('show')){
            $root_id=$this->input->post('routeId');
            if($root_id=="0"){
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id');
                $this->load->view('report_route_result',$data);
            }else{
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id',array('root_id'=>$root_id));
                $this->load->view('report_route_result',$data);
            }
            
        }elseif($this->input->post('pdf')){
            $root_id=$this->input->post('routeId');
            if($root_id=="0"){
                
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id');
                $this->load->view('report_route_result_pdf',$data);
            }else{
                
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id',array('root_id'=>$root_id));
                $this->load->view('report_route_result_pdf',$data);
            }
        }elseif($this->input->post('xls')){
            $root_id=$this->input->post('routeId');
            if($root_id=="0"){
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id');
                $this->load->view('report_route_result_xls',$data);
            }else{
                $data['route_list']=$this->mdl_general->GetAllInfo('dn_root','root_id',array('root_id'=>$root_id));
                $this->load->view('report_route_result_xls',$data);
            }
        }

    }

    //for donor report city wise
    function rep_donorcitywise(){
        
        $page_details['page_title']="Ucare Foundation | Report donor citywise";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_donorcitywise');
    }

    function rep_donorcitywise_filter(){
        $this->load->model('mdl_extra_report');
        ($this->input->post('donorHomeCity') ? $donor_homecity= "1" : $donor_homecity ="0");
        ($this->input->post('donorEmail') ? $donor_email="1" : $donor_email="d.donor_sendmail");
        ($this->input->post('donorTextAlert') ? $donor_text_alert="1" : $donor_text_alert="d.donor_textalert");
        ($this->input->post('donorBoxDonor') ? $donor_box_donor="1" : $donor_box_donor="d.donor_box");
        ($this->input->post('donorVIP') ? $donor_vip="1" : $donor_vip="d.donor_vip");
        ($this->input->post('donorCardSend') ? $donor_card_send="1" : $donor_card_send="d.donor_cardsend");
        ($this->input->post('donorNews') ? $donor_news="1" : $donor_news="d.donor_sendnews");
        ($this->input->post('donorDataSharing') ? $donor_data_sharing="1" : $donor_data_sharing="d.donor_sharedata");
        ($this->input->post('donorMuslim') ? $donor_muslim="1" : $donor_muslim="d.donor_muslim");
        ($this->input->post('donorCommittee') ? $donor_committee="1" : $donor_committee="d.donor_committee");
        ($this->input->post('donorMailOfficeAddress') ? $donor_mail_office="1" : $donor_mail_office="d.donor_homeletter");
        $donor_city=$this->input->post('donorCity');

        if($this->input->post('donorHomeCity')){
                if($donor_city=="0"){
                    $donor_city="d.donor_homecityid";
                    $city_name="All";
                }
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$donor_city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
                $city="d.donor_homecityid=".$donor_city;
                $ordercity="d.donor_homecityid";
        }else{
                if($donor_city=="0"){
                    $donor_city="d.donor_officecity";
                    $city_name="All";
                }
                try {
                    $city_name=$this->mdl_general->GetInfoByRow('dn_city','city_id',array('city_id'=>$donor_city))->city_name;
                } catch (Exception $e) {
                    $city_name="N/A";
                }
                $city="d.donor_officecity=".$donor_city;
                $ordercity="d.donor_officecity";
        }
        
        
        if($this->input->post('show')){
            
            $data['city_name']=$city_name;
            $data['home_city']=$donor_homecity;
            $data['list']=$this->mdl_extra_report->GetDonorCityWise($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$city,$ordercity);
            //var_dump($data);
            $this->load->view('report_donorcitywise_result',$data);
            
        }elseif($this->input->post('pdf')){
            $data['city_name']=$city_name;
            $data['home_city']=$donor_homecity;
            $data['list']=$this->mdl_extra_report->GetDonorCityWise($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$city,$ordercity);
            $this->load->view('report_donorcitywise_pdf',$data);
        }elseif($this->input->post('xls')){
            $data['city_name']=$city_name;
            $data['home_city']=$donor_homecity;
            $data['list']=$this->mdl_extra_report->GetDonorCityWise($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$city,$ordercity);
            $this->load->view('report_donorcitywise_xls',$data);
        }
        
        

    }

    //for expense summary 

    function expensesummary(){
        $page_details['page_title']="Ucare Foundation | Report Expense Summary";
        $this->load->module('header')->index($page_details);
        $this->load->view('report_expensesummary');
    }

    function rep_expense_summary_filter(){
        $this->load->model('mdl_extra_report');
        $from_date=date('Y-m-d',strtotime($this->input->post('fromDate')));
        $to_date=date('Y-m-d',strtotime($this->input->post('toDate')));
        $supplier=$this->input->post('supplier');
        if($supplier=="0"){
            $supplier="i.sup_id";
        }
        if($this->input->post('show')){
            $data['list']=$this->mdl_extra_report->GetExpenseSummary($from_date,$to_date,$supplier);
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $this->load->view('report_expensesummary_result',$data);

        }elseif($this->input->post('pdf')){
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetExpenseSummary($from_date,$to_date,$supplier);
            $this->load->view('report_expensesummary_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['to']=$this->input->post('toDate');
            $data['from']=$this->input->post('fromDate');
            $data['list']=$this->mdl_extra_report->GetExpenseSummary($from_date,$to_date,$supplier);
            $this->load->view('report_expensesummary_xls',$data);
        }
    }

     function rep_project_child(){
        $page_details['page_title']="Ucare Foundation | Report Project Child";
        $this->load->module('header')->index($page_details);
        $this->load->view('rep_project_child');
    }
    function rep_project_child_filter(){
        $this->load->model('mdl_extra_report');
        

        $psite_id=$this->input->post('payment_projectsite');
        $status_id=$this->input->post('orphan_status');
        
        if($this->input->post('show')){
            $data['list']=$this->mdl_extra_report->getOrphanChildName($psite_id, $status_id);
            $this->load->view('rep_project_child_result',$data);

        }elseif($this->input->post('pdf')){
            
            $data['list']=$this->mdl_extra_report->getOrphanChildName($psite_id, $status_id);
            $this->load->view('report_expensesummary_pdf',$data);

        }elseif($this->input->post('xls')){
            $data['list']=$this->mdl_extra_report->getOrphanChildName($psite_id, $status_id);
            $this->load->view('report_expensesummary_xls',$data);
        }
    }
    
}

