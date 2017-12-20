<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class chart extends MX_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        
        
    }

    function index(){
    	$main_title=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>1));
    	$page_details['page_title']= $main_title->cherity_name.' | Charts';
        $this->load->Module('header')->index($page_details);
    	$this->load->view('chart');
    }
}