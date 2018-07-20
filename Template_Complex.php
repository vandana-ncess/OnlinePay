<?php session_start(); 
		$_SESSION['sear_id'] ='';
	if($_SESSION['userName'] == "")
	{
		echo "<script>alert('Invalid Login! Please login again!'); document.location = 'adminLogin.php'; </script>";
	}
	$conn = require_once('databaseconnection.php');
	if(isset($_GET['id']) && !empty($_GET['id'])){
    	$id = $_GET['id'];
		if($id != '')
		{
			$sql = "SELECT * FROM lab_master WHERE labServiceID=" . $id;
			$result = mysqli_query($conn,$sql);
			$data = mysqli_fetch_row($result);
			$_SESSION['$sear_lab'] = $data[1];
			$_SESSION['sear_id'] = $data[0];

			$samp_size=$data[5];
		}
	} 
	else {
   		$_SESSION['$sear_lab'] = "";
		$samp_size = 0;

	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NCESS Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body >
<div id="container">
  <div id="headerinner"> </div>
  <div id="border" style=" min-height: 400px;height:auto;">
    <div id="main" style=" min-height: 400px;height:auto;">
   <style type="text/css">
  
   li { margin: 0; padding: 0; }
   label { display: block; color: WindowText; background-color: Window; margin: 0; padding: 0; width: 100%; }
   label:hover { background-color: Highlight; color: HighlightText; }
  </style>

    <script>
	

	function validateForm()
	{
		var len = document.getElementById("tblTests").rows.length - 2 ;
		var str = 0;
		var con = 0;
 		for($i = 0 ; $i < len; $i++)
		{
			str = "chkConAppl" + $i ;
			if(document.getElementById(str).checked)
				document.getElementById('txtConc' + $i).value = 1;
			else
				document.getElementById('txtConc' + $i ).value = 0;	
		}

	}

function searchServices() {
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				$div = document.getElementById("divSearch");
				$div.innerHTML = this.responseText ;
				$div.style.border="1px solid #A5ACB2";
				if($div.getElementsByTagName('a').length == 0)
				{
					$div.style.display = 'none';
					sessionStorage.removeItem('sear_id');
					var table = document.getElementById("tblTests");
					var row = table.rows[0];
					var tfoot = table.rows[table.rows.length-1].cloneNode(true); 
					var clone = table.rows[table.rows.length-2].cloneNode(true); 
					while(table.hasChildNodes())
					{
					   table.removeChild(table.firstChild);
					}
					table.appendChild(row);
					table.appendChild(clone);
					table.appendChild(tfoot);
					loadSample();
					loadParam();
					document.getElementById('txtSampSize').value='';
				}
            }
        };
		$str = document.getElementById('txtLab').value;

		if($str != "")
		{
        	xmlhttp.open("GET","search.php?q="+$str,true);
        	xmlhttp.send();
		}
}


