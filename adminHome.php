<?php session_start(); 
	if($_SESSION['userName'] == "")
	{
		echo "<script>alert('Invalid Login! Please login again!'); document.location = 'adminLogin.php'; </script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Online Payment Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="images/logo1.png" type="image/x-icon"/>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="header"> </div>
  <div id="border">
    <div id="main">
      <div id="left">
        <div id="menu" style="height:400px;">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="Request_Category.php">Category Master</a></li>
            <li><a href="Component_Master.php">Component Master</a></li>
            <li><a href="SampleType_Master.php">Sample Type Master</a></li>
            <li><a href="LabService_Master.php">Lab Services Master</a></li>
            <li><a href="Template_Complex.php">Complex Lab Services </a></li>
            <li><a href="LabConcessions.php">Categorywise Charges</a></li>
            <li class="lastchild"><a href="mapAccounts.php">Map Accounts</a></li>
          </ul>
        </div>
        <div id="menubottom">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
      <div id="right">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
        <div class="content" style="text-align: center;" >
           <h4 align="right">Welcome <?php echo $_SESSION['userName']; ?> &nbsp;<a href="" >Logout</a></h4>
         <!-- <a href="#"><img src="images/product1.gif" alt="product" /></a> <a href="#"><img src="images/product2.gif" alt="product" /></a> <a href="#"><img src="images/product3.gif" alt="product" /></a> <a href="#"><img src="images/product4.gif" alt="product" /></a> <a href="#"><img src="images/product5.gif" alt="product" /></a> <a href="#"><img src="images/product6.gif" alt="product" /></a> <a href="#"><img src="images/product7.gif" alt="product" /></a> <a href="#"><img src="images/product8.gif" alt="product" /></a>-->
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div id="footer">
    
    <div id="payment" ><img src="images/paypal.gif" alt="paypal" /></div>
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>
