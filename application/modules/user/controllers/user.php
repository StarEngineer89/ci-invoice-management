<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/16/2017
 * Time: 7:29 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        $this->load->library('session');
        if($this->session->userdata('sess_logged_in')!=true){
            redirect('login/index?error=4');
        }
    }

    public function changePassword() {
        $main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
        $page_details['page_title']= $main_title->cherity_name.' | Change your Password';

        $data = array();
        $data['email'] = $this->input->get('email');

        $this->load->module('header')->index($page_details);
        $this->load->view('change-password', $data);
    }

    public function updatePassword() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');

        if ($password == $confirm) {
            $encrpt_pass = sha1($password);
        }

        $result = $this->mdl_general->Manage('acs_user', array('u_password'=>$encrpt_pass), array('u_email' => $email), 1);

        if ($result) {
            redirect("login/do_login_by_email?user_email=$email&user_pass=$password");
        } else {
            redirect("user/changepassword?email=$email");
        }
    }
}