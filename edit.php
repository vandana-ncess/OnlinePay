<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

	$id = $_GET['id'];
	$charge = $_GET['charge'];
	$addn =$_GET['addn'];

	$sql="UPDATE lab_rates SET charge=" . $charge . ", addnCharge = ". $addn . " WHERE labID=" . $id;
	echo "<script>alert(" . $sql . ");</script>";
	$con = require_once('databaseconnection.php');
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	$result = mysqli_query($con,$sql);
	if($result)
		echo "Updated successfully!";
	else 
	 echo $sql;
	header("Location: LabService_Master.php");
	mysqli_close($con);
?>
</body>
</html>