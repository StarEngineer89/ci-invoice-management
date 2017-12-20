<?php 
	header("content-disposition: attachment; filename=\"project_child_report.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        if(@$list[0]['psite_status'] == 1){
            $status = 'Active';
        }else{
            $status = 'Inactive';
        }
        echo "Project Child Report\n\n";
        echo "Project Name \t ".@$list[0]['psite_name']."\n\n";
        echo "Status \t ".@$status."\n\n";
        

        echo "Child Name \t Address \t City \t Status\n";
        
        $counter=1;
        $total=0;
        foreach(@$list as $row){
            
		    echo  $row['orphanChildName']."\t".$row['country_name']."\t".$row['city_name']."\t". $row['status'] ."\n ";
		    $counter++;
        }

        
    // echo "\n Total Amount :".$total;
    echo "\n Printed on ".Date("d-m-Y");


  