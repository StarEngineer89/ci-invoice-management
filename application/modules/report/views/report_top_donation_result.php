
<!DOCTYPE html>
<html>
	<head>
		<title>Top Donations</title>
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
	<body style="margin:50px;">
    	<div style="margin:0px auto 5px;padding:0px;">
            <div style="padding:0px;">
                <div id="thanksletter">
                    <?php $config=$this->mdl_general->GetInfoByRow('acs_configration','config_id',array('config_id'=>"1"));?>
                    
                    <div style="float:left;margin:0px;padding:0px;width:200px;text-align:right;">
                        <img src="<?=base_url().'assets/image/setUpwindow/'.$config->logo?>" height="65px"/>
                    </div>
                    <div style="float:left;margin:0px 10px;padding:0px; text-align:center;color:#00CC00;">
                        <?php
                            echo"<b>".$config->cherity_name."</b><br />";
                            echo $config->address."<br />";
                            echo"Phone: ".$config->phone;
                            echo" Fax: ".$config->fax;
                        ?>
                    </div>
                    
                </div>
                <hr />
                <div style="text-align:center"><h2>Top Donation Report</h2></div>
                <p>From date : <b><?=$from_date?></b>  To date : <b><?=$to_date?></b></p>
                <p>City : <b><?=$city_name?></b>  Donor Type : <b><?=$donor_type_name?></b></p>
                <p>Event : <b><?=$event?></b></p>
                
                <div id="thanksletter">
                    
                        <table cellspacing="0px">
                            <thead>
                                <tr>
                                    <th style="border-bottom:1px solid #000" align="left">Id</th>
                                    <th style="border-bottom:1px solid #000" >Name</th>
                                    <th style="border-bottom:1px solid #000">Business Name</th>
                                    <th style="border-bottom:1px solid #000">Home Address</th>
                                    <th style="border-bottom:1px solid #000">Office Address</th>
                                    <th style="border-bottom:1px solid #000">Mobile</th>
                                    <th style="border-bottom:1px solid #000">Home Phone</th>
                                    <th style="border-bottom:1px solid #000">Office Phone</th>
                                    <th style="border-bottom:1px solid #000" align="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $counter=0;
                                $city=0;
                                $allDonationSum=0;
                                $donationtotal = 0;
                                foreach($list as $row){
                                        $allDonationSum=$allDonationSum + $row['donation_amount'];
                                        if($home_city=="1"){
                                            if($city != trim($row['donor_homecityid'])){
                                                if($counter>0){
                                                    echo "<tr bgcolor='#007CF9'><td colspan='9' align='right'> Total :<b>".number_format($donationtotal,2)."</b></td></tr>";
                                                }
                                                if($city_name =="All"){
                                                    echo "<tr bgcolor='#FFFFC4'><td colspan='9'> <b>".$row['homecity']."</b></td></tr>";
                                                }
                                                $donationtotal=0;

                                            }
                                            $city=trim($row['donor_homecityid']);

                                        }else{
                                            if($city != trim($row['donor_officecity'])){
                                                if($counter>0){
                                                    echo "<tr bgcolor='#007CF9'><td colspan='9' align='right'> Total :<b>".number_format($donationtotal,2)."</b></td></tr>";
                                                }
                                                if($city_name =="All"){
                                                    echo "<tr bgcolor='#FFFFC4'><td colspan='9'><b>".$row['officecity']."</b></td></tr>";
                                                }
                                                $donationtotal=0;
                                            }
                                            $city=trim($row['donor_officecity']);
                                        }
                                        $donationtotal=$donationtotal+$row['donation_amount'];
                                    if($counter%2==0)
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';
                                ?>
                                    <td align="left"><?=$row['donor_id']?></td>
                                    <td><?=$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel']?></td>
                                    <td><?=$row['donor_businessname']?></td>
                                    <td><?=$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode']?></td>
                                    <td><?=$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode']?></td>
                                    <td><?=$row['donor_mobile']?></td>
                                    <td><?=$row['donor_homephone']?></td>
                                    <td><?=$row['donor_officephone']?></td>
                                    <td align="right"><?=number_format($row['donation_amount'],2)?></td>
                                </tr>
                                
                                <?php $counter++;}?>
                                    <tr bgcolor='#007CF9'><td align="right" colspan="9">Total : <b><?=number_format($donationtotal,2)?></b></td></tr>
                                    <tr bgcolor='#007CF9'><td align="right" colspan="9">Grand Total : <b><?=number_format($allDonationSum,2)?></b></td></tr>
                                
                            </tbody>
                        </table>
                    
                </div>
                <div id="thanksletter">
                    <hr />
                    <?php  echo"Printed on: ".date("d-m-Y"); ?>
                </div>
                
            </div>
        </div>
	</body>
</html>
