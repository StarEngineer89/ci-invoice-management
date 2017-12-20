<?php 
$html =
            '	
            	<h3 style="text-align:center">Route Report</h3>

            ';
            foreach ($route_list as $row){
	            $html.='<h5>'.$row['root_name'].'</h5>
	                    <table  style="font-size:9px">
	                        <thead>
	                            <tr>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Sequence</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Box No</th>
	                                <th width="25%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Business Name</th>
	                                <th width="25%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Address</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Postcode</th>
	                                <th width="10%" style="text-align:left;border-bottom: 1px solid #000000; font-weight: bold;">Phone</th>
	                                <th width="10%" style="text-align:center;border-bottom: 1px solid #000000; font-weight: bold;">Active</th>
	                            </tr>
	                        </thead>
	            ';
	            $box_list=$this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id']));
	            $total_box=count($box_list);
                $total_active=count($this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id'],'box_active'=>'1')));
                $total_inactive=$total_box-$total_active;
                $counter=1;
                foreach($box_list as $row){
                	try {
		                                        $donor=$this->mdl_general->GetInfoByRow('dn_donor','donor_id',array('donor_id'=>$row['donor_id']));
		                                        
		                                    } catch (Exception $e) {
		                                    	$donor=  new stdClass();
		                                        $donor->donor_businessname="N/A";
		                                        $donor->donor_officeaddress="N/A";
		                                        $donor->donor_officepostcode="N/A";
		                                        $donor->donor_officephone="N/A";
		                                    }
                	$html.='<tbody>';
                	if ($counter%2==0){
						$html.='<tr>';
					}else{
						$html.='<tr bgcolor="#EFEFEF">';
					}
			
			                		
		                        $html.='
		                                <td width="10%" style="text-align:left">'.$row['box_Seq'].'</td>
		                                <td width="10%" style="text-align:left">'.$row['box_id'].'</td>
		                                <td width="25%" style="text-align:left">'.$donor->donor_businessname.'</td>
			                            <td width="25%" style="text-align:left">'.$donor->donor_officeaddress.'</td>
			                            <td width="10%" style="text-align:left">'.$donor->donor_officepostcode.'</td>
			                            <td width="10%" style="text-align:left">'.$donor->donor_officephone.'</td>
                            			<td width="10%"style="text-align:center">';
                    if($row['box_active']=="1"){
                    	$html.='Y';
                    }else{ 
                    	$html.='N';}
                    $html.='</td>
                        </tr>';
                        $counter++;
                        }
		            $html.= '
		            <tr><td>Total Box : <strong>'.$total_box.'</strong> </td><td>Total active: <strong>'.$total_active.'</strong></td><td colspan="4">Total inactive : <strong>'.$total_inactive.'</strong></td></tr>
		            </tbody>
		                    </table>
		                    <p>          </p>
		                    ';
		            

                
	        }
	        

	        //echo $html;

			$this->load->library('mypdf');
            $pdf = new mypdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator($this->session->userdata('sess_user_name'));
            $pdf->SetAuthor($this->session->userdata('sess_user_name'));
            $pdf->SetTitle('Report Route');
            //config setting
            $name="Route report ".Date('d-m-Y');
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

?>