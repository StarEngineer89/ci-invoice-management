<?php 
	header("content-disposition: attachment; filename=\"report_box_donation_details.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Box Donation Detail Report\n\n";
        echo "From Date ".$from_date."\t To Date".$to_date."\n\n ";
        echo "Donation Id \t Date \t Box Id \t Donor Businessname \t Address \t Postcode \t Phone \t Amount \n";
        
        $root=0;
        $allDonationSum=0;
        $counter=0;
        foreach($list as $row){
            $allDonationSum=$allDonationSum + $row['donation_amount'];
            if($root != trim($row['root_id']))
                echo"\n\n ".$row['root_name']."\n";
            $root=trim($row['root_id']);

		    echo  $row['donation_id']." \t".date('d-m-Y',strtotime($row['donation_date']))."\t".$row['box_id']."\t".$row['donor_businessname']."\t".$row['donor_officeaddress']."\t".$row['donor_officepostcode']."\t".$row['donor_officephone']." \t".number_format($row['donation_amount'],2) ."\n ";
		    $counter++;
        }
        echo "\n\n Total amount : ".number_format($allDonationSum,2);
    echo "\n Printed on \t".Date("d-m-Y");


  