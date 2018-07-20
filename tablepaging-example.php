<html>
<head>
<title>Paging in HTML table-Dot Net-Concept</title>
    
 <script type="text/javascript" src="JS/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="JS/jquery.dataTables.js"></script>
    <script type="text/javascript" src="JS/dataTables.bootstrap.js"></script>
</head>
<body>
  
<div >
        <h3>Paging in HTML table-Example</h3>
    <hr />
    <table id="tblService" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
        <?php
				$conn = require_once('databaseconnection.php');
				$sql = "SELECT A.labServiceID, labServiceName,subServiceName, noOfSubServices, charge, addnCharge, labServiceStatus FROM lab_master A JOIN lab_rates B on A.labServiceID = B.labServiceID ";
	            $result = mysqli_query($conn,$sql);
				$row_no = mysqli_num_rows($result); 
		   		
			?>
            <table title="Laboratory Services" id="tblService" style="padding-top:30px;">
                    	<thead style="background:#3A8E00; color:#FFF;">
                        	<tr>
                            	<th height="30px" colspan="7" ><strong>Laboratory Services</strong></th>
                            </tr>
                        </thead>
                        <thead style="color:#333" align="left">
  							<tr>

 								<th width="91" style="text-align:center">Serial No.</th>
 							 	<th>Service Name</th>
  								<th>Analytical Charges</th>
								<th>Status</th>
 							</tr>
  						</thead>
                         <tbody style="color:#333" align="left">
						<?php
								$count = 1;$row =1;
									$data = mysqli_fetch_row($result);
								while( $count <= $row_no)
								{
								
										$row =  $data[3];
 						?>	
                       		<tr>
 								<td  colspan="4"><?php echo $data[1]; ?></td>
                            </tr>
                            <?php 
									
									for($i = 0; $i < $row ; $i++) 
									{
									
							?>
  								<tr>
 									<td width="91" style="color:#333; text-align:center"><?php echo $i + 1 ; ?></td>
    								<td width="200" style="color:#333"> <?php echo $data[2]; ?>
                                    <td width="100" style="color:#333"><?php echo $data[4];?></td>
    								<td width="100" style="color:#333"><?php echo $data[6];?></td>
                                     <td width="60" style="color:#333"><input type="button" class="edit" style="background-image: url(images/edit.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#009900"  name= <?php echo "btnEdit" . $count; ?> id= <?php echo "btnEdit" . $count; ?> onclick="edit(this)"  value="Edit" /></td>
                                      <td width="60" style="color:#333"><input type="button" name="btnDel"  style="background-image: url(images/erase.png);background-repeat: no-repeat;background-position: left;text-align:center;width:80px;height:25px;color:#FF0000" value="Delete" onclick="delService(this)" id= <?php echo "btnDel" . $count; ?> /></td><td style="display:none;"> <?php echo $data[0]; ?></td>
 								</tr>
                               
  							<?php
									$data = mysqli_fetch_row($result);
							} 
							$count = $count + $row;
								
								}
							?>
						 </tbody>
 					</table>	

</div>
 
  
  <script type="text/javascript">
      $(document).ready(function () {
          $('#tblService').dataTable({
              "iDisplayLength": 4,
              "lengthMenu": [5,10, 25, 50, 100]
          });
      });
  </script>
</body>
</html>