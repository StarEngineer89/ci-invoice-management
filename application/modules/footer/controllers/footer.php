<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Footer extends MX_Controller{
	function __construct() {
        parent::__construct();
        
    }

    function index(){
    	$this->load->view('footer');
    }
}