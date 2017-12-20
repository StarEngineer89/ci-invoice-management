
<!DOCTYPE html>
<html>
	<head>
		<title>Gift Aid Claim</title>
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
            <div style="text-align:center"><h2>Gift Aid Claim</h2></div>
            
            <div id="thanksletter">
                
                    <table style="font-size:11px;">
                        <thead>
                            <tr>

                                <th colspan="3" align="left">From Date: <?php echo $this->input->post("fromDate");?></th>
                                <th colspan="5">To Date: <?php echo $this->input->post("toDate");?></th>
                            </tr>
                            <tr>
                                <th width="5%">Item</th>
                                <th width="5%">Title</th>
                                <th width="20%">First name</th>
                                <th width="20%">Last name</th>
                                <th width="30%">House name or number</th>
                                <th width="5%">Postcode</th>
                                <th width="5%">Aggregated donations</th>
                                <th width="5%">Sponsored event</th>
                                <th width="10%">Donation date</th>
                                <!-- <th width="10%" align="right">Amount</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter=1;
                            foreach($list as $row){
                                
                            ?>
                            <tr>
                                <td width="5%"><?=$counter?></td>
                                
                                <td width="5%"><?=$row['title_name']?></td>
                                <td width="20%"><?=$row['donor_namef']?></td>
                                <td width="20%"><?=$row['donor_namel']?></td>
                                <td width="10%"><?=$row['donorhome_address']?></td>
                                <td width="5%"><?=strtoupper($row['donor_postcode'])?></td>
                                <td width="10%" align="right"><?=$row['donation_amount']?></td>
                                <td width="5%"><?php echo $row['event_name']?></td>
                                <td width="10%"><?=date('d/m/Y',strtotime($row['donation_date']))?></td>
                                <!-- <td width="10%" align="right"><?=$row['donation_amount']?></td> -->
                            </tr>
                            
                            <?php $counter++;}?>
                            
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
