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
<body onload="showUser(document.getElementById('ddlService').value); ">
<div id="container">
  <div id="headerinner"> </div>
  <div id="border" style=" min-height: 400px;height:auto;">
    <div id="main" style=" min-height: 400px;height:auto;">
   <style type="text/css">
  
   li { margin: 0; padding: 0; }
   label { display: block; color: WindowText; background-color: Window; margin: 0; padding: 0; width: 100%; }
   label:hover { background-color: Highlight; color: HighlightText; }
  </style>

    <script>
	

	function validate()
	{
		document.getElementById("txtMode").value=document.getElementById("btnSave").value.trim();

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
			/*document.getElementById("txtCommercial").value = "";
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
			}*/
				document.getElementById("lstParameters").innerHTML = this.responseText ; 
            }
        };
        xmlhttp.open("GET","getParameters.php?q="+str,true);
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
       <div class="lab"  style=" min-height: 400px;width:970px; height:80px;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="validate()">
          	<table  height="80px" width="700px" style="padding-top:50px;">
            	
                <tr>
                    <td> Select SampleType</td><td> <select id="ddlSample" style="width:280px;height:25px;" 	name="ddlSample" required onchange="showUser(this.value)"  > 
                     <?php
						$sql = "SELECT * FROM sampletype_master where sampleTypeStatus=1";
	            		$result = mysqli_query($conn,$sql); 
		   				if(mysqli_num_rows($result) > 0)
						{
							while($data = mysqli_fetch_row($result)){
					?>
                    <option value="<?php echo $data[0] ?> ">  <?php echo $data[1] ?> </option>
                    <?php } } ?>
                    </select>
                    </td>
                    <td><input type="submit" name="btnSave" id="btnSave" value="Save" style="width:80px;height:28px;"  />
                </tr>    
              	
                 <?php 
  		
		if(isset($_POST["btnSave"]))
		{
				$param = $_POST['chkParam'];
				$sql = "DELETE FROM parameter_mapping WHERE sampleTypeID = " . $_POST['ddlSample'] ;
				mysqli_query($conn,$sql);
				for($i=0;$i<sizeof($param);$i++)
				{
					$sql = "INSERT INTO parameter_mapping(sampleTypeID,parameterID) VALUES(". $_POST['ddlSample'] . "," . $param[$i] .")";
					mysqli_query($conn,$sql);
				}
		}
  ?>
              </table>
              <div id = 'lstParameters' />
          </form>

          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
 
 S
 
</body>
</html>