</script>
      <div align="center" id="right" style="width:970px;min-height:400px;height:auto">
       <!-- <div class="content">
          <h3>Welcome</h3>
          <p>NCESS provides a variety of services like Laboratory services, TA/OA... </p>
          <p>This website is designed to provide online payment towards this services sothat anyone wish to avail trhese services can pay the money online and come and use these facilities.</p>
          <p>Kindly read all instructions before you proceed .</p>
        
        </div>-->
       <div class="lab"  style=" min-height: 400px;width:900px; height:auto;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="validateForm()">
          	<table style="height:80px; width:800px;padding-top:20px;padding-left:10px;padding-right:15px;">
            	<tr>
                	<td width="150px;" style="padding-left:45px;"> Lab Sevice Name : </td><td><input type="text" id="txtLab" name="txtLab" style="width:300px;" onkeyup="searchServices();" <?php if($_SESSION['$sear_lab'] !=='') echo ' value="' . $_SESSION['$sear_lab'] . '";' ?>  required  /><div id="divSearch" /></td><td width="150px;" style="padding-left:0px;">Minimum Sample</td><td><input type="text" name="txtSampSize" id="txtSampSize" style="width:80px;"   <?php if($samp_size !==0) echo 'value=' . $samp_size; ?>  required /></td>
                </tr>
             <tr>
             	<td colspan="4" >
                <table  width="800px" style="padding-top:50px;padding-left:10px;height:auto" id="tblTests">
                    <thead style="color:#333; border:solid ; " align="center">
                        <tr style="background-color:#00CC00;">
                            <th width="170px;" style="text-align:center">Sample Type</th>
                            <th  width="250px;">Parameter</th>
                            <th  width="100px;">Charge</th>
                            <th  width="100px;">Addn. Sample Charge</th>
                            <th width="50px;">Concession Applicable?</th>
                            <th />
                        </tr>
                    </thead>
                    	<?php if($_SESSION['$sear_lab'] == "")
						{ ?>
                        <tbody style="color:#333" align="center">
                        <tr>
                            <td><select id="ddlSample" style="width:100px;height:25px;"  onchange="validate()"	name="ddlSample[]" required   > 
                         <?php
                            $sql = "SELECT * FROM sampletype_master where sampleTypeStatus=1";
                            $result = mysqli_query($conn,$sql); 
                            $i= 0;
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($data = mysqli_fetch_row($result)){
                        ?>
                        <option value="<?php echo $data[0] ?> ">  <?php echo $data[1] ?> </option>
                        <?php } } ?>
                        </select>
                        </td>
                        <td>  <select id="ddlParam" style="width:180px;height:25px;" onchange="validate()" 	name="ddlParam[]" required  > 
                         <?php
                            $sql = "SELECT * FROM parameter_master where parameterStatus=1";
                            $result = mysqli_query($conn,$sql); 
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($data = mysqli_fetch_row($result)){
                        ?>
                        <option value="<?php echo $data[0] ?> ">  <?php echo $data[1] ?> </option>
                        <?php } } ?>
                        </select>
                        
                        </td>
                        <td><input type="text" name="txtCharge[]" style="width:80px;" required /></td>
                        <td><input type="text" name="txtAddnCharge[]" style="width:80px;" required /></td>
                        <td><input type="checkbox" name="chkConAppl[]" <?php echo ' id="chkConAppl' . $i . '";' ?> value="1" style="width:30px;" checked="checked" /><input type="hidden" name="txtConc[]" <?php echo 'id="txtConc' . $i . '";'; $i++; ?>  /><input type="hidden" name="txtMode[]" value="Save" /> </td>
                        <td><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $i; ?> /></td>
                     </tr>  </tbody>
                     <?php 
					 }else {
					 ?>
                     <tbody>
                     <?php 
					 	$sql = "SELECT sampleType,parameterName,charge,addnCharge,isConcAppl,labParameterID FROM lab_parameter_rates A JOIN sampletype_master B ON A.sampleTypeID = B.sampleTypeID JOIN parameter_master C ON A.parameterID = C.parameterID where labID=" . $_SESSION['sear_id'];
						$result = mysqli_query($conn,$sql);
						if(mysqli_num_rows($result) > 0)
                            {
	                            $i= 0;
                                while($data = mysqli_fetch_row($result))
								{
					 ?> 
                     			<tr>
                                	<td><?php echo $data[0]; ?></td><td><?php echo $data[1]; ?></td>  
                                    <td><input type="text" name="txtCharge[]" style="width:80px;"  <?php echo " value='" . $data[2] . "'";?>  required /></td>
                        			<td><input type="text" name="txtAddnCharge[]" style="width:80px;"  <?php echo " value='" . $data[3] . "'";?> required /></td>
                        			<td><input type="checkbox" name="chkConAppl[]" <?php echo ' id="chkConAppl' . $i . '";' ?> value="1" style="width:30px;"  <?php  if($data[4] == 1) echo "checked=checked"; ?> /><input type="hidden" name="txtConc[]" <?php echo 'id="txtConc' . $i . '";';  " value='" . $data[4] . "'"; ?>  /><input type="hidden" name="txtMode[]" <?php echo 'id="txtMode' . $i . '";'; $i++; echo " value='" . $data[5] . "'";?> /></td>
                                    <td><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $i; ?> /></td>
                        		</tr>
                     <?php }}} ?>
                     </tbody>
                     <tfoot>
                        <tr>                        <td colspan="3"><input type="button" name="btnAdd" id="btnAdd" value="Add" style="width:80px;height:28px;" onclick="cloneRow()"  /></td>
