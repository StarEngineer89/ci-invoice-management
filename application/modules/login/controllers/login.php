<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller{

	function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        $this->load->library('session');
        //$this->load->library('facebook'); 
    }
    function index(){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        if($this->session->userdata('sess_logged_in')==true){
            redirect('dashboard');
        }
    	$data['page_title']=$main_title->cherity_name.' | Login';
        //$data['facebook_login_url']=$this->facebook->get_login_url();
        $this->load->view('login_header',$data);
        $this->load->view('login',$data);
    	$this->load->view('login_footer');

    }

    function customer(){
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        if($this->session->userdata('sess_logged_in')==true){
            redirect('dashboard');
        }
        $data['page_title']=$main_title->cherity_name.' | Login';
        //$data['facebook_login_url']=$this->facebook->get_login_url();
        $this->load->view('login_header',$data);
        $this->load->view('login-customer',$data);
        $this->load->view('login_footer');

    }

    function do_login(){
    	$username=trim($this->input->post('user_logname'));
    	$password=trim($this->input->post('user_pass'));
        $encrpt_pass = sha1($password);
    	$logindate = date("Y-m-d");
        $user=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_logname'=>$username,'u_password'=>$encrpt_pass));
        if($user){//user available in database

    		if($user->u_enabled !='1'){//is user is disabled?
    			redirect('login/index?error=2');
    		}else{//do the login ,set the session and redirect dashboard
    			$session_data=array(
    				'sess_user_id'=>$user->u_id,
                    'sess_user_name'=>$user->u_name,
                    'sess_psite_id'=>$user->psite_id,
					'sess_country_id'=>$user->country_id,
					'sess_header_bg'=>$user->header_bg,
					'sess_footer_bg'=>$user->footer_bg,
    				'sess_logged_in'=>true
    				);
    			$this->session->set_userdata($session_data);
    			redirect('dashboard');
    		}
    	}else{//username not available in database
    		redirect('login/index?error=1');
    	}
    }

    function do_login_by_email(){
        $username=trim($this->input->get('user_email'));
        $password=trim($this->input->get('user_pass'));
        $encrpt_pass = sha1($password);
        $logindate = date("Y-m-d");
        $user=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_email'=>$username,'u_password'=>$encrpt_pass));
        if($user){//user available in database

            if($user->u_enabled !='1'){//is user is disabled?
                redirect('login/index?error=2');
            }else{//do the login ,set the session and redirect dashboard
                $session_data=array(
                    'sess_user_id'=>$user->u_id,
                    'sess_user_name'=>$user->u_name,
                    'sess_psite_id'=>$user->psite_id,
                    'sess_country_id'=>$user->country_id,
                    'sess_header_bg'=>$user->header_bg,
                    'sess_footer_bg'=>$user->footer_bg,
                    'sess_logged_in'=>true
                );
                $this->session->set_userdata($session_data);
                redirect('dashboard');
            }
        }else{//username not available in database
            redirect('login/index?error=1');
        }
    }

    function do_login_customer(){
        $username=trim($this->input->post('user_email'));
        $password=trim($this->input->post('user_pass'));
        $encrpt_pass = sha1($password);
        $logindate = date("Y-m-d");
        $user=$this->mdl_general->GetInfoByRow('ims_customer_info','customer_id',array('customer_email'=>$username,'password'=>$encrpt_pass));
        if($user){//user available in database

            if($user->active !='1'){//is user is disabled?
                redirect('customer/login?error=2');
            }else{//do the login ,set the session and redirect dashboard
                $session_data=array(
                    'sess_customer_id' => $user->customer_id,
                    'sess_user_name'=>$user->fname . " " . $user->mname . " " . $user->lname,
                    'sess_logged_in'=>true
                );
                $this->session->set_userdata($session_data);
                redirect('customer/index');
            }
        }else{//username not available in database
            redirect('customer/login?error=1');
        }
    }

    function logout(){
    	//unsetting data from session and redirect to login page
    	$session_data=array(
    		'sess_user_id'=>'',
    		'sess_user_name'=>'',
    		'sess_logged_in'=>false
    		);
    	$this->session->set_userdata($session_data);

    	redirect('login');
    }

    public function handle_facebook_response(){
        $fb_data=$this->facebook->validate();
        
        //array to store data in database
        $user=$this->mdl_general->GetInfoByRow('acs_user','u_id',array('u_email'=>$fb_data['email']));
        
        if(!is_null($user)){
            $session_data=array(
                'sess_user_id'=>$user->u_id,
                'sess_user_name'=>$user->u_name,
                'sess_logged_in'=>true
                );
            $this->session->set_userdata($session_data);
            
        }else{
            $data=array(
                'u_name'=>$fb_data['name'],
                'u_email'=>$fb_data['email'],
                'u_enabled'=>'1',
                'source'=>'facebook'//,
                // 'profile_pic'=>"http://graph.facebook.com/".$fb_data['id']."/picture?width=800",
                // 'link'=>$fb_data['link']
            );
            $user_id=$this->mdl_general->SaveForm('acs_user',$data);
            $session_data=array(
                'sess_user_id'=>$user_id,
                'sess_user_name'=>$fb_data['name'],
                'sess_logged_in'=>true
                );
            $this->session->set_userdata($session_data);
        }
        
        redirect('dashboard');

    }
}