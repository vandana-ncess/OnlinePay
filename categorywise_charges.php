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
<body onload="showUser(document.getElementById('ddlService').value)">
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
    <script>
	function validate()
	{
		document.getElementById("txtMode").value=document.getElementById("btnSave").value.trim();
				alert(document.getElementById("txtMode").value);

	}
function showUser(str) {
    if (str == "") {
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtCommercial").value = "";
			document.getElementById("txtResearch").value = "";
			document.getElementById("txtStudent").value = "";
			document.getElementById("txtGst").value = "";
			var	start = this.responseText.indexOf('mod=') + 4;
			var end = this.responseText.indexOf(',') ;
			var txt = this.responseText.substr(start,end-start) ;
            document.getElementById("btnSave").value = txt.toString();
			if(txt.trim() == 'Update')
			{
				start = this.responseText.indexOf('com=') + 4;
				end = this.responseText.indexOf(',',start) - start ;
				document.getElementById("txtCommercial").value = this.responseText.substr(start,end) ;
				start = this.responseText.indexOf('res=') + 4;
				end = this.responseText.indexOf(',',start) - start ;
				
				document.getElementById("txtResearch").value = this.responseText.substr(start,end) ;
				start = this.responseText.indexOf('stud=') + 5;
				end = this.responseText.indexOf(',',start) - start ;
				document.getElementById("txtStudent").value = this.responseText.substr(start,end) ;
				start = this.responseText.indexOf('gst=') + 4;
				end = this.responseText.indexOf(',',start) - start ;
				document.getElementById("txtGst").value = this.responseText.substr(start,end) ;
			}
            }
        };
        xmlhttp.open("GET","get_user.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
          	<table  height="80px" width="500px" style="padding-top:50px;">
            	
                <tr>
                    <td> Select Service Name</td><td> <select id="ddlService" style="width:180px;" 	name="ddlService" required onchange="showUser(this.value)"  > 
                     <?php
						$sql = "SELECT * FROM laboratory_services where labServiceStatus='Active'";
	            		$result = mysqli_query($conn,$sql); 
		   				if(mysqli_num_rows($result) > 0)
						{
							while($data = mysqli_fetch_row($result)){
					?>
                    <option value="<?php echo $data[0] ?> ">  <?php echo $data[1] ?> </option>
                    <?php } } ?>
                    </select>
                    </td>
                </tr>    
                <tr>
                	<td>Commercial</td><td><input type="text" name="txtCommercial" id="txtCommercial" />%</td>
                </tr>
                <tr>
                	<td>R&D Institute</td><td><input type="text" name="txtResearch" id="txtResearch" />%</td>
                </tr>
                <tr>
                	<td>Research Student</td><td><input type="text" name="txtStudent" id="txtStudent" />%</td>
                </tr>
                <tr>
                	<td>GST</td><td><input type="text" name="txtGst" id="txtGst" />%<input type="hidden" id="txtMode"  name="txtMode" value="Save" /> </td>
                </tr>
                <tr>
                	<td /><td align="right"><input type="submit" name="btnSave" id="btnSave" value="Save" class="but" /></td>
                </tr>
                 <?php 
  		
		if(isset($_POST["btnSave"]))
		{
			
			if($_POST['txtMode'] == "Save") {
				$sql = "INSERT INTO labcharge_catergorywise(labServiceID,commercial_charge,research_charge,student_charge,gst) VALUES(" . $_POST['ddlService'] . "," . $_POST['txtCommercial'] . "," . $_POST['txtResearch'] . "," . $_POST['txtStudent'] . "," . $_POST['txtGst'] .  ")";
				$result = mysqli_query($conn,$sql); 
				if($result)
					echo "Saved Successfully!";
				else
					echo "Unable to save!";
		/*	echo "<script> window.location='Service_Master.php';</script>";*/
					$_POST['btnSave'] = '';
			}
			else
			{
			
				$sql = "UPDATE labcharge_catergorywise SET commercial_charge = " . $_POST['txtCommercial'] . ", research_charge = " .  $_POST['txtResearch'] . " , student_charge = " . $_POST['txtStudent'] . ", gst = " . $_POST['txtGst'] .  " WHERE labServiceID = " . $_POST['ddlService'];

				$result = mysqli_query($conn,$sql); 
				if($result)
					echo "Updated Successfully!";
				else
					echo "Unable to Update!";
					$_POST['txtMode'] = "Add";
					$_POST['btnSave'] = '';

			}
		}
  ?>
              </table>
          </form>

          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
 
  <script type="text/javascript">
  function loadRates(x) {
	var theId = x.id;
	var index = theId.substring(theId.length-1) ;
	++index;
	var serviceID = document.getElementById("tblService").rows[index].cells.item(0).innerHTML;
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
  function delete(this)
  {}
  </script>
 
</body>
</html>
