<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sidebar extends MX_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('mdl_general');
        
        
    }

    function index(){
    	$this->load->view('sidebar');
    }

    function customer(){
        $this->load->view('sidebar-customer');
    }
}