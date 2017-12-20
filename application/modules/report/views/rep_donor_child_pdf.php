<?php 
$donor_name = @$list[0]['donor_name_payment'];
$donor_address = @$list[0]['donor_address'];
$city_name = (@$list[0]['city_name']);
$contact_no = (@$list[0]['contact_no']);
$donor_email = @$list[0]['donor_email'];
$donor_officeaddress = @$list[0]['donor_officeaddress'];
$html ='<h3 style="text-align:center">Report Donor Child Sponsor Payment</h3>
    <table style="font-size:9px; width:500px; margin:0; padding;0">
        <tr>
            <td>Donor Name : <b>'.$donor_name.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Address : <b>'.$donor_address.'</b>       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            City : <b>'.$city_name.'</b></td>
        </tr>
        <tr>
            <td>Contact No : <b>'.$contact_no.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Email : <b>'.$donor_email.'</b>       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Office : <b>'.$donor_officeaddress.'</b></td>
        </tr>
        <tr>
            <td>From Date : <b>'.$fromDate.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            To Date : <b>'.$toDate.'</b></td>
        </tr>
    </table><br/>';
$html .='<br>
	<table >
        <thead>
           <tr>

            <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Payment Date</th>
            <th width="30%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Child Name</th>
            <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Purpose </th>
            <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Donation Type </th>
            <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Amount</th>
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
            <td width="20%" style="font-size:10px">'.$row['distributed_date'].'</td>
            <td width="30%" style="font-size:10px">'.$row['orphan_childName'].'</td>
            <td width="20%" style="font-size:10px">'.$row['purpose'].'</td>
            <td width="20%" style="font-size:10px">'.$row['support_type'].'</td>
            <td width="20%" style="font-size:10px">'.$row['support_amount'].'</td>
        </tr>';
    $counter++;
    $total += @$row['support_amount'];
}
$html .= '<tr>
            <th colspan="4" style="font-weight: bold; text-align: right;">Total :</th>
            <td style="font-weight: bold;">'.$total.'</td>
        </tr>';
$html.= '</tbody>
</table><br>';


$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Donor Child Sponsor Payment');
//config setting
$name="Report Donor Child Sponsor Payment ".Date('d-m-Y');
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