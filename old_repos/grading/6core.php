<?php
$student_id=filter_input(INPUT_POST, 'student_id');
$school_year=filter_input(INPUT_POST, 'school_year');
$year_level=filter_input(INPUT_POST, 'year_level');
$section=filter_input(INPUT_POST, 'section');
$student_name=filter_input(INPUT_POST, 'name');
	
	$FIL1=filter_input(INPUT_POST, 'FIL1');
	$FIL2=filter_input(INPUT_POST, 'FIL2');
	$FIL3=filter_input(INPUT_POST, 'FIL3');
	$FIL4=filter_input(INPUT_POST, 'FIL4');
	$EN1=filter_input(INPUT_POST, 'EN1');
	$EN2=filter_input(INPUT_POST, 'EN2');
	$EN3=filter_input(INPUT_POST, 'EN3');
	$EN4=filter_input(INPUT_POST, 'EN4');
	$MA1=filter_input(INPUT_POST, 'MA1');
	$MA2=filter_input(INPUT_POST, 'MA2');
	$MA3=filter_input(INPUT_POST, 'MA3');
	$MA4=filter_input(INPUT_POST, 'MA4');
	$SCI1=filter_input(INPUT_POST, 'SCI1');
	$SCI2=filter_input(INPUT_POST, 'SCI2');
	$SCI3=filter_input(INPUT_POST, 'SCI3');
	$SCI4=filter_input(INPUT_POST, 'SCI4');
	$AP1=filter_input(INPUT_POST, 'AP1');
	$AP2=filter_input(INPUT_POST, 'AP2');
	$AP3=filter_input(INPUT_POST, 'AP3');
	$AP4=filter_input(INPUT_POST, 'AP4');
	$TLE1=filter_input(INPUT_POST, 'TLE1');
	$TLE2=filter_input(INPUT_POST, 'TLE2');
	$TLE3=filter_input(INPUT_POST, 'TLE3');
	$TLE4=filter_input(INPUT_POST, 'TLE4');
	$MU1=filter_input(INPUT_POST, 'MU1');
	$MU2=filter_input(INPUT_POST, 'MU2');
	$MU3=filter_input(INPUT_POST, 'MU3');
	$MU4=filter_input(INPUT_POST, 'MU4');
	$A1=filter_input(INPUT_POST, 'A1');
	$A2=filter_input(INPUT_POST, 'A2');
	$A3=filter_input(INPUT_POST, 'A3');
	$A4=filter_input(INPUT_POST, 'A4');
	$PE1=filter_input(INPUT_POST, 'PE1');
	$PE2=filter_input(INPUT_POST, 'PE2');
	$PE3=filter_input(INPUT_POST, 'PE3');
	$PE4=filter_input(INPUT_POST, 'PE4');
	$H1=filter_input(INPUT_POST, 'H1');
	$H2=filter_input(INPUT_POST, 'H2');
	$H3=filter_input(INPUT_POST, 'H3');
	$H4=filter_input(INPUT_POST, 'H4');
	$EP1=filter_input(INPUT_POST, 'EP1');
	$EP2=filter_input(INPUT_POST, 'EP2');
	$EP3=filter_input(INPUT_POST, 'EP3');
	$EP4=filter_input(INPUT_POST, 'EP4');

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="gradingsystem";

