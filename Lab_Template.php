<?php 
	session_start();
	$_SESSION['labServiceID'] = $_GET['labID'];
	$conn = require_once('databaseconnection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Online Payment Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload=<?php echo "'loadConcession(" . $_SESSION['labServiceID'] . ");'"; ?>>
<script type="text/javascript">
	
	function calculateTotal()
	{
		var tab = document.getElementById('tblTests');
		var rows = tab.rows.length;
		var total = 0;
		for(i = 1;i<rows;i++)
		{
			col = tab.rows[i].cells.length;
			j = i -1;
			if(col>2)
			{
				chk =tab.rows[i].cells[0].children[0].checked;
				if(chk)
				{
					$no = (tab.rows[i].cells[3].children[0].value == 0)? 1: tab.rows[i].cells[3].children[0].value;
					$rate = tab.rows[i].cells[2].innerHTML.substr(0,tab.rows[i].cells[2].innerHTML.indexOf('/'));
					if($rate == '') $rate = tab.rows[i].cells[2].innerHTML;
					if(tab.rows[i].cells[3].children[1].value != "Element")
						total += ($no * $rate);
					else
					{
						if(tab.rows[i-1].cells[3].children[1].value == "Sample")
						{
							$samp = tab.rows[i-1].cells[3].children[0].value ;
							total += ($no*$rate*$samp);
						}
					}

				}
			}
		}
		 document.getElementById('txtCharge').value = total;
		 calculateConcession();
		 
	}
	
	function calculateConcession()
	{
		$total = document.getElementById('txtCharge').value;
		if($total>0)
		{
			for(i = 1; i < document.getElementById('fld').children.length; i=i+2)
			{
				element = document.getElementById('fld').children[i];
				if(element.checked)
				{
					$conID = element.value;
					break;
				}
			}
			tab = document.getElementById('tblConcessions');
			str = document.getElementById($conID).parentNode.innerHTML;
			con = str.substr(0,str.indexOf('<'));
			document.getElementById('txtAddnCharge').value = $total - ($total*con)/100;
		}
		loadGST();
	}
	function loadGST()
	{
		gst = document.getElementById('txtGSTRate').value;
		total = document.getElementById('txtAddnCharge').value;
		document.getElementById('txtGst').value = (total*gst)/100;
		document.getElementById('txtTotal').value  = Number(document.getElementById('txtGst').value) + Number(document.getElementById('txtAddnCharge').value);
	}	 
	 function loadConcession(labID)
	 {
	 	 if (labID == "") {
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
				document.getElementById("tblConcession").innerHTML = this.responseText ;
            }
        };
        xmlhttp.open("GET","getConcession.php?q="+labID + "&mode='view'",true);
        xmlhttp.send();
    }
	}
	
