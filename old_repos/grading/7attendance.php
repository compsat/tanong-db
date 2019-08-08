<?php
	$student_id=filter_input(INPUT_POST, 'student_id');
	$student_name=filter_input(INPUT_POST, 'name');
	$year_level=filter_input(INPUT_POST, 'year_level');
	$section=filter_input(INPUT_POST, 'section');	
	$school_year=filter_input(INPUT_POST, 'school_year');
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="gradingsystem";
	$A1_1=filter_input(INPUT_POST, '1A1');
$A1_2=filter_input(INPUT_POST, '1A2');
$A1_3=filter_input(INPUT_POST, '1A3');
$A1_4=filter_input(INPUT_POST, '1A4');
$A2_1=filter_input(INPUT_POST, '1B1');
$A2_2=filter_input(INPUT_POST, '1B2');
$A2_3=filter_input(INPUT_POST, '1B3');
$A2_4=filter_input(INPUT_POST, '1B4');
$B1_1=filter_input(INPUT_POST, '2A1');
$B1_2=filter_input(INPUT_POST, '2A2');
$B1_3=filter_input(INPUT_POST, '2A3');
$B1_4=filter_input(INPUT_POST, '2A4');
$B2_1=filter_input(INPUT_POST, '2B1');
$B2_2=filter_input(INPUT_POST, '2B2');
$B2_3=filter_input(INPUT_POST, '2B3');
$B2_4=filter_input(INPUT_POST, '2B4');
$C1_1=filter_input(INPUT_POST, '3A1');
$C1_2=filter_input(INPUT_POST, '3A2');
$C1_3=filter_input(INPUT_POST, '3A3');
$C1_4=filter_input(INPUT_POST, '3A4');
$D1_1=filter_input(INPUT_POST, '4A1');
$D1_2=filter_input(INPUT_POST, '4A2');
$D1_3=filter_input(INPUT_POST, '4A3');
$D1_4=filter_input(INPUT_POST, '4A4');
$D2_1=filter_input(INPUT_POST, '4B1');
$D2_2=filter_input(INPUT_POST, '4B2');
$D2_3=filter_input(INPUT_POST, '4B3');
$D2_4=filter_input(INPUT_POST, '4B4');	
	//create connection
	$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);
	if(mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
	
}
else{
	$i=1;
	$current_marking=0;
	while ($i<=4){
		$b_id=1;
		while($b_id<=7){
			if ($i==1){
				if ($b_id==1){
					$current_marking=$A1_1;
				}
				else if ($b_id==2){
					$current_marking=$A2_1;
				}
				else if ($b_id==3){
					$current_marking=$B1_1;
				}
				else if ($b_id==4){
					$current_marking=$B2_1;
				}
				else if ($b_id==5){
					$current_marking=$C1_1;
				}
				else if ($b_id==6){
					$current_marking=$D1_1;
				}
				else if ($b_id==7){
					$current_marking=$D2_1;
				}
			}
			else if ($i==2){
				if ($b_id==1){
					$current_marking=$A1_2;
				}
				else if ($b_id==2){
					$current_marking=$A2_2;
				}
				else if ($b_id==3){
					$current_marking=$B1_2;
				}
				else if ($b_id==4){
					$current_marking=$B2_2;
				}
				else if ($b_id==5){
					$current_marking=$C1_2;
				}
				else if ($b_id==6){
					$current_marking=$D1_2;
				}
				else if ($b_id==7){
					$current_marking=$D2_2;
				}
			}
			else if ($i==3){
				if ($b_id==1){
					$current_marking=$A1_3;
				}
				else if ($b_id==2){
					$current_marking=$A2_3;
				}
				else if ($b_id==3){
					$current_marking=$B1_3;
				}
				else if ($b_id==4){
					$current_marking=$B2_3;
				}
				else if ($b_id==5){
					$current_marking=$C1_3;
				}
				else if ($b_id==6){
					$current_marking=$D1_3;
				}
				else if ($b_id==7){
					$current_marking=$D2_3;
				}
			}
			else if ($i==4){
				if ($b_id==1){
					$current_marking=$A1_4;
				}
				else if ($b_id==2){
					$current_marking=$A2_4;
				}
				else if ($b_id==3){
					$current_marking=$B1_4;
				}
				else if ($b_id==4){
					$current_marking=$B2_4;
				}
				else if ($b_id==5){
					$current_marking=$C1_4;
				}
				else if ($b_id==6){
					$current_marking=$D1_4;
				}
				else if ($b_id==7){
					$current_marking=$D2_4;
				}
			}
			if (mysqli_num_rows(checkConductMarkings($conn,$student_id,$school_year,$i,$b_id))==1){
				updateTable($conn,$student_id,$school_year,$i,$b_id,$current_marking);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,$b_id,$current_marking);
			}
			$b_id=$b_id+1;
		}
		$i=$i+1;
	}
	
}

