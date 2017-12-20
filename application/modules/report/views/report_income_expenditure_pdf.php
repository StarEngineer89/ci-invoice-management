<?php 
$config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));
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
$html='<h3 style="text-align:center">Income Expenditure Report</h3>
		
			<table cellspacing="0px" width="100%">
				<tr>
					<td>Month  : <b>'.$month->month_name.'</b></td>
					<td></td>
				</tr>
				<tr>
					<td>Opening Balance in Bank  :<strong>'.number_format($opening_bank,2).'</strong></td>
					<td align="right">Closing Balance in Bank : <b>'.number_format($closing_bank,2).'</b></td>
				</tr>
				<tr>
					<td>Opening Balance in Cash : <b>'.number_format($opening_cash,2).'</b></td>
					<td align="right">Closing Balance in Cash  : <b>'.number_format($closing_cash,2).'</b></td>
				</tr>
				<tr>
					<td>Opening Balance Grand : <b>'.number_format($grand_opening,2).'</b></td>
					<td align="right">Closing Balance Grand : <b>'.number_format($grand_closing,2).'</b></td>
				</tr>
			</table>
		<br>
		<h4>Income List</h4>
    	<table cellspacing="0px" width="100%">
            <thead>
                <tr>
                    <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Income Type</th>
                    <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Description</th>
                    <th style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
                </tr>
            </thead>
            <tbody>';
$counter=0;
$total_income=0;
$income_list=$this->mdl_extra_report->GetIncomeList($month_id);
foreach($income_list as $row){
	if ($counter%2==0){
		$html.='<tr>';
	}else{
		$html.='<tr bgcolor="#EFEFEF">';
	}
	$html.='
            <td align="left">'.$row['dt_name'].'</td>
            <td>'.$row['description'].'</td>
            <td align="right">'.$row['amount'].'</td>
        </tr>';
    $counter++;
    $total_income=$total_income+$row['amount'];
}
$html.= '
<tr><td></td><td></td><td align="right"><b>Total Income: '.number_format($total_income,2).'</b></td></tr>
</tbody>
                </table><br>  
                ';
$html.='<br>
		<h4>Expense List</h4>
    	<table cellspacing="0px" width="100%">
            <thead>
                <tr>
                    <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Expense Type</th>
                    <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Description</th>
                    <th style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
                </tr>
            </thead>
            <tbody>';
$counter=0;
$total_expense=0;
$expense_list=$this->mdl_extra_report->GetExpenseList($month_id);
foreach($expense_list as $row){
	if ($counter%2==0){
		$html.='<tr>';
	}else{
		$html.='<tr bgcolor="#EFEFEF">';
	}
	$html.='
            <td align="left">'.$row['eh_name'].'</td>
            <td>'.$row['description'].'</td>
            <td align="right">'.$row['amount'].'</td>
        </tr>';
    $counter++;
    $total_expense=$total_expense+$row['amount'];
}
$html.= '
<tr><td></td><td></td><td align="right"><b>Total Expense: '.number_format($total_expense,2).'</b></td></tr>
</tbody>
                </table><br>  
                ';


//echo $html;
$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Income Expenditure');
//config setting
$name="Income Expenditure".Date('d-m-Y');


// set default header data
$pdf->SetHeaderData('assets/image/setUpwindow/'.$config->logo, 50,$config->cherity_name,$config->address."\n"."Phone: ".$config->phone, array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,0,0), array(0,0,0));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins('10', '27', '5');
$pdf->SetHeaderMargin('5');
$pdf->SetFooterMargin('10');
$pdf->SetAutoPageBreak(TRUE,'18');
$pdf->AddPage('P','A4');

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($name, 'I');