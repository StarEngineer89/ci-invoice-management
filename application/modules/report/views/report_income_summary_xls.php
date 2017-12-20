<?php 
	header("content-disposition: attachment; filename=\"report_income_summary.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Income Summary Report\n\n";
        echo "Income ID \t Date \t Currency \t Amount\n";
        
        $counter=1;
        $total=0;
        foreach($list as $row){
            
		    echo  $row['invoice_id']." \t".date('d-m-Y',strtotime($row['date']))."\t".$row['currency_name']."\t".number_format($row['amount'],2) ."\n ";
		    $counter++;$total += $row['amount'];
        }

        
    echo "\n Total Amount :".$total;
    echo "\n Printed on ".Date("d-m-Y");


  