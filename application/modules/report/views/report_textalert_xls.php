<?php 
	header("content-disposition: attachment; filename=\"report_text_alert.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Text Alert Report\n\n";
        echo "Id \t Name \t City \t Mobile\n";
        
        $counter=1;
        foreach($list as $row){
            $name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
		    echo  $row['donor_id']."\t".$name."\t".$row['cityname']."\t".$row['donor_mobile'] ."\n ";
		    $counter++;
        }

        
    echo "\n Total Donors :".count($list);
    echo "\n Printed on \t".Date("d-m-Y");


  