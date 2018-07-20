<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

	$no = $_GET['noOfServices'];
	$sample = $_GET['sampleType'];
	$con = require_once('databaseconnection.php');
	if (!$con) {
   	 die('Could not connect: ' . mysqli_error($con));
	}
	$sql="SELECT * FROM component_master WHERE componentStatus = 1" ;
	$result = mysqli_query($con,$sql);
	$components = array();
	$samples = array();
	while($comp = mysqli_fetch_row($result)){
   		$components[] = $comp;
	}
	$sql="SELECT * FROM sampletype_master WHERE sampletypeStatus = 1" ;
	$result = mysqli_query($con,$sql);
	while($comp = mysqli_fetch_row($result)){
   		$samples[] = $comp;
	}
	echo '<table border="0"  id="tblSub" style="width:950px; height:80px; font-size: 9px;"><tr>'; if($sample == 'true') echo '<td>Sample Type</td>';
	echo '<td>Component Name</td><td colspan="2">Charge</td><td colspan="2">Additional Charge</td><td>Mandatory</td><td>Concession</td></tr>';
	for($i=0;$i<$no;$i++)
	{
		echo '<tr> ';
					if($sample == 'true') {
						echo '<td ><select style="width:100px;height:22px;" id="ddlSampleType" name="ddlSampleType[]">';
						foreach ($samples as $samp){
							echo "<option value=". $samp[0] . ">". $samp[1] . "</option>";
						} 
						echo '</select></td>' ; 
					} 
					else 	
					{
						echo '<input type="hidden" style="width:100px;height:22px;" id="ddlSampleType" name="ddlSampleType[]" />';
					}
                	echo '<td><input type="text" id="txtSubService" name="txtSubService[]" style="width:180px;height:22px;" /></td>
                   	<td><input type="text" id="txtCharge" name="txtCharge[]" style="width:60px;height:22px;"  /></td>
                  	
				  	<td ><select style="width:100px;height:22px;" id="ddlType" name="ddlType[]" >';
       				foreach ($components as $comp){
   						echo "<option value=". $comp[0] . ">". $comp[1] . "</option>";
   					}
   					echo '</select></td><td><input type="text" id="txtAddnCharge" name="txtAddnCharge[]" style="width:60px;height:22px;"  /></td>
                  	<td ><select style="width:100px;height:22px;" id="ddlAddnType" name="ddlAddnType[]" >';
       				foreach ($components as $comp){
   						echo "<option value=". $comp[0] . ">". $comp[1] . "</option>";
   					}
   					echo '</select></td> <td align="center">
					<input type="checkbox" id="chkIsMandatory[' . $i . ']" name="chkIsMandatory[]" value="1" style="width:30px;height:25px;margin: 0;"  /><input type="hidden" id="txtMand[' . $i . ']" name="txtMand[]" /> </td>
					<td><input type="checkbox" id="chkIsAppl[' . $i . ']" name="chkIsAppl[]" value="1" style="width:30px;height:25px;margin: 0;"  /><input type="hidden" id="txtIsAppl[' . $i . ']" name="txtIsAppl[]" /> </td></tr>';
 	}
 	echo '<tr><td colspan="6" /><td><input type="submit" id="btnSave" name="btnSave" value="Save" style="width:100px;height:30px;" /></td></table>';

	mysqli_close($con);
?>
</body>
</html>