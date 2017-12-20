<?php 
	header("content-disposition: attachment; filename=\"project_child_report.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        if(@$list[0]['psite_status'] == 1){
            $status = 'Active';
        }else{
            $status = 'Inactive';
        }
        $psite_name = @$list[0]['psite_name'];
        $orphanChildName = (@$list[0]['orphanChildName']);
        $address = @$list[0]['address'];
        $city_name = (@$list[0]['city_name']);
        echo "Project Child Payment\n\n";
        echo "Project Name \t ".$psite_name."\n\n";
        echo "Child Name \t ".@$orphanChildName. "Address \t ".@$address."City \t ".@$city_name."\n\n";
        echo "From Date \t ".@$fromDate. "To Date \t ".@$toDate."Current Status \t ".@$status."\n\n";
        

        echo "Payment Date \t Donor Name \t Purpose \t Donation Type \t Amount \n";
        
        $counter=1;
        $total=0;
        foreach(@$list as $row){
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
		    echo  $row['distributed_date']."\t".$row['donor_name']."\t".$row['distributed']."\t". $row['support_type'] ."\t". $row['support_amount']."\n ";
		    $counter++;
            $total += @$row['support_amount'];
        }

        
    echo "&nbsp; \t &nbsp; \t &nbsp; \t &nbsp; \t &nbsp; \n Total Amount :".$total;
    echo "\n Printed on ".Date("d-m-Y");


  