//create connection
$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
}
else{
	$i=1;
	$current_grade=0;
	while ($i<=4){
		if(mysqli_num_rows(checkExists($conn,$student_id,$year_level,$school_year,$section,$i))==1){
			//Filipino
			if ($i==1){
				$current_grade=$FIL1;
			}
			else if ($i==2){
				$current_grade=$FIL2;
			}
			else if ($i==3){
				$current_grade=$FIL3;
			}
			else if ($i==4){
				$current_grade=$FIL4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Filipino'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Filipino',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Filipino',$current_grade);
			}
			//English
			if ($i==1){
				$current_grade=$EN1;
			}
			else if ($i==2){
				$current_grade=$EN2;
			}
			else if ($i==3){
				$current_grade=$EN3;
			}
			else if ($i==4){
				$current_grade=$EN4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'English'))==1){
				updateTable($conn,$student_id,$school_year,$i,'English',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'English',$current_grade);
			}
			//Math 
			if ($i==1){
				$current_grade=$MA1;
			}
			else if ($i==2){
				$current_grade=$MA2;
			}
			else if ($i==3){
				$current_grade=$MA3;
			}
			else if ($i==4){
				$current_grade=$MA4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Mathematics'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Mathematics',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Mathematics',$current_grade);
			}
			//Science
			if ($i==1){
				$current_grade=$SCI1;
			}
			else if ($i==2){
				$current_grade=$SCI2;
			}
			else if ($i==3){
				$current_grade=$SCI3;
			}
			else if ($i==4){
				$current_grade=$SCI4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Science'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Science',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Science',$current_grade);
			}
			//AP
			if ($i==1){
				$current_grade=$AP1;
			}
			else if ($i==2){
				$current_grade=$AP2;
			}
			else if ($i==3){
				$current_grade=$AP3;
			}
			else if ($i==4){
				$current_grade=$AP4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'AP'))==1){
				updateTable($conn,$student_id,$school_year,$i,'AP',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'AP',$current_grade);
			}
			//TLE
			if ($i==1){
				$current_grade=$TLE1;
			}
			else if ($i==2){
				$current_grade=$TLE2;
			}
			else if ($i==3){
				$current_grade=$TLE3;
			}
			else if ($i==4){
				$current_grade=$TLE4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'TLE'))==1){
				updateTable($conn,$student_id,$school_year,$i,'TLE',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'TLE',$current_grade);
			}
			//Music
			if ($i==1){
				$current_grade=$MU1;
			}
			else if ($i==2){
				$current_grade=$MU2;
			}
			else if ($i==3){
				$current_grade=$MU3;
			}
			else if ($i==4){
				$current_grade=$MU4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Music'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Music',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Music',$current_grade);
			}
			//Art
			if ($i==1){
				$current_grade=$A1;
			}
			else if ($i==2){
				$current_grade=$A2;
			}
			else if ($i==3){
				$current_grade=$A3;
			}
			else if ($i==4){
				$current_grade=$A4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Art'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Art',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Art',$current_grade);
			}
			//PE
			if ($i==1){
				$current_grade=$PE1;
			}
			else if ($i==2){
				$current_grade=$PE2;
			}
			else if ($i==3){
				$current_grade=$PE3;
			}
			else if ($i==4){
				$current_grade=$PE4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'PE'))==1){
				updateTable($conn,$student_id,$school_year,$i,'PE',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'PE',$current_grade);
			}
			//Health
			if ($i==1){
				$current_grade=$H1;
			}
			else if ($i==2){
				$current_grade=$H2;
			}
			else if ($i==3){
				$current_grade=$H3;
			}
			else if ($i==4){
				$current_grade=$H4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'Health'))==1){
				updateTable($conn,$student_id,$school_year,$i,'Health',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'Health',$current_grade);
			}
			//EP
			if ($i==1){
				$current_grade=$EP1;
			}
			else if ($i==2){
				$current_grade=$EP2;
			}
			else if ($i==3){
				$current_grade=$EP3;
			}
			else if ($i==4){
				$current_grade=$EP4;
			}
			if (mysqli_num_rows(checkSubjGrades($conn,$student_id,$school_year,$i,'EP'))==1){
				updateTable($conn,$student_id,$school_year,$i,'EP',$current_grade);
			}
			else{
				insertToTable($conn,$student_id,$school_year,$i,'EP',$current_grade);
			}
		}
		else{
			$res1=mysqli_query($conn, "INSERT INTO student_academic_level (student_id, year_level, school_year, section_name, quarter) VALUES ($student_id, $year_level, $school_year, '$section', $i)");
		}
		$i=$i+1;
	}
}

function checkExists($conn,$student_id,$year_level,$school_year,$section,$current_quarter){
	$sql="SELECT * FROM student_academic_level 
		WHERE student_id=$student_id
		AND year_level=$year_level
		AND school_year=$school_year
		AND section_name='$section'
		AND quarter=".$current_quarter;
	$query=mysqli_query($conn,$sql);
	return $query;
}

function checkSubjGrades($conn,$student_id,$school_year,$current_quarter,$current_subject){
	$sql="SELECT * FROM student_subject_t 
		WHERE student_id=$student_id
		AND school_year=$school_year
		AND quarter=".$current_quarter.
		" AND subject_name='".$current_subject."'";
	$query=mysqli_query($conn,$sql);
	return $query;
}

function updateTable($conn,$student_id,$school_year,$current_quarter,$current_subject,$grade){
	$res=mysqli_query($conn, "UPDATE student_subject_t SET quarter_grade=$grade WHERE student_id=$student_id AND school_year=$school_year AND quarter=$current_quarter AND subject_name='$current_subject'");
}

function insertToTable($conn,$student_id,$school_year,$current_quarter,$current_subject,$grade){
	$res=mysqli_query($conn, "INSERT INTO student_subject_t(student_id, school_year, quarter, subject_name, quarter_grade) VALUES ($student_id, $school_year, $current_quarter, '$current_subject', $grade)");
}
?>

