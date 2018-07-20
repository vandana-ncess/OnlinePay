<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php

	$str = $_GET['q'];

	$sql="SELECT * FROM lab_master WHERE template='complex' AND labServiceName LIKE '%" . $str . "%'";
	$con = require_once('databaseconnection.php');
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0)
	{
		echo "<div id='divSearch' style='background-color:white;'>";
		while($data = mysqli_fetch_array($result))
		{
			echo "<a href='Template_Complex.php?id=" . $data[0] . "' style='text-decoration:none;' onclick='loadTest(this)'> ". $data[1]. "</a><br />";
		}
		echo "</div>";
	}
	mysqli_close($con);
?>
</body>
</html>