<?php 

$html =
            '	
            	<h3 style="text-align:center">Donors List</h3>
            	<h5>City : '.$city_name .'</h5>
            	<table style="font-size:8px;" >
	                        <thead>
	                            <tr>
	                                <th width="5%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Id</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Name</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Business Name</th>
	                                <th width="15%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Home Address</th>
	                                <th width="15%"style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Office Address</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Home Phone</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Office Phone</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Mobile</th>
	                                <th width="15%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Email</th>
	                            </tr>
	                        </thead>

	                        <tbody >

            ';
            $counter=0;
            $city=0;
            $mCitydonor = 0;
            foreach($list as $row){
            	if($home_city =="1"){
                    if($city != $row['donor_homecityid']){
                        if($counter >0){
                            $html.= "<tr bgcolor='#FFFFC4'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>Total Donors :</td><td> <b>".$mCitydonor."</b></td></tr>";
                        
                        }
                        $mCitydonor=0;
                        if($city_name=="All"){
                        	$html.= "<tr bgcolor='#FFFFC4'><td ><b>".$row['homecity']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                    	}
                    }
                    $mCitydonor++;
                    $city=trim($row['donor_homecityid']);
                }else{
                    if($city != $row['donor_officecity']){
                        if($counter >0){
                            $html.= "<tr bgcolor='#FFFFC4'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>Total Donors :</td><td> <b>".$mCitydonor."</b></td></tr>";
                        }
                        $mCitydonor=0;
                        if($city_name=="All"){
                        	$html.= "<tr bgcolor='#FFFFC4'><td ><b>".$row['officecity']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                    	}
                    }
                    $mCitydonor++;
                    $city=trim($row['donor_officecity']);
                }




            		if ($counter%2==0){
						$html.='<tr>';
					}else{
						$html.='<tr bgcolor="#EFEFEF">';
					}
					$donor_name=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel'] ;
		            $home_address=$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode'];
		            $office_address=$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode'];
                	
                	$html.='
                                
                                <td width="5%">'.$row['donor_id'].'</td>
                                <td width="10%">'.$donor_name.'</td>
                                <td width="10%">'.$row['donor_businessname'].'</td>
                                <td width="15%">'.$home_address.'</td>
                                <td width="15%">'.$office_address.'</td>
                                <td width="10%">'.$row['donor_homephone'].'</td>
                                <td width="10%">'.$row['donor_officephone'].'</td>
                                <td width="10%">'.$row['donor_mobile'].'</td>
                                <td width="15%">'.$row['donor_email'].'</td>
                            </tr>';
                $counter++;
	        }
	        $html.= '<tr bgcolor="#FFFFC4"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align="right">Total Donors :</td><td> <b>'.$mCitydonor.'</b></td></tr>
	        			</tbody>
		                    </table><br>
		                    

		                    
		                    ';






$this->load->library('mypdf');
ob_clean();
$pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator($this->session->userdata('sess_user_name'));
$pdf->SetAuthor($this->session->userdata('sess_user_name'));
$pdf->SetTitle('Report Donor Citywise');
//config setting
$name="Donor Citywise report ".Date('d-m-Y');
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
