<?php
$student_id=filter_input(INPUT_POST, 'student_id');
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
	header("Location: 7attendance.html");
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