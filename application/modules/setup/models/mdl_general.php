<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_general extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function SaveForm($table,$form_data) {
        $this->db->insert($table, $form_data);
        if ($this->db->affected_rows() == '1') {
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function GetAllInfo($table,$order_by,$data = null, $num = null, $offset = null) {
        $this->db->order_by($order_by, 'DESC');
        if ($data != null)
            $this->db->where($data);
        return $this->db->get($table, $num, $offset)->result_array();
    }
    public function GetAllInfoASC($table,$order_by,$data = null, $num = null, $offset = null) {
        $this->db->order_by($order_by, 'ASC');
        if ($data != null)
            $this->db->where($data);
        return $this->db->get($table, $num, $offset)->result_array();
    }

    public function Delete($table,$data) {
        if ($this->db->delete($table, $data))
            return "successfully removed";
        else
            return "deletion unsuccessful";
    }

    public function GetInfoByRow($table,$order_by,$data = null) {
        $this->db->order_by($order_by, 'DESC');
        $this->db->where($data);
        $query = $this->db->get($table)->row();
        if (empty($query)){
          // throw new Exception("No result");
            return '';
        }else{
            return $query;
        }
    }

    public function Manage($table,$data, $where, $type) {
        $this->db->where($where);
        if ($this->db->update($table, $data))
            return True;
        else
            return False;
    }

	public function getPaymentList()
	{
		$query=$this->db->query("SELECT approval_date,pf.payment_id,transferredMode,CONCAT(`orphan_fname`,' ', `orphan_mname`, '', `orphan_lname`) AS orphan_name,CONCAT(`donor_namef`,' ', `donor_namem`, '', `donor_namel`) AS donor_name,support_amount,support_type,transferred_date 
FROM dn_payment_info pf LEFT JOIN dn_payment_donor pd ON pf.`payment_id`=pd.`payment_id` 
LEFT JOIN dn_orphanregistration of ON pd.`orphan_id`=of.`orphan_id` 
LEFT JOIN dn_donor dr ON pd.`donor_id`=dr.`donor_id`");
									
		return $query->result_array();
		
	}
}

?>