<?php
	$conn = require_once('databaseconnection.php');
	$empID= $_GET['empID'];
	$fromDate = $_GET['fromDate'];
	$toDate = $_GET['toDate'];
				echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color:#000000;">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Time In</th>
                          <th>Time Out</th>
                          <th>Leave</th>
                          <th>Tour</th>
                          <th>Gate Register</th>
                          <th>Status</th>
						 </tr>
					  </thead>
                      <tfoot>
                        <tr>
                          <th>Date</th>
                          <th>Time In</th>
                          <th>Time Out</th>
                          <th>Leave</th>
                          <th>Tour</th>
                          <th>Gate Register</th>
                          <th>Status</th>
                        </tr>
                      </tfoot>
              		<tbody>';
                    	 
							$sql = "SELECT A.date,A.intime,A.outtime,A.status,leaveType,place,H.outtime as gateout, H.intime as gatein from employee_attendance A JOIN employee B ON A.employeeID = B.employeeID LEFT JOIN employee_tour G ON B.employeeCode = G.employeeCode AND ((G.startDate <= '" . $startDate ."' AND G.endDate <='" . $startDate . "' ) OR (G.startDate >= '" . $endDate ."' AND G.endDate >='" . $endDate . "')) LEFT JOIN gate_register H ON B.employeeCode = H.employeeCode AND (H.date >= '" . $startDate . "' AND H.date <= '" . $endDate  . "' ) LEFT JOIN employee_leave E ON B.employeeCode = E.employeeCode  AND ((E.startDate <= '" . $startDate ."' AND E.endDate <='" . $startDate . "' ) OR (E.startDate >= '" . $endDate ."' AND E.endDate >='" . $endDate . . "')) LEFT JOIN leave_type F ON E.leaveTypeID=F.leaveTypeID WHERE B.employeeID =" . $empID . " AND ( A.date >= '" . $startDate . "' AND A.date <= '" . $endDate  . "');
							$result1 = mysqli_query($conn,$sql);
							while($data = mysqli_fetch_array($result1))
							{
						
                        echo "<tr>
                        	<td> <a href='employeeDtls.php?empID=" . $data['employeeID'] . "' target='_blank'>" . $data['employeeName'] . "</a> </td>
                            <td>" . $data['designation'] . "</td>
                            <td>".  $data['divisionName'] . "</td>
                            <td>". $data['intime']."</td>
                            <td>". $data['outtime']."</td>
                            <td>". $data['leaveType']. "</td>
                            <td>". $data['place']."</td>
                            <td align='center' style='vertical-align:middle;'>";
							if($data['gateout'] != '') echo "<image src='images/tick.png' />";
							echo "</td><td>";
							if($data['status'] == 'A')
										{
											if($data['leaveType'] !='')
												 echo "L";
											else if($data['place'] != '')
												echo "T";
											else echo "A";
										}
										else
										{
											if($data['gateout'] != '' && $data['gatein'] == '')
												echo "O";
											else
												echo "P";
										}
							echo "
                           </td>
                        </tr>";
                         } 
                    echo "</tbody>
                </table>";
			?>