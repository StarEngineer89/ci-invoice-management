
<!DOCTYPE html>
<html>
	<head>
		<title>Donorwise Donation </title>
		<style type="text/css">
			#thanksletter
			{	
				float:left;
				width:100%;
				font-size:13px;
				padding:0px;
				font-family:Times New Roman, Times, serif;
				margin:1px 5px;
			}
			#donation_receipt td
			{
				border:solid #000000 1px;
			}
		</style>
	</head>
	<body style="margin:0px auto;">
    	<div style="width:8.5in;height:11in;margin:0px auto 5px;padding:0px;">
        <div style="width:6.5in;height:10.8in;border:solid black 0px;margin:.1in 1in;padding:0px;">
            <div id="thanksletter">
                <?php $config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));?>
                
                <div style="float:right;margin:0px;padding:0px;width:200px;text-align:right;">
                    <img src="<?=base_url().'assets/image/setUpwindow/'.$config->logo?>" height="65px"/>
                </div>
                <div style="float:right;margin:0px 5px;padding:0px; text-align:center;color:#00CC00;width:3.5in;">
                    <?php
                        echo"<b>".$config->cherity_name."</b><br />";
                        echo $config->address."<br />";
                        echo"Phone: ".$config->phone;
                        echo" Fax: ".$config->fax;
                    ?>
                </div>
                
            </div>
            <hr />
            <div style="text-align:center"><h2>Donorwise Donation Report</h2></div>
            
                    <?php
                    $donor=0;
                    $totalDonation=0; 
                    $counter=0;
                    foreach($list as $row){
                        if($donor !=$row['donor_id']){
                            if($counter>0){
                                echo "<tr><td></td><td></td><td></td><td align='right'> Total Donation :<b>".number_format($totalDonation,2)."</b></td></tr><hr><br><br><br>";
                            }
                            
                            echo "<p>Donor Id : <b>".$row['donor_id']."</b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Donor Name : <b>".$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel']."</b></p>
                                    <p>Home Address  : <b>".$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode']."</b></p>
                                    <p>Office Address  : <b>".$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode']."</b></p>
                                    <p>Business Name : <b>".$row['donor_businessname']."</b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Email : <b>".$row['donor_email']."</b></p> 
                                    <p>Contact No : <b>".$row['donor_homephone'].",".$row['donor_officephone']."</b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Mobile : <b>".$row['donor_mobile']."</b></p>

                                    <table cellspacing='0px' width='100%' style='font-size:11px;'>
                                        <thead>
                                            <tr>
                                                <th align='left' style='border-bottom:1px solid #000'>Donation Id</th>
                                                <th style='border-bottom:1px solid #000'>Donation Date</th>
                                                <th style='border-bottom:1px solid #000'>Event Name</th>
                                                <th style='border-bottom:1px solid #000'>Donation Type</th>
                                                <th style='border-bottom:1px solid #000'>Gift Aid Consent</th>
                                                <th style='border-bottom:1px solid #000'>Currency</th>
                                                <th style='border-bottom:1px solid #000'align='right'>Amount</th>
                                            </tr>
                                        </thead><tbody>
                            ";
                            $totalDonation=0;
                            }
                        $donor=trim($row['donor_id']);
                        $totalDonation += $row['donation_amount'];
                        if($row['giftaid_consent'] == 1) {$giftaid_consent_stat = 'Yes';}else{$giftaid_consent_stat = 'No';}
                        if($counter%2==0)
                            echo"<tr>";
                        else
                            echo'<tr bgcolor="#EFEFEF">';
                    ?>
                    
                        <td align="left"><?=$row['donation_id']?></td>
                        <td ><?php echo date('d-m-Y',strtotime($row['donation_date']))?></td>
                        <td ><?php echo $row['event_name']?></td>
                        <td ><?php echo $row['donation_type']?></td>
                        <td ><?php echo $giftaid_consent_stat?></td>
                        <td ><?php echo $row['currency_name']?></td>
                        <td align="right"><?=$row['donation_amount']?></td>
                    </tr>
                        
                    <?php $counter++;}?>

                    </tbody>
                     </table>
                     
                
            <div id="thanksletter">
                <hr />

                <?php  echo"Printed on: ".date("d-m-Y"); ?>
            </div>
            
        </div>
    </div>
	</body>
</html>
