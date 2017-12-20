
<!DOCTYPE html>
<html>
	<head>
		<title>Donation Report</title>
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
            <div style="text-align:center"><h2>Donation Report</h2></div>
            <p>From date : <b><?=$from_date?></b>  To date : <b><?=$to_date?></b></p>
            <p>City : <b><?=$city?></b>  Donation Type : <b><?=$donation_type?></b></p>
            <p>From Amount : <b><?=$from_amount?></b>  To Amount : <b><?=$to_amount?></b></p>
            
            <div id="thanksletter">
                
                    <table cellspacing="0px" style="font-size:12px">
                        <thead>
                            <tr>
                                <th width="5%" align="left">Id</th>
                                <th width="5%">Date</th>
                                <th width="10%">Name</th>
                                <th width="15%">Business Name</th>
                                <th width="15%">Home Address</th>
                                <th width="15%">Office Address</th>
                                <th width="10%">Mobile</th>
                                <th width="10%">Home Phone</th>
                                <th width="10%">Office Phone</th>
                                <th width="5%" align="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter=1;
                            foreach($list as $row){
                                if($counter%2==0)
                                    echo"<tr>";
                                else
                                    echo'<tr bgcolor="#EFEFEF">';
                            ?>
                                <td width="5%" align="left"><?=$row['donor_id']?></td>
                                <td width="5%" ><?=date('d-m-Y',strtotime($row['donation_date']))?></td>
                                <td width="10%"><?=$row['donor_namef'].' '.$row['donor_namem'].' '.$row['donor_namel']?></td>
                                <td width="15%"><?=$row['donor_businessname']?></td>
                                <td width="15%"><?=$row['donorhome_address'].' '.$row['homecity'].' '.$row['donor_postcode']?></td>
                                <td width="15%"><?=$row['donor_officeaddress'].' '.$row['officecity'].' '.$row['donor_officepostcode']?></td>
                                <td width="10%"><?=$row['donor_mobile']?></td>
                                <td width="10%"><?=$row['donor_homephone']?></td>
                                <td width="10%"><?=$row['donor_officephone']?></td>
                                <td width="5%" align="right"><?=number_format($row['donation_amount'],2)?></td>
                            </tr>
                            
                            <?php $counter++;}?>
                            
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
