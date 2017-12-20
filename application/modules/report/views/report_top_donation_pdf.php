<?php
$html =
            '	
            	<h3 style="text-align:center">Top Donation Report</h3>
            	<div>
					<table>
						<tr>
							<td>From date : <b>'.$from_date.'</b></td>
							<td>To Date : <b>'.$to_date.'</b></td>
						</tr>
						<tr>
							<td>City :<strong>'.$city_name.'</strong></td>
							<td>Donor Type : <b>'.$donor_type_name.'</b></td>
						</tr>
						<tr>
							<td>Event : <b>'.$event.'</b></td>
						</tr>
					</table>
				</div>
            	<table style="font-size:9px" >
	                        <thead>
	                            <tr>
                                    <th width="5%" style="border-bottom:1px solid #000;font-weight: bold" align="left">Id</th>
	                            	<th width="15%" style="border-bottom:1px solid #000;font-weight: bold">Name</th>
                                    <th width="10%" style="border-bottom:1px solid #000;font-weight: bold">Business Name</th>
                                    <th width="15%" style="border-bottom:1px solid #000;font-weight: bold">Home Address</th>
                                    <th width="15%" style="border-bottom:1px solid #000;font-weight: bold">Office Address</th>
                                    <th width="10%" style="border-bottom:1px solid #000;font-weight: bold">Mobile</th>
                                    <th width="10%" style="border-bottom:1px solid #000;font-weight: bold">Home Phone</th>
                                    <th width="10%" style="border-bottom:1px solid #000;font-weight: bold">Office Phone</th>
                                    <th width="10%" align="right" style="border-bottom:1px solid #000;font-weight: bold">Amount</th>
	                            </tr>
	                        </thead>

	                        <tbody>

            ';
            $counter=0;
            $city=0;
            $allDonationSum=0;
            $donationtotal = 0;

            foreach($list as $row){
            	$allDonationSum=$allDonationSum + $row['donation_amount'];
                if($home_city=="1"){
                    if($city != trim($row['donor_homecityid'])){
                        
                        $html.='<tr bgcolor="#FFFFC4"><td colspan="9"> <b>'.$row['homecity'].'</b></td></tr>';
                        $donationtotal=0;

                    }
                    $city=trim($row['donor_homecityid']);

                }else{
                    if($city != trim($row['donor_officecity'])){
                        
                        $html.='<tr bgcolor="#FFFFC4"><td colspan="9"> <b>'.$row['homecity'].'</b></td></tr>';
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
                                <td width="5%" >'.$row['donor_id'].'</td>
                                <td width="15%">'.$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel'].'</td>
                                <td width="10%">'.$row['donor_businessname'].'</td>
                                <td width="15%">'.$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'].'</td>
                                <td width="15%">'.$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'].'</td>
                                <td width="10%">'.$row['donor_mobile'].'</td>
                                <td width="10%">'.$row['donor_homephone'].'</td>
                                <td width="10%">'.$row['donor_officephone'].'</td>
                                <td width="10%" align="right">'.number_format($row['donation_amount'],2).'</td>
                            </tr>';
                $counter++;
	        }
	        $html.= '
            <tr><td align="right" colspan="9">Total : <b>'.number_format($donationtotal,2).'</b></td></tr>
            <tr><td align="right" colspan="9">Grand Total : <b>'.number_format($allDonationSum,2).'</b></td></tr>
            </tbody>
		                    </table><br>
		                    <p>Total Donors: <b>'.count($list).'</b></p>

		                    
		                    ';
	        //echo $html;


$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Top Donation');
//config setting
$name="Top donation report ".Date('d-m-Y');
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
