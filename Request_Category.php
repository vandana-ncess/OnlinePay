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
          	<table  height="80px" width="700px">
            	
                <tr><td height="20px;">Request Category</td>	
                    <td height="20px;"> <input type="text" id="txtCategory" 	name="txtCategory" style="width:250px;height:22px;" required />
                    <input type="hidden" id="txtCategoryID" name="txtCategoryID" /> <input type="hidden" id="txtMode" name="txtMode" value="Add" /></td>
                    <td><input type="submit" class="edit"  id="btnAdd" name="btnAdd" value="Add" style="width:100px;height:30px;" />	</td>                   
                </tr>
              
             </table>
          </form>
          <div style="height:300px;">
          <?php
				$sql = "SELECT * FROM category_master";
	            $result = mysqli_query($conn,$sql); 
		   		if(mysqli_num_rows($result) > 0)
				{
			?>
          	<table class="master" title="Request Category" id="tblComp">
                    	<thead style="background:#3A8E00; color:#FFF;">
                        	<tr>
                            	<th height="30px" colspan="7" ><strong>Request Category</strong></th>
                            </tr>
                        </thead>

 						<thead style="color:#333" align="left">
  							<tr>

 								<th width="100" style="text-align:center">Serial No.</th>
 							 	<th>Category Name</th>
								<th>Status</th>
 							</tr>
  						</thead>
  						<tbody style="color:#333" align="left">
  							<?php
								$count = 1;
 								while($data = mysqli_fetch_row($result)){
							?>	  
  								<tr>
 									<td width="100" style="color:#333; text-align:center"><?php echo $count; ?></td>
    								<td width="250" style="color:#333"> <?php echo $data[1]; ?>
                                    <td width="100" style="color:#333"><?php  if($data[2] == '1') echo 'Active'; else echo "Inactive";?></td>
                                     
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $count; ?> /></td><td style="display:none;"> <?php echo $data[0]; ?></td>
 								</tr>
                                </tbody>
  							<?php
							  $count++;
								}}
							?>

 					</table>
          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <?php 
  	
		if(isset($_POST["btnAdd"]))
		{
			$sql = "SELECT * FROM category_master WHERE categoryName = '" . $_POST['txtCategory'] . "' ";
			echo $sql;
			$result1 = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result1) > 0)
			{
				echo "Category already Exists!";
				exit();
			}
				$sql = "INSERT INTO category_master(categoryName,categoryStatus) VALUES('" . $_POST['txtCategory'] .  "',1)";
				$result = mysqli_query($conn,$sql); 
				echo $sql;
				if($result)
					echo "Saved Successfully!";
				else
					echo "Unable to save!";
				echo "<script> window.location='Request_Category.php';</script>";
					$_POST['btnAdd'] = '';
		
		}
  ?>
  <script type="text/javascript">
 
  function delService(x) {
	var theId = x.id;
	var index = theId.substring(theId.length-1) ;
	++index;
	var serviceID = document.getElementById("tblComp").rows[index].cells.item(4).innerHTML;

	if(confirm('Are you sure you want to delete this Service?'))
	{
		 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.location='Request_Category.php';
			}
        };
        xmlhttp.open("GET","del_service.php?service=category&q="+serviceID,true);
        xmlhttp.send();
	}

  }
  </script>
  <div id="footer">
  
  </div>
  <div id="footerend"></div>
</div>
</body>
</html>
