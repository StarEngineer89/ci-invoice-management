<?php 
	header("content-disposition: attachment; filename=\"report_pledge_summary.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        if($pledge_paid=="0"){ $pledge_type="All";}elseif($pledge_paid=="1"){$pledge_type="Unpaid";}else{$pledge_type="Paid";}
        echo "Pledge Summary Report\n\n";
        echo "From Date :".$from_date."\t To Date :".$to_date."\n";
        echo "Pledge Type :".$pledge_type. "\t Donor Type :".$donor_type."\n";
        echo "City :".$city." \t Event :".$event."\n";
        echo "Donor Id \t Donor name \t Home Address \t Office Address \t Cell \t Email \t Pledge \t Received \t Balance \n";
        
        $counter=0;
        $totalPledge=0;
        $totalReceived=0;
        $totalBalance=0;
        foreach($list as $row){
            $balance = $row['dp_amount'] - $row['received'];
            if($pledge_paid=="0"){//all
                $totalPledge= $totalPledge + $row['dp_amount'];
                $totalReceived = $totalReceived + $row['received'];
                $totalBalance = $totalBalance + $balance;
                
            }
            elseif($pledge_paid=="1"){//unpaid
                if($balance != 0){
                    $totalPledge= $totalPledge + $row['dp_amount'];
                    $totalReceived = $totalReceived + $row['received'];
                    $totalBalance = $totalBalance + $balance;
                }

            }
            else{//paid
                if($balance == 0){
                    $totalPledge= $totalPledge + $row['dp_amount'];
                    $totalReceived = $totalReceived + $row['received'];
                    $totalBalance = $totalBalance + $balance;
                }
            }
            $name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
            $home_address=$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode'];
            $office_address=$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode'];
		    echo  $row['donor_id']." \t".$name."\t".$home_address."\t".$office_address."\t".$row['donor_mobile']."\t".$row['donor_email']." \t". number_format($row['dp_amount'],2)."\t".number_format($row['received'],2)."\t".number_format($balance,2)."\n ";
		    
        }

        
    echo "\n Total Donors :".count($list);
    echo "\n Printed on \t".Date("d-m-Y");


  