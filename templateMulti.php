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
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body >
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
   
      <?php 		$conn = require_once('databaseconnection.php');
?>
      <div align="center" id="right" style="width:970px;height:400px;">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div  style="width:970px; height:80px;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="validate()">
         
             <fieldset class="field" style="width:820px;" ><legend align="left" style="padding-left:10px;padding-left:10px;"><h4>Laboratory Services<?php echo $_SESSION['noTests']; ?></h4></legend>
          	<table  height="80px" width="800px">
            	  <?php for($i=0; $i<$_SESSION['noTests']; $i++)
			   { ?>
                <tr>
                    <td>Lab Test SubName</td><td height="20px;"> <input type="text"  id="txtService[]" 	name="txtService[]"  required />
                    <input type="hidden" id="txtSubServiceID[]" name="txtSubServiceID[]" /> <input type="hidden" id="txtMode" name="txtMode" value="Add" /></td>
                    <td>Charge</td><td> <input type="text" id="txtCharge"	name="txtCharge[]" required /></td>
                </tr>
             
                 <?php } ?>
                 <tr>
                	<td colspan="3">   <td><input type="submit" class="edit"  id="btnAdd" name="btnAdd" value="Add" />	</td>                   

                 </tr>
             </table>
            </fieldset><br />
          	 <?php
				$sql = "SELECT A.labServiceID, labServiceName,subServiceName, noOfSubServices, charge, addnCharge, labServiceStatus FROM lab_master A JOIN lab_rates B on A.labServiceID = B.labServiceID WHERE template = 'multi'";
	            $result = mysqli_query($conn,$sql);
				$row_no = mysqli_num_rows($result); 
		   		if($row_no > 0)
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
								<th>Status</th>
 							</tr>
  						</thead>
                         <tbody style="color:#333" align="left">
						<?php
								$count = 1;$row =1;
								for($row = 1; $row < $row_no; $row++)
								{
									$data = mysqli_fetch_row($result);
										$row =  $data[3];
 						?>	
                       		<tr>
 								<td colspan="4"><?php echo $data[1]; ?></td>
                            </tr>
                            <?php 
									
									for($i = 0; $i < $row ; $i++) 
									{
									
							?>
  								<tr>
 									<td width="91" style="color:#333; text-align:center"><?php echo $i + 1; ?></td>
    								<td width="200" style="color:#333"> <?php echo $data[2]; ?>
                                    <td width="100" style="color:#333"><?php echo $data[4];?></td>
    								<td width="100" style="color:#333"><?php echo $data[6];?></td>
                                     <td width="60" style="color:#333"><input type="button" class="edit" style="background-image: url(images/edit.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#009900"  name= <?php echo "btnEdit" . $count; ?> id= <?php echo "btnEdit" . $count; ?> onclick="edit(this)"  value="Edit" /></td>
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $count; ?> /></td><td style="display:none;"> <?php echo $data[0]; ?></td>
 								</tr>
                               
  							<?php
									$data = mysqli_fetch_row($result);
							}
								
								}}
							?>
						 </tbody>
 					</table>	
          </form>

          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>

<?php 
  	
		if(isset($_POST["btnAdd"]))
		{
			$sql = "SELECT * FROM lab_master WHERE labServiceName = '" . $_SESSION['labService'] . "' ";
			echo $sql;
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1) > 0)
			{
				echo "Service already Exists!";
				exit();
			}
			if($_POST['txtMode'] == "Add") {
				$sql = "INSERT INTO lab_master(labServiceName,noOfSubServices,labServiceStatus,template) VALUES('" . $_SESSION['labService'] . "'," . $_SESSION['noTests'] .",'Active','". $_SESSION['template'] ."')";
				$result = mysqli_query($conn,$sql); 
				$last_id = mysqli_insert_id($conn);
				$name = $_POST['txtService'];
				$charge = $_POST['txtCharge'];
				for($i=0; $i<$_SESSION['noTests']; $i++)
				{
					$sql = "INSERT INTO lab_rates(labServiceID,subServiceName,charge,category,status,mandatory) VALUES(". $last_id . " ,'". $name[$i] . "', " . $charge[$i] . ",'sample','Active','Optional')";
					$result = mysqli_query($conn,$sql); 
					echo $sql;
				}
				if($result)
					echo "Saved Successfully!";
				else
					echo "Unable to save!";
					$_POST['btnAdd'] = '';
			}
			else
			{
			
				for($i=0; $i<$_SESSION['noTests']; $i++)
				{
					$sql = "UPDATE lab_rates SET subServiceName = '" . $_POST['txtSubServiceName'] ."', charge= " . $_POST['txtCharge'] . " WHERE labServiceID = ". $_POST['txtLabServiceID'];
					$result = mysqli_query($conn,$sql); 
				}
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
 
</body>
</html>
