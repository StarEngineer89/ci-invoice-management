
<!DOCTYPE html>
<html>
	<head>
		<title>Route Report</title>
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
            <div style="text-align:center"><h2>Route Report</h2></div>
            
            <div id="thanksletter">
                <?php foreach($route_list as $row){?>
                    <h3 style="background-color:#FFFFC4"><?=$row['root_name']?></h3>
                    <table cellspacing="0px">
                        <thead>
                            <tr>
                                <th widtdh="5%">Sequence</th>
                                <th width="10%">Box No</th>
                                <th width="25%">Business Name</th>
                                <th width="30%">Address</th>
                                <th width="15%">Postcode</th>
                                <th width="10%">Phone</th>
                                <th width="5%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $box_list=$this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id']));
                            $total_box=count($box_list);
                            $total_active=count($this->mdl_general->GetAllInfo('dn_box','box_id',array('root_id'=>$row['root_id'],'box_active'=>'1')));
                            $total_inactive=$total_box-$total_active;
                            $counter=1;
                            foreach($box_list as $row){
                                if($counter%2==0)
                                    echo"<tr>";
                                else
                                    echo'<tr bgcolor="#EFEFEF">';
                                
                            ?>
                            
                                <td width="5%"><?=$row['box_Seq']?></td>
                                <td width="10%"><?=$row['box_id']?></td>
                                <td width="30%">
                                    <?php 
                                    try {
                                        $donor=$this->mdl_general->GetInfoByRow('dn_donor','donor_id',array('donor_id'=>$row['donor_id']));
                                        $donor_businessname=$donor->donor_businessname;
                                        $address=$donor->donor_officeaddress;
                                        $postcode=$donor->donor_officepostcode;
                                        $phone=$donor->donor_officephone;

                                    } catch (Exception $e) {
                                        $donor_businessname="N/A";
                                        $address="N/A";
                                        $postcode="N/A";
                                        $phone="N/A";
                                    }
                                    echo $donor_businessname;
                                    ?>
                                    
                                </td>
                                <td width="30%"><?=$address?></td>
                                <td width="15%"><?=$postcode?></td>
                                <td width="10%"><?=$phone?></td>
                                <td align="center" width="5%"><?php if($row['box_active']){echo "Y";}else{ echo "N";}?></td>
                            </tr>
                            
                            <?php $counter++; }?>
                            
                        </tbody>
                    </table>
                    <h4>Total Box: <?=$total_box?> &nbsp&nbsp Total active: <?=$total_active ?> &nbsp&nbsp Total inactive :<?=$total_inactive?></h4>
                <?php }?>
                
            </div>
            <div id="thanksletter">
                <hr />
                <?php echo"Printed on: ".date("d-m-Y"); ?>
            </div>
            
        </div>
    </div>
	</body>
</html>
