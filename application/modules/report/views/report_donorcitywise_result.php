
<!DOCTYPE html>
<html>
	<head>
		<title>Donor Report</title>
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
                <div style="text-align:center"><h2>Donors List</h2></div>
                <p>City : <b><?=$city_name?></b></p>
                <div id="thanksletter">
                    
                        <table cellspacing="0px">
                            <thead>
                                <tr>
                                    
                                    <th >Id</th>
                                    <th >Name</th>
                                    <th >Business Name</th>
                                    <th >Home Address</th>
                                    <th >Office Address</th>
                                    <th >Home Phone</th>
                                    <th >Office Phone</th>
                                    <th >Mobile</th>
                                    <th  align="right">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $counter=0;
                                $city=0;
                                $mCitydonor = 0;
                                foreach($list as $row){
                                    if($home_city =="1"){
                                        if($city != $row['donor_homecityid']){
                                            if($counter >0){
                                                echo "<tr bgcolor='#FFFFC4'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>Total Donors :</td><td> <b>".$mCitydonor."</b></td></tr>";
                                            }
                                            $mCitydonor=0;
                                            if($city_name=="All"){
                                                echo"<tr bgcolor='#FFFFC4'><td ><b>".$row['homecity']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            }
                                            
                                        }
                                        $mCitydonor++;
                                        $city=trim($row['donor_homecityid']);
                                    }else{
                                        if($city != $row['donor_officecity']){
                                            if($counter >0){
                                                echo "<tr bgcolor='#FFFFC4'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>Total Donors :</td><td> <b>".$mCitydonor."</b></td></tr>";
                                            }
                                            $mCitydonor=0;
                                            if($city_name=="All"){
                                                echo"<tr bgcolor='#FFFFC4'><td ><b>".$row['officecity']."</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            }
                                        }
                                        $mCitydonor++;
                                        $city=trim($row['donor_officecity']);
                                    }




                                    if($counter%2==0)
                                        echo"<tr>";
                                    else
                                        echo'<tr bgcolor="#EFEFEF">';
                                ?>

                                    
                                    <td ><?=$row['donor_id']?></td>
                                    <td ><?=$row['donor_namef']." ".$row['donor_namem']." ".$row['donor_namel']?></td>
                                    <td ><?=$row['donor_businessname']?></td>
                                    <td ><?=$row['donorhome_address']." ".$row['homecity']." ".$row['donor_postcode']?></td>
                                    <td ><?=$row['donor_officeaddress']." ".$row['officecity']." ".$row['donor_officepostcode']?></td>
                                    <td ><?=$row['donor_homephone']?></td>
                                    <td><?=$row['donor_officephone']?></td>
                                    <td><?=$row['donor_mobile']?></td>
                                    <td align="right"><?=$row['donor_email']?></td>
                                </tr>
                                
                                <?php $counter++;}
                                echo "<tr bgcolor='#FFFFC4'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right'>Total Donors :</td><td> <b>".$mCitydonor."</b></td></tr>";
                                ?>
                                
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
