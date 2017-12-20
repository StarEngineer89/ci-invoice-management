<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_extra_sidebar extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function GetPermittedMenuItem($type,$user_id) {
        $this->db->order_by('acs_menu.menu_order', 'ASC');
        $this->db->where('acs_menu.mt_id',$type);
        $this->db->where('acs_user.u_id',$user_id);
        $this->db->where('acs_userd.u_view','1');
        $this->db->from('acs_menu');
        $this->db->join('acs_userd','acs_menu.menu_id=acs_userd.menu_id');
        $this->db->join('acs_user','acs_user.u_id=acs_userd.u_id');
        return $this->db->get()->result_array();
    }

    
}