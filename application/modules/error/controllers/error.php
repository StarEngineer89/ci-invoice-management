<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MX_Controller{

	function index(){
		$this->load->view('error_404');
	}
}