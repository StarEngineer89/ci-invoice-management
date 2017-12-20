<?php 
	header("content-disposition: attachment; filename=\"report_route.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    foreach ($route_list as $row){
        echo $row['root_name']."\n\n";
        echo "Sequence \t Box No \t Business Name \t Address \t Postcode \t Phone \t Active\n";
        $box_list=$this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id']));
        $total_box=count($box_list);
        $total_active=count($this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id'],'box_active'=>'1')));
        $total_inactive=$total_box-$total_active;
        $counter=1;
        foreach($box_list as $row){
        	try {
        		$donor=$this->mdl_general->GetInfoByRow('dn_donor','donor_id',array('donor_id'=>$row['donor_id']));
                $donor_businessname=$donor->donor_businessname;
                $address=$donor->donor_officeaddress;
                $postcode=$donor->donor_officepostcode;
                (string)$phone=$donor->donor_officephone;
            }catch (Exception $e) {
            	$donor_businessname="N/A";
	            $address="N/A";
	            $postcode="N/A";
	            $phone="N/A";
		    }
		    if($row['box_active']=='1'){
		    	$active="Y";
		    }else{
		    	$active="N";
		    }
		    echo  $row['box_Seq']."\t".$row['box_id']."\t".$donor_businessname."\t".$address."\t".$postcode."\t".$phone."\t".$active."\n";
		    $counter++;
        }
        echo "\n Total Box \t".$total_box."\t \t Total active \t".$total_active."\t \t Total inactive \t".$total_inactive."\n\n\n";
    }
    echo "\n Printed on \t".Date("d-m-Y");


  