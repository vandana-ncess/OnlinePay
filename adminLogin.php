<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload="showUser(document.getElementById('ddlService').value)">
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
   
      <div align="center" id="right" style="width:970px;height:400px;">
      
      
       <div   style="width:500px; height:200px;border:medium;border-style:solid;margin-top:100px;border-color:#330066;color:#000066;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="validate()">
          	<table  height="80px" width="410px" style="padding-top:30px;padding-left:50px;">
            	<thead>
                	<th colspan="2" align="left" style="padding-bottom:20px;"><h3>NCESS Admin Login</h3></th>
                </thead>
                <tr>
                    <td style="padding-right:20px;"> User Name</td><td> <input type="text" id="txtUser" style="width:250px;height:22px;" 	name="txtUser" required > </td>

                </tr>    
                <tr>
                	<td>Password</td><td><input type="password" name="txtPwd" id="txtPwd" style="width:250px;height:22px;" required /></td>
                </tr>
               
                <tr>
                	<td /><td style="padding-top:20px;" align="right"><input type="submit" name="btnLogin" id="btnLogin" value="Login" class="but" /></td>
                </tr>
                 <?php 
					if(isset($_POST["btnLogin"]))
					{
			
						if($_POST['txtUser']=="admin" && $_POST['txtPwd']=="admin")
						{
							$_SESSION['userName']=$_POST['txtUser'];
							echo "<script>document.location='adminHome.php';</script>";
							
						}
						else
							echo "Invalid Username/Password";
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
 
 
</body>
</html>
