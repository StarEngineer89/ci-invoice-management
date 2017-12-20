<?php 
class Mdl_extra extends CI_model{

	function getCityList($where){
		if(!empty($where)){
			$wheres = $where;
		}else{
			$wheres = '';
		}
		$query= $this->db->query("
							SELECT ct.city_id, ct.city_name, ct.active, cn.country_name, cn.country_id
							FROM ims_city ct
							LEFT JOIN ims_country cn ON ct.country_id = cn.country_id
							$wheres
							ORDER BY ct.city_id ASC
						")->result_array();
		return $query;

	}
}