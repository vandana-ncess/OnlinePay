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
                <table  height="80px" width="500px">
                    
                    <tr>
                        <td>Name of Lab Service</td>
                        <td height="20px;" colspan="2"> <input type="text" id="txtService" 	name="txtService" style="width:250px;height:22px;" required />
                    </tr>
                    <tr>
                        <td>Template Type</td>
                        <td> <select id="ddlTemplateType"	name="ddlTemplateType" onchange="loadTemplate()" required >
                                <option value="simple">Simple</option>
                                <option value="multi">Multiple Tests</option>
                                <option value="complex">Complex</option>
                             </select>
                        </td>
                        <td><input type="text" id="txtNoOfTests" name="txtNoOfTests" style="display:none;" /></td>
                    </tr>
                    <tr>
                        <td colspan="2"> </td>
                        
                     </tr>
                     <tr>
                        <td><input type="submit" class="edit"  id="btnNext" name="btnNext" value="Next" style="width:100px;height:30px;" />	</td>                  
                    </tr>
                   
                	<tr><td>
              		<img src="images/simple_template.png"  id="imgTemplate" />
             		 </td>
             		 </tr>
              </table>
          </form>
          <?php 
		  	if(isset($_POST['btnNext']))
			{
				$_SESSION['labService'] = $_POST['txtService'];
				$_SESSION['template'] = $_POST['ddlTemplateType'];
				$_SESSION['noTests']=$_POST['txtNoOfTests'];
				if($_POST['ddlTemplateType'] == 'simple')
				echo "<script>document.location='labComponents.php'</script>";
				else if($_POST['ddlTemplateType'] == 'multi')
				echo "<script>document.location='templateMulti.php'</script>";

			}
		  ?>
         <script type="text/javascript">
		 	function loadTemplate()
			{
				var x = document.getElementById('ddlTemplateType').value;
				var im = document.getElementById('imgTemplate');
									 alert(x);

				switch(x)
				{
					case 'simple' : 
						im.src = "images/simple_template.png";
						break;
					case 'multi':
						im.src = "images/multi_template.png";
						document.getElementById("txtNoOfTests").style.display='block';
						break;
					im.src = "images/complex_template.png";
						break;
				}
				
			}
		 </script>
          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
 
  <div id="footer">
  
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>
