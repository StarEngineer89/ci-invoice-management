<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_extra_report extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_matching_donor($name){
        $this->db->order_by('donor_id', 'DESC');
        $this->db->like('donor_namef', $name);
        $this->db->or_like('donor_namem', $name);
        $this->db->or_like('donor_namel', $name);
        $this->db->or_like('donor_id', $name);
        $this->db->from('dn_donor');
        $this->db->join('dn_donortype','dn_donor.donortype_id=dn_donortype.donortype_id','left');
        return $this->db->get()->result_array();

    }
    //for getting gift aid report
    function GetGiftAidReport($from,$to){
    	$query= $this->db->query("SELECT t.title_name,d.donor_namef,d.donorhome_address,d.donor_postcode, d.donor_namel, dn.donor_id, dn.donation_date, sum(dnd.donation_amount) AS donation_amount, e.event_name, dn.donor_name
                                FROM dn_donor AS d INNER JOIN dn_donation AS dn ON ( d.donor_id = dn.donor_id )
                                INNER JOIN dn_donationd AS dnd ON (dnd.donation_id = dn.donation_id  ) 
                                INNER JOIN dn_title AS t on(d.title_id=t.title_id)
                                INNER JOIN dn_events AS e ON dnd.event_id = e.event_id
                                WHERE dn.donation_date >= '$from' AND dn.donation_date <= '$to' AND dnd.giftaid_consent = 1
                                GROUP BY d.donor_namef, d.donor_namem, d.donor_namel, dn.donor_id, dn.donation_date
                                ORDER BY d.donor_namef, d.donor_namem, d.donor_namel")->result_array();
        return $query;
        

    }

    function GetPledgeReport($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_date,$to_date,$pledge_city,$pledge_donor_type,$pledge_event){
        $query=$this->db->query("SELECT d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_officeaddress,
                                        d.donor_postcode, d.donor_officepostcode,  d.donor_mobile, d.donor_email, c.city_name  as officecity,
                                        hm.city_name as homecity, IFNULL(dp.dp_amount,0) AS dp_amount, IFNULL(sum(dnd.donation_amount),0) AS received
                                FROM ((((dn_donor AS d LEFT OUTER JOIN dn_donorpledges AS dp ON d.donor_id= dp.donor_id)
                                LEFT OUTER JOIN dn_city AS c ON c.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_city AS hm ON hm.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_donationd AS dnd ON dnd.dpledge_id = dp.dp_id)
                                WHERE   d.donor_sendmail=".$donor_email." AND
                                        d.donor_textalert=".$donor_text_alert." AND 
                                        d.donor_box = ".$donor_box_donor." AND
                                        d.donor_vip = ".$donor_vip." AND
                                        d.donor_cardsend = ".$donor_card_send." AND
                                        d.donor_sendnews =".$donor_news." AND
                                        d.donor_sharedata = ".$donor_data_sharing." AND
                                        d.donor_muslim = ".$donor_muslim." AND
                                        d.donor_committee = ".$donor_committee." AND
                                        d.donor_homeletter = ".$donor_mail_office." AND
                                        dp.dp_date >= '$from_date' AND
                                        dp.dp_date <= '$to_date' AND $pledge_city AND ".$pledge_donor_type." AND ".$pledge_event." 
                                GROUP BY    d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_officeaddress, 
                                            d.donor_postcode, d.donor_officepostcode,  d.donor_mobile, d.donor_email, officecity,
                                            homecity, dp_amount")->result_array();
        return $query;
    }

    

    //for getting total donation amount
    function GetTotalDonationAmount($donation_id) {
        $this->db->where('donation_id',$donation_id);
        $this->db->select_sum('donation_amount');
        $query = $this->db->get('dn_donationd')->row()->donation_amount;

        if (empty($query)){
          throw new Exception("No result");
        }else{
            return $query;
        }
       
    }

    //for getting text alert report

    function GetTextAlertReport($home_city){
        if($home_city =="1"){
            $query=$this->db->query("SELECT d.donor_id,d.donor_namef,d.donor_namem, d.donor_namel, d.donor_homecityid AS cityid, c.city_name AS cityname,d.donor_mobile
                                    FROM dn_donor AS d, dn_city AS c
                                    WHERE c.city_id = d.donor_homecityid AND d.donor_mobile !='' ")->result_array();
            return $query;
        }else{
            $query=$this->db->query("SELECT d.donor_id,d.donor_namef,d.donor_namem,d.donor_namel,d.donor_officecity AS cityid,c.city_name AS cityname,d.donor_mobile
                                    FROM dn_donor AS d, dn_city AS c
                                    WHERE c.city_id = d.donor_officecity AND d.donor_mobile !='' ")->result_array();
            return $query;
            
        }

    }

    function GetActiveBoxCollection($from_date,$to_date,$city){
        $query=$this->db->query("   SELECT r.root_id, r.root_name, r.currency_name, IFNULL(r.donation_amount,0) AS donation_amount, IFNULL(a.activebox,0) AS activebox, IFNULL(i.inactivebox,0) AS inactivebox
                                    FROM boxsummary_vu AS r LEFT OUTER JOIN 
                                    (SELECT root_id, count(*) AS activebox FROM dn_box WHERE box_active = 1) AS a ON r.root_id = a.root_id
                                    LEFT OUTER JOIN(SELECT root_id, count(*) AS inactivebox FROM dn_box WHERE box_active = 0) AS i ON r.root_id = i.root_id
                                    WHERE r.donation_date >= '$from_date' AND r.donation_date <= '$to_date' AND ".$city." ")->result_array();
        return $query;
    }

    //for getting donor city wise

    function GetDonorCityWise($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$city,$ordercity){
        $query=$this->db->query("SELECT d.donor_namef,d.donor_id, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_postcode, c.city_name AS homecity, d.donor_homephone, d.donor_mobile, d.donor_businessname, d.donor_officeaddress, x.city_name AS officecity, d.donor_officepostcode, d.donor_officephone, d.donor_email, d.donor_officecity, d.donor_homecityid
                                FROM dn_donor AS d, dn_city AS c,(select city_id, city_name FROM dn_city) x
                                WHERE   x.city_id = d.donor_officecity AND
                                        c.city_id = d.donor_homecityid AND
                                        d.donor_sendmail=".$donor_email." AND
                                        d.donor_textalert=".$donor_text_alert." AND
                                        d.donor_box = ".$donor_box_donor." AND
                                        d.donor_vip = ".$donor_vip." AND
                                        d.donor_cardsend = ".$donor_card_send." AND
                                        d.donor_sendnews =".$donor_news." AND
                                        d.donor_sharedata = ".$donor_data_sharing." AND
                                        d.donor_muslim = ".$donor_muslim." AND
                                        d.donor_committee = ".$donor_committee." AND
                                        d.donor_homeletter = ".$donor_mail_office." AND
                                        $city order by $ordercity")->result_array();
        return $query;
    }

    //for expense summary 

    function GetExpenseSummary($from_date,$to_date,$supplier){
        $query=$this->db->query("SELECT i.invoice_id, s.sup_name, e.event_name, c.currency_name, sum(id.amount) AS amount
            FROM ((((dn_invoiec AS i INNER JOIN dn_invoiecd AS id ON i.invoice_id = id.invoice_id)
                LEFT OUTER JOIN dn_supplier AS s ON i.sup_id = s.sup_id)
                LEFT OUTER JOIN dn_currency AS c ON i.currency_id = c.currency_id)
                LEFT OUTER JOIN dn_events AS e ON i.event_id = e.event_id)
                WHERE   i.sup_id = ".$supplier." AND 
                        i.invoice_date >='$from_date' AND 
                        i.invoice_date<='$to_date'
                GROUP BY i.invoice_id, s.sup_name, e.event_name, c.currency_name
                ORDER BY i.invoice_id")->result_array();
        return $query;
    }

    //for getting income report
    function GetIncomeReport($from_date,$to_date){
        $query=$this->db->query("SELECT oti.invoice_id, oti.date, SUM(otid.amount) AS amount, c.currency_name
            FROM ((dn_otherincome AS oti INNER JOIN dn_otherincomed AS otid ON oti.invoice_id = otid.invoice_id)
            LEFT OUTER JOIN dn_currency AS c ON oti.currency_id = c.currency_id) 
            WHERE oti.date >= '$from_date' AND oti.date <= '$to_date'
            GROUP BY oti.invoice_id, oti.date")->result_array();
        return $query;
    }

    function GetDonationCitywiseReport($from_date,$to_date,$city,$ordercity,$donation_type,$from_amount,$to_amount){
        $query=$this->db->query("SELECT d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_postcode, d.donor_homephone,
                                        d.donor_mobile, d.donor_businessname, d.donor_officeaddress, d.donor_officepostcode, d.donor_officephone,
                                        d.donor_email, d.donor_officecity, d.donor_homecityid, hc.city_name AS homecity, ofc.city_name AS officecity,
                                        dn.donor_id, sum(dnd.donation_amount) AS donation_amount ,dn.donation_date
                                FROM dn_donor AS d INNER JOIN dn_donation AS dn ON ( d.donor_id = dn.donor_id )
                                INNER JOIN dn_donationd AS dnd ON (dnd.donation_id = dn.donation_id  )
                                LEFT OUTER JOIN dn_city AS hc ON (hc.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_city AS ofc ON (ofc.city_id = d.donor_officecity)
                                WHERE   dn.donation_date >= '$from_date' AND
                                        dn.donation_date <= '$to_date' AND
                                        dn.box_id = '0' AND
                                        dnd.dt_id=".$donation_type." AND
                                        dnd.donation_amount >= ".$from_amount." AND
                                        dnd.donation_amount <= ".$to_amount."  AND $city
                                GROUP BY    d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_postcode,d.donor_homephone,
                                            d.donor_mobile, d.donor_businessname, d.donor_officeaddress, d.donor_officepostcode, d.donor_officephone,   
                                            d.donor_email, d.donor_officecity, d.donor_homecityid , dn.donor_id, hc.city_name, ofc.city_name
                                ORDER BY dn.donation_date ASC")->result_array();//$ordercity order by change
        return $query;
    }

    function GetTopDonation($from_date,$to_date,$city,$ordercity,$donor_type,$event,$donation_no){
        $query=$this->db->query("SELECT d.donor_id,d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_postcode, d.donor_homephone,
                                        d.donor_mobile, d.donor_businessname, d.donor_officeaddress, d.donor_officepostcode, d.donor_officephone,
                                        d.donor_email, d.donor_homecityid, d.donor_officecity, hc.city_name AS homecity, ofc.city_name AS officecity,
                                        dnd.donation_amount 
                                FROM dn_donor AS d INNER JOIN dn_donation AS dn ON ( d.donor_id = dn.donor_id )
                                INNER JOIN dn_donationd AS dnd ON (dnd.donation_id = dn.donation_id  )
                                LEFT OUTER JOIN dn_city AS hc ON (hc.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_city AS ofc ON (ofc.city_id = d.donor_officecity)
                                WHERE   d.donortype_id = ".$donor_type." AND dnd.event_id = ".$event." AND
                                        dn.donation_date >='$from_date' AND dn.donation_date <= '$to_date' AND $city
                                ORDER BY $ordercity, dnd.donation_amount DESC limit 0,".$donation_no."")->result_array();
        return $query;
    }

    function GetDonorDonation($donor_id,$donor_type,$city,$ordercity){
        $query=$this->db->query("SELECT d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address, d.donor_postcode, d.donor_homephone,
                                        d.donor_mobile, d.donor_businessname, d.donor_officeaddress, d.donor_officepostcode, d.donor_officephone,d.donor_email, d.donor_homecityid,
                                        d.donor_officecity, hc.city_name AS homecity, ofc.city_name AS officecity,dnd.donation_amount, c.currency_name, dn.donation_date,dn.donation_id,
                                        e.event_name, dn.donor_name, dt.dt_name as donation_type, dnd.giftaid_consent
                                FROM dn_donor AS d 
                                INNER JOIN dn_donation AS dn ON ( d.donor_id = dn.donor_id )
                                INNER JOIN dn_donationd AS dnd ON (dnd.donation_id = dn.donation_id  )
                                LEFT OUTER JOIN dn_city AS hc ON (hc.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_city AS ofc ON (ofc.city_id = d.donor_officecity)
                                LEFT OUTER JOIN dn_currency AS c ON (dnd.currency_id = c.currency_id)
                                LEFT OUTER JOIN dn_events AS e ON dnd.event_id = e.event_id
                                LEFT OUTER JOIN dn_donationtype AS dt ON dnd.dt_id = dt.dt_id
                                WHERE   d.donortype_id = ".$donor_type." AND d.donor_id = ".$donor_id." AND $city
                                ORDER BY d.donor_id,donation_id")->result_array();
        return $query;
    }
    function GetCitywiseDonationType($cityname,$cityid,$ordercity){
        $query=$this->db->query("SELECT dt.dt_name, cu.currency_name, sum(dnd.donation_amount) AS donation_amount, $cityname
                                FROM dn_donor AS d INNER JOIN dn_donation AS dn ON ( d.donor_id = dn.donor_id )
                                INNER JOIN dn_donationd AS dnd ON (dnd.donation_id = dn.donation_id  )
                                LEFT OUTER JOIN dn_city AS c ON (c.city_id = $cityid)
                                LEFT OUTER JOIN dn_currency AS cu ON (cu.currency_id = dnd.currency_id)
                                INNER JOIN dn_donationtype AS dt ON (dt.dt_id = dnd.dt_id)
                                GROUP BY dt.dt_name, cu.currency_name, $cityname
                                ORDER BY $ordercity")->result_array();
        return $query;
    }

    function GetBoxCollection($from_date,$to_date,$route){
        $query=$this->db->query("SELECT r.root_id, r.root_name, d.donor_businessname, d.donor_officeaddress, d.donor_officepostcode,
                                        d.donor_officephone, dn.box_id, dn.donation_date, dnd.donation_amount, dn.donation_id
                                FROM dn_root AS r, dn_donation AS dn, dn_donationd AS dnd, dn_donor AS d
                                WHERE   r.root_id = dn.root_id AND dn.donation_id = dnd.donation_id AND 
                                        d.donor_id = dn.donor_id AND dn.donation_date >= '$from_date' AND dn.donation_date <= '$to_date' AND $route")->result_array();
        return $query;
    }

    function GetDonorForEmail($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_amount,$to_amount,$from_date,$to_date,$donor_city,$donor_type,$donor_event){
        $query=$this->db->query("SELECT Distinct d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel,d.donor_mobile, d.donorhome_address, d.donor_homephone,
                                                 d.donor_postcode, d.donor_email, c.city_name AS hcity, d.donor_officeaddress, d.donor_officephone, 
                                                 d.donor_officepostcode, of.city_name AS ofcity, t.title_name, e.event_name 
                                FROM dn_donor AS d INNER JOIN dn_donation AS dn ON  d.donor_id = dn.donor_id
                                LEFT OUTER JOIN dn_donationd AS dnd ON dn.donation_id = dnd.donation_id    
                                LEFT OUTER JOIN dn_title AS t ON d.title_id = t.title_id 
                                LEFT OUTER JOIN dn_city AS c ON c.city_id = d.donor_homecityid
                                LEFT OUTER JOIN dn_city AS of ON of.city_id = d.donor_officecity
                                LEFT OUTER JOIN dn_events AS e ON e.event_id = dnd.event_id
                                WHERE   d.donor_sendmail=".$donor_email." AND
                                        d.donor_textalert=".$donor_text_alert." AND 
                                        d.donor_box = ".$donor_box_donor." AND
                                        d.donor_vip = ".$donor_vip." AND
                                        d.donor_cardsend = ".$donor_card_send." AND
                                        d.donor_sendnews =".$donor_news." AND
                                        d.donor_sharedata = ".$donor_data_sharing." AND
                                        d.donor_muslim = ".$donor_muslim." AND
                                        d.donor_committee = ".$donor_committee." AND
                                        d.donor_homeletter = ".$donor_mail_office." AND
                                        d.donortype_id = ".$donor_type." AND
                                        dn.donation_date >= '$from_date' AND
                                        dn.donation_date <= '$to_date' AND 
                                        dnd.donation_amount >= ".$from_amount." AND
                                        dnd.donation_amount <= ".$to_amount." AND
                                        dnd.event_id = ".$donor_event." AND $donor_city")->result_array();
        return $query;
    }

    function GetDonorForSMS($donor_email,$donor_text_alert,$donor_box_donor,$donor_vip,$donor_card_send,$donor_news,$donor_data_sharing,$donor_muslim,$donor_committee,$donor_mail_office,$from_amount,$to_amount,$from_date,$to_date,$donor_city){
        $query=$this->db->query("SELECT d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address , d.donor_officeaddress ,
                                        d.donor_homeletter, d.donor_homephone , d.donor_officephone,  d.donor_postcode  , d.donor_officepostcode,
                                        d.donor_mobile, d.donor_email,t.title_name,dn.donation_id, c.city_name  as officecity , hm.city_name as homecity,
                                        sum(dnd.donation_amount) as donation_amount
                                FROM (((((dn_donor AS d LEFT OUTER JOIN dn_donation AS dn ON d.donor_id= dn.donor_id)
                                LEFT OUTER JOIN dn_title AS t ON d.title_id = t.title_id)
                                LEFT OUTER JOIN dn_city AS c ON c.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_city AS hm ON hm.city_id = d.donor_homecityid)
                                LEFT OUTER JOIN dn_donationd  AS dnd ON dnd. donation_id = dn. donation_id)
                                WHERE   d.donor_sendmail=".$donor_email." AND
                                        d.donor_textalert=".$donor_text_alert." AND 
                                        d.donor_box = ".$donor_box_donor." AND
                                        d.donor_vip = ".$donor_vip." AND
                                        d.donor_cardsend = ".$donor_card_send."   AND
                                        d.donor_sendnews =".$donor_news." AND
                                        d.donor_sharedata = ".$donor_data_sharing." AND
                                        d.donor_muslim = ".$donor_muslim."   AND
                                        d.donor_committee = ".$donor_committee." AND
                                        d.donor_homeletter = ".$donor_mail_office." AND
                                        dn.donation_date >= '$from_date' AND
                                        dn.donation_date <= '$to_date' AND 
                                        dnd.donation_amount >= ".$from_amount." AND
                                        dnd.donation_amount <= ".$to_amount." AND $donor_city AND d.donor_textalert = 1
                            GROUP BY    d.donor_id, d.donor_namef, d.donor_namem, d.donor_namel, d.donorhome_address , d.donor_officeaddress ,
                                        d.donor_homeletter, d.donor_homephone , d.donor_officephone,  d.donor_postcode  , d.donor_officepostcode,
                                        d.donor_mobile, d.donor_email,t.title_name, officecity , homecity")->result_array();
        return $query;
    }

    function GetCashBalance($from_date,$to_date){
        $query=$this->db->query("SELECT SUM(IFNULL(dnopeningCash, 0) + IFNULL(otopeningCash,0)) AS openingCash, SUM(IFNULL(dnclosingCash,0) + IFNULL(otclosingCash,0)) AS closingCash
                                            FROM ( 
                                                SELECT SUM(dnd.donation_amount) AS dnopeningCash, 0 AS dnclosingCash,0 AS otopeningCash,0 AS otclosingCash
                                                    FROM dn_donation AS dn, dn_donationd AS dnd, dn_paymentmode AS pm
                                                    WHERE dn.donation_id = dnd.donation_id AND
                                                        dnd.pm_id = pm.pm_id AND
                                                        dn.donation_date < '$from_date' AND pm.cash = 1 GROUP BY dnclosingCash,otopeningCash, otclosingCash
                                                UNION ALL
                                                    SELECT 0 AS dnopeningCash, SUM(dnd.donation_amount) AS dnclosingCash, 0 AS otopeningCash,0 AS otclosingCash
                                                        FROM dn_donation AS dn, dn_donationd AS dnd, dn_paymentmode AS pm
                                                        WHERE dn.donation_id = dnd.donation_id AND
                                                            dnd.pm_id = pm.pm_id AND
                                                            dn.donation_date < '$to_date' AND pm.cash = 1 GROUP BY dnopeningCash, otopeningCash, otclosingCash
                                                UNION ALL
                                                    SELECT 0 AS dnopeningCash, 0 AS dnclosingCash, SUM(oid.amount) AS otopeningCash, 0 AS  otclosingCash
                                                        FROM dn_otherincomed AS oid, dn_otherincome AS oi,dn_paymentmode AS pm
                                                        WHERE oi.invoice_id = oid.invoice_id AND
                                                            oid.pm_id = pm.pm_id AND
                                                            date < '$from_date' AND pm.cash = 1  GROUP BY dnopeningCash, dnclosingCash, otclosingCash
                                                UNION ALL
                                                    SELECT 0 AS dnopeningCash, 0 AS dnclosingCash, 0 AS otopeningCash, SUM(oid.amount) AS otclosingCash
                                                        FROM dn_otherincomed AS oid, dn_otherincome AS oi, dn_paymentmode AS pm
                                                        WHERE oi.invoice_id = oid.invoice_id AND
                                                            oid.pm_id = pm.pm_id AND
                                                            date < '$to_date' AND pm.cash = 1 GROUP BY dnopeningCash, dnclosingCash, otopeningCash) x")->row();
        return $query;
    }

    function GetBankBalance($from_date,$to_date){
        $query=$this->db->query("SELECT SUM(IFNULL(dnopeningBank,0) + IFNULL(otopeningBank,0)) AS openingBank, SUM(IFNULL(dnclosingBank,0) + IFNULL(otclosingBank,0)) AS closingBank
                                            FROM (
                                                SELECT SUM(dnd.donation_amount) AS dnopeningBank, 0 AS dnclosingBank,0 AS otopeningBank,0 AS otclosingBank
                                                    FROM dn_donation AS dn, dn_donationd AS dnd, dn_paymentmode AS pm
                                                    WHERE dn.donation_id = dnd.donation_id AND
                                                        dnd.pm_id = pm.pm_id AND
                                                        dn.donation_date < '$from_date' AND pm.cash <> 1 GROUP BY dnclosingBank,otopeningBank, otclosingBank
                                                UNION ALL
                                                    SELECT 0 AS dnopeningBank, SUM(dnd.donation_amount) AS dnclosingBank, 0 AS otopeningBank, 0 AS otclosingBank
                                                    FROM dn_donation AS dn, dn_donationd AS dnd, dn_paymentmode AS pm
                                                    WHERE dn.donation_id = dnd.donation_id AND
                                                        dnd.pm_id = pm.pm_id AND
                                                        dn.donation_date < '$to_date' AND pm.cash <> 1 GROUP BY dnopeningBank, otopeningBank, otclosingBank
                                                UNION ALL
                                                    SELECT 0 AS dnopeningBank, 0 AS dnclosingBank, SUM(oid.amount) AS otopeningBank, 0 AS  otclosingBank
                                                    FROM dn_otherincomed AS oid, dn_otherincome AS oi,dn_paymentmode AS pm
                                                    WHERE oi.invoice_id = oid.invoice_id AND
                                                        oid.pm_id = pm.pm_id AND
                                                        date < '$from_date' AND pm.cash <> 1  GROUP BY dnopeningBank, dnclosingBank, otclosingBank
                                                UNION ALL
                                                    SELECT 0 AS dnopeningBank, 0 AS dnclosingBank, 0 AS otopeningBank, SUM(oid.amount) AS otclosingBank
                                                    FROM dn_otherincomed AS oid, dn_otherincome AS oi, dn_paymentmode AS pm
                                                    WHERE oi.invoice_id = oid.invoice_id AND
                                                        oid.pm_id = pm.pm_id AND
                                                        date < '$to_date' AND pm.cash <> 1 GROUP BY dnopeningBank, dnclosingBank, otopeningBank) x")->row();
        return $query;
    }





    function GetIncomeList($month_id){
        $query=$this->db->query("SELECT inx.sreial_no, inx.description, inx.amount, dt.dt_name 
                                FROM    dn_inexd AS inx 
                                LEFT OUTER JOIN dn_donationtype AS dt ON dt.dt_id = inx.income_id
                                WHERE inx.inex_block = 'i' AND inx.month_id='$month_id'
                                ORDER BY inx.sreial_no")->result_array();
        return $query;
    }

    function GetExpenseList($month_id){
        $query=$this->db->query("SELECT inx.sreial_no, inx.description, inx.amount, eh.eh_name
                                FROM    dn_inexd AS inx 
                                LEFT OUTER JOIN dn_expensehead AS eh ON inx.expense_id = eh.eh_id
                                WHERE inx.inex_block = 'e' AND inx.month_id='$month_id'
                                ORDER BY inx.sreial_no")->result_array();
        return $query;
    }
    function getOrphanChildName($psite_id, $status_id){
        $query = $this->db->query("SELECT ps.psite_id, ps.psite_name, c.country_name, ct.city_name, ps.psite_openingdate,       concat(dr.orphan_fname, ' ', dr.orphan_mname, ' ', dr.orphan_lname) as orphanChildName,
                                u.u_name as psite_incharge, ps.`psite_contactno`, ps.`psite_email`, ps.`psite_remarks`, ps.`psite_status`, ds.stat_name status
                                FROM dn_project_site ps
                                LEFT JOIN dn_orphanregistration dr ON ps.psite_id = dr.orphan_projectsite
                                LEFT JOIN dn_country c ON ps.country_id = c.country_id
                                LEFT JOIN dn_city ct ON ps.city_id = ct.city_id
                                LEFT JOIN acs_user u ON ps.psite_incharge=u.u_id
                                LEFT JOIN dn_status ds ON dr.orphan_status = ds.stat_id
                                WHERE ps.psite_id = '".$psite_id."'
                                AND dr.orphan_status='".$status_id."'
                                ORDER BY ps.psite_id")->result_array(); // orphan status = 3 is approve
        return $query;
    }
    function getOrphanChildNamelist($psite_id){
        $query = $this->db->query("SELECT *, concat(orphan_fname, ' ', orphan_mname, ' ', orphan_lname) as orphanChildName FROM dn_orphanregistration WHERE orphan_projectsite = $psite_id ORDER BY orphan_projectsite")->result_array();
        return $query;
    }
    function getOrphanPaymentlist($psite_id, $orphan_id, $fromDate, $toDate, $group_by = null){
        $query = $this->db->query(" SELECT dps.psite_id, dps.psite_name, c.country_name as address, ct.city_name, dps.psite_status as current_status, dpi.transferred_date, dpn.donor_name, dpn.*
                                    FROM dn_payment_info dpi
                                    LEFT JOIN dn_payment_donor dpn ON dpi.payment_id = dpn.payment_id
                                    LEFT JOIN dn_status ds ON dpi.payment_status = ds.stat_id
                                    LEFT JOIN dn_project_site dps ON dpi.psite_id = dps.psite_id
                                    LEFT JOIN dn_paymentmode dpm ON dpi.transferredMode = dpm.pm_id
                                    LEFT JOIN dn_currency dc ON dpi.currencyType = dc.currency_id
                                    LEFT JOIN dn_support_cycle dsc ON dpn.support_cycle = dsc.supportcycle_id
                                    LEFT JOIN dn_country c ON dps.country_id = c.country_id
                                    LEFT JOIN dn_city ct ON dps.city_id = ct.city_id
                                    WHERE dps.psite_id = '".$psite_id."'
                                    AND dpn.orphan_id = '".$orphan_id."'
                                    AND dpi.transferred_date BETWEEN '$fromDate' AND '$toDate'
                                    $group_by
                                    ")->result_array();
      return $query;
    }
    function getdetailsDonorName(){
        $query= $this->db->query("
                        SELECT  dn_donor.donor_id, concat(dn_donor.donor_namef, ' ', dn_donor.donor_namem, ' ', dn_donor.donor_namel ) donor_name_payment,dn_donor.donorhome_address as donor_address, dn_donation.donor_name as orphan_childName, sum(dn_donationd.donation_amount) as support_amount, dn_donationtype.dt_name as support_type
                        FROM (`dn_donor`)
                        LEFT JOIN `dn_donation` ON `dn_donor`.`donor_id` = `dn_donation`.`donor_id`
                        LEFT JOIN `dn_donationd` ON `dn_donation`.`donation_id` = `dn_donationd`.`donation_id`
                        LEFT JOIN `dn_events` ON `dn_donationd`.`event_id` = `dn_events`.`event_id`
                        LEFT JOIN `dn_donationtype` ON `dn_donationd`.`dt_id`=`dn_donationtype`.`dt_id`
                        WHERE `dn_donationd`.`event_id` = 17
                        GROUP BY `dn_donor`.`donor_id`
                        ORDER BY `dn_donor`.`donor_id` DESC")->result_array();
        return $query;

    }
    function getdetailsDonorPayment($donor_id, $fromDate, $toDate){
        $query= $this->db->query("
                        SELECT  dn_donor.donor_id,concat(dn_donor.donor_namef, ' ', dn_donor.donor_namem, ' ',
                        dn_donor.donor_namel ) donor_name_payment,dn_donor.donorhome_address as donor_address, dn_donor.donor_mobile as contact_no,
                        dn_donor.donor_email, dn_donor.donor_officeaddress,
                        dn_donation.donor_name as orphan_childName, sum(dn_donationd.donation_amount) as support_amount,
                        dn_donationtype.dt_name as support_type, dn_city.city_name, dn_payment_donor.distributed_date, '' purpose
                        FROM (`dn_donor`)
                        LEFT JOIN `dn_donation` ON `dn_donor`.`donor_id` = `dn_donation`.`donor_id`
                        LEFT JOIN `dn_donationd` ON `dn_donation`.`donation_id` = `dn_donationd`.`donation_id`
                        LEFT JOIN `dn_payment_donor` ON `dn_donor`.`donor_id` = `dn_payment_donor`.donor_id
                        LEFT JOIN `dn_events` ON `dn_donationd`.`event_id` = `dn_events`.`event_id`
                        LEFT JOIN `dn_donationtype` ON `dn_donationd`.`dt_id`=`dn_donationtype`.`dt_id`
                        LEFT JOIN dn_city ON dn_donor.donor_homecityid = dn_city.city_id
                        WHERE `dn_donationd`.`event_id` = 17
                        AND dn_donor.donor_id = $donor_id
                        AND dn_payment_donor.distributed_date BETWEEN '$fromDate' AND '$toDate'
                        GROUP BY `dn_donor`.`donor_id`
                        ORDER BY `dn_donor`.`donor_id` DESC")->result_array();
        return $query;

    }
}