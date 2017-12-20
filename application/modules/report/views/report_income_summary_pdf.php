<?php 
$html='<h3 style="text-align:center">Report Income Summary</h3><br>
	<div style="text-align:left">From : <b>'.$from.'</b>  To :<b>'.$to.'</b></div><br><br>
            	<table >
	                        <thead>
	                            <tr>
	                                <th align="left "width="20%" style="border-bottom: 1px solid #000000; font-weight: bold;" >Income ID</th>
	                                <th width="40%" style="border-bottom: 1px solid #000000; font-weight: bold;">Date</th>
	                                <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold;">Currency </th>
	                                <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold;" align="right">Amount</th>
	                            </tr>
	                        </thead>
	                        <tbody >';
$counter=1;
$total=0;
foreach($list as $row){

	if ($counter%2==0){
		$html.='<tr>';
	}else{
		$html.='<tr bgcolor="#EFEFEF">';
	}
	$html.='
            <td width="20%" style="font-size:10px">'.$row['invoice_id'].'</td>
            <td width="40%" style="font-size:10px">'.date('d-m-Y',strtotime($row['date'])).'</td>
            <td width="20%" style="font-size:10px">'.$row['currency_name'].'</td>
            <td width="20%" style="font-size:10px" align="right">'.number_format($row['amount'],2).'</td>
        </tr>';
    $counter++;$total += $row['amount'];
}
$html.= '</tbody>
                </table><br>
                <p align="right"><b>Total amount: '.number_format($total,2).'</b> </p>

                
                ';



$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Income Summary');
//config setting
$name="Report Income Summary ".Date('d-m-Y');
$config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));

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