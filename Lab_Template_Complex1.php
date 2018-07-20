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
		var tab = document.getElementById('tblParam');
		var rows = tab.rows.length;
		var total = 0;
		for(i = 1;i<rows;i++)
		{
			chk =tab.rows[i].cells[0].children[0].checked;
			if(chk)
			{
				$no = Number(document.getElementById('txtNoofSamples').value);
				$min = Number(document.getElementById('txtMinSize').value);
				$rate = Number(tab.rows[i].cells[2].innerHTML);
				if($no <= $min)
					total +=  Number($rate);
				else
				{
					$extra = Number(tab.rows[i].cells[3].innerHTML);
					total += Number(($rate + ($no - $min)*$extra));
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
			document.getElementById('txtAddnCharge').value =$total- ($total*con)/100;
		}
		else
		{
			document.getElementById('txtAddnCharge').value =0;
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
	function loadParam(labID)
	{
		sampID = document.getElementById('ddlSamp').value;
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
				document.getElementById("lstParameters").innerHTML = this.responseText ; 
				calculateTotal();
            }
        };
        xmlhttp.open("GET","getParameters.php?labID="+labID+"&sampID="+sampID,true);
        xmlhttp.send();
    }
		
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
				document.getElementById("tblConcession").innerHTML = this.responseText ;
				loadParam(labID);
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
    <div id="main" style="width:960px;min-height:600px;">
      
      <div align="center" id="right" style="width:950px;height:auto;">
       <div class="lab" style="width:950px;min-height:600px;">
          <!--<div class="inn"> <h3>XRF</h3></div>--><br />
          <form action="" method="post">
          <table cellpadding="0" cellspacing="0"   style="width:970px;height:auto;min-height:600px;">
          	<tr>
            	<td style="width:130px;">Name of Indenter</td><td style="width:420px;"><input type="text" name="txtIndenter" width="300px"	id="txtIndenter"/></td> <td >Sample Type<select name="ddlSamp"	id="ddlSamp" style="width:90px;" onchange="loadParam(<?php echo $_SESSION['labServiceID']; ?>)">
                <?php 
					$sql = "SELECT * FROM sampletype_master WHERE sampleTypeStatus=1";
					$result = mysqli_query($conn,$sql); 
		   			if(mysqli_num_rows($result) > 0)
					{
						while($data = mysqli_fetch_row($result)){
				?>
                    	<option value="<?php echo $data[0] ?> ">  <?php echo $data[1] ?> </option>
                    <?php } } ?>
                    </select></td> <td>
                
               No. of Samples<input type="text" style="width:40px;"	id="txtNoofSamples" onchange="calculateTotal()" /></td>
              
            </tr>
            <tr>
                <td >Affiliation</td><td ><input  type="text" name="txtAffliation"	id="txtAffliation"   /></td><td rowspan="8" colspan="2" > <div class="summary" align="center" id="lstParameters" / >
         
         </div></td>
            </tr>
             <tr>
            	<td>Project</td><td ><input type="text"	id="txtProject" name="txtProject" /></td>
           </tr>
           <tr>
                <td>Address</td><td ><textarea name="txtAddress" id="txtAddress" rows="5"  style="width:250px;" ></textarea></td>
            	
            </tr>
            <tr>
            	<td>Email Address</td><td><input type="text" name="txtEmail"	id="txtEmail" /></td>
            </tr>
          	<tr>
				<td style="padding-top:10px;">Mobile No.</td><td><input type="text" id="txtMobile"  name="txtMobile" /></td>
                
            </tr>
           <tr>
          
           </tr>
           <tr>
            <td colspan="2" valign="top">
	                <fieldset id='fld' style="width:180px;vertical-align:top;height:100px;"><legend align="top">Category of Request</legend>
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
            <td align="left" valign="top" style="padding-left:0px;height:130px;padding-bottom:10px;" colspan="2"  ><div id="tblConcession" width="320px"  /></td>
            </tr>
            </table>
         </form>
     
          <div class="summary" align="center" >
           
          </div>
         <!-- <a href="#"><img src="images/product1.gif" alt="product" /></a> <a href="#"><img src="images/product2.gif" alt="product" /></a> <a href="#"><img src="images/product3.gif" alt="product" /></a> <a href="#"><img src="images/product4.gif" alt="product" /></a> <a href="#"><img src="images/product5.gif" alt="product" /></a> <a href="#"><img src="images/product6.gif" alt="product" /></a> <a href="#"><img src="images/product7.gif" alt="product" /></a> <a href="#"><img src="images/product8.gif" alt="product" /></a>-->
      
      </div>
       <div class="clear"></div>
    </div>
  </div>
  <div id="footer" style="width;979px;height:80px;" >
         <div style="float:left; vertical-align:middle;height:80px;padding-top:30px;padding-left:15px;width:979px;">
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

