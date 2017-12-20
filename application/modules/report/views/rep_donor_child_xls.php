<?php 
	header("content-disposition: attachment; filename=\"report_donor_child_payment.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");

        $donor_name = @$list[0]['donor_name_payment'];
        $donor_address = @$list[0]['donor_address'];
        $city_name = (@$list[0]['city_name']);
        $contact_no = (@$list[0]['contact_no']);
        $donor_email = @$list[0]['donor_email'];
        $donor_officeaddress = @$list[0]['donor_officeaddress'];
        echo "Report Donor Child Sponsor Payment\n\n";
        echo "Donor Name \t ".$donor_name. "\t Address \t ".$donor_address."\t City \t ".$city_name."\n";
        echo "Contact No \t ".$contact_no. "\t Email \t ".$donor_email."\t Office \t ".$donor_officeaddress."\n";
        echo "From Date \t ".$fromDate. "\t To Date \t ".$toDate."\n\n";
        

        echo "Payment Date \t Child Name \t Purpose \t Donation Type \t Amount \n";
        
        $counter=1;
        $total=0;
        foreach(@$list as $row){
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
		    echo  $row['distributed_date']."\t".$row['orphan_childName']."\t".$row['purpose']."\t". $row['support_type'] ."\t". $row['support_amount']."\n ";
		    $counter++;
            $total += @$row['support_amount'];
        }

        
    echo "\n Total Amount :".$total;
    echo "\n Printed on ".Date("d-m-Y");


  