<?Php
//****************************************************************************
////////////////////////Downloaded from  www.plus2net.com   //////////////////////////////////////////
///////////////////////  Visit www.plus2net.com for more such script and codes.
////////                    Read the readme file before using             /////////////////////
//////////////////////// You can distribute this code with the link to www.plus2net.com ///
/////////////////////////  Please don't  remove the link to www.plus2net.com ///
//////////////////////////
//*****************************************************************************
?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Plus2net.com paging script in PHP</title>
<link rel="stylesheet" href="../../../Users/DS SURESH BABU/Downloads/php_paging/php_paging/style.css" type="text/css">
</head>

<body>
<?Php

$page_name="demo_paging1.php"; //  If you use this code with a different page ( or file ) name then change this 
$start=$_GET['start'];
if(strlen($start) > 0 and !is_numeric($start)){
echo "Data Error";
exit;
}

$conn = require_once('databaseconnection.php');
$eu = ($start - 0); 
$limit = 2;                                 // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 
				$sql = "SELECT * FROM component_master";
	            $result = mysqli_query($conn,$sql); 
				$row_no =mysqli_num_rows($result);
		   		if($row_no > 0)
				{
          	echo '<table title="Rate Components" id="tblComp">
                    	<thead style="background:#3A8E00; color:#FFF;">
                        	<tr>
                            	<th height="30px" colspan="7" ><strong>Rate affecting Components</strong></th>
                            </tr>
                        </thead>

 						<thead style="color:#333" align="left">
  							<tr>

 								<th width="100" style="text-align:center">Serial No.</th>
 							 	<th>Component Name</th>
								<th>Status</th>
 							</tr>
  						</thead>
  						<tbody style="color:#333" align="left">';
								$count = 1;
 								while($data = mysqli_fetch_row($result)){
  							echo	'<tr>
 									<td width="100" style="color:#333; text-align:center">'. $count .'</td>
    								<td width="250" style="color:#333">'. $data[1] .'
                                    <td width="100" style="color:#333">'. $data[2].'</td>
                                     
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= "btnDel"' . $count .' /></td><td style="display:none;"> '.  $data[0] .'</td>
 								</tr>
                                </tbody>';
							  $count++;
								}}

 					echo '</table>';
////////////////////////////// End of displaying the table with records ////////////////////////

/////////////////////////////// 
if($row_no > $limit ){ // Let us display bottom links if sufficient records are there for paging

/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";
//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
if($back >=0) { 
print "<a href='$page_name?start=$back'><font face='Verdana' size='2'>PREV</font></a>"; 
} 
//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
echo "</td><td align=center width='30%'>";
$i=0;
$l=1;
for($i=0;$i < $row_no;$i=$i+$limit){
if($i <> $eu){
echo " <a href='$page_name?start=$i'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";}        /// Current page is not displayed as link and given font color red
$l=$l+1;
}


echo "</td><td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
if($this1 < $row_no) { 
print "<a href='$page_name?start=$next'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";

}// end of if checking sufficient records are there to display bottom navigational link. 
?>
 <br><br>
<a href=../../../Users/DS SURESH BABU/Downloads/php_paging/php_paging/demo_paging1.php>PHP paging demo I ></a> |
<a href=../../../Users/DS SURESH BABU/Downloads/php_paging/php_paging/demo_paging2.php> User managing records per page</a> | <a href=../../../Users/DS SURESH BABU/Downloads/php_paging/php_paging/demo_paging4.php>Sorting by column</a> |

<br><br>
<center><a href='http://www.plus2net.com' rel="nofollow">PHP SQL HTML free tutorials and scripts</a></center> 
</body>

</html>
