<?php 
$html='<h3 style="text-align:center">Text Alert Report</h3>
            	<table cellspacing="0px" style="font-size:9px">
	                        <thead>
	                            <tr>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Id</th>
	                                <th width="50%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Name</th>
	                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">City</th>
	                                <th width="20%" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Mobile</th>
	                            </tr>
	                        </thead>
	                        <tbody>';
$counter=1;
foreach($list as $row){
	if ($counter%2==0){
		$html.='<tr>';
	}else{
		$html.='<tr bgcolor="#EFEFEF">';
	}
	$html.='
            <td width="10%">'.$row['donor_id'].'</td>
            <td width="50%">'.$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel'].'</td>
            <td width="20%">'.$row['cityname'].'</td>
            <td width="20%" align="right">'.$row['donor_mobile'].'</td>
        </tr>';
    $counter++;
}
$html.= '</tbody>
                </table><br>
                <p>Total Donors: <b>'.count($list).'</b></p>

                
                ';



$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Text Alert');
//config setting
$name="Text Alert".Date('d-m-Y');
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