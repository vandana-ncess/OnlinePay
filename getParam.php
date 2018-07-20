<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	session_start();
	$conn = require_once('databaseconnection.php');
	echo '<select id="ddlParam" style="width:180px;height:25px;" onchange="validate()" 	name="ddlParam[]" required  > ';
	$sql = "SELECT * FROM parameter_master where parameterStatus=1";
    $result = mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result) > 0)
    {
   		while($data = mysqli_fetch_row($result)){
        echo '<option value="' . $data[0] . '">' . $data[1] . '</option>';
        }
	}
	echo '</select>';
                        
	mysqli_close($conn);
?>
</body>
</html>