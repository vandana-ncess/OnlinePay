<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$q = $_GET['q'];

$con = require_once('databaseconnection.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql="select labServiceID, labServiceName from laboratory_services WHERE trim(lower(labServiceName)) = lower('" .$q . "')";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_array($result);
$labID = $row['labServiceID'];
$sql="select * from laboratory_services A JOIN  labcharge_catergorywise B ON A.labServiceID = B.labServiceID where A.labServiceID=" .$labID;
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	echo  "com=" .  $row['commercial_charge'] . ", res=" .  $row['research_charge'] . ", stud="  .  $row['student_charge'] . ", gst=" . $row['gst']. ", charge= ". $row['analyticalCharge'] . ", addn= ". $row['additionalCharge']. ","  ;
}else {
 echo "mod=Save ,";
 }
 }
 else
 echo $sql;
mysqli_close($con);
?>
</body>
</html>