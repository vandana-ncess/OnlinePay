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
<script type="text/javascript" src="JS/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="JS/jquery.dataTables.js"></script>
    <script type="text/javascript" src="JS/dataTables.bootstrap.js"></script>
<style type="text/css">
.focus {
  	background-color: #ff00ff;
	color: #fff;
	cursor: pointer;
   font-weight: bold;
}
.pageNumber {
   padding: 2px;
}
</style>
 <script type="text/javascript">
      $(document).ready(function () {
          $('#tblService').dataTable({
              "iDisplayLength": 5,
              "lengthMenu": [5,10, 25, 50, 100]
          });
      });
  </script>
</head>
<body>
<div id="container" style="height:auto;">
  <div id="headerinner"> </div>
  <div id="border" style=" min-height: 400px;height:auto;">
    <div id="main" style=" min-height: 400px;height:auto;">
      <?php 		$conn = require_once('databaseconnection.php');
?>
      <div align="center" id="right" style="width:970px; min-height: 100px;height:auto;">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div class="lab" align="center"  style="width:970px; min-height: 200px; height:auto;padding-top:30px;">
      
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="validate()">
         	<table id="tblMain" height="60px" width="950px">
            	<thead>
                	<tr>
                    	<th colspan="4"> <h3 align="left">Define Laboratory services</h3></th>
                    </tr>
                </thead>
            	<tr>
                	<td><input type="text" name="txtLabService" id="txtLabService" style="width:280px;height:22px;"/></td>
                   <td><input type="text" name="txtNoOfServices" id="txtNoOfServices" style="width:100px;height:22px;" /></td>
                   <td><input type="checkbox" name="chkVary" id="chkVary" style="width:20px;height:22px;" />Rate varies with Sample Type?</td>
                  <td><input type="button" id="btnNext" name="btnNext" value="Next" onclick="addSubService()" style="width:100px;height:30px;" /></td>
                </tr>
                <tr>
                <td>Name of Laboratory Service</td>
                 <td>No. of Analysis</td>
                </tr>
                <tr></tr>
            </table><br />
            <table id="tblSub" /><br />
             <?php
				$sql = "SELECT A.labServiceID, labServiceName,subServiceName, noOfSubServices, charge, addnCharge, status,labID FROM lab_master A JOIN lab_rates B on A.labServiceID = B.labServiceID WHERE labServiceStatus='Active' ";
	            $result = mysqli_query($conn,$sql);
				$row_no = mysqli_num_rows($result); 
		   		if($row_no > 0)
				{
			?>
            <table title="Laboratory Services" id="tblService" style="padding-top:30px;">
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
								$count = 1;$row =1;
									$data = mysqli_fetch_row($result);
								while( $count <= $row_no)
								{
								
										$row =  $data[3];
 						?>	
                       		<tr>
 								<td  ><?php echo $data[1]; ?></td><td><?php echo '<a href="del_service.php?q=' . $data[0] . '&service=labmaster"  onClick=return confirm("Are you sure you want to delete?")>Delete</a>'; ?></td>
                            </tr>
                            <?php 
									
									for($i = 0; $i < $row ; $i++) 
									{
									
							?>
  								<tr>
 									<td width="91" style="color:#333; text-align:center"><?php echo $i + 1 ; ?></td>
    								<td width="200" style="color:#333"> <?php echo $data[2]; ?>
                                    <td width="100" style="color:#333"><?php echo $data[4];?></td>
                                    <td width="100" style="color:#333"><?php echo $data[5];?></td>
    								<td width="100" style="color:#333"><?php echo $data[6];?></td>
                                     <td width="60" style="color:#333"><input type="button" class="edit" style="background-image: url(images/edit.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#009900"  name= "btnEdit"  id= <?php echo "btnEdit" . $count; ?> onclick="edit(this)"  value="Edit" /></td>
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $count; ?> /></td><td style="display:none;"> <?php echo $data[0]; ?> <input type="hidden" value=' <?php echo $data[7]; ?> ' /></td>
 								</tr>
                               
  							<?php
									$data = mysqli_fetch_row($result);
							} 
							$count = $count + $row;
								
								}}
							?>
						 </tbody>
 					</table>	
                  
         </form>
       </div>
        
        <script type="text/javascript">
		function edit(btn)
		{
			row = btn.parentNode.parentNode;
			id = row. cells[7].children[0].value;
			if(btn.value=='Edit')
			{
				charge = (row.cells[2].innerHTML=='')?0:row.cells[2].innerHTML;
				addn = (row.cells[3].innerHTML=='')?0:row.cells[3].innerHTML;
				row.cells[2].innerHTML = "<input type='text' name='txtEditCharge' style='width:70px' value='" + charge + "' />";
				row.cells[3].innerHTML = "<input type='text' name='txtEditAddn' style='width:70px' value='" + addn + "' />";
				row. cells[7].innerHTML = "<input type='hidden' name='txtEditID'  value='" + id + "' />";
				btn.value='Update';
			}
			else
			{
				charge = (row.cells[2].children[0].value=='')?0:row.cells[2].children[0].value;
				addn = (row.cells[3].children[0].value=='')?0:row.cells[3].children[0].value;
				document.location= 'edit.php?id=' + id +'&charge=' + charge + '&addn=' + addn;
			}
		}
		function delService(btn)
		{
			if(confirm('Are you sure you want to delete this?'))
			{
				row = btn.parentNode.parentNode;
				id = row. cells[7].children[0].value;
				document.location= 'del_service.php?q=' + id +'&service=lab';
			}
		}
			function addSubService()
			{
				var rows = document.getElementById("txtNoOfServices").value;
				var boo = document.getElementById("chkVary").checked;
				if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            	xmlhttp = new XMLHttpRequest();
        		} else {
            // code for IE6, IE5
            		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        		}			
				
				xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
						document.getElementById("tblSub").innerHTML = this.responseText;
					}
        		};
				xmlhttp.open("GET","getComponents.php?noOfServices="+rows+"&sampleType="+boo,true);
        		xmlhttp.send();
				
		   }
		   function validate()
		   {
		   		var len = document.getElementById("txtNoOfServices").value;
				var str = 0;
				var con = 0;
		   		for($i = 0 ; $i < len; $i++)
				{
					str = "chkIsMandatory[" + $i + "]";
					con = "chkIsAppl[" + $i + "]";
					if(document.getElementById(str).checked)
						document.getElementById('txtMand[' + $i + ']').value = 1;
					else
						document.getElementById('txtMand[' + $i + ']').value = 0;	
					if(document.getElementById(con).checked)
						document.getElementById('txtIsAppl[' + $i + ']').value = 1;
					else
						document.getElementById('txtIsAppl[' + $i + ']').value = 0;	
				}
		   }
		</script>  
        <?php
		if(isset($_POST['btnEdit']))
		{
			$sql = "UPDATE lab_rates SET charge=" . $_POST['txtEditCharge'] . " addnCharge=" . $_POST['txtEditAddn'] . " WHERE labID = " . $_POST['txtEditID'];
			echo "<script>alert(" . $sql . ");</script>";
			$result = mysqli_query($conn,$sql); 
				if($result)
					echo "Updated Successfully!";
				else
					echo "Unable to save!";
		}
			if(isset($_POST["btnSave"]))
			{
				$sql = "SELECT * FROM lab_master WHERE labServiceName = '" . $_POST['txtLabService'] . "' ";
				$result1 = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result1) > 0)
				{
					echo "Service already Exists!";
					exit();
				}
				$sql = "INSERT INTO lab_master(labServiceName,noOfSubServices,labServiceStatus) VALUES('" . $_POST['txtLabService'] . "'," . $_POST['txtNoOfServices'] .",'Active')";
				$result = mysqli_query($conn,$sql); 
				$last_id = mysqli_insert_id($conn);
				$name = $_POST['txtSubService'];
				$charge = $_POST['txtCharge'];
				$cat = $_POST['ddlType'];
				$chk = $_POST['txtMand'];
				$conc = $_POST['txtIsAppl'];
				$addncharge = $_POST['txtAddnCharge'];
				$addncat = $_POST['ddlAddnType'];
				$sampType = $_POST['ddlSampleType'];
				for($i=0; $i<$_POST['txtNoOfServices']; $i++)
				{
					if($sampType[$i]=='') $sampType[$i] = "null";
					if($addncharge[$i]=='') 
						$adncharge = 0; 
					else 
						$adncharge = $addncharge[$i];
					$sql = "INSERT INTO lab_rates(labServiceID,subServiceName,charge,componentID,addnCharge,addncomponentID,status,mandatory,isConcAppl,sampleTypeID) VALUES(". $last_id . " ,'". $name[$i] . "', " . $charge[$i] . "," . $cat[$i] . ",". $adncharge  . "," . $addncat[$i] .",'Active'," . $chk[$i] . "," . $conc[$i] . "," . $sampType[$i] . ")";
					$result = mysqli_query($conn,$sql); 
				}
				if($result)
					echo "Saved Successfully!";
				else
					echo "Unable to save!";
					$_POST['btnSave'] = '';
					echo "<script>document.location = 'LabService_Master.php';</script>";
			}
		?>
     </div>
      </div>
      <div class="clear"></div>
    </div>
 
  <div id="footer">
  
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>
