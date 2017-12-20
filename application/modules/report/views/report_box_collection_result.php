
<!DOCTYPE html>
<html>
	<head>
		<title>Box Collection Detail Report</title>
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
                <div style="text-align:center"><h2>Box Collection Detail Report</h2></div><br><br>
                <p>From Date :<b> <?=$from_date?></b> &nbsp&nbsp&nbsp&nbsp To Date : <b><?=$to_date?></b> </p>

                
                <table width="100%" cellspacing="0px">
                            <thead>
                                <tr>
                                    <th width="10%" align="left">Donation Id</th>
                                    <th width="10%" >Date</th>
                                    <th width="10%">Box Id</th>
                                    <th width="20%">Donor Business Name</th>
                                    <th width="20%">Address</th>
                                    <th width="10%">Postcode</th>
                                    <th width="10%">Phone</th>
                                    <th width="10%" align="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $root=0;
                                $allDonationSum=0;
                                $counter=0;
                                foreach($list as $row){
                                    $allDonationSum=$allDonationSum + $row['donation_amount'];
                                    if($root != trim($row['root_id']))
                                        echo"<tr bgcolor='#FFFFC4'><td ><b>".$row['root_name']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

                                    $root=trim($row['root_id']);


                                    if($counter%2==0)
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';
                                ?>

                                    <td align="left" width="10%"><?=$row['donation_id']?></td>
                                    <td width="10%"><?=date('d-m-Y',strtotime($row['donation_date']))?></td>
                                    <td width="10%"><?=$row['box_id']?></td>
                                    <td width="20%"><?=$row['donor_businessname']?></td>
                                    <td width="20%"><?=$row['donor_officeaddress']?></td>
                                    <td width="10%"><?=$row['donor_officepostcode']?></td>
                                    <td width="10%"><?=$row['donor_officephone']?></td>
                                    <td width="10%" align="right"><?=number_format($row['donation_amount'],2)?></td>
                                </tr>
                                
                                <?php $counter++;}?>
                                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Total :</td><td><b><?=number_format($allDonationSum,2)?></b></td></tr>
                                
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
