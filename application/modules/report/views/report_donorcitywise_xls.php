<?php 
	header("content-disposition: attachment; filename=\"report_donor_citywise.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Donors List\n\n";
        echo "City :".$city_name."\n\n";
        echo "Id \t Name \t Business Name \t Home Address \t Office Address \t Home Phone \t Office Phone \t Mobile \t Email \n";
        
        $counter=0;
        $city=0;
        $mCitydonor = 0;
        foreach($list as $row){
            if($home_city =="1"){
                if($city != $row['donor_homecityid']){
                    if($counter >0){
                        echo " \t\t\t\t\t\t\t\t Total Donors :".$mCitydonor."\n\n";
                    }
                    $mCitydonor=0;
                    if($city_name=="All"){
                        echo  $row['homecity']."\n";
                    }
                }
                $mCitydonor++;
                $city=trim($row['donor_homecityid']);
            }else{
                if($city != $row['donor_officecity']){
                    if($counter >0){
                        echo " \t\t\t\t\t\t\t\t Total Donors :".$mCitydonor."\n\n";
                    }
                    $mCitydonor=0;
                    if($city_name=="All"){
                        echo  $row['officecity']."\n";
                    }
                }
                $mCitydonor++;
                $city=trim($row['donor_officecity']);
            }
            $donor_name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
            $home_address=$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode'];
            $office_address=$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode'];

		    echo  $row['donor_id']."\t".$donor_name."\t".$row['donor_businessname']."\t ".$home_address."\t".$office_address." \t".$row['donor_homephone']."\t".$row['donor_officephone']."\t".$row['donor_mobile']."\t".$row['donor_email']."\n ";
		    $counter++;
        }
        echo " \t\t\t\t\t\t\t\t Total Donors :".$mCitydonor."\n\n";

        
    echo "\n Total Donors :".count($list);
    echo "\n Printed on \t".Date("d-m-Y");


  