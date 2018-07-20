<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
	session_start();
	$conn = require_once('databaseconnection.php');
	echo '<select id="ddlSample" style="width:100px;height:25px;"  onchange="validate()"	name="ddlSample[]" required > ';
	$sql = "SELECT * FROM sampletype_master where sampleTypeStatus=1";
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