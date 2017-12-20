
<!DOCTYPE html>
<html>
	<head>
		<title>Text Alert Report</title>
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
            <div style="text-align:center"><h2>Text Alert Report</h2></div>
            
            <div id="thanksletter">
                
                    <table>
                        <thead>
                            <tr>
                                <th align="left" width="10%">Id</th>
                                <th width="50%">Name</th>
                                <th width="20%">City</th>
                                <th align="right" width="20%">Mobile</th>
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
                                
                                <td width="10%"><?=$row['donor_id']?></td>
                                <td width="50%"><?=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel']?></td>
                                <td width="10%"><?=$row['cityname']?></td>
                                <td width="20%" align="right"><?=$row['donor_mobile']?></td>
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
