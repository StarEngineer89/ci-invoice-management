
<!DOCTYPE html>
<html>
	<head>
		<title>Pledge Summary Report</title>
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
                <?php if($pledge_paid=="0"){$pledge_type="All";}elseif($pledge_paid=="1"){ $pledge_type ="Unpaid";}else{ $pledge_type="Paid";} ?>
            <div style="text-align:center"><h2>Pledge Summary Report</h2></div>
            <p>From date : <b><?=$from_date?></b>  To date : <b><?=$to_date?></b></p>
            <p>Pledge Type : <b><?=$pledge_type?></b>  Donor Type : <b><?=$donor_type?></b></p>
            <p>City : <b><?=$city?></b>  Event : <b><?=$event?></b></p>
            
            <div id="thanksletter">
                
                    <table width="100%" cellspacing="0px">
                        <thead>
                            <tr>
                                <th style="border-bottom:1px solid #000000" width="5%">Donor Id</th>
                                <th style="border-bottom:1px solid #000000" width="20%">Donor Name</th>
                                <th style="border-bottom:1px solid #000000" width="20%">Home Address</th>
                                <th style="border-bottom:1px solid #000000" width="20%">Office Address</th>
                                <th style="border-bottom:1px solid #000000" width="5%">Cell</th>
                                <th style="border-bottom:1px solid #000000" width="10%">Email</th>
                                <th style="border-bottom:1px solid #000000" width="5%" align="right">Pledge</th>
                                <th style="border-bottom:1px solid #000000" width="5%" align="right">Received</th>
                                <th style="border-bottom:1px solid #000000" width="10%" align="right">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
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
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';
                                }
                                elseif($pledge_paid=="1"){//unpaid
                                    if($balance != 0){
                                        $totalPledge= $totalPledge + $row['dp_amount'];
                                        $totalReceived = $totalReceived + $row['received'];
                                        $totalBalance = $totalBalance + $balance;
                                    }
                                    if($counter%2==0)
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';

                                }
                                else{//paid
                                    if($balance == 0){
                                        $totalPledge= $totalPledge + $row['dp_amount'];
                                        $totalReceived = $totalReceived + $row['received'];
                                        $totalBalance = $totalBalance + $balance;
                                    }
                                    if($counter%2==0)
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';
                                }
                                
                                
                            ?>
                            <tr>
                                <td width="5%"><?=$row['donor_id']?></td>
                                <td width="20%"><?=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel']?></td>
                                <td width="20%"><?=$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode']?></td>
                                <td width="20%"><?=$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode']?></td>
                                <td width="5%"><?=$row['donor_mobile']?></td>
                                <td width="10%"><?=$row['donor_email']?></td>
                                <td width="5%" align="right"><?=number_format($row['dp_amount'],2)?></td>
                                <td width="5%" align="right"><?=number_format($row['received'],2)?></td>
                                <td width="10%" align="right"><?=number_format($balance,2)?></td>
                            </tr>
                            
                            <?php $counter++;}?>
                            <tr><td></td><td></td><td></td><td></td><td></td><td><b>Total :</b></td><td align="right"><b><?=number_format($totalPledge,2)?></b></td><td align="right"><b><?=number_format($totalReceived,2)?></b></td><td align="right"><b><?=number_format($totalBalance,2)?></b></td></tr>
                            
                        </tbody>
                    </table>
                    <p>Total Donors : <b><?=count($list)?></b></p>
                
            </div>
            <div id="thanksletter">
                <hr />

                <?php  echo"Printed on: ".date("d-m-Y"); ?>
            </div>
            
        </div>
    </div>
	</body>
</html>