<td  /><td><input type="submit" name="btnSave" id ="btnSave" value="Save" style="width:80px;height:28px;" /></td></tr>
                     </tfoot>
                    </table>
                </td>
             </tr>
           </table>
          </form>
			<?php 
				if(isset($_POST['btnSave']))
				{
					$isConAppl = $_POST['txtConc'];
					$sample = $_POST['ddlSample'];
					$charge = $_POST['txtCharge'];
					$addncharge = $_POST['txtAddnCharge'];
					$mode = $_POST['txtMode'];
					$param = $_POST['ddlParam'];
					$j=0;
					if($_SESSION['sear_id']!=0){
						for($i=0;$i<sizeof($mode);$i++)
						{
							if($mode[$i]=='Save')
							{
								$sql = "INSERT INTO lab_parameter_rates(labID,sampleTypeID,parameterID,charge,addnCharge,isConcAppl,status) VALUES(" . $_SESSION['sear_id'] . "," . $sample[$j]. "," .$param[$j]."," . $charge[$i]  . "," . $addncharge[$i]."," .$isConAppl[$i]. ",1)";
								$j++;
							}
							else
								$sql = "UPDATE lab_parameter_rates SET charge = " . $charge[$i] . ", addnCharge = " . $addncharge[$i] . ", isConcAppl = " . $isConAppl[$i] . " WHERE labParameterID=" . $mode[$i];
						$result = mysqli_query($conn,$sql); 
						}
					}
					else{
						$sql = "SELECT * FROM lab_master WHERE labServiceName = '" . $_POST['txtLab'] . "' ";
						$result1 = mysqli_query($conn,$sql);
						if(mysqli_num_rows($result1) > 0)
						{
							echo "Service already Exists!" . $_SESSION['sear_id'];
							exit();
						}

						$sql = "INSERT INTO lab_master(labServiceName,noOfSubServices,minSampleSize,labServiceStatus,template) VALUES('" . $_POST['txtLab'] . "'," . sizeof($param) .",". $_POST['txtSampSize'] .",'Active','complex')";
						$result = mysqli_query($conn,$sql); 
						$last_id = mysqli_insert_id($conn);
						for($i=0;$i<sizeof($param);$i++)
						{
							$sql = "INSERT INTO lab_parameter_rates(labID,sampleTypeID,parameterID,charge,addnCharge,isConcAppl,status) VALUES(" . $last_id . "," . $sample[$i]. "," .$param[$i]."," . $charge[$i]  . "," . $addncharge[$i]."," .$isConAppl[$i]. ",1)";
							$result = mysqli_query($conn,$sql); 
						}
						
					}
					if($result)
						echo "Saved Successfully!";
					else
						echo "Unable to save!";
					$_POST['btnSave'] = '';
					$_SESSION['sear_id']=0;
					$_SESSION['$sear_lab']='';
				}
			?>
          </div>
        
          
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
 
  <script type="text/javascript">
  var arr = new Array();
  	function validate()
	{
		if(arr.length > 0)
		{
			var table = document.getElementById("tblTests"); // find table to append to
			var row = table.rows[table.rows.length - 2];
			 ddlSamp = row.cells[0].children[0];
			  ddlParam = row.cells[1].children[0];
			var str =  ddlSamp.options[ddlSamp.selectedIndex].text + ddlParam.options[ddlParam.selectedIndex].text;
			for($i = 0; $i <arr.length; $i++)
			{
				if(arr[$i]==str)
				{	
					row.cells[0].children[0].value = "";
					row.cells[1].children[0].value = "";
					alert('Parameter already defined!');
					return false;
				}
			}
		}	 
		
		return true;	
	}
 	function cloneRow() {
			  var table = document.getElementById("tblTests"); // find table to append to
			  var row = table.rows[table.rows.length - 2]; // find row to copy
			  var clone = row.cloneNode(true); // copy children too
			  clone.cells[4].children[0].id="chkConAppl" + (table.rows.length - 2);
			   clone.cells[4].children[1].id="txtConc" + (table.rows.length - 2);
 			   clone.cells[4].children[2].id="txtMode" + (table.rows.length - 2);
			    clone.cells[4].children[2].value = "Save";
		 // row.cells[row.cells.length-1].innerHTML="";
			  if(row.cells[0].children.length > 0)
			  {
			  	ddlSamp = row.cells[0].children[0];
			  	ddlParam = row.cells[1].children[0];
			  	arr[arr.length] = ddlSamp.options[ddlSamp.selectedIndex].text + ddlParam.options[ddlParam.selectedIndex].text;

				for($i=0;$i<clone.cells.length-1;$i++)
			  	{
					clone.cells[$i].children[0].value="";
			  	}
				clone.id = "newID"; // change id or other attributes/contents
			  
			  table.insertBefore(clone,table.children[table.rows.length-1]);
			}
			else
			{
			  	arr[arr.length] = row.cells[0].innerHTML + row.cells[1].innerHTML;
				clone.cells[2].children[0].value="";
				clone.cells[3].children[0].value="";
				clone.id = "newID"; // change id or other attributes/contents
			  
			  table.appendChild(clone);
				loadSample();
				loadParam();
				
			}
			   // add new row to end of table
			  
    }
	function loadSample()
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
						var table = document.getElementById("tblTests"); // find table to append to
			  			var row = table.rows[table.rows.length - 2];
						row.cells[0].innerHTML = this.responseText ; 
						row.cells[0].children[0].value="";
            		}
        		};
        		xmlhttp.open("GET","getSampleTypes.php",true);
        		xmlhttp.send();
	}
	function loadParam()
	{
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            		xmlhttp1 = new XMLHttpRequest();
        		} else {
            // code for IE6, IE5
            		xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP");
        		}
        		xmlhttp1.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						var table = document.getElementById("tblTests"); // find table to append to
			  			var row = table.rows[table.rows.length - 2];
						row.cells[1].innerHTML = this.responseText ; 
						row.cells[1].children[0].value="";
            		}
        		};
        		xmlhttp1.open("GET","getParam.php",true);
        		xmlhttp1.send();
	}
	function delService(btn)
		{
			if(document.getElementById("tblTests").rows.length==3)
			{
				alert('Unable to delete!');
				return;
			}
			if(confirm('Are you sure you want to delete this?'))
			{
				row = btn.parentNode.parentNode;
				id = row.cells[4].children[2].value;
				if(id=='Save')
					document.getElementById("tblTests").deleteRow(btn.parentNode.parentNode.rowIndex);
				else
					document.location= 'del_service.php?q=' + id +'&service=labparam';
			}
		}
  </script>
 
</body>
</html>
