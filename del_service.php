<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

$ser = $_GET['service'];
$q = $_GET['q'];
$sql ='';

switch($ser)
{
	case 'lab':
		$sql="UPDATE lab_rates SET status='Inactive' WHERE labID = " .$q  ;
		$result = mysqli_query($con,$sql);
		header("Location: LabService_Master.php");
		break;
	case 'labparam':
		$sql="DELETE FROM lab_parameter_rates WHERE labParameterID = " .$q  ;
		$result = mysqli_query($con,$sql);
		header("Location: Template_Complex.php?id=" . $_SESSION['sear_id']);
		break;
	case 'labmaster':
		$sql="UPDATE lab_master SET labServiceStatus='Inactive' WHERE labServiceID = " .$q  ;
		$result = mysqli_query($con,$sql);
		header("Location: LabService_Master.php");
		break;
	case 'comp':
		$sql="UPDATE component_master SET componentStatus='Inactive' WHERE componentID = " .$q  ;
		break;
	case 'category':
		$sql="UPDATE category_master SET categoryStatus='Inactive' WHERE categoryID = " .$q  ;
		break;
	case 'samp':
		$sql="UPDATE sampletype_master SET sampleTypeStatus='Inactive' WHERE sampleTypeID = " .$q  ;
		break;
	case 'param':
		$sql="UPDATE parameter_master SET parameterStatus='Inactive' WHERE parameterID = " .$q  ;
		break;
}

$con = require_once('databaseconnection.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$result = mysqli_query($con,$sql);
if($result)
	echo "Deleted successfully!";
else 
 echo $ser;

mysqli_close($con);
?>
</body>
</html>