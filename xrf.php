<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Online Payment Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload="getRates('xrf')">
<script type="text/javascript">
	var service = "xrf";
	var comm = 0;
	var res = 0;
	var stud = 0;
	var gst = 0;
	var charge = 0;
	 var addncharge = 0;
	 
	 function getRates(str)
	 {
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
				start = this.responseText.indexOf('com=') + 4;
				end = this.responseText.indexOf(',',start) - start ;
				comm = Number(this.responseText.substr(start,end).trim()) ;
				
				start = this.responseText.indexOf('res=') + 4;
				end = this.responseText.indexOf(',',start) - start ;				
				res = Number(this.responseText.substr(start,end).trim()) ;

				start = this.responseText.indexOf('stud=') + 5;
				end = this.responseText.indexOf(',',start) - start ;
				stud = Number(this.responseText.substr(start,end).trim()) ;

				start = this.responseText.indexOf('gst=') + 4;
				end = this.responseText.indexOf(',',start) - start ;
				gst = Number(this.responseText.substr(start,end).trim()) ;

				start = this.responseText.indexOf('charge=') + 7;
				end = this.responseText.indexOf(',',start) - start ;
				charge = Number(this.responseText.substr(start,end).trim()) ;

				start = this.responseText.indexOf('addn=') + 5;
				end = this.responseText.indexOf(',',start) - start ;
				addncharge = Number(this.responseText.substr(start,end).trim()) ;

			}
            }
        };
        xmlhttp.open("GET","get_rates.php?q="+str,true);
        xmlhttp.send();
	 }
	 function calculateRates()
	 {
	 	document.getElementById('txtTotal').value = 0;
		cat =document.getElementsByName('category');
		for (var i = 0, length = cat.length; i < length; i++)
		{
			 if (cat[i].checked)
			 {
			  	$type = cat[i].value;
			  	break;
			 }
		}		
	 	//$type = document.getElementById('optCategory').value;
		var $samp = Number(document.getElementById('txtNoofSamples').value);
		if($samp == '')
			$samp=1;
		var $tot = 0;
		var $charge = 0;
		if($type == 'Commercial')
			 $charge = (charge * comm)/100; 
		else if($type == 'Research')
			 $charge = (charge * res)/100; 
		else if($type == 'Student')
			 $charge = (charge * stud)/100; 
		document.getElementById('txtCharge').value = $charge;
		document.getElementById('txtAddnCharge').value = addncharge;
		document.getElementById('txtGst').value = gst;
		if(document.getElementById('chkAdditional').checked)
			 $tot = $samp * ($charge + addncharge + ((($charge + addncharge)*gst)/100));
		else
			 $tot = $samp* ($charge +  (($charge*gst)/100));
		document.getElementById('txtTotal').value = $tot ;
	 }
</script>
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
       <div class="lab" style="width:970px;height:200px;">
          <!--<div class="inn"> <h3>XRF</h3></div>--><br />
          <form action="" method="post">
          <table cellpadding="0" cellspacing="0"   style="width:900px;height:200px;">
          	<tr>
            	<td >Name of Indenter</td><td><input type="text"	id="txtIndenter"/></td>
            	<td >Affliation</td><td ><input type="text"	id="txtAffliation"   /></td>
            </tr>
            <tr>
                <td>Project</td><td ><input type="text"	id="txtProject" /></td>
            	<td>Email Address</td><td><input type="text"	id="txtEmail" /></td>
            </tr>
           
            <tr>
                <td colspan="2"><fieldset style="width:400px;"><legend>Category of Request</legend>
                	<input type="radio" name="category" id="optCategory" value="Commercial" onchange="calculateRates()"> Commercial <br />
  					<input type="radio" name="category" id="optCategory" value="Research" onchange="calculateRates()"> R & D Institute <br />
  					<input type="radio" name="category" id="optCategory" value="Student" onchange="calculateRates()"> Research Student
                    </fieldset>
                </td>
                <td>No. of Samples</td><td><input type="text"	id="txtNoofSamples" onchange="calculateRates()" /></td>
           </tr>
           
          </table>
          </form>
         </div>
          <div class="summary" align="center" >
           <form action="" method="post">
          	<table>
                	<tr>
                    	<td >Analytical Charge</td><td><input type="text" name="txtCharge" id="txtCharge" readonly="readonly" style="width:80px;height:25px;" /></td>
                    </tr>
                    <tr><td><input type="checkbox" onchange="calculateRates()"  id="chkAdditional" value="add" />Additional Charge</td>
                    <td><input type="text" name="txtAddnCharge" id="txtAddnCharge" readonly="readonly" style="width:80px;height:25px;" /></td></tr>
                    <tr><td>GST</td><td><input type="text" name="txtGst"  id="txtGst" readonly="readonly" style="width:80px;height:25px;" /></td></tr>
                    <tr><td>Total</td><td><input type="text" name="txtTotal"  id="txtTotal" readonly="readonly" style="width:80px;height:25px;" /></td></tr>
                    <tr><td colspan="2" style="padding-top:10px;" ><input type="submit" name="btnMakePayment" value="Make Payment" class="pay" style="width:280px;height: 35px;border-radius:20px;color:#CCCCCC;font-weight:bold;font-size:16px;background-color:#006699;" /> </td></tr>
                </table>
          
          </form>
          </div>
         <!-- <a href="#"><img src="images/product1.gif" alt="product" /></a> <a href="#"><img src="images/product2.gif" alt="product" /></a> <a href="#"><img src="images/product3.gif" alt="product" /></a> <a href="#"><img src="images/product4.gif" alt="product" /></a> <a href="#"><img src="images/product5.gif" alt="product" /></a> <a href="#"><img src="images/product6.gif" alt="product" /></a> <a href="#"><img src="images/product7.gif" alt="product" /></a> <a href="#"><img src="images/product8.gif" alt="product" /></a>-->
      
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

