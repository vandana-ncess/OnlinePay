<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$q = intval($_GET['q']);
$mod = $_GET['mode'];

$con = require_once('databaseconnection.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="select A.labServiceID as labID, C.categoryID as catID, categoryName,concessionRate,gst,minSampleSize from lab_master A JOIN  labcharge_concessions B ON A.labServiceID = B.labServiceID JOIN category_master C on B.categoryID = C.categoryID where A.labServiceID=" .$q . " AND categoryStatus=1";
$result = mysqli_query($con,$sql);
if($mod=='edit')
{
	echo "<table id='tblConcession' style='padding-top:30px;' class='master'> <thead><tr> <th>Category</th> <th>Concession Rate( %)</th> </tr></thead>";
	
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$gs = $row['gst'];
			echo "<tr><td>" . $row['categoryName'] . "</td><td><input type='text' name = 'txtRate[]' value='" . $row['concessionRate'] . "' /><input type='hidden' name = 'txtCatID[]' value='" . $row['catID'] .  "' /></td></tr>"; 
		}
		echo "<tr><td>GST</td><td><input type='text' name = 'txtGST' value='" . $gs . "' /></td><td>" . $row['labID'] .  "</td><input type='hidden' name = 'txtMode' value='Update' /> </td></tr>
		<tr><td /><td><input type='submit' name = 'btnSave' value='Update' style='width:100px;' /> </td></tr>"; 
		//echo  "mod=Update ,com=" .  $row['commercial_charge'] . ", res=" .  $row['research_charge'] . ", stud="  .  $row['student_charge'] . ", gst=" . $row['gst']. ","  ;
	}
	else 
	{
		$sql="select categoryID as catID, categoryName from category_master where categoryStatus=1";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				echo "<tr><td>" . $row['categoryName'] . "</td><td><input type='text' name = 'txtRate[]' /></td><td><input type='hidden' name = 'txtCatID[]' value='" . $row['catID'] .  "' /></td></tr>"; 
			}
			echo "<tr><td>GST</td><td><input type='text' name = 'txtGST'  /></td><td><input type='hidden' name = 'txtlabID[]' value='" . $row['labID'] .  "' /></td><input type='hidden' name = 'txtMode' value='Save' /> </td></tr>
			<tr><td /><td><input type='submit' name = 'btnSave' value='Save' style='height:25px;' /> </td></tr>"; 
		}
	 }
	 echo "</table>";
	}
	else
	{
		echo "<table id='tblConcessions' height='100px' style='padding-left:5px;'> <tr> <td>Category</td> <td>Concession Rate( %)</td> </tr>";
	
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$gs = $row['gst'];
				$min = $row['minSampleSize'];
				echo "<tr><td>" . $row['categoryName'] . "</td><td align='center'>" . $row['concessionRate'] . "<input type='hidden' name = 'txtCatID[]' id='" .$row['catID']. "' value='" . $row['catID'] .  "' /></td></tr>"; 
			}
			echo "<tr><td>GST</td><td align='center'>" . $gs . "<input type='hidden' name = 'txtGSTRate' id='txtGSTRate' value='" .  $gs  .  "' /><input type='hidden' name ='txtMinSize' id = 'txtMinSize' value='" . $min . "' /></td></tr></table>";
		}
	}
mysqli_close($con);
?>
</body>
</html>