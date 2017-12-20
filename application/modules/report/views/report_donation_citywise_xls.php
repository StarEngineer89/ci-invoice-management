<?php 
	header("content-disposition: attachment; filename=\"report_donation_citywise.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Donation Report\n\n";
        echo "From date : ".$from_date." To date : ".$to_date."\n";
        echo "City : ".$city."  Donation Type : ".$donation_type."\n";
        echo "From Amount : ".$from_amount."  To Amount : ".$to_amount."\n\n";
        echo "Id \t Date \t Name  \t  Business Name \t  Home Address  \t  Office Address \t Mobile  \t  Home Phone \t Office Phone   \t Amount \n";
        
        $city=0;
        $donationtotal = 0;
        foreach($list as $row){
            
            $name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
            $home_address=$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'];
            $office_address=$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'];
		    echo  $row['donor_id']."\t".$row['donation_date']."\t".$name." \t".$row['donor_businessname']."\t".$home_address."\t".$office_address."\t".$row['donor_mobile']."\t".$row['donor_homephone']."\t".$row['donor_officephone']."\t".number_format($row['donation_amount'],2)."\n ";
		    
        }

        
    echo "\n Total Donations :".count($list);
    echo "\n Printed on \t".Date("d-m-Y");


  