<?php 
	header("content-disposition: attachment; filename=\"report_citywise_donation_type.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Citywise Donation Type Report\n\n";
        echo "Donation type \t Currency \t Amount \n" ;
        $counter=0;
        $city=0;
        $donationtotal=0;
        $allDonationSum=0;
        foreach($list as $row){
            $allDonationSum=$allDonationSum + $row['donation_amount'];
            if($home_city =="1"){
                if($city != trim($row['donor_homecityid'])){
                    if($counter>0){
                        echo "\t Total Amount : \t".number_format($donationtotal,2)."\n\n";
                    }
                    echo $row['city_name']."\n";
                    $donationtotal=0;
                }
                
                $city=trim($row['donor_homecityid']);
            }else{
                if($city != trim($row['donor_officecity'])){
                    if($counter>0){
                        echo "\t Total Amount \t".number_format($donationtotal,2)."\n\n";
                    }
                    echo $row['city_name']."\n";
                    $donationtotal=0;
                }
                
                $city=trim($row['donor_officecity']);
            }
            $donationtotal=$donationtotal+$row['donation_amount'];  
            echo $row['dt_name']."\t".$row['currency_name']."\t".$row['donation_amount']."\n";
		    $counter++;
        }
    echo "\t Total Amount \t".number_format($donationtotal,2)."\n\n";
    echo "\t Grand Total Amount \t".number_format($allDonationSum,2)."\n";
    echo "\n Printed on \t".Date("d-m-Y");


  