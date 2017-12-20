
<!DOCTYPE html>
<html>
	<head>
		<title>Income Summary Report</title>
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
            <div style="text-align:center"><h2>Income Summary Report</h2></div><br>
            <div style="text-align:left">From : <b><?=$from?></b>  To :<b><?=$to?></b></div><br><br>
            
                
                    <table >
                        <thead>
                            <tr>
           
                                <th align="left "width="20%" style="border-bottom: 1px solid #000000; font-weight: bold;" >Income ID</th>
                                <th width="40%" style="border-bottom: 1px solid #000000; font-weight: bold;">Date</th>
                                <th width="10%" style="border-bottom: 1px solid #000000; font-weight: bold;">Currency </th>
                                <th width="10%" style="border-bottom: 1px solid #000000; font-weight: bold;" align="right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $counter=1;
                            $total=0;
                            foreach($list as $row){
                                if($counter%2==0)
                                    echo"<tr>";
                                else
                                    echo'<tr bgcolor="#EFEFEF">';
                            ?>
                            
                                <td width="20%"><?=$row['invoice_id']?></td>
                                <td width="20%"><?=date('d-m-Y',strtotime($row['date']))?></td>
                                <td width="10%"><?=$row['currency_name']?></td>
                                <td width="10%" align="right"><?=number_format($row['amount'],2)?></td>
                            </tr>
                            
                            <?php $counter++; $total += $row['amount'];}?>
                            
                        </tbody>
                        
                    </table>
                        <p align="right"><b>Total amount: <?=number_format($total,2)?></b> </p>
                
            
            <div id="thanksletter">
                <hr />

                <?php  echo"Printed on: ".date("d-m-Y"); ?>
            </div>
            
        </div>
    </div>
	</body>
</html>
