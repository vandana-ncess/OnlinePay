<?php session_start(); 
	if($_SESSION['userName'] == "")
	{
		echo "<script>alert('Invalid Login! Please login again!'); document.location = 'adminLogin.php'; </script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="images/logo1.png" type="image/x-icon"/>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
      <?php 		$conn = require_once('databaseconnection.php');
?>
      <div align="center" id="right" style="width:970px;height:600px;">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div class="lab" align="center"  style="width:970px; height:80px;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <fieldset class="field" style="width:820px;" ><legend align="left" style="padding-left:10px;padding-left:10px;"><h4>Laboratory Services</h4></legend>
          	<table  height="80px" width="800px">
            	
                <tr>
                    <td height="20px;"> <input type="text" id="txtService" 	name="txtService" style="width:250px;height:22px;" required />
                    <input type="hidden" id="txtServiceID" name="txtServiceID" /> <input type="hidden" id="txtMode" name="txtMode" value="Add" /></td>
                    <td> <input type="text" id="txtCharge"	name="txtCharge" required style="width:150px;height:22px;"/></td>
                    <td> <input type="text"	id="txtAddnCharge" name="txtAddnCharge" required style="width:150px;height:22px;padding-left:20px;" /></td>
                    <td><input type="submit" class="edit"  id="btnAdd" name="btnAdd" value="Add" style="width:100px;height:30px;" />	</td>                   
                </tr>
                <tr>
                	<td height="20px;">Name of Service</td>	
                    <td>Analytical Charges</td>		                   
                   	<td>Additional Charges</td>
                </tr>
                <tr>
                </tr>
             </table>
            </fieldset><br />
          </form>
          <div style="height:300px;">
          <?php
				$sql = "SELECT * FROM laboratory_services";
	            $result = mysqli_query($conn,$sql); 
		   		if(mysqli_num_rows($result) > 0)
				{
			?>
          	<table title="Laboratory Services" id="tblService">
                    	<thead style="background:#3A8E00; color:#FFF;">
                        	<tr>
                            	<th height="30px" colspan="7" ><strong>Laboratory Services</strong></th>
                            </tr>
                        </thead>

 						<thead style="color:#333" align="left">
  							<tr>

 								<th width="91" style="text-align:center">Serial No.</th>
 							 	<th>Service Name</th>
  								<th>Analytical Charges</th>
  								<th>Additional Charges</th>
								<th>Status</th>
 							</tr>
  						</thead>
  						<tbody style="color:#333" align="left">
  							<?php
								$count = 1;
 								while($data = mysqli_fetch_row($result)){
							?>	  
  								<tr>
 									<td width="91" style="color:#333; text-align:center"><?php echo $count; ?></td>
    								<td width="200" style="color:#333"> <?php echo $data[1]; ?>
                                    <td width="100" style="color:#333"><?php echo $data[2];?></td>
    								<td width="100" style="color:#333"><?php echo $data[3];?></td>
                                    <td width="150" style="color:#333"><?php echo $data[4];?></td>
                                     <td width="60" style="color:#333"><input type="submit" class="edit" style="background-image: url(images/edit.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#009900"  name= <?php echo "btnEdit" . $count; ?> id= <?php echo "btnEdit" . $count; ?> onclick="edit(this)"  value="Edit" /></td>
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $count; ?> /></td><td style="display:none;"> <?php echo $data[0]; ?></td>
 								</tr>
                                </tbody>
  							<?php
							  $count++;
								}}
							?>

 					</table>
<div   id="common" align="right" style="padding-top:20px;padding-right:40px;">
          <input type="button" name="btnCharges" onclick="document.location.href='categorywise_charges.php'" value="Define Categorywise Charges" />
          </div>
          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <?php 
  	
		if(isset($_POST["btnAdd"]))
		{
			$sql = "SELECT * FROM laboratory_services WHERE labServiceName = '" . $_POST['txtService'] . "' ";
			echo $sql;
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1) > 0)
			{
				echo "Service already Exists!";
				exit();
			}
			if($_POST['txtMode'] == "Add") {
				$sql = "INSERT INTO laboratory_services(labServiceName,analyticalCharge,additionalCharge,labServiceStatus) VALUES('" . $_POST['txtService'] . "','" . $_POST['txtCharge'] . "','" . $_POST['txtAddnCharge'] . "','Active')";
				$result = mysqli_query($conn,$sql); 
				echo $sql;
				if($result)
					echo "Saved Successfully!";
				else
					echo "Unable to save!";
				echo "<script> window.location='Service_Master.php';</script>";
					$_POST['btnAdd'] = '';
			}
			else
			{
			
				$sql = "UPDATE laboratory_services SET labServiceName ='" .  $_POST['txtService'] . "',analyticalCharge = " . $_POST['txtCharge'] . ", additionalCharge =  " .  $_POST['txtAddnCharge'] . " WHERE labServiceID =  " . $_POST['txtServiceID']  ;
								echo $sql;

				$result = mysqli_query($conn,$sql); 
				if($result)
					echo "Updated Successfully!";
				else
					echo "Unable to Update!";
					$_POST['txtMode'] = "Add";
					echo "<script> window.location='Service_Master.php';</script>";
					$_POST['btnAdd'] = '';

			}
		}
  ?>
  <script type="text/javascript">
  function edit(x) {
  
	var theId = x.id;
	alert(theId);
	var index = theId.substring(theId.length-1) ;
	++index;
	var serviceID = document.getElementById("tblService").rows[index].cells.item(7).innerHTML;
	var service = document.getElementById("tblService").rows[index].cells.item(1).innerHTML;
				

	var charge = document.getElementById("tblService").rows[index].cells.item(2).innerHTML;
	var extra = document.getElementById("tblService").rows[index].cells.item(3).innerHTML;

	document.getElementById("txtServiceID").value = serviceID;
	document.getElementById("txtService").value = service;
	document.getElementById("txtService").readOnly = true;
	document.getElementById("txtCharge").value = charge;
	document.getElementById("txtAddnCharge").value = extra;
	document.getElementById("txtMode").value = "Update";
	document.getElementById("btnAdd").value = "Update";

  }
  function delService(x) {
	var theId = x.id;
	var index = theId.substring(theId.length-1) ;
	++index;
	var serviceID = document.getElementById("tblService").rows[index].cells.item(7).innerHTML;
		alert(serviceID);

	if(confirm('Are you sure you want to delete this Service?'))
	{
		 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				alert(this.responseText);
			}
        };
        xmlhttp.open("GET","del_service.php?q="+serviceID,true);
        xmlhttp.send();
	}

  }
  </script>
  <div id="footer">
  
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>
