<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Header extends MX_Controller{
	function __construct() {
        parent::__construct();
        
    }

    function index($page_data){
    	$this->load->view('header',$page_data);
    }
}