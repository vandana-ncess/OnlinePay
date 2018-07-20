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
      
      <div align="center" id="right" style="width:970px;height:auto;">
          <div class="ser" align="left" style=" padding-left:100px;"><h1>Travel Allowance/ Other Advances</h1>
          	<form action="" method="post">
            	<table align="left" id="tblSer"  style="width:970px;height:80px;">
                	
                    <thead>
                    	<tr>
                        <th align="left" colspan="4" >Payee Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    	<td>Salutation</td><td style="width:250px;"><select id="ddlSal" name="ddlSal" style="width:60px;">
                        	<option value="Dr.">Dr.</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td> <td><input type="text" name="txtFname" id="txtFname" required /></td>
                        <td>Last Name</td><td><input type="text" name="txtLname" id="txtLname" required /></td>
                    </tr>
                    <tr>
                       <td style="width:130px;" >Address Line1</td><td><input type="text" name="txtAdd1" id="txtAdd1" required /></td>
                        <td style="width:130px;">Address Line2</td> <td><input type="text" name="txtAdd2" id="txtAdd2" /></td>
                    </tr>
                    <tr>
                       <td style="width:130px;" >City</td><td><input type="text" name="txtCity" id="txtCity" required /></td>
                        <td style="width:130px;">State</td> <td><input type="text" name="txtState" id="txtState" required /></td>
                    </tr>
                    <tr>
                       <td style="width:130px;" >PIN</td><td><input type="text" pattern="[0-9]{6}" name="txtPin" id="txtPin" required /></td>
                    </tr>
                    <thead>
                    	<tr>
                        <th align="left" colspan="4" >Payment Details</th>
                        </tr>
                    </thead>
                    <tr>
                    	<td>Category</td><td><select id="ddlCategory" name="ddlCategory" style="width:250px;" onchange="loadLabel()" >
                        	<option value="NCESS">NCESS</option>
                            <option value="External Projects">External Projects</option>
                            <option value="MoES Projects">MoES Projects</option>
                            <option value="Consultancy Projects">Consultancy Projects</option>
                        	</select>
 						</td>
                        <td colspan="2">Amount to be paid &nbsp;&nbsp;&nbsp;<input type="text" name="" required txtAmountid="txtAmount" style="width:80px;" /></td>
                    </tr>
                     <tr>
                       <td>OA/TA Sanction Details</td><td><textarea name="txtDetails" id="txtDetails" rows="3" style="width:250px;" required></textarea></td>
                       <td style="width:130px;">Remarks</td> <td colspan="3"><textarea name="txtRemarks" id="txtRemarks" rows="3" style="width:250px;"> </textarea></td>
                    </tr>
                     <tr><td><td colspan="2" align="left" style="padding-top:10px;padding-bottom:10px;" ><input type="submit" name="btnMakePayment" value="Make Payment" class="pay" style="width:280px;height: 35px;border-radius:20px;color:#CCCCCC;font-weight:bold;font-size:16px;background-color:#006699;float:left;" /> </td></tr>
                    </tbody>
                </table>
            </form>
          </div>
          <script type="text/javascript">
		  	function loadLabel()
			{
				if(document.getElementById('ddlCategory').value != 'NCESS')
					document.getElementById('tblSer').rows[8].cells[0].innerHTML = "Project Details";
				else
					document.getElementById('tblSer').rows[8].cells[0].innerHTML = "OA/TA Sanction Details";
			}
		  </script>
      </div>
      <div class="clear"></div>
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

