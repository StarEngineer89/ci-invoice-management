<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller{

	function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        $this->load->model('mdl_extra_dashboard');
        $this->load->library('session');
        if($this->session->userdata('sess_logged_in')!=true){
    			redirect('login/index?error=4');
        }

        
    }

    function index(){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
    	$page_details['page_title']= $main_title->cherity_name.' | Dashboard';
        $this->load->Module('header')->index($page_details);
    	$this->load->view('dashboard');
    }
    public function month_summary_graph(){
        $data_points = array();
        $month = array( '01' => 'January', '02' => 'Febuary', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10'=> 'October', '11'=> 'November', '12'=> 'December' );
        $monthlyreport = $this->mdl_extra_dashboard->getdonationMonthly(date('Y'));
        foreach ($monthlyreport as $row) {
            $point = array("label" => $month[$row['Month']] , "y" => $row['total']);
            array_push($data_points, $point);        
        }
        echo json_encode($data_points, JSON_NUMERIC_CHECK);
    }

    public function yearly_summary_graph(){
        $data_points = array();
        $monthlyreport = $this->mdl_extra_dashboard->getdonationYearly();
        foreach ($monthlyreport as $row) {
            $point = array("label" => $row['Year'] , "y" => $row['total']);
            array_push($data_points, $point);        
        }
        echo json_encode($data_points, JSON_NUMERIC_CHECK);
    }

    function change_password(){
        $current_pass=$this->input->post('currentPassword');
        $new_pass=$this->input->post('newPassword');
        $confirm_pass=$this->input->post('confirmNewPassword');
        if($new_pass == $confirm_pass){
            //if new password is equal to confirm password
            //get user details
            $u_details=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_id'=>$this->session->userdata('sess_user_id')));
            //check if the current password is correct
        if($u_details->u_password == $current_pass){
            //password match found and update password
            $this->mdl_general->Manage('acs_user',array('u_password'=>$new_pass),array('u_id'=>$this->session->userdata('sess_user_id')),'Update');
            $response=array(
                'status'=>'success',
                'message'=>'Password change successful'
                );
            //send response back to client
            $this->session->set_flashdata($response);
            redirect('dashboard');
        }else{
            //password doesnt match with database
            $response=array('status'=>'danger','message'=>'Incorrect password,try again!');
            $this->session->set_flashdata($response);
            redirect('dashboard');
        }


        }else{
            //new password is not equal to confirm password
            $response=array(
                'status'=>'danger',
                'message'=>'New password and Confirm password does not match'
                );
            $this->session->set_flashdata($response);
            redirect('dashboard');


        }     
    }

}