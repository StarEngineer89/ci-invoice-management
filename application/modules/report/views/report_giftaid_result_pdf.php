<?php
$html =
            '	
            	<h3 style="text-align:center">Gift Aid Claim</h3>
            	<table style="font-size:11px;">
	                        <thead>
	                        	<tr>
	                            <th colspan="2" align="left">From Date: '.$this->input->post("fromDate").'</th>
                                <th colspan="5">To Date: '.$this->input->post("toDate").'</th>
                                </tr>
	                            <tr>
	                                <th width="4%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;" >Item</th>
	                                <th width="8%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Title</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">First name</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Last Name</th>
	                                <th width="18%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">House name or number</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Postcode</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Aggregated donations</th>
	                                <th width="20%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Sponsored event</th>
	                                <th width="8%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Donation Date</th>
	                            </tr>
	                        </thead>

	                        <tbody>

            ';
            $counter=1;
            foreach($list as $row){
            		if ($counter%2==0){
						$html.='<tr>';
					}else{
						$html.='<tr bgcolor="#EFEFEF">';
					}
                	
                	$html.='
                                <td width="3%">'.$counter.'</td>
                                
                                <td width="8%">'.$row['title_name'].'</td>
                                <td width="10%">'.$row['donor_namef'].'</td>
                                <td width="10%">'.$row['donor_namel'].'</td>
                                <td width="18%">'.$row['donorhome_address'].'</td>
                                <td width="10%">'.strtoupper($row['donor_postcode']).'</td>
                                <td width="10%" align="right">'.$row['donation_amount'].'</td>
                                <td width="20%">'.$row['event_name'].'</td>
                                <td width="8%">'.date('d/m/Y',strtotime($row['donation_date'])).'</td>
                            </tr>';
                $counter++;
	        }
	        $html.= '</tbody>
		                    </table><br>
		                    <p>Total Donors: <b>'.count($list).'</b></p>

		                    
		                    ';
	        //echo $html;


$this->load->library('mypdf');
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Gift Aid Claim');
//config setting
$name="Gift aid consent report ".Date('d-m-Y');
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
