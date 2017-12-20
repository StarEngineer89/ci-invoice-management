<?php 
$html='<h3 style="text-align:center">Citywise Donation Type Report</h3>
            	<table width="100%" style="font-size:9px">
	                        <thead>
	                            <tr>
	                                <th  style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Donation Type</th>
	                                <th  style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Currency</th>
	                                <th  style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
	                            </tr>
	                        </thead>
	                        <tbody>';
$counter=0;
$city=0;
$donationtotal=0;
$allDonationSum=0;
foreach($list as $row){
	$allDonationSum=$allDonationSum + $row['donation_amount'];
    if($home_city =="1"){
        if($city != trim($row['donor_homecityid'])){
            if($counter>0){
                $html.="<tr bgcolor='#007CF9'><td colspan='3' align='right'>Total Amount : <b>".number_format($donationtotal,2)."</b></td></tr>";
            }
            $html.="<tr bgcolor='#FFFFC4'> <td colspan='3' ><b>".$row['city_name']."</b></td></tr>";
            $donationtotal=0;
        }
        $city=trim($row['donor_homecityid']);
    }else{
        if($city != trim($row['donor_officecity'])){
            if($counter>0){
                $html.="<tr bgcolor='#007CF9'><td colspan='3' align='right'> Total Amount :<b>".number_format($donationtotal,2)."</b></td></tr>";
            }
            $html.="<tr bgcolor='#FFFFC4'><td colspan='3' ><b>".$row['city_name']."</b></td></tr>";
            $donationtotal=0;
        }
        $city=trim($row['donor_officecity']);
    }
    $donationtotal=$donationtotal+$row['donation_amount']; 
	if ($counter%2==0){
		$html.='<tr>';
	}else{
		$html.='<tr bgcolor="#EFEFEF">';
	}
	$html.='
            <td>'.$row["dt_name"].'</td>
            <td>'.$row["currency_name"].'</td>
            <td align="right">'.number_format($row["donation_amount"],2).'</td>
        </tr>';
    $counter++;
}
$html.="<tr bgcolor='#007CF9'><td colspan='3' align='right'>Total Amount : <b>".number_format($donationtotal,2)."</b></td></tr>
<tr bgcolor='#007CF9'><td colspan='3' align='right'>Grand Total Amount : <b>".number_format($allDonationSum,2)."</b></td></tr>";
$html.= '</tbody>
                </table>

                
                ';
                echo $html;


// $this->load->library('mypdf');
// $pdf = new mypdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->SetCreator($this->session->userdata('sess_user_name'));
// $pdf->SetAuthor($this->session->userdata('sess_user_name'));
// $pdf->SetTitle('Report Citywise Donation Type');
// //config setting
// $name="Citywise Donation Type".Date('d-m-Y');
// $config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));

// // set default header data
// $pdf->SetHeaderData('assets/image/setUpwindow/'.$config->logo, 50,$config->cherity_name,$config->address."\n"."Phone: ".$config->phone, array(0,0,0), array(0,0,0));
// $pdf->setFooterData(array(0,0,0), array(0,0,0));
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// // set margins
// $pdf->SetMargins('10', '27', '5');
// $pdf->SetHeaderMargin('5');
// $pdf->SetFooterMargin('10');
// $pdf->SetAutoPageBreak(TRUE,'18');
// $pdf->AddPage('P','A4');

// $pdf->writeHTML($html, true, false, true, false, '');
// $pdf->Output($name, 'I');