<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$q = intval($_GET['q']);

$con = require_once('databaseconnection.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="select * from laboratory_services A JOIN  labcharge_catergorywise B ON A.labServiceID = B.labServiceID where A.labServiceID=" .$q;
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	echo  "mod=Update ,com=" .  $row['commercial_charge'] . ", res=" .  $row['research_charge'] . ", stud="  .  $row['student_charge'] . ", gst=" . $row['gst']. ","  ;
}else {
 echo "mod=Save ,";
 }
mysqli_close($con);
?>
</body>
</html>