<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Online Payment Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
      
      <div align="center" id="right" style="width:970px;height:400px;">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div class="content" style="width:970px;"><br />
          <div style="background-image:url(images/services.gif); background:no-repeat;"><h2></h2></div>
          <?php
		  		$conn = require_once('databaseconnection.php');
				$sql = "SELECT * FROM laboratory_services";
	            $result = mysqli_query($conn,$sql); 
				$rows  = mysqli_num_rows($result);
		   		if($rows > 0)
				{
			?>
          	 <table align="center" cellpadding="10" cellspacing="10" id="services" style="width:700px;padding-left:20px;">
                    	
  						<tbody style="color:#333" align="left">
                       		<tr>
  							<?php
								$i = 0;
								
 								while($data = mysqli_fetch_row($result)) {
							?>	  
  								 
                                	<td bgcolor="#3333FF"><?php echo "<a href='" .  trim($data[1]) . ".php' target='_blank'>" .  $data[1] . "</a>" ?></td>
                                    
 								<?php if(($i +1) % 3 == 0) { ?>	
 								</tr>
                                <tr>
                                
                                <?php }$i++; }} ?>
                                </tr>
                                </tbody>
  						
 					</table>
        <!--  <table align="center" cellpadding="10" cellspacing="10" id="services" style="width:700px;padding-left:50px;">
          	<tr>
            	<td bgcolor="#CC99CC"><a href="xrf.php" target="_blank">XRF</a></td>
                <td bgcolor="#CC99CC"><a href="labservices.php" target="_blank">XRD</a></td>
                <td bgcolor="#CC99CC"><a href="labservices.php" target="_blank">SEM</a></td>
            </tr>
            <tr>
                <td bgcolor="#CC99CC"><a href="labservices.php" target="_blank">LRSA</a></td>
                <td bgcolor="#CC99CC"><a href="labservices.php" target="_blank">PSA</a></td>
                <td bgcolor="#CC99CC"><a href="labservices.php" target="_blank">TDS</a></td>
             </tr>
           
          </table> -->
         <!-- <a href="#"><img src="images/product1.gif" alt="product" /></a> <a href="#"><img src="images/product2.gif" alt="product" /></a> <a href="#"><img src="images/product3.gif" alt="product" /></a> <a href="#"><img src="images/product4.gif" alt="product" /></a> <a href="#"><img src="images/product5.gif" alt="product" /></a> <a href="#"><img src="images/product6.gif" alt="product" /></a> <a href="#"><img src="images/product7.gif" alt="product" /></a> <a href="#"><img src="images/product8.gif" alt="product" /></a>-->
          </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div id="footer" style="height:80px;" >
         <div style="float:left; vertical-align:middle;height:80px;padding-top:30px;padding-left:15px;">
           <a href="#">Home</a> |
           <a href="#">About us</a>|
            <a href="#">Contact</a>
         </div>
    <div id="payment" ><img src="images/paypal.gif" alt="paypal" /></div>
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>