</script>
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
      
      <div align="center" id="right" style="width:970px;height:auto;">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div class="lab" style="width:970px;height:auto;padding-left:50px;">
          <!--<div class="inn"> <h3>XRF</h3></div>--><br />
          <form action="" method="post">
          <table cellpadding="0" cellspacing="0"   style="width:970px;height:240px;">
          	<tr>
            	<td>Name of Indenter</td><td ><input type="text" name="txtIndenter"	id="txtIndenter"/></td>
                <td  rowspan="2" colspan="2" valign="top">
	                <fieldset id='fld' style="width:300px;vertical-align:top;height:105px;padding-top:5px;"><legend align="top">Category of Request</legend>
                	<?php 
						$sql="select categoryID , categoryName from category_master where categoryStatus=1";
						$result = mysqli_query($conn,$sql);
						$i = 0;
						while($data=mysqli_fetch_assoc($result))
						{
					?>
                         	<input type="radio" name="category" id="optCategory" <?php echo 'value=' . $data['categoryID'];  if($i==0) echo ' checked'; ?> onchange="calculateConcession()" style="width:40px;"> <?php echo $data['categoryName']; $i++;?> <br />
                         <?php } 
						  ?>
                     </fieldset>
                </td>
            </tr>
            <tr>
                <td>Address</td><td ><textarea name="txtAddress" id="txtAddress" rows="4"  style="width:250px;" ></textarea></td>

            </tr>
            <tr>
            	<td>Email Address</td><td><input type="text" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"	id="txtEmail" /></td>
                <td align="left" rowspan="4" valign="top" style="padding-left:0px;"><div id="tblConcession" width="350px" /></td>

            </tr>
          	<tr>
				<td>Mobile No.</td><td><input type="text" id="txtMobile"  name="txtMobile" /></td>
            </tr>
             <tr>
                <td >Affiliation</td><td ><input  type="text" name="txtAffliation"	id="txtAffliation"   /></td>
                 
            </tr>
            <tr>
                <td>Project</td><td ><input type="text"	id="txtProject" name="txtProject" /></td>
            </tr>
            
            <!--<tr>
                
                <td>No. of Samples</td><td><input type="text"	id="txtNoofSamples" onchange="calculateRates()" /></td>
           </tr>-->
           
          </table><br />
          <table width="900px;" align="left" id="tblTests" >
          	 <thead style="color:#333; border:solid ; " align="left">
  							<tr style="background-color:#00CC00;">

 								<th width="70px;" style="text-align:center">Select</th>
 							 	<th  width="500px;">Component Name</th>
  								<th  width="280px;">Charges</th>
								<th  width="50px;">No. of Samples/<br />Hours/Elements</th>
 							</tr>
  						</thead>
                         <tbody style="color:#333" align="left">
           <?php  
		   		
				$sql = "SELECT A.labServiceID, labServiceName,subServiceName, noOfSubServices, charge, mandatory, labServiceStatus, C.componentName, addnCharge, D.componentName as addnType , sampleType FROM lab_master A JOIN lab_rates B on A.labServiceID = B.labServiceID JOIN component_master C ON B.componentID=C.componentID JOIN component_master D ON B.addnComponentID=D.componentID LEFT JOIN sampletype_master E on B.sampleTypeID = E.sampleTypeID WHERE A.labServiceID=" . $_SESSION['labServiceID'] . " ORDER BY B.sampleTypeID, labID";
	            		$result = mysqli_query($conn,$sql); 
				$sql1 = "SELECT sampleType, COUNT(sampleType) FROM lab_master A JOIN lab_rates B on A.labServiceID = B.labServiceID JOIN component_master C ON B.componentID=C.componentID JOIN component_master D ON B.addnComponentID=D.componentID LEFT JOIN sampletype_master E on B.sampleTypeID = E.sampleTypeID WHERE A.labServiceID=" .  $_SESSION['labServiceID'] . " GROUP By sampleType ORDER BY labID";
				$result1 = mysqli_query($conn,$sql1);
				if(mysqli_num_rows($result1) > 1)
				{
					while($ro = mysqli_fetch_row($result1))
					{ 
					?>
						<tr><td style="font-weight:bold;" ><?php echo $ro[0]; ?> </td></tr> 
						<?php  
							$n = $ro[1];
							for($i=0; $i <$n ; $i++)
							{
								$data = mysqli_fetch_row($result);
						 ?>
							<tr>
						<td ><input type="checkbox"  <?php echo "id='chkSelect[" . $i . "]'"; ?>   name="chkSelect" style="width: 40px;"  <?php if($data[5] == '1') { echo "checked " ; } ?> onchange="calculateTotal();" /></td>
						<td > <?php echo $data[2]; ?></td>
						<td ><?php if($data[7] == 'Fixed') echo $data[4]; else echo $data[4] . "/" . $data[7] ; ?></td>
						<td><input type="text" <?php echo "id='txtMulFactor[" . $i . "]'"; ?>  name="txtMulFactor" style="width: 80px;" onchange="calculateTotal()" /> <input type="hidden" name="txtType" <?php echo "id='txtType[" . $i . "]'"; echo " value='" . $data[7] . "'" ; ?> /></td>
                        </tr>
                        <?php if($data[8] !=0) { ++$i;++$n;?>
                        	<tr>
								<td ><input type="checkbox"  <?php echo "id='chkSelect[" . $i . "]'"; ?> name="chkSelect" style="width: 40px;" onchange="calculateTotal();" /></td>
								<td >Addional Charge</td>
								<td ><?php if($data[9] == 'Fixed') echo $data[8]; else echo $data[8] . "/" . $data[9] ; ?></td>
								<td><input type="text" <?php echo "id='txtMulFactor[" . $i . "]'"; ?>  name="txtMulFactor" onchange="calculateTotal()" style="width: 80px;" /><input type="hidden" name="txtType" <?php echo "id='txtType[" . $i . "]'"; echo " value='" . $data[9] . "'" ; ?> /> </td>
                        	</tr>
						 <?php }}}}
				else
				{
					$i = 0;
					while($data = mysqli_fetch_row($result))
					{
					?>
						<tr>
						<td ><input type="checkbox"  <?php echo "id='chkSelect[" . $i . "]'"; ?>   name="chkSelect" style="width: 40px;"  <?php if($data[5] == '1') { echo "checked " ; } ?> onchange="calculateTotal();" /></td>
						<td > <?php echo $data[2]; ?></td>
						<td ><?php if($data[7] == 'Fixed') echo $data[4]; else echo $data[4] . "/" . $data[7] ; ?></td>
						<td><input type="text" <?php echo "id='txtMulFactor[" . $i . "]'"; ?>  name="txtMulFactor" style="width: 80px;" onchange="calculateTotal()" /> <input type="hidden" name="txtType" <?php echo "id='txtType[" . $i . "]'"; echo " value='" . $data[7] . "'" ; ?> /></td>
                        </tr>
                        <?php if($data[8] !=0) { ++$i;?>
                        	<tr>
								<td ><input type="checkbox"  <?php echo "id='chkSelect[" . $i . "]'"; ?> name="chkSelect" style="width: 40px;" onchange="calculateTotal();" /></td>
								<td >Addional Charge</td>
								<td ><?php if($data[9] == 'Fixed') echo $data[8]; else echo $data[8] . "/" . $data[9] ; ?></td>
								<td><input type="text" <?php echo "id='txtMulFactor[" . $i . "]'"; ?>  name="txtMulFactor" style="width: 80px;" onchange="calculateTotal()" /><input type="hidden" name="txtType" <?php echo "id='txtType[" . $i . "]'"; echo " value='" . $data[9] . "'" ; ?> /> </td>
                        	</tr>
					 <?php } ++$i; }
				}?>
               <!--	<tr><td colspan="4" /><td><input type="button" name="btnCalculate" id="btnCalculate" value="Calculate Total" style="width:120px;height:25px;" />	-->
					
          </table><br />
          </form>
         </div>
          <div class="summary" align="center" >
           <form action="" method="post">
          	<table width="400px">
                	<tr>
                    	<td >Total</td><td><input type="text" name="txtCharge" id="txtCharge" readonly="readonly" style="width:80px;height:25px" onchange="calculateConcession();" /></td>
                    </tr>
                    <tr><td> After Concession </td>
                    <td><input type="text" name="txtAddnCharge" id="txtAddnCharge" readonly="readonly" style="width:80px;height:25px;" onchange="loadGST();" /></td></tr>
                    <tr><td>GST</td><td><input type="text" name="txtGst"  id="txtGst" readonly="readonly" style="width:80px;height:25px;" /></td></tr>
                    <tr><td>Amount Payable</td><td><input type="text" name="txtTotal"  id="txtTotal" readonly="readonly" style="width:80px;height:25px;" /></td></tr>
                    <tr><td colspan="2" align="left" style="padding-top:10px;padding-bottom:10px;" ><input type="submit" name="btnMakePayment" value="Make Payment" class="pay" style="width:280px;height: 35px;border-radius:20px;color:#CCCCCC;font-weight:bold;font-size:16px;background-color:#006699;" /> </td></tr>
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

