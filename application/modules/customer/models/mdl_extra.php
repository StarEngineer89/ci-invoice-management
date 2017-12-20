<?php 
class mdl_extra extends CI_model{

	function __construct() {
        parent::__construct();
    }

  public function get_customer_detail($name){
        $this->db->order_by('customer_id', 'DESC');
        $this->db->like('fname', $name);
        $this->db->or_like('mname', $name);
        $this->db->or_like('lname', $name);
        $this->db->or_like('home_address', $name);
        $this->db->from('ims_customer_info');
        return $this->db->get()->result_array();

    }

    public function getCustomerOrder($where = null, $groupby = null){
        $sql = $this->db->query("SELECT om.orderid, om.order_date, s.description as order_status, om.remarks,
            om.total_order, om.discount, om.customer_id, om.camera_required, om.mixer, om.studio, om.album_type,
            om.no_of_album, concat(ci.fname, ' ',ci.mname,' ',ci.lname) as complete_name,
            concat(ci.home_address, '-', ci.home_postcode) as home_address, ci.business_name,
            concat(ci.office_address, '-', ci.office_postcode) as office_address, ci.customer_email, ci.mobile_no,
            od.album_id, od.amount, os.service_id, rs.description as service_description, rs.vat as stat_vat, s.*,
            substring(ac.vat_percent, 1,2)/100 as vat_percent,
            (od.amount * od.quantity) totalperItem, od.quantity
            FROM ims_ordermaster om 
            LEFT OUTER JOIN  `ims_customer_info` ci ON om.customer_id=ci.customer_id
            LEFT OUTER JOIN ims_orderdetails od ON om.orderid = od.order_id
            LEFT OUTER JOIN ims_order_services os ON od.order_id = os.order_id and od.album_id = os.service_id
            LEFT OUTER JOIN ims_required_services rs ON os.service_id = rs.service_id
            LEFT OUTER JOIN ims_status s ON om.order_status = s.status_id
            LEFT OUTER JOIN acs_configration ac ON ac.config_id = 1
            $where
            $groupby
            order by om.orderid
            ")->result_array();
        return $sql;
    }
    public function truncate_table($table = null){
        $this->db->truncate($table);
    }
    public function getInvoiceDetails($where = null, $groupby = null){
        $sql = $this->db->query("SELECT im.*, om.order_date, om.order_status, om.total_order, om.discount,
                '' as VAT, ci.customer_id, concat(ci.fname, ' ',ci.mname,' ',ci.lname) as complete_name,
                concat(ci.home_address, '-', ci.home_postcode) as home_address, ci.business_name,
                concat(ci.office_address, '-', ci.office_postcode) as office_address, ci.customer_email,
                ci.mobile_no, pm.description as paymentmode, s.*
                FROM ims_invoicemaster im
                LEFT OUTER JOIN ims_ordermaster om ON im.order_no = om.orderid
                LEFT OUTER JOIN ims_customer_info ci ON om.customer_id = ci.customer_id
                LEFT OUTER JOIN ims_paymentmode pm ON im.paymentmode_id = pm.paymentmode_id
                LEFT OUTER JOIN ims_status s ON im.invoice_status = s.status_id
                $where
                $groupby
                ")->result_array();
        return $sql;
    }
     public function getDeliveryNoteDetails($where = null, $groupby = null){
        $sql = $this->db->query("SELECT dn.*, om.order_date, om.order_status, om.total_order, om.discount,
                '' as VAT, ci.customer_id, concat(ci.fname, ' ',ci.mname,' ',ci.lname) as complete_name,
                concat(ci.home_address, '-', ci.home_postcode) as home_address, ci.business_name,
                concat(ci.office_address, '-', ci.office_postcode) as office_address, ci.customer_email,
                ci.mobile_no, s.*
                FROM ims_delivery_note dn
                LEFT OUTER JOIN ims_ordermaster om ON dn.order_no = om.orderid
                LEFT OUTER JOIN ims_customer_info ci ON om.customer_id = ci.customer_id
                LEFT OUTER JOIN ims_status s ON dn.delivery_status = s.status_id
                $where
                $groupby
                ")->result_array();
        return $sql;
    }
    public function getMaxDetails($table= null, $field=null){
        $this->db->select_max($field);
        $query = $this->db->get($table)->result_array();
        return $query[0];
    }
    public function getOrderNoforInvoice(){
        $query = $this->db->query("SELECT o.Orderid, i.balance, i.balance_status FROM `ims_ordermaster` o
                LEFT OUTER JOIN ims_invoicemaster i ON o.orderid = i.order_no
                WHERE i.balance_status <> 0
                OR i.balance is null")->result_array();
        return $query;
    }
    public function get_field($table=null)
    {
    $result = $this->db->list_fields($table);
        foreach($result as $field)
            {
                $data[] = '{'.$field.'}';
            }
        return $data;
    }
}