<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Online Payment Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>
<div id="container">
  <div id="headerinner"> </div>
  <div id="border">
    <div id="main">
      
      <div align="center" id="right" style="width:970px;height:auto;">
          <div class="ser" align="left" style=" padding-left:100px;"><h1>Students Registration</h1>
          	<form action="" method="post">
            	<table align="left" id="tblSer"  style="width:970px;height:80px;">
                	
                    <thead>
                    	<tr>
                        <th align="left" colspan="4" >Student Details</th>
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
                    <tr>
            			<td>Email Address</td><td><input type="text" name="txtEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"	id="txtEmail" /></td>
               			<td>Mobile No.</td><td><input type="text" id="txtMobile"  name="txtMobile" /></td> 
            		</tr>
                    <tr>
                 		<td>Course of Study</td><td ><input type="text"	id="txtCourse" name="txtCourse" /></td>
                        <td >Affiliation</td><td ><input  type="text" name="txtAffliation"	id="txtAffliation"   /></td>
           			</tr>
           			
                    <thead>
                    	<tr>
                        <th align="left" colspan="4" >Payment Details</th>
                        </tr>
                    </thead>
                    	<tr>
                		<td >Research Group</td><td ><input  type="text" name="txtResGrp"	id="txtResGrp"   /></td>
                 		<td>Research Guide</td><td ><input type="text"	id="txtGuide" name="txtProject" /></td>
            		</tr>
                    <tr>
                        <td>Date of Joining</td><td><input type="date" name="datepicker" id="datepicker" />
                        <td colspan="2">Registration Fee &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<input type="text" name="" required txtAmountid="txtAmount" style="width:80px;" /></td>
					</tr>
                    <tr>
                		<td >Dissertation Details</td><td colspan="3"><textarea name="txtDetails" id="txtDetails" rows="3" style="width:675px;" required></textarea></td>
                    </tr>
                     <tr><td><td colspan="2" align="left" style="padding-top:10px;padding-bottom:10px;" ><input type="submit" name="btnMakePayment" value="Make Payment" class="pay" style="width:280px;height: 35px;border-radius:20px;color:#CCCCCC;font-weight:bold;font-size:16px;background-color:#006699;float:left;" /> </td></tr>
                    </tbody>
                </table>
            </form>
          </div>
         
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

