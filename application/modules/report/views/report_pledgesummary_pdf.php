<?php
if($pledge_paid=="0"){$pledge_type="All";}elseif($pledge_paid=="1"){ $pledge_type ="Unpaid";}else{ $pledge_type="Paid";}
$html ='	
        	<h3 style="text-align:center">Pledge Summary Report</h3>
        	<div>
				<table>
					<tr>
						<td>From date : <b>'.$from_date.'</b></td>
						<td>To Date : <b>'.$to_date.'</b></td>
					</tr>
					<tr>
						<td> Pledge Type:<strong>'.$pledge_type.'</strong></td>
						<td>Donor Type : <b>'.$donor_type.'</b></td>
					</tr>
					<tr>
						<td>City : <b>'.$city.'</b></td>
						<td>Event : <b>'.$event.'</b></td>
					</tr>
				</table>
			</div>
        	<table width="100%" cellspacing="0px" style="font-size:9px;">
                        <thead>
                            <tr>
                                <th width="5%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Donor Id</th>
                                <th width="15%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Donor Name</th>
                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Home address</th>
                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Office Address</th>
                                <th width="5%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Cell</th>
                                <th width="12%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Email</th>
                                <th width="6%" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Pledge</th>
                                <th width="6%" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Received</th>
                                <th width="6%" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
                            </tr>
                        </thead>

                        <tbody>

            ';
            $counter=0;
            $totalPledge=0;
            $totalReceived=0;
            $totalBalance=0;
            foreach($list as $row){
            	$balance = $row['dp_amount'] - $row['received'];
                if($pledge_paid=="0"){//all
                    $totalPledge= $totalPledge + $row['dp_amount'];
                    $totalReceived = $totalReceived + $row['received'];
                    $totalBalance = $totalBalance + $balance;
                    if($counter%2==0)
                        $html.="<tr>";
                    else
                        $html.='<tr bgcolor="#EFEFEF">';
                }
                elseif($pledge_paid=="1"){//unpaid
                    if($balance != 0){
                        $totalPledge= $totalPledge + $row['dp_amount'];
                        $totalReceived = $totalReceived + $row['received'];
                        $totalBalance = $totalBalance + $balance;
                    }
                    if($counter%2==0)
                        $html.="<tr>";
                    else
                        $html.='<tr bgcolor="#EFEFEF">';

                }
                else{//paid
                    if($balance == 0){
                        $totalPledge= $totalPledge + $row['dp_amount'];
                        $totalReceived = $totalReceived + $row['received'];
                        $totalBalance = $totalBalance + $balance;
                    }
                    if($counter%2==0)
                        $html.="<tr>";
                    else
                        $html.='<tr bgcolor="#EFEFEF">';
                }
                	
            	$html.='
                            <td width="5%">'.$row['donor_id'].'</td>
                            <td width="15%">'.$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel'].'</td>
                            <td width="20%">'.$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode'].'</td>
                            <td width="20%">'.$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode'].'</td>
                            <td width="5%">'.$row['donor_mobile'].'</td>
                            <td width="12%">'.$row['donor_email'].'</td>
                            <td width="6%" align="right">'.number_format($row['dp_amount'],2).'</td>
                            <td width="6%" align="right">'.number_format($row['received'],2).'</td>
                            <td width="6%" align="right">'.number_format($balance,2).'</td>
                        </tr>';
            $counter++;
	        }
	        $html.= '
	        <tr><td></td><td></td><td></td><td></td><td></td><td><b>Total :</b></td><td align="right"><b>'.number_format($totalPledge,2).'</b></td><td align="right"><b>'.number_format($totalReceived,2).'</b></td><td align="right"><b>'.number_format($totalBalance,2).'</b></td></tr>
	        </tbody>
		                    </table><br>
		                    <p>Total Donors: <b>'.count($list).'</b></p>

		                    
		                    ';
	        //echo $html;


$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Pledge Summary');
//config setting
$name="pledge Summary ".Date('d-m-Y');
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
