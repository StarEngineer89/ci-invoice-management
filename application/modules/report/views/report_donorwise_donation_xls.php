<?php 
	header("content-disposition: attachment; filename=\"report_donor_donation.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Donor Donation Report\n\n";
        $donor=0;
        $totalDonation=0; 
        $counter=0;
        foreach($list as $row){
            if($donor !=$row['donor_id']){
                if($counter>0){
                    echo "\n \t\t\t Total Donation :".number_format($totalDonation,2)."\n";
                }
                if($row['giftaid_consent'] == 1) {$giftaid_consent_stat = 'Yes';}else{$giftaid_consent_stat = 'No';}
                echo "  Donor Id : ".$row['donor_id']."   Donor Name :".$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel']."\n\n\n
                        Home Address  : ".$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode']."\n
                        Office Address  :".$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode']."\n
                        Business Name : ".$row['donor_businessname']."   Email :".$row['donor_email']."\n
                        Contact No : ".$row['donor_homephone'].",".$row['donor_officephone']."   Mobile : ".$row['donor_mobile']."\n
                        Event Name : ".$row['event_name']."   Donation Type : ".$row['donation_type']."\n
                        Gift Aid Consent : ".$giftaid_consent_stat." \n\n
                        Donation Id \t Donation Date \tCurrency \tAmount \n";
                $totalDonation=0;
            }
            $donor=trim($row['donor_id']);
            $totalDonation += $row['donation_amount'];
            $date=date('d-m-Y',strtotime($row['donation_date']));

            echo $row['donation_id']."\t".$date."\t" .$row['currency_name']."\t".$row['donation_amount']."\n";
		    $counter++;
        }

    echo "\n Printed on \t".Date("d-m-Y");


  