<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	$labID = $_GET['labID'];
	$sampID = $_GET['sampID'];
	$con = require_once('databaseconnection.php');
	if (!$con) {
    	die('Could not connect: ' . mysqli_error($con));
	}
	 $sql="SELECT A.sampleTypeID,sampleType,A.parameterId,ParameterName,charge,addnCharge,isConcAppl,labParameterID FROM lab_parameter_rates A 	     JOIN sampletype_master B ON A.sampleTypeID = B.sampleTypeID JOIN parameter_master C ON A.parameterID=C.parameterID WHERE A.sampleTypeID=" .     $sampID . " AND labID = " . $labID;
     $result = mysqli_query($con,$sql);
	 $i = 0;
	 
	 echo '<div align="left" style="width:550px; display: block; color: WindowText; background-color: Window; margin: 0; padding: 0; height: 220px; overflow: auto; "> 
     <table id="tblParam" align="center" id="tab" style="padding-left:0px;padding-right:0px;"><thead><tr><th width="20px">Select</th><th width="400px">Parameter</th><th width="50px">Rate</th><th width="50px">Extra </th><th width="30px">Concession?</th></tr></thead><tbody>';
	while($data = mysqli_fetch_array($result))
	{
		echo '<tr><td>
        <input type="checkbox" name="chkSelect[]" id="chkSelect' . $i .  '" style="width:10px;padding-left:0px;" value="1" onchange="calculateTotal()"></td>
		<td>' . $data[3] . '</td><td align="center">' . $data[4] . '</td><td align="center">' . $data[5] . '</td><td align="center">';
		if($data[6]==1) echo "Yes"; else echo "No";
		echo '</td></tr>';
		$i++;
					
	}				
	echo '</tbody></table></div>';
  
	mysqli_close($con);
?>
<script type="text/javascript">

</script>
</body>
</html>
         