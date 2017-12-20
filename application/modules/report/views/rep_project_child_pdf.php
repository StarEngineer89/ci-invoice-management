<?php 
if(@$list[0]['psite_status'] == 1){
            $status = 'Active';
        }else{
            $status = 'Inactive';
        }
$html='<h3 style="text-align:center">Project Child Report</h3><br>
<div style="text-align:left">Project Name : <b>'.@$list[0]['psite_name'].'</b>
'."<br></br>".'Status : <b>'.$status.'</b></div> 
            	<table >
	                        <thead>
	                           <tr>
           
                                <th width="40%" style="border-bottom: 1px solid #000000; font-weight: bold;">Child Name</th>
                                <th width="20%" style="border-bottom: 1px solid #000000; font-weight: bold;">Address</th>
                                <th width="10%" style="border-bottom: 1px solid #000000; font-weight: bold;">City </th>
                                <th width="10%" style="border-bottom: 1px solid #000000; font-weight: bold;" align="right">Status</th>
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
            <td width="40%" style="font-size:10px">'.$row['orphanChildName'].'</td>
            <td width="20%" style="font-size:10px">'.$row['country_name'].'</td>
            <td width="10%" style="font-size:10px">'.$row['city_name'].'</td>
            <td width="10%" style="font-size:10px">'.$row['status'].'</td>
        </tr>';
    $counter++;
}
$html.= '</tbody>
                </table><br>

                
                ';



$this->load->library('mypdf');
$pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Project Child REport');
//config setting
$name="Project Child REport ".Date('d-m-Y');
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