<?php 
	header("content-disposition: attachment; filename=\"report_top_donation.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Top Donation Report\n\n";
        echo "From date : ".$from_date." To date : ".$to_date."\n";
        echo "City : ".$city_name."  Donor Type Type : ".$donor_type_name."\n";
        echo "Event :".$event."\n\n";
        echo "Id \t Name  \t  Business Name \t  Home Address  \t  Office Address \t Mobile  \t  Home Phone \t Office Phone   \t Amount \n";
        
        $city=0;
        $allDonationSum=0;
        $donationtotal = 0;
        foreach($list as $row){
            $allDonationSum=$allDonationSum + $row['donation_amount'];
            if($home_city=="1"){
                if($city != trim($row['donor_homecityid'])){
                    if($counter>0){
                        echo "\t\t\t\t\t\t\t Total : \t ".number_format($donationtotal,2)."\n";
                    }
                    if($city_name =="All"){
                        echo "<b>".$row['homecity']."</b>\n\n";
                    }
                    $donationtotal=0;

                }
                $city=trim($row['donor_homecityid']);

            }else{
                if($city != trim($row['donor_officecity'])){
                    if($counter>0){
                        echo "\t\t\t\t\t\t\t Total : \t ".number_format($donationtotal,2)."\n";
                    }
                    if($city_name =="All"){
                        echo "<b>".$row['homecity']."</b>\n\n";
                    }
                    $donationtotal=0;
                }
                $city=trim($row['donor_officecity']);
            }
            $donationtotal=$donationtotal+$row['donation_amount'];

            $name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
            $home_address=$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'];
            $office_address=$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'];
		    echo  $row['donor_id']."\t".$name." \t".$row['donor_businessname']."\t".$home_address."\t".$office_address."\t".$row['donor_mobile']."\t".$row['donor_homephone']."\t".$row['donor_officephone']."\t".number_format($row['donation_amount'],2)."\n ";
		    
        }
        echo "\t\t\t\t\t\t\t Total : \t ".number_format($donationtotal,2)."\n";
        echo "\t\t\t\t\t\t\t Grand Total : \t ".number_format($allDonationSum,2)."\n";
        echo "\n Printed on \t".Date("d-m-Y");


  