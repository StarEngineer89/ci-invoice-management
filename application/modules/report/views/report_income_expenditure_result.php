
<!DOCTYPE html>
<html>
	<head>
		<title>Income Expenditure Report</title>
		<style type="text/css">
			#thanksletter
			{	
				float:left;
				width:100%;
				font-size:13px;
				padding:0px;
				font-family:Times New Roman, Times, serif;
				margin:1px 5px;
			}
			#donation_receipt td
			{
				border:solid #000000 1px;
			}
		</style>
	</head>
	<body style="margin:0px auto;">
    	<div style="width:8.5in;height:11in;margin:0px auto 5px;padding:0px;">
        <div style="width:6.5in;height:10.8in;border:solid black 0px;margin:.1in 1in;padding:0px;">
            <div id="thanksletter">
                <?php $config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));?>
                
                <div style="float:right;margin:0px;padding:0px;width:200px;text-align:right;">
                    <img src="<?=base_url().'assets/image/setUpwindow/'.$config->logo?>" height="65px"/>
                </div>
                <div style="float:right;margin:0px 5px;padding:0px; text-align:center;color:#00CC00;width:3.5in;">
                    <?php
                        echo"<b>".$config->cherity_name."</b><br />";
                        echo $config->address."<br />";
                        echo"Phone: ".$config->phone;
                        echo" Fax: ".$config->fax;
                    ?>
                </div>
                
            </div>
            <hr />
            <?php 
            $month=$this->mdl_general->GetInfoByRow('dn_monthes','month_id',array('month_id'=>$month_id));
            $from_date=$month->month_datefrom;
            $to_date=$month->month_dateto;
            $opening_cash=$config->opcashbalance;
            $opening_bank=$config->opbankbalance;

            $cash_balance=$this->mdl_extra_report->GetCashBalance($from_date,$to_date);
            $opening_cash = $opening_cash + $cash_balance->openingCash;
            $closing_cash = $opening_cash + $cash_balance->closingCash;

            $bank_balance=$this->mdl_extra_report->GetBankBalance($from_date,$to_date);
            $opening_bank = $opening_bank + $bank_balance->openingBank;
            $closing_bank = $opening_bank + $bank_balance->closingBank; 

            $grand_opening = $opening_bank + $opening_cash;
            $grand_closing = $closing_bank + $closing_cash;    

            ?>
            <div style="text-align:center"><h2>Income Expenditure Report</h2></div>
            <p>Month  : <b><?=$month->month_name?></b></p>
            <p>Opening Balance in Bank : <b><?=number_format($opening_bank,2)?></b>  Closing Balance in Bank : <b><?=number_format($closing_bank,2)?></b></p>
            <p>Opening Balance in Cash : <b><?=number_format($opening_cash,2)?></b>  Closing Balance in Cash : <b><?=number_format($closing_cash,2)?></b></p>
            <p>Opening Balance Grand : <b><?=number_format($grand_opening,2)?></b>  Closing Balance Grand : <b><?=number_format($grand_closing,2)?></b></p>
            <br>
            <h4>Income List</h4>
            <div id="thanksletter">
                
                    <table width="100%" cellspacing="0px">
                        <thead>
                            <tr>
                                <th style="border-bottom:1px solid #000000" align="left">Income Type</th>
                                <th style="border-bottom:1px solid #000000">Description</th>
                                <th style="border-bottom:1px solid #000000" align="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter=0;
                            $total_income=0;
                            $income_list=$this->mdl_extra_report->GetIncomeList($month_id);
                            foreach($income_list as $row){
                                if($counter%2==0)
                                    echo"<tr>";
                                else
                                    echo'<tr bgcolor="#EFEFEF">';
                            ?>
                            
                                <td align="left"><?=$row['dt_name']?></td>
                                <td><?=$row['description']?></td>
                                <td align="right"><?=number_format($row['amount'],2)?></td>
                            </tr>
                            
                            <?php $counter++; $total_income=$total_income+$row['amount'];}?>
                            <tr><td></td><td></td><td align="right"><b>Total Income: <?=number_format($total_income,2)?></b></td></tr>
                            
                        </tbody>
                    </table>
            </div>
            <br>
            <h4>Expense List</h4>
            <div id="thanksletter">
                    <table width="100%" cellspacing="0px">
                        <thead>
                            <tr>
                                <th style="border-bottom:1px solid #000000" align="left">Expense Type</th>
                                <th style="border-bottom:1px solid #000000" >Description</th>
                                <th style="border-bottom:1px solid #000000" align="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter=0;
                            $total_expense=0;
                            $expense_list=$this->mdl_extra_report->GetExpenseList($month_id);
                            foreach($expense_list as $row){
                                if($counter%2==0)
                                    echo"<tr>";
                                else
                                    echo'<tr bgcolor="#EFEFEF">';
                            ?>
                            
                                <td align="left"><?=$row['eh_name']?></td>
                                <td><?=$row['description']?></td>
                                <td align="right"><?=number_format($row['amount'],2)?></td>
                            </tr>
                            
                            <?php $counter++; $total_expense=$total_expense+$row['amount'];}?>
                            <tr><td></td><td></td><td align="right"><b>Total Expense: <?=number_format($total_expense,2)?></b></td></tr>
                        </tbody>
                    </table>
            </div>
            <div id="thanksletter">
                <hr />

                <?php  echo"Printed on: ".date("d-m-Y"); ?>
            </div>
            
        </div>
    </div>
	</body>
</html>
