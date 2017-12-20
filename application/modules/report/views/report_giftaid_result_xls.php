<?php 
	header("content-disposition: attachment; filename=\"report_giftaid.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Gift Aid Claim\n\n";
        echo "From Date: ".$this->input->post('fromDate')."\n\n";
        echo "To Date: ".$this->input->post('toDate')."\n\n";
        echo "Item \t title \t First name \t Last Name \t House name or number \t Postcode \t Aggregated donations \t Sponsored event \t Donation Date\n";
        
        $counter=1;
        foreach($list as $row){
        	
		    
		    echo  $counter."\t".$row['title_name']."\t".$row['donor_namef']."\t".$row['donor_namel']."\t".$row['donorhome_address']."\t".strtoupper($row['donor_postcode'])."\t".strtoupper($row['donation_amount'])."\t".strtoupper($row['event_name'])."\t".date('d/m/Y',strtotime($row['donation_date']))."\n";
		    $counter++;
        }

        
    echo "\n Total Donors :".count($list);
    echo "\n Printed on \t".Date("d-m-Y");


  