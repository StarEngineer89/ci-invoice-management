<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_extra_dashboard extends CI_Model {

	function getdonationMonthly($year){
		$query= $this->db->query('SELECT DATE_FORMAT(dd.donation_date, "%m") AS Month, count(dd.donation_date) count_donation, sum(dnd.donation_amount) as total
			FROM dn_donation dd
			LEFT JOIN dn_donationd dnd on dd.donation_id = dnd.donationd_id
			where DATE_FORMAT(donation_date, "%Y") = '.$year.'
			GROUP BY DATE_FORMAT(donation_date, "%m-%Y")')->result_array();
        return $query;
	}
	function getdonationYearly(){
		// $datefrom = '2006';
		$datefrom = date('Y', strtotime('-11 years'));
		$dateto = date('Y');
		$query= $this->db->query('SELECT DATE_FORMAT(dd.donation_date, "%m") AS Month, DATE_FORMAT(dd.donation_date, "%Y") as Year, count(dd.donation_date) count_donation, sum(dnd.donation_amount) as total
			FROM dn_donation dd
			LEFT JOIN dn_donationd dnd on dd.donation_id = dnd.donationd_id
			WHERE DATE_FORMAT(dd.donation_date, "%Y") BETWEEN '.$datefrom.' AND '.$dateto.'
			GROUP BY DATE_FORMAT(donation_date, "%Y")')->result_array();
        return $query;
	}
	
}