<?php 
if(@$list[0]['psite_status'] == 1){
            $status = 'Active';
        }else{
            $status = 'Inactive';
        }
$psite_name = @$list[0]['psite_name'];
$orphanChildName = (@$list[0]['orphanChildName']);
$address = @$list[0]['address'];
$city_name = (@$list[0]['city_name']);
$html ='<h3 style="text-align:center">Project Child Payment</h3>
    <table style="font-size:10px; width:200px; margin:0; padding;0">
        <tr>
            <td>Project Name : <b>'.$psite_name.'</b></td>
        </tr>
        <tr>
            <td>Child Name : <b>'.$orphanChildName.'</b></td><td>
            Address : <b>'.$address.'</b>       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            City : <b>'.$city_name.'</b></td>
        </tr>
        <tr>
            <td>From Date : <b>'.$fromDate.'</b></td><td>
            To Date : <b>'.$toDate.'</b>       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Current Status : <b>'.$status.'</b></td>
        </tr>
    </table>';
$html .='<br>
	<table >
        <thead>
           <tr>

            <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Payment Date</th>
            <th width="30%" style="border-bottom: 1px solid #000000; font-weight: bold; font-size:10px">Donor Name</th>
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
            <td width="30%" style="font-size:10px">'.$row['donor_name'].'</td>
            <td width="20%" style="font-size:10px">'.$row['distributed'].'</td>
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
$pdf->SetTitle('Project Child Payment');
//config setting
$name="Project Child Payment ".Date('d-m-Y');
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