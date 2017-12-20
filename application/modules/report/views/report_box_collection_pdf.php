<?php
$html =
            '	
            	<h3 style="text-align:center">Box Collection Detail Report</h3>
            	<p>From Date :'.$from_date.'  To Date : '.$to_date.'</p>
            	<table >
	                        <thead>
	                            <tr>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Donation Id</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Date</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Box Id</th>
	                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Donor Businessname</th>
	                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Address</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Postcode</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Phone</th>
	                                <th width="10%" style="text-align:right;border-bottom: 1px solid #000000; font-weight: bold;">Amount</th>
	                            </tr>
	                        </thead>

	                        <tbody style="font-size:10px">

            ';
            $root=0;
            $allDonationSum=0;
            $counter=0;
            foreach($list as $row){
            	$allDonationSum=$allDonationSum + $row['donation_amount'];
                if($root != trim($row['root_id']))
                    $html.="<tr bgcolor='#FFFFC4'><td ><b>".$row['root_name']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

                $root=trim($row['root_id']);
				if ($counter%2==0){
					$html.='<tr>';
				}else{
					$html.='<tr bgcolor="#EFEFEF">';
				}
                	
            	$html.='
                            <td width="10%">'.$row['donation_id'].'</td> 
                            <td width="10%">'.date('d-m-Y',strtotime($row['donation_date'])).'</td>
                            <td width="10%">'.$row['box_id'].'</td>
                            <td width="20%">'.$row['donor_businessname'].'</td>
                            <td width="20%">'.$row['donor_officeaddress'].'</td>
                            <td width="10%">'.strtoupper($row['donor_officepostcode']).'</td>
                            <td width="10%">'.$row['donor_officephone'].'</td>
                            <td width="10%" align="right">'.number_format($row['donation_amount'],2).'</td>
                        </tr>';
                $counter++;
	        }
	        $html.= '
	        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Grand Total Amount</td><td>'.number_format($allDonationSum,2).'</td> </tr>
	        </tbody>
		                    </table><br>

		                    
		                    ';
	        //echo $html;


$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Box Donation Detail');
//config setting
$name="Box Donation Detailreport ".Date('d-m-Y');
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
