<?php 
	header("content-disposition: attachment; filename=\"report_expense_summary.xls\"");
	header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    
        echo "Expense Summary Report\n\n";
        echo "Expense ID \t Supplier Name \t Event \t Currency \t Amount\n";
        
        $counter=1;
        $total=0;
        foreach($list as $row){
            
		    echo  $row['invoice_id']." \t".$row['sup_name']."\t".$row['event_name']."\t".$row['currency_name']."\t".number_format($row['amount'],2) ."\n ";
		    $counter++;$total += $row['amount'];
        }

        
    echo "\n Total Amount :".$total;
    echo "\n Printed on ".Date("d-m-Y");


  