function checkConductMarkings($conn,$student_id,$school_year,$current_quarter,$current_behavior){
	$sql="SELECT * FROM student_behavior_t 
		WHERE student_id=$student_id
		AND school_year=$school_year
		AND quarter=".$current_quarter.
		" AND behavior_id=".$current_behavior;
	$query=mysqli_query($conn,$sql);
	return $query;
}

function updateTable($conn,$student_id,$school_year,$current_quarter,$current_behavior,$marking){
	$res=mysqli_query($conn, "UPDATE student_behavior_t SET marking='$marking' WHERE student_id=$student_id AND school_year=$school_year AND quarter=$current_quarter AND behavior_id=$current_behavior");
}

function insertToTable($conn,$student_id,$school_year,$current_quarter,$current_behavior,$marking){
	$res=mysqli_query($conn, "INSERT INTO student_behavior_t(student_id, school_year, quarter, behavior_id, marking) VALUES ($student_id, $school_year, $current_quarter, $current_behavior, '$marking')");
	}
?>
	


<!DOCTYPE html> 
<html>
	<head>  <link rel="stylesheet" href="bootstrap.css"></head>
		<body style="margin:20px;">
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<ul class="navbar-nav">
			  <li class="nav-item">
				<h5 class="text-white">Ta&#0241ong High School</h5>
				
			  </li>
			</ul>
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
				<a class="nav-link text-white" href="2select.php">Home</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link text-white" href="1login.html">Sign out</a>
			  </li>
			</ul>
		</nav>
		<form method="post" action="8summary.php">
			<h1> ATTENDANCE </h1>
			<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
			<table class="table table-bordered table-hover" style="padding-top:2px;">
				<thead>
					<tr class="thead-light">
						<th style="width:300px;"></th>
						<th style="width:100px;">Jun</th>
						<th style="width:100px;">July</th>
						<th style="width:100px;">Aug</th>
						<th style="width:100px;">Sept</th>
						<th style="width:100px;">Oct</th>
						<th style="width:100px;">Nov</th>
						<th style="width:100px;">Dec</th>
						<th style="width:100px;">Jan</th>
						<th style="width:100px;">Feb</th>
						<th style="width:100px;">Mar</th>
						<th style="width:100px;">Apr</th>
						<th style="width:100px;">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr> 
					<?php
					//Days Present
						$sql_attendance="SELECT ss.days_present
							FROM student_t st, student_attendance_t ss,  attendance_t su
							WHERE st.student_id=ss.student_id
							AND st.student_id=ss.student_id
							AND ss.school_year=$school_year 
							AND ss.student_id=$student_id";
						$sql1=$sql_attendance.' AND ss.school_month=1';
						$sql2=$sql_attendance.' AND ss.school_month=2';
						$sql3=$sql_attendance.' AND ss.school_month=3';
						$sql4=$sql_attendance.' AND ss.school_month=4';
						$sql5=$sql_attendance.' AND ss.school_month=5';
						$sql6=$sql_attendance.' AND ss.school_month=6';
						$sql7=$sql_attendance.' AND ss.school_month=7';
						$sql8=$sql_attendance.' AND ss.school_month=8';
						$sql9=$sql_attendance.' AND ss.school_month=9';
						$sql10=$sql_attendance.' AND ss.school_month=10';
						$sql11=$sql_attendance.' AND ss.school_month=11';
						
						
						
						$query_junsc=mysqli_query($conn,$sql1) or die(mysqli_error($conn)); 
						$row_junsc=mysqli_fetch_array($query_junsc);
						$query_julsc=mysqli_query($conn,$sql2) or die(mysqli_error($conn)); 
						$row_julsc=mysqli_fetch_array($query_julsc);
						$query_augsc=mysqli_query($conn,$sql3) or die(mysqli_error($conn)); 
						$row_augsc=mysqli_fetch_array($query_julsc);
						$query_sepsc=mysqli_query($conn,$sql4) or die(mysqli_error($conn)); 
						$row_sepsc=mysqli_fetch_array($query_sepsc);
						$query_octsc=mysqli_query($conn,$sql5) or die(mysqli_error($conn)); 
						$row_octsc=mysqli_fetch_array($query_octsc);
						$query_novsc=mysqli_query($conn,$sql6) or die(mysqli_error($conn)); 
						$row_novsc=mysqli_fetch_array($query_novsc);
						$query_decsc=mysqli_query($conn,$sql7) or die(mysqli_error($conn)); 
						$row_decsc=mysqli_fetch_array($query_decsc);
						$query_jansc=mysqli_query($conn,$sql8) or die(mysqli_error($conn)); 
						$row_jansc=mysqli_fetch_array($query_jansc);
						$query_febsc=mysqli_query($conn,$sql9) or die(mysqli_error($conn)); 
						$row_febsc=mysqli_fetch_array($query_febsc);
						$query_marsc=mysqli_query($conn,$sql10) or die(mysqli_error($conn)); 
						$row_marsc=mysqli_fetch_array($query_marsc);
						$query_aprsc=mysqli_query($conn,$sql11) or die(mysqli_error($conn)); 
						$row_aprsc=mysqli_fetch_array($query_aprsc);
						
						//Total Days
						$sqltot_attendance="SELECT su.total_school_days
							FROM student_t st, student_attendance_t ss,  attendance_t su
							WHERE su.school_year=$school_year ";
						$sqltot1=$sqltot_attendance.' AND su.school_month=1';
						$sqltot2=$sqltot_attendance.' AND su.school_month=2';
						$sqltot3=$sqltot_attendance.' AND su.school_month=3';
						$sqltot4=$sqltot_attendance.' AND su.school_month=4';
						$sqltot5=$sqltot_attendance.' AND su.school_month=5';
						$sqltot6=$sqltot_attendance.' AND su.school_month=6';
						$sqltot7=$sqltot_attendance.' AND su.school_month=7';
						$sqltot8=$sqltot_attendance.' AND su.school_month=8';
						$sqltot9=$sqltot_attendance.' AND su.school_month=9';
						$sqltot10=$sqltot_attendance.' AND su.school_month=10';
						$sqltot11=$sqltot_attendance.' AND su.school_month=11';
						
						
						
						$query_juntotsc=mysqli_query($conn,$sqltot1) or die(mysqli_error($conn)); 
						$row_juntotsc=mysqli_fetch_array($query_juntotsc);
						$query_jultotsc=mysqli_query($conn,$sqltot2) or die(mysqli_error($conn)); 
						$row_jultotsc=mysqli_fetch_array($query_jultotsc);
						$query_augtotsc=mysqli_query($conn,$sqltot3) or die(mysqli_error($conn)); 
						$row_augtotsc=mysqli_fetch_array($query_jultotsc);
						$query_septotsc=mysqli_query($conn,$sqltot4) or die(mysqli_error($conn)); 
						$row_septotsc=mysqli_fetch_array($query_septotsc);
						$query_octtotsc=mysqli_query($conn,$sqltot5) or die(mysqli_error($conn)); 
						$row_octtotsc=mysqli_fetch_array($query_octtotsc);
						$query_novtotsc=mysqli_query($conn,$sqltot6) or die(mysqli_error($conn)); 
						$row_novtotsc=mysqli_fetch_array($query_novtotsc);
						$query_dectotsc=mysqli_query($conn,$sqltot7) or die(mysqli_error($conn)); 
						$row_dectotsc=mysqli_fetch_array($query_dectotsc);
						$query_jantotsc=mysqli_query($conn,$sqltot8) or die(mysqli_error($conn)); 
						$row_jantotsc=mysqli_fetch_array($query_jantotsc);
						$query_febtotsc=mysqli_query($conn,$sqltot9) or die(mysqli_error($conn)); 
						$row_febtotsc=mysqli_fetch_array($query_febtotsc);
						$query_martotsc=mysqli_query($conn,$sqltot10) or die(mysqli_error($conn)); 
						$row_martotsc=mysqli_fetch_array($query_martotsc);
						$query_aprtotsc=mysqli_query($conn,$sqltot11) or die(mysqli_error($conn)); 
						$row_aprtotsc=mysqli_fetch_array($query_aprtotsc);
						?>
						<td class="table-success"> No. of School Days </td>
						<td><input type="text" name="juntotsc" class="form-control" id="juntotsc" value="<?php echo $row_juntotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="jultotsc" class="form-control" id="jultotsc" value="<?php echo $row_jultotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="augtotsc" class="form-control" id="augtotsc" value="<?php echo $row_augtotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="septotsc" class="form-control" id="septotsc" value="<?php echo $row_septotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="octtotsc" class="form-control" id="octtotsc" value="<?php echo $row_octtotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="novtotsc" class="form-control" id="novtotsc" value="<?php echo $row_novtotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="dectotsc" class="form-control" id="dectotsc" value="<?php echo $row_dectotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="jantotsc" class="form-control" id="jantotsc" value="<?php echo $row_jantotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="febtotsc" class="form-control" id="febtotsc" value="<?php echo $row_febtotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="martotsc" class="form-control" id="martotsc" value="<?php echo $row_martotsc['total_school_days']; ?>"></td>
						<td><input type="text" name="aprtotsc" class="form-control" id="aprtotsc" value="<?php echo $row_aprtotsc['total_school_days']; ?>"></td>
						</label></td><td label for="pwd"><?php echo ($row_juntotsc['total_school_days']+$row_jultotsc['total_school_days']+$row_augtotsc['total_school_days']+$row_septotsc['total_school_days']+$row_octtotsc['total_school_days']+$row_novtotsc['total_school_days']+$row_dectotsc['total_school_days']+$row_jantotsc['total_school_days']+$row_febtotsc['total_school_days']+$row_martotsc['total_school_days']+$row_aprtotsc['total_school_days']); ?></label></td>
						
						
					</tr>
					<tr> 
						<td class="table-success"> No. of Days Present </td>
						<td><input type="text" name="junsc" class="form-control" id="junsc" value="<?php echo $row_junsc['days_present']; ?>"></td>
						<td><input type="text" name="julsc" class="form-control" id="julsc" value="<?php echo $row_julsc['days_present']; ?>"></td>
						<td><input type="text" name="augsc" class="form-control" id="augsc" value="<?php echo $row_augsc['days_present']; ?>"></td>
						<td><input type="text" name="sepsc" class="form-control" id="sepsc" value="<?php echo $row_sepsc['days_present']; ?>"></td>
						<td><input type="text" name="octsc" class="form-control" id="octsc" value="<?php echo $row_octsc['days_present']; ?>"></td>
						<td><input type="text" name="novsc" class="form-control" id="novsc" value="<?php echo $row_novsc['days_present']; ?>"></td>
						<td><input type="text" name="decsc" class="form-control" id="decsc" value="<?php echo $row_decsc['days_present']; ?>"></td>
						<td><input type="text" name="jansc" class="form-control" id="jansc" value="<?php echo $row_jansc['days_present']; ?>"></td>
						<td><input type="text" name="febsc" class="form-control" id="febsc" value="<?php echo $row_febsc['days_present']; ?>"></td>
						<td><input type="text" name="marsc" class="form-control" id="marsc" value="<?php echo $row_marsc['days_present']; ?>"></td>
						<td><input type="text" name="aprsc" class="form-control" id="aprsc" value="<?php echo $row_aprsc['days_present']; ?>"></td>
						<td label for="pwd"><?php echo ($row_junsc['days_present']+$row_julsc['days_present']+$row_augsc['days_present']+$row_sepsc['days_present']+$row_octsc['days_present']+$row_novsc['days_present']+$row_decsc['days_present']+$row_jansc['days_present']+$row_febsc['days_present']+$row_marsc['days_present']+$row_aprsc['days_present']); ?></label></td>
					</tr>
					<tr> 
						<td class="table-success"> No. of Days Absent</td>
						<?php
						$junab=($row_juntotsc['total_school_days'] - $row_junsc['days_present']);
						$julab=($row_jultotsc['total_school_days'] - $row_julsc['days_present']);
						$augab=($row_augtotsc['total_school_days'] - $row_augsc['days_present']);
						$sepab=($row_septotsc['total_school_days'] - $row_sepsc['days_present']);
						$octab=($row_octtotsc['total_school_days'] - $row_octsc['days_present']);
						$novab=($row_novtotsc['total_school_days'] - $row_novsc['days_present']);
						$decab=($row_dectotsc['total_school_days'] - $row_decsc['days_present']);
						$janab=($row_jantotsc['total_school_days'] - $row_jansc['days_present']);
						$febab=($row_febtotsc['total_school_days'] - $row_febsc['days_present']);
						$marab=($row_martotsc['total_school_days'] - $row_marsc['days_present']);
						$aprab=($row_aprtotsc['total_school_days'] - $row_aprsc['days_present']);
						$totab=$junab+$julab+$augab+$sepab+$octab+$novab+$decab+$febab+$janab+$marab+$aprab;
						?>
						<td label for="pwd"><?php echo $junab ?></label></td>
						<td label for="pwd"><?php echo $julab ?></label></td>
						<td label for="pwd"><?php echo $augab ?></label></td>
						<td label for="pwd"><?php echo $sepab ?></label></td>
						<td label for="pwd"><?php echo $octab ?></label></td>
						<td label for="pwd"><?php echo $novab ?></label></td>
						<td label for="pwd"><?php echo $decab ?></label></td>
						<td label for="pwd"><?php echo $janab ?></label></td>
						<td label for="pwd"><?php echo $febab ?></label></td>
						<td label for="pwd"><?php echo $marab ?></label></td>
						<td label for="pwd"><?php echo $aprab ?></label></td>
						<td label for="pwd"><?php echo $totab ?></label></td>
					</tr>
			</table>
			<button type="submit" class="btn btn-secondary" style="position:relative; right:-900px;"> SUBMIT</button>
			</form>
		</body>
	</html>