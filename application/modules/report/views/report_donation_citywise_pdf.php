<?php
$html =
            '	
            	<h3 style="text-align:center">Donation Report</h3>
            	<div>
					<table>
						<tr>
							<td>From date : <b>'.$from_date.'</b></td>
							<td>To Date : <b>'.$to_date.'</b></td>
						</tr>
						<tr>
							<td>City :<strong>'.$city.'</strong></td>
							<td>Donation Type : <b>'.$donation_type.'</b></td>
						</tr>
						<tr>
							<td>From Amount : <b>'.$from_amount.'</b></td>
							<td>To Amount : <b>'.$to_amount.'</b></td>
						</tr>
					</table>
				</div>
            	<table style="font-size:8px" >
	                        <thead>
	                            <tr>
	                            	<th width="5%" align="left" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Id</th>
	                            	<th width="9%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Date</th>
		                            <th width="12%" align="left" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Name</th>
	                                <th width="14%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Business Name</th>
	                                <th width="14%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Home Address</th>
	                                <th width="14%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Office Address</th>
	                                <th width="9%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Mobile</th>
	                                <th width="9%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Home Phone</th>
	                                <th width="9%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Office Phone</th>
	                                <th width="5%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" align="right">Amount</th>
	                            </tr>
	                        </thead>

	                        <tbody>

            ';
            $counter=1;
            $total_amount=0;
            foreach($list as $row){
            		if ($counter%2==0){
						$html.='<tr>';
					}else{
						$html.='<tr bgcolor="#EFEFEF">';
					}
                	
                	$html.='	<td width="5%" >'.$row['donor_id'].'</td>
                				<td width="9%" >'.date('d-m-Y',strtotime($row['donation_date'])).'</td>
                				<td width="12%"align="left">'.$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel'].'</td>
                                <td width="14%">'.$row['donor_businessname'].'</td>
                                <td width="14%">'.$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'].'</td>
                                <td width="14%">'.$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'].'</td>
                                <td width="9%">'.$row['donor_mobile'].'</td>
                                <td width="9%" >'.$row['donor_homephone'].'</td>
                                <td width="9%" >'.$row['donor_officephone'].'</td>
                                <td width="5%" align ="right">'.number_format($row['donation_amount'],2).'</td>
                            </tr>';
                $counter++;
                $total_amount=$total_amount+$row['donation_amount'];
	        }
	        $html.= '
	        <tr><td colspan="5">No. of  Donations: <b>'.count($list).'</b></td><td></td><td></td><td></td><td>Total amount : </td><td><b>'.number_format($total_amount,2).'</b></td></tr>
	        </tbody>
		                    </table><br>
		                    

		                    
		                    ';
	        //echo $html;


$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Donation Citywise');
//config setting
$name="Report Donation Citywise ".Date('d-m-Y');
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
