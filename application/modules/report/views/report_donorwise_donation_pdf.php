<?php 

$counter=0;
$donor=0;
$totalDonation=0; 
if(count($list) >0){
	$html='<h3 style="text-align:center">Donorwise Donation Report</h3>';
foreach($list as $row){
	if($donor !=$row['donor_id']){

			if($counter>0){
	            $html.='<tr><td colspan="4" align="right"> Total Donation Amount :<b>'.number_format($totalDonation,2).'</b></td></tr></tbody>
		                    </table><br><br>';
	        }

	        
	        $html.= '<div>
						<table width="100%" style="font-size:9px">
							<tr>
								<td>Donor Id : <b>'.$row['donor_id'].'</b></td>
								<td align="right">Donor Name : <b>'.$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel'].'</b></td>
							</tr>
							<tr>
								<td>Home Address  :<strong>'.$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'].'</strong></td>
								<td align="right">Office Address : <b>'.$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'].'</b></td>
							</tr>
							<tr>
								<td>Business Name : <b>'.$row['donor_businessname'].'</b></td>
								<td align="right">Email  : <b>'.$row['donor_email'].'</b></td>
							</tr>
							<tr>
								<td>Contact No : <b>'.$row['donor_homephone'].','.$row['donor_officephone'].'</b></td>
								<td align="right">Mobile  : <b>'.$row['donor_mobile'].'</b></td>
							</tr>
							
						</table>
					</div>
					<table style="font-size:9px">
	                    <thead>
	                        <tr>
	                        	<th align="left" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Donation Id</th>
	                            <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Donation Date</th>
	                            <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Event Name</th>
	                            <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Donation Type</th>
	                            <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Gift Aid Consent</th>
	                            <th style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Currency</th>
	                            <th align="right" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
	                        </tr>
	                    </thead><tbody>
	        ';
	        $totalDonation=0;
        }
        $donor=trim($row['donor_id']);
        $totalDonation += $row['donation_amount'];



		if ($counter%2==0){
			$html.='<tr>';
		}else{
			$html.='<tr bgcolor="#EFEFEF">';
		}
		if($row['giftaid_consent'] == 1) {$giftaid_consent_stat = 'Yes';}else{$giftaid_consent_stat = 'No';}
	$html.='
            <td align="left">'.$row['donation_id'].'</td>
            <td>'.date('d-m-Y',strtotime($row['donation_date'])).'</td>
            <td>'.$row['event_name'].'</td>
            <td>'.$row['donation_type'].'</td>
            <td>'.$giftaid_consent_stat.'</td>
            <td>'.$row['currency_name'].'</td>
            <td align="right">'.$row['donation_amount'].'</td>
        </tr>';
    $counter++;

    
}
$html.='<tr><td colspan="4" align="right"> Total Donation Amount :<b>'.number_format($totalDonation,2).'</b></td></tr></tbody>
		                    </table><br><br>';
	        
}else{
	$html="No result to display";
}


//echo $html;
//var_dump($counter);
$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Donorwise Donation');
//config setting
$name="Donorwise Donation".Date('d-m-Y');
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
$pdf->AddPage('L','A4');

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($name, 'I');