<!DOCTYPE html> 
<html>
	<head>  <link rel="stylesheet" href="bootstrap.css"></head>
		<body>
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
			<div style="margin:20px;">
			<form method="post" action="7attendance.php">
			<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
			<h1> LEARNER'S OBSERVED VALUES 
				<button type="submit" class="btn btn-secondary" style="position:relative; right:-350px;">NEXT </button>
			</h2>
			<table class="table table-bordered table-hover" style="padding-top:2px;">
				<thead>
					<tr class="thead-light">
						<th rowspan="2" style="width:300px;">Core Values</th>
						<th rowspan="2" style="width:300px;"> Behavior Statements</th>
						<th colspan="4" style="width:300px;">Quarter</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql_grade="SELECT sb.marking 
						FROM student_t st, student_behavior_t sb, student_academic_level sa, behavior_t b
						WHERE st.student_id=sb.student_id
						AND sb.behavior_id=b.behavior_id
						AND sb.student_id=sa.student_id
						AND sb.school_year=sa.school_year
						AND sb.quarter=sa.quarter
						AND sa.school_year=$school_year 
						AND sb.student_id=$student_id";
					$sql1=$sql_grade.' AND sb.quarter=1';
					$sql2=$sql_grade.' AND sb.quarter=2';
					$sql3=$sql_grade.' AND sb.quarter=3';
					$sql4=$sql_grade.' AND sb.quarter=4';
					
					//1A
					$sql1_1A=$sql1.' AND sb.behavior_id=1';
					$sql2_1A=$sql2.' AND sb.behavior_id=1';
					$sql3_1A=$sql3.' AND sb.behavior_id=1';
					$sql4_1A=$sql4.' AND sb.behavior_id=1';	
					$query1_1A=mysqli_query($conn,$sql1_1A) or die(mysqli_error($conn)); 
					$row1_1A=mysqli_fetch_array($query1_1A);
					$query2_1A=mysqli_query($conn,$sql2_1A) or die(mysqli_error($conn)); 
					$row2_1A=mysqli_fetch_array($query2_1A);
					$query3_1A=mysqli_query($conn,$sql3_1A) or die(mysqli_error($conn)); 
					$row3_1A=mysqli_fetch_array($query3_1A);
					$query4_1A=mysqli_query($conn,$sql4_1A) or die(mysqli_error($conn)); 
					$row4_1A=mysqli_fetch_array($query4_1A);
					//1B
					$sql1_1B=$sql1.' AND sb.behavior_id=2';
					$sql2_1B=$sql2.' AND sb.behavior_id=2';
					$sql3_1B=$sql3.' AND sb.behavior_id=2';
					$sql4_1B=$sql4.' AND sb.behavior_id=2';	
					$query1_1B=mysqli_query($conn,$sql1_1B) or die(mysqli_error($conn)); 
					$row1_1B=mysqli_fetch_array($query1_1B);
					$query2_1B=mysqli_query($conn,$sql2_1B) or die(mysqli_error($conn)); 
					$row2_1B=mysqli_fetch_array($query2_1B);
					$query3_1B=mysqli_query($conn,$sql3_1B) or die(mysqli_error($conn)); 
					$row3_1B=mysqli_fetch_array($query3_1B);
					$query4_1B=mysqli_query($conn,$sql4_1B) or die(mysqli_error($conn)); 
					$row4_1B=mysqli_fetch_array($query4_1B);
					//2A
					$sql1_2A=$sql1.' AND sb.behavior_id=3';
					$sql2_2A=$sql2.' AND sb.behavior_id=3';
					$sql3_2A=$sql3.' AND sb.behavior_id=3';
					$sql4_2A=$sql4.' AND sb.behavior_id=3';	
					$query1_2A=mysqli_query($conn,$sql1_2A) or die(mysqli_error($conn)); 
					$row1_2A=mysqli_fetch_array($query1_2A);
					$query2_2A=mysqli_query($conn,$sql2_2A) or die(mysqli_error($conn)); 
					$row2_2A=mysqli_fetch_array($query2_2A);
					$query3_2A=mysqli_query($conn,$sql3_2A) or die(mysqli_error($conn)); 
					$row3_2A=mysqli_fetch_array($query3_2A);
					$query4_2A=mysqli_query($conn,$sql4_2A) or die(mysqli_error($conn)); 
					$row4_2A=mysqli_fetch_array($query4_2A);	
					//2B
					$sql1_2B=$sql1.' AND sb.behavior_id=4';
					$sql2_2B=$sql2.' AND sb.behavior_id=4';
					$sql3_2B=$sql3.' AND sb.behavior_id=4';
					$sql4_2B=$sql4.' AND sb.behavior_id=4';	
					$query1_2B=mysqli_query($conn,$sql1_2B) or die(mysqli_error($conn)); 
					$row1_2B=mysqli_fetch_array($query1_2B);
					$query2_2B=mysqli_query($conn,$sql2_2B) or die(mysqli_error($conn)); 
					$row2_2B=mysqli_fetch_array($query2_2B);
					$query3_2B=mysqli_query($conn,$sql3_2B) or die(mysqli_error($conn)); 
					$row3_2B=mysqli_fetch_array($query3_2B);
					$query4_2B=mysqli_query($conn,$sql4_2B) or die(mysqli_error($conn)); 
					$row4_2B=mysqli_fetch_array($query4_2B);
					//3A
					$sql1_3A=$sql1.' AND sb.behavior_id=5';
					$sql2_3A=$sql2.' AND sb.behavior_id=5';
					$sql3_3A=$sql3.' AND sb.behavior_id=5';
					$sql4_3A=$sql4.' AND sb.behavior_id=5';	
					$query1_3A=mysqli_query($conn,$sql1_3A) or die(mysqli_error($conn)); 
					$row1_3A=mysqli_fetch_array($query1_3A);
					$query2_3A=mysqli_query($conn,$sql2_3A) or die(mysqli_error($conn)); 
					$row2_3A=mysqli_fetch_array($query2_3A);
					$query3_3A=mysqli_query($conn,$sql3_3A) or die(mysqli_error($conn)); 
					$row3_3A=mysqli_fetch_array($query3_3A);
					$query4_3A=mysqli_query($conn,$sql4_3A) or die(mysqli_error($conn)); 
					$row4_3A=mysqli_fetch_array($query4_3A);
					//4A
					$sql1_4A=$sql1.' AND sb.behavior_id=6';
					$sql2_4A=$sql2.' AND sb.behavior_id=6';
					$sql3_4A=$sql3.' AND sb.behavior_id=6';
					$sql4_4A=$sql4.' AND sb.behavior_id=6';	
					$query1_4A=mysqli_query($conn,$sql1_4A) or die(mysqli_error($conn)); 
					$row1_4A=mysqli_fetch_array($query1_4A);
					$query2_4A=mysqli_query($conn,$sql2_4A) or die(mysqli_error($conn)); 
					$row2_4A=mysqli_fetch_array($query2_4A);
					$query3_4A=mysqli_query($conn,$sql3_4A) or die(mysqli_error($conn)); 
					$row3_4A=mysqli_fetch_array($query3_4A);
					$query4_4A=mysqli_query($conn,$sql4_4A) or die(mysqli_error($conn)); 
					$row4_4A=mysqli_fetch_array($query4_4A);
					//4B
					$sql1_4B=$sql1.' AND sb.behavior_id=7';
					$sql2_4B=$sql2.' AND sb.behavior_id=7';
					$sql3_4B=$sql3.' AND sb.behavior_id=7';
					$sql4_4B=$sql4.' AND sb.behavior_id=7';	
					$query1_4B=mysqli_query($conn,$sql1_4B) or die(mysqli_error($conn)); 
					$row1_4B=mysqli_fetch_array($query1_4B);
					$query2_4B=mysqli_query($conn,$sql2_4B) or die(mysqli_error($conn)); 
					$row2_4B=mysqli_fetch_array($query2_4B);
					$query3_4B=mysqli_query($conn,$sql3_4B) or die(mysqli_error($conn)); 
					$row3_4B=mysqli_fetch_array($query3_4B);
					$query4_4B=mysqli_query($conn,$sql4_4B) or die(mysqli_error($conn)); 
					$row4_4B=mysqli_fetch_array($query4_4B);
				?>
					<tr>
						<td></td>
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
					</tr>
					<tr>
						<td rowspan="2" class="table-danger" style="align:center;"> 1.Maka-Diyos </td>
						<td> Expresses one's spiritual beliefs while respecting the spiritual beliefs of others </td>
						<td><input type="text" name="1A1" class="form-control" id="1A1" style="width:50px;" value="<?php echo $row1_1A['marking']; ?>"></td>
						<td><input type="text" name="1A2" class="form-control" id="1A2" style="width:50px;" value="<?php echo $row2_1A['marking']; ?>"></td>
						<td><input type="text" name="1A3" class="form-control" id="1A3" style="width:50px;" value="<?php echo $row3_1A['marking']; ?>"></td>
						<td><input type="text" name="1A4" class="form-control" id="1A4" style="width:50px;" value="<?php echo $row4_1A['marking']; ?>"></td>
					</tr>
					<tr>
						<td> Shows adherence to ethical principles by upholding the truth</td>
						<td><input type="text" name="1B1" class="form-control" id="1B1" style="width:50px;" value="<?php echo $row1_1B['marking']; ?>"></td>
						<td><input type="text" name="1B2" class="form-control" id="1B2" style="width:50px;" value="<?php echo $row2_1B['marking']; ?>"></td>
						<td><input type="text" name="1B3" class="form-control" id="1B3" style="width:50px;" value="<?php echo $row3_1B['marking']; ?>"></td>
						<td><input type="text" name="1B4" class="form-control" id="1B4" style="width:50px;" value="<?php echo $row4_1B['marking']; ?>"></td>
					</tr>
					<tr>
						<td rowspan="2" class="table-danger"> 2.Makatao </td>
						<td> Is sensitive to individual, social, and cultural differences</td>
						<td><input type="text" name="2A1" class="form-control" id="2A1" style="width:50px;" value="<?php echo $row1_2A['marking']; ?>"></td>
						<td><input type="text" name="2A2" class="form-control" id="2A2" style="width:50px;" value="<?php echo $row2_2A['marking']; ?>"></td>
						<td><input type="text" name="2A3" class="form-control" id="2A3" style="width:50px;" value="<?php echo $row3_2A['marking']; ?>"></td>
						<td><input type="text" name="2A4" class="form-control" id="2A4" style="width:50px;" value="<?php echo $row4_2A['marking']; ?>"></td>
					</tr>
					<tr>
						<td> Demonstrates contributions toward solidarity  </td>
						<td><input type="text" name="2B1" class="form-control" id="2B1" style="width:50px;" value="<?php echo $row1_2B['marking']; ?>"></td>
						<td><input type="text" name="2B2" class="form-control" id="2B2" style="width:50px;" value="<?php echo $row2_2B['marking']; ?>"></td>
						<td><input type="text" name="2B3" class="form-control" id="2B3" style="width:50px;" value="<?php echo $row3_2B['marking']; ?>"></td>
						<td><input type="text" name="2B4" class="form-control" id="2B4" style="width:50px;" value="<?php echo $row4_2B['marking']; ?>"></td>
					</tr>
					<tr>
						<td class="table-danger"> 3.Maka-Kalikasan </td>
						<td>Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
						<td><input type="text" name="3A1" class="form-control" id="3A1" style="width:50px;" value="<?php echo $row1_3A['marking']; ?>"></td>
						<td><input type="text" name="3A2" class="form-control" id="3A2" style="width:50px;" value="<?php echo $row2_3A['marking']; ?>"></td>
						<td><input type="text" name="3A3" class="form-control" id="3A3" style="width:50px;" value="<?php echo $row3_3A['marking']; ?>"></td>
						<td><input type="text" name="3A4" class="form-control" id="3A4" style="width:50px;" value="<?php echo $row4_3A['marking']; ?>"></td>
					</tr>
					<tr>
						<td rowspan="2" class="table-danger"> 4.Maka-Bansa </td>
						<td> Demonstrates pride in being a Filipino; excercises the rights and responsibilities of a Filipino citizen</td>
						<td><input type="text" name="4A1" class="form-control" id="4A1" style="width:50px;" value="<?php echo $row1_4A['marking']; ?>"></td>
						<td><input type="text" name="4A2" class="form-control" id="4A2" style="width:50px;" value="<?php echo $row2_4A['marking']; ?>"></td>
						<td><input type="text" name="4A3" class="form-control" id="4A3" style="width:50px;" value="<?php echo $row3_4A['marking']; ?>"></td>
						<td><input type="text" name="4A4" class="form-control" id="4A4" style="width:50px;" value="<?php echo $row4_4A['marking']; ?>"></td>
					</tr>
					<tr>
						<td> Demonstrates approriate behavior in carrying out activities in the school, community, and country  </td>
						<td><input type="text" name="4B1" class="form-control" id="4B1" style="width:50px;" value="<?php echo $row1_4B['marking']; ?>"></td>
						<td><input type="text" name="4B2" class="form-control" id="4B2" style="width:50px;" value="<?php echo $row2_4B['marking']; ?>"></td>
						<td><input type="text" name="4B3" class="form-control" id="4B3" style="width:50px;" value="<?php echo $row3_4B['marking']; ?>"></td>
						<td><input type="text" name="4B4" class="form-control" id="4B4" style="width:50px;" value="<?php echo $row4_4B['marking']; ?>"></td>
					</tr>
			</table>
		</form>
		</div>
		</body>
	</html>