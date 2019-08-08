<?php
$student_id=filter_input(INPUT_POST, 'student_id');
$school_year=filter_input(INPUT_POST, 'school_year');
$year_level=filter_input(INPUT_POST, 'year_level');
$section=filter_input(INPUT_POST, 'section');
$student_name=filter_input(INPUT_POST, 'name');	
$juntotsc=filter_input(INPUT_POST, 'juntotsc');
$jultotsc=filter_input(INPUT_POST, 'jultotsc');
$augtotsc=filter_input(INPUT_POST, 'augtotsc');
$septotsc=filter_input(INPUT_POST, 'septotsc');
$octtotsc=filter_input(INPUT_POST, 'octtotsc');
$novtotsc=filter_input(INPUT_POST, 'novtotsc');
$dectotsc=filter_input(INPUT_POST, 'dectotsc');
$jantotsc=filter_input(INPUT_POST, 'jantotsc');
$febtotsc=filter_input(INPUT_POST, 'febtotsc');
$martotsc=filter_input(INPUT_POST, 'martotsc');
$aprtotsc=filter_input(INPUT_POST, 'aprtotsc');
$junsc=filter_input(INPUT_POST, 'junsc');
$julsc=filter_input(INPUT_POST, 'julsc');
$augsc=filter_input(INPUT_POST, 'augsc');
$sepsc=filter_input(INPUT_POST, 'sepsc');
$octsc=filter_input(INPUT_POST, 'octsc');
$novsc=filter_input(INPUT_POST, 'novsc');
$decsc=filter_input(INPUT_POST, 'decsc');
$jansc=filter_input(INPUT_POST, 'jansc');
$febsc=filter_input(INPUT_POST, 'febsc');
$marsc=filter_input(INPUT_POST, 'marsc');
$aprsc=filter_input(INPUT_POST, 'aprsc');



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
	
	//Attendance
	$i=1;
	while ($i<=11){
		if ($i ==1)
		{$month=$juntotsc;
		$present=$junsc;
	}
		else if ($i ==2)
		{$month=$jultotsc;
		$present=$julsc;
	}
	else if ($i ==3)
		{$month=$augtotsc;
		$present=$augsc;
	}
	else if ($i ==4)
		{$month=$septotsc;
		$present=$sepsc;
	}
	else if ($i ==5)
		{$month=$octtotsc;
		$present=$octsc;
	}
	else if ($i ==6)
		{$month=$novtotsc;
		$present=$novsc;
	}
	else if ($i ==7)
		{$month=$dectotsc;
		$present=$decsc;
	}
	else if ($i ==8)
		{$month=$jantotsc;
		$present=$jansc;
	}
	else if ($i ==9)
		{$month=$febtotsc;
		$present=$febsc;}
	else if ($i ==10)
		{$month=$martotsc;
	$present=$marsc;}
	else if ($i ==11)
		{$month=$aprtotsc;
	$present=$aprsc;}
	
		if(mysqli_num_rows(checkExists($conn,$school_year,$i))==1){
			$res=mysqli_query($conn, "UPDATE attendance_t SET total_school_days=$month WHERE school_year=$school_year AND school_month=$i ");
			if (mysqli_num_rows(checkAttendance($conn,$student_id,$school_year,$i))==1){
				$res=mysqli_query($conn, "UPDATE student_attendance_t SET days_present=$present WHERE school_year=$school_year AND school_month=$i and student_id=$student_id");
			}
			else{
				$res=mysqli_query($conn, "INSERT INTO student_attendance_t(student_id,school_year, school_month, days_present) VALUES ($student_id, $school_year, $i, $present)");
			}
			
			$i=$i+1;
		}
		else{
			$res=mysqli_query($conn, "INSERT INTO attendance_t(school_year, school_month, total_school_days) VALUES ($school_year, $i, $juntotsc)");
		}
		
	}
}

function checkExists($conn,$school_year,$schoolmonth){
	$sql="SELECT * FROM attendance_t
		WHERE school_year=$school_year
		AND school_month=".$schoolmonth;
	$query=mysqli_query($conn,$sql);
	return $query;
}

function checkAttendance($conn,$student_id,$school_year,$schoolmonth){
	$sql="SELECT * FROM student_attendance_t 
		WHERE student_id=$student_id
		AND school_year=$school_year
		AND school_month=".$schoolmonth;
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
<head>  <link rel="stylesheet" href="bootstrap.css"> </head>
	<body style="margin:20px;">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
		<ul class="navbar-nav">
		  <li class="nav-item">
			<h5 class="text-white">Ta&#0241ong High School</h5>
		  </li>
		</ul>
		<ul class="navbar-nav ml-auto">
		  <li class="nav-item">
			<a class="nav-link text-white" href="#">Home</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link text-white" href="#">Sign out</a>
		  </li>
		</ul>
	  </nav>
	  <form method="post" action="9form.php">
	  <input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
		<div class="student-info">
			<h1> <center> STUDENT INFORMATION </h1>
				<div class="form-check-inline">
					<label for="Student Name">Student Name:</label>
					<input type="text" class="form-control" id="name" style="width:600px;" value="<?php $sqlname="SELECT student_name FROM student_t 
					WHERE student_id=$student_id;";
					$query_name=mysqli_query($conn,$sqlname);
					$row_name=mysqli_fetch_array($query_name);
					echo $row_name['student_name'];?>">
					<label for="photo" style="position:relative; right:-50px;"> Picture: </label>
					<input type="image" style="position:relative; right:-60px;" value="<?php $sqlname="SELECT picture FROM student_t 
					WHERE student_id=$student_id;";
					$query_name=mysqli_query($conn,$sqlname);
					$row_name=mysqli_fetch_array($query_name);
					echo $row_name['picture'];?>"> 
				</div>
				<div class="form-check-inline" style="padding:7px;">
					<label for="lrn">LRN:</label>
					<input type="text" class="form-control" id="lrn" style="width:300px;" value="<?php $sqlname="SELECT lrn FROM student_t 
					WHERE student_id=$student_id;";
					$query_name=mysqli_query($conn,$sqlname);
					$row_name=mysqli_fetch_array($query_name);
					echo $row_name['lrn'];?>">
					<label for="birthdate">Birthdate:</label>
					<input type="date" class="form-control" style="width:300px;" value="<?php $sqlname="SELECT birthdate FROM student_t 
					WHERE student_id=$student_id;";
					$query_name=mysqli_query($conn,$sqlname);
					$row_name=mysqli_fetch_array($query_name);
					echo $row_name['birthdate'];?>">
				</div>
				<div class="form-check-inline" style="padding:7px;">
					<label for="sex">Sex:</label>
					<input type="text" class="form-control" id="sex" style="width:50px" value="<?php $sqlname="SELECT sex FROM student_t 
					WHERE student_id=$student_id;";
					$query_name=mysqli_query($conn,$sqlname);
					$row_name=mysqli_fetch_array($query_name);
					echo $row_name['sex'];?>">
					<label for="currentlevel">Current Year Level:</label>
					<input type="text" class="form-control" id="lvl" style="width:190px" value="<?php echo $year_level?>">
					<label for="currentsection">Current Section:</label>
					<input type="text" class="form-control" id="section" style="width:190px"value="<?php echo $section?>">
				</div>
				<div class="buttons" style="padding:5px;">
				<center>
				 <!--<button type="button" class="btn btn-secondary">Previous Student</button> -->
				 <button type="submit" class="btn btn-secondary" formaction="2select.php">CHANGE CLASS</button>
				 <!--<button type="submit" class="btn btn-secondary">Next Student</button> -->
				 </center>
			</div>
		</div>
		<div class="grades" style="padding:20px;">
			<table class="table table-bordered table-hover">
				<thead>
					<tr class="thead-light">
						<th rowspan="2" style="width:250px;">Learning Areas</th>
						<th colspan="4" style="width:250px;">Quarter</th>
						<th rowspan="2" style="width:200px;"> Final Grade </th>
						
					</tr>
				</thead>
				<tbody>
				<?php
						$sql_grade="SELECT ss.quarter_grade 
							FROM student_t st, student_subject_t ss, student_academic_level sa, subject_t su
							WHERE st.student_id=ss.student_id
							AND ss.subject_name=su.subject_name
							AND st.student_id=sa.student_id
							AND ss.student_id=sa.student_id
							AND ss.school_year=sa.school_year
							AND ss.quarter=sa.quarter
							AND ss.school_year=$school_year 
							AND sa.year_level=$year_level
							AND sa.section_name='$section'
							AND ss.student_id=$student_id";
						
						$sql1=$sql_grade.' AND ss.quarter=1';
						$sql2=$sql_grade.' AND ss.quarter=2';
						$sql3=$sql_grade.' AND ss.quarter=3';
						$sql4=$sql_grade.' AND ss.quarter=4';
						$sql1_FIL=$sql1.' AND ss.subject_name=\'Filipino\'';
							$sql2_FIL=$sql2.' AND ss.subject_name=\'Filipino\'';
							$sql3_FIL=$sql3.' AND ss.subject_name=\'Filipino\'';
							$sql4_FIL=$sql4.' AND ss.subject_name=\'Filipino\'';
							$query_FIL1=mysqli_query($conn,$sql1_FIL) or die(mysqli_error($conn)); 
							$row_FIL1=mysqli_fetch_array($query_FIL1);
							$query_FIL2=mysqli_query($conn,$sql2_FIL) or die(mysqli_error($conn)); 
							$row_FIL2=mysqli_fetch_array($query_FIL2);
							$query_FIL3=mysqli_query($conn,$sql3_FIL) or die(mysqli_error($conn)); 
							$row_FIL3=mysqli_fetch_array($query_FIL3);
							$query_FIL4=mysqli_query($conn,$sql4_FIL) or die(mysqli_error($conn)); 
							$row_FIL4=mysqli_fetch_array($query_FIL4);
						//English
						$sql1_EN=$sql1.' AND ss.subject_name=\'English\'';
						$sql2_EN=$sql2.' AND ss.subject_name=\'English\'';
						$sql3_EN=$sql3.' AND ss.subject_name=\'English\'';
						$sql4_EN=$sql4.' AND ss.subject_name=\'English\'';
						$query_EN1=mysqli_query($conn,$sql1_EN) or die(mysqli_error($conn)); 
						$row_EN1=mysqli_fetch_array($query_EN1);
						$query_EN2=mysqli_query($conn,$sql2_EN) or die(mysqli_error($conn)); 
						$row_EN2=mysqli_fetch_array($query_EN2);
						$query_EN3=mysqli_query($conn,$sql3_EN) or die(mysqli_error($conn)); 
						$row_EN3=mysqli_fetch_array($query_EN3);
						$query_EN4=mysqli_query($conn,$sql4_EN) or die(mysqli_error($conn)); 
						$row_EN4=mysqli_fetch_array($query_EN4);
						//Mathematics
						$sql1_MA=$sql1.' AND ss.subject_name=\'Mathematics\'';
						$sql2_MA=$sql2.' AND ss.subject_name=\'Mathematics\'';
						$sql3_MA=$sql3.' AND ss.subject_name=\'Mathematics\'';
						$sql4_MA=$sql4.' AND ss.subject_name=\'Mathematics\'';
						$query_MA1=mysqli_query($conn,$sql1_MA) or die(mysqli_error($conn)); 
						$row_MA1=mysqli_fetch_array($query_MA1);
						$query_MA2=mysqli_query($conn,$sql2_MA) or die(mysqli_error($conn)); 
						$row_MA2=mysqli_fetch_array($query_MA2);
						$query_MA3=mysqli_query($conn,$sql3_MA) or die(mysqli_error($conn)); 
						$row_MA3=mysqli_fetch_array($query_MA3);
						$query_MA4=mysqli_query($conn,$sql4_MA) or die(mysqli_error($conn)); 
						$row_MA4=mysqli_fetch_array($query_MA4);
						//Science
						$sql1_SCI=$sql1.' AND ss.subject_name=\'Science\'';
						$sql2_SCI=$sql2.' AND ss.subject_name=\'Science\'';
						$sql3_SCI=$sql3.' AND ss.subject_name=\'Science\'';
						$sql4_SCI=$sql4.' AND ss.subject_name=\'Science\'';
						$query_SCI1=mysqli_query($conn,$sql1_SCI) or die(mysqli_error($conn)); 
						$row_SCI1=mysqli_fetch_array($query_SCI1);
						$query_SCI2=mysqli_query($conn,$sql2_SCI) or die(mysqli_error($conn)); 
						$row_SCI2=mysqli_fetch_array($query_SCI2);
						$query_SCI3=mysqli_query($conn,$sql3_SCI) or die(mysqli_error($conn)); 
						$row_SCI3=mysqli_fetch_array($query_SCI3);
						$query_SCI4=mysqli_query($conn,$sql4_SCI) or die(mysqli_error($conn)); 
						$row_SCI4=mysqli_fetch_array($query_SCI4);
						//AP
						$sql1_AP=$sql1.' AND ss.subject_name=\'AP\'';
						$sql2_AP=$sql2.' AND ss.subject_name=\'AP\'';
						$sql3_AP=$sql3.' AND ss.subject_name=\'AP\'';
						$sql4_AP=$sql4.' AND ss.subject_name=\'AP\'';
						$query_AP1=mysqli_query($conn,$sql1_AP) or die(mysqli_error($conn)); 
						$row_AP1=mysqli_fetch_array($query_AP1);
						$query_AP2=mysqli_query($conn,$sql2_AP) or die(mysqli_error($conn)); 
						$row_AP2=mysqli_fetch_array($query_AP2);
						$query_AP3=mysqli_query($conn,$sql3_AP) or die(mysqli_error($conn)); 
						$row_AP3=mysqli_fetch_array($query_AP3);
						$query_AP4=mysqli_query($conn,$sql4_AP) or die(mysqli_error($conn)); 
						$row_AP4=mysqli_fetch_array($query_AP4);
						//TLE
						$sql1_TLE=$sql1.' AND ss.subject_name=\'TLE\'';
						$sql2_TLE=$sql2.' AND ss.subject_name=\'TLE\'';
						$sql3_TLE=$sql3.' AND ss.subject_name=\'TLE\'';
						$sql4_TLE=$sql4.' AND ss.subject_name=\'TLE\'';
						$query_TLE1=mysqli_query($conn,$sql1_TLE) or die(mysqli_error($conn)); 
						$row_TLE1=mysqli_fetch_array($query_TLE1);
						$query_TLE2=mysqli_query($conn,$sql2_TLE) or die(mysqli_error($conn)); 
						$row_TLE2=mysqli_fetch_array($query_TLE2);
						$query_TLE3=mysqli_query($conn,$sql3_TLE) or die(mysqli_error($conn)); 
						$row_TLE3=mysqli_fetch_array($query_TLE3);
						$query_TLE4=mysqli_query($conn,$sql4_TLE) or die(mysqli_error($conn)); 
						$row_TLE4=mysqli_fetch_array($query_TLE4);
						//Music
						$sql1_Music=$sql1.' AND ss.subject_name=\'Music\'';
						$sql2_Music=$sql2.' AND ss.subject_name=\'Music\'';
						$sql3_Music=$sql3.' AND ss.subject_name=\'Music\'';
						$sql4_Music=$sql4.' AND ss.subject_name=\'Music\'';
						$query_Music1=mysqli_query($conn,$sql1_Music) or die(mysqli_error($conn)); 
						$row_Music1=mysqli_fetch_array($query_Music1);
						$query_Music2=mysqli_query($conn,$sql2_Music) or die(mysqli_error($conn)); 
						$row_Music2=mysqli_fetch_array($query_Music2);
						$query_Music3=mysqli_query($conn,$sql3_Music) or die(mysqli_error($conn)); 
						$row_Music3=mysqli_fetch_array($query_Music3);
						$query_Music4=mysqli_query($conn,$sql4_Music) or die(mysqli_error($conn)); 
						$row_Music4=mysqli_fetch_array($query_Music4);
						//Arts
						$sql1_Arts=$sql1.' AND ss.subject_name=\'Art\'';
						$sql2_Arts=$sql2.' AND ss.subject_name=\'Art\'';
						$sql3_Arts=$sql3.' AND ss.subject_name=\'Art\'';
						$sql4_Arts=$sql4.' AND ss.subject_name=\'Art\'';
						$query_Arts1=mysqli_query($conn,$sql1_Arts) or die(mysqli_error($conn)); 
						$row_Arts1=mysqli_fetch_array($query_Arts1);
						$query_Arts2=mysqli_query($conn,$sql2_Arts) or die(mysqli_error($conn)); 
						$row_Arts2=mysqli_fetch_array($query_Arts2);
						$query_Arts3=mysqli_query($conn,$sql3_Arts) or die(mysqli_error($conn)); 
						$row_Arts3=mysqli_fetch_array($query_Arts3);
						$query_Arts4=mysqli_query($conn,$sql4_Arts) or die(mysqli_error($conn)); 
						$row_Arts4=mysqli_fetch_array($query_Arts4);
						//PE
						$sql1_PE=$sql1.' AND ss.subject_name=\'PE\'';
						$sql2_PE=$sql2.' AND ss.subject_name=\'PE\'';
						$sql3_PE=$sql3.' AND ss.subject_name=\'PE\'';
						$sql4_PE=$sql4.' AND ss.subject_name=\'PE\'';
						$query_PE1=mysqli_query($conn,$sql1_PE) or die(mysqli_error($conn)); 
						$row_PE1=mysqli_fetch_array($query_PE1);
						$query_PE2=mysqli_query($conn,$sql2_PE) or die(mysqli_error($conn)); 
						$row_PE2=mysqli_fetch_array($query_PE2);
						$query_PE3=mysqli_query($conn,$sql3_PE) or die(mysqli_error($conn)); 
						$row_PE3=mysqli_fetch_array($query_PE3);
						$query_PE4=mysqli_query($conn,$sql4_PE) or die(mysqli_error($conn)); 
						$row_PE4=mysqli_fetch_array($query_PE4);
						//Health
						$sql1_Health=$sql1.' AND ss.subject_name=\'Health\'';
						$sql2_Health=$sql2.' AND ss.subject_name=\'Health\'';
						$sql3_Health=$sql3.' AND ss.subject_name=\'Health\'';
						$sql4_Health=$sql4.' AND ss.subject_name=\'Health\'';
						$query_Health1=mysqli_query($conn,$sql1_Health) or die(mysqli_error($conn)); 
						$row_Health1=mysqli_fetch_array($query_Health1);
						$query_Health2=mysqli_query($conn,$sql2_Health) or die(mysqli_error($conn)); 
						$row_Health2=mysqli_fetch_array($query_Health2);
						$query_Health3=mysqli_query($conn,$sql3_Health) or die(mysqli_error($conn)); 
						$row_Health3=mysqli_fetch_array($query_Health3);
						$query_Health4=mysqli_query($conn,$sql4_Health) or die(mysqli_error($conn)); 
						$row_Health4=mysqli_fetch_array($query_Health4);
						//EP
						$sql1_EP=$sql1.' AND ss.subject_name=\'EP\'';
						$sql2_EP=$sql2.' AND ss.subject_name=\'EP\'';
						$sql3_EP=$sql3.' AND ss.subject_name=\'EP\'';
						$sql4_EP=$sql4.' AND ss.subject_name=\'EP\'';
						$query_EP1=mysqli_query($conn,$sql1_EP) or die(mysqli_error($conn)); 
						$row_EP1=mysqli_fetch_array($query_EP1);
						$query_EP2=mysqli_query($conn,$sql2_EP) or die(mysqli_error($conn)); 
						$row_EP2=mysqli_fetch_array($query_EP2);
						$query_EP3=mysqli_query($conn,$sql3_EP) or die(mysqli_error($conn)); 
						$row_EP3=mysqli_fetch_array($query_EP3);
						$query_EP4=mysqli_query($conn,$sql4_EP) or die(mysqli_error($conn)); 
						$row_EP4=mysqli_fetch_array($query_EP4);
						$finalma=($row_MA1['quarter_grade']+$row_MA2['quarter_grade']+$row_MA3['quarter_grade']+$row_MA4['quarter_grade'])/4;
						$finalfil=(($row_FIL1['quarter_grade']+$row_FIL2['quarter_grade']+$row_FIL3['quarter_grade']+$row_FIL4['quarter_grade'])/4);
						$finalen = (($row_EN1['quarter_grade']+$row_EN2['quarter_grade']+$row_EN3['quarter_grade']+$row_EN4['quarter_grade'])/4);
						$finalsci = (($row_SCI1['quarter_grade']+$row_SCI2['quarter_grade']+$row_SCI3['quarter_grade']+$row_SCI4['quarter_grade'])/4);
						$finalap = (($row_AP1['quarter_grade']+$row_AP2['quarter_grade']+$row_AP3['quarter_grade']+$row_AP4['quarter_grade'])/4);
						$finaltle=(($row_TLE1['quarter_grade']+$row_TLE2['quarter_grade']+$row_TLE3['quarter_grade']+$row_TLE4['quarter_grade'])/4);
						$finalMusic=(($row_Music1['quarter_grade']+$row_Music2['quarter_grade']+$row_Music3['quarter_grade']+$row_Music4['quarter_grade'])/4);
						$finalPE=(($row_PE1['quarter_grade']+$row_PE2['quarter_grade']+$row_PE3['quarter_grade']+$row_PE4['quarter_grade'])/4);
						$finalArts=(($row_Arts1['quarter_grade']+$row_Arts2['quarter_grade']+$row_Arts3['quarter_grade']+$row_Arts4['quarter_grade'])/4);
						$finalHealth=(($row_Health1['quarter_grade']+$row_Health2['quarter_grade']+$row_Health3['quarter_grade']+$row_Health4['quarter_grade'])/4);
						$finalEP=(($row_EP1['quarter_grade']+$row_EP2['quarter_grade']+$row_EP3['quarter_grade']+$row_EP4['quarter_grade'])/4);
						$genave=($finalma+$finalfil+$finalen+$finalsci+$finalap+$finaltle+$finalMusic+$finalPE+$finalArts+$finalHealth+$finalEP)/11;
						$res=mysqli_query($conn, "UPDATE student_subject_t SET final_grade=$genave WHERE student_id=$student_id AND school_year=$school_year");
						
						?>
					<tr>
						<td></td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td></td>
					
					</tr>
					<tr>
					
						<td class="table-success">English</td>
						<td><input type="text" name="EN1" class="form-control" id="EN1" value="<?php echo $row_EN1['quarter_grade']; ?>"></td>
						<td><input type="text" name="EN2" class="form-control" id="EN2" value="<?php echo $row_EN2['quarter_grade']; ?>"></td>
						<td><input type="text" name="EN3" class="form-control" id="EN3" value="<?php echo $row_EN3['quarter_grade']; ?>"></td>
						<td><input type="text" name="EN4" class="form-control" id="EN4" value="<?php echo $row_EN4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_EN1['quarter_grade']+$row_EN2['quarter_grade']+$row_EN3['quarter_grade']+$row_EN4['quarter_grade'])/4); ?></label></td>
						
					</tr>
					
					<td class="table-info">Filipino</td>
							<td><input type="text" name="FIL1" class="form-control" id="FIL1" value="<?php echo $row_FIL1['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL2" class="form-control" id="FIl2" value="<?php echo $row_FIL2['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL3" class="form-control" id="FIL3" value="<?php echo $row_FIL3['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL4" class="form-control" id="FIL4" value="<?php echo $row_FIL4['quarter_grade']; ?>"></td>
							<td label for="pwd"><?php echo $finalfil; ?></label></td>
							</tr>
					<tr>
						<td class="table-info">Mathematics</td>
						<td><input type="text" name="MA1" class="form-control" id="MA1" value="<?php echo $row_MA1['quarter_grade']; ?>"></td>
						<td><input type="text" name="MA2" class="form-control" id="MA2" value="<?php echo $row_MA2['quarter_grade']; ?>"></td>
						<td><input type="text" name="MA3" class="form-control" id="MA3" value="<?php echo $row_MA3['quarter_grade']; ?>"></td>
						<td><input type="text" name="MA4" class="form-control" id="MA4" value="<?php echo $row_MA4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_MA1['quarter_grade']+$row_MA2['quarter_grade']+$row_MA3['quarter_grade']+$row_MA4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-success">Science</td>
						<td><input type="text" name="SCI1" class="form-control" id="SCI1" value="<?php echo $row_SCI1['quarter_grade']; ?>"></td>
						<td><input type="text" name="SCI2" class="form-control" id="SCI2" value="<?php echo $row_SCI2['quarter_grade']; ?>"></td>
						<td><input type="text" name="SCI3" class="form-control" id="SCI3" value="<?php echo $row_SCI3['quarter_grade']; ?>"></td>
						<td><input type="text" name="SCI4" class="form-control" id="SCI4" value="<?php echo $row_SCI4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_SCI1['quarter_grade']+$row_SCI2['quarter_grade']+$row_SCI3['quarter_grade']+$row_SCI4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-info">Araling Panlipunan (AP)</td>
						<td><input type="text" name="AP1" class="form-control" id="AP1" value="<?php echo $row_AP1['quarter_grade']; ?>"></td>
						<td><input type="text" name="AP2" class="form-control" id="AP2" value="<?php echo $row_AP2['quarter_grade']; ?>"></td>
						<td><input type="text" name="AP3" class="form-control" id="AP3" value="<?php echo $row_AP3['quarter_grade']; ?>"></td>
						<td><input type="text" name="AP4" class="form-control" id="AP4" value="<?php echo $row_AP4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_AP1['quarter_grade']+$row_AP2['quarter_grade']+$row_AP3['quarter_grade']+$row_AP4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-success">Technology and Livelihood Education (TLE)</td>
						<td><input type="text" name="TLE1" class="form-control" id="TLE1" value="<?php echo $row_TLE1['quarter_grade']; ?>"></td>
						<td><input type="text" name="TLE2" class="form-control" id="TLE2" value="<?php echo $row_TLE2['quarter_grade']; ?>"></td>
						<td><input type="text" name="TLE3" class="form-control" id="TLE3" value="<?php echo $row_TLE3['quarter_grade']; ?>"></td>
						<td><input type="text" name="TLE4" class="form-control" id="TLE4" value="<?php echo $row_TLE4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_TLE1['quarter_grade']+$row_TLE2['quarter_grade']+$row_TLE3['quarter_grade']+$row_TLE4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-info">MAPEH</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td class="table-warning" style="text-indent:50px;">Music</td>
						<td><input type="text" name="MU1" class="form-control" id="MU1" value="<?php echo $row_Music1['quarter_grade']; ?>"></td>
						<td><input type="text" name="MU2" class="form-control" id="MU2" value="<?php echo $row_Music2['quarter_grade']; ?>"></td>
						<td><input type="text" name="MU3" class="form-control" id="MU3" value="<?php echo $row_Music3['quarter_grade']; ?>"></td>
						<td><input type="text" name="MU4" class="form-control" id="MU4" value="<?php echo $row_Music4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_Music1['quarter_grade']+$row_Music2['quarter_grade']+$row_Music3['quarter_grade']+$row_Music4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-warning" style="text-indent:50px;">Arts</td>
						<td><input type="text" name="A1" class="form-control" id="A1" value="<?php echo $row_Arts1['quarter_grade']; ?>"></td>
						<td><input type="text" name="A2" class="form-control" id="A2" value="<?php echo $row_Arts2['quarter_grade']; ?>"></td>
						<td><input type="text" name="A3" class="form-control" id="A3" value="<?php echo $row_Arts3['quarter_grade']; ?>"></td>
						<td><input type="text" name="A4" class="form-control" id="A4" value="<?php echo $row_Arts4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_Arts1['quarter_grade']+$row_Arts2['quarter_grade']+$row_Arts3['quarter_grade']+$row_Arts4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-warning" style="text-indent:50px;">Physical Education</td>
						<td><input type="text" name="PE1" class="form-control" id="PE1" value="<?php echo $row_PE1['quarter_grade']; ?>"></td>
						<td><input type="text" name="PE2" class="form-control" id="PE2" value="<?php echo $row_PE2['quarter_grade']; ?>"></td>
						<td><input type="text" name="PE3" class="form-control" id="PE3" value="<?php echo $row_PE3['quarter_grade']; ?>"></td>
						<td><input type="text" name="PE4" class="form-control" id="PE4" value="<?php echo $row_PE4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_PE1['quarter_grade']+$row_PE2['quarter_grade']+$row_PE3['quarter_grade']+$row_PE4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-warning" style="text-indent:50px;">Health</td>
						<td><input type="text" name="H1" class="form-control" id="H1" value="<?php echo $row_Health1['quarter_grade']; ?>"></td>
						<td><input type="text" name="H2" class="form-control" id="H2" value="<?php echo $row_Health2['quarter_grade']; ?>"></td>
						<td><input type="text" name="H3" class="form-control" id="H3" value="<?php echo $row_Health3['quarter_grade']; ?>"></td>
						<td><input type="text" name="H4" class="form-control" id="H4" value="<?php echo $row_Health4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_Health1['quarter_grade']+$row_Health2['quarter_grade']+$row_Health3['quarter_grade']+$row_Health4['quarter_grade'])/4); ?></label></td>
					</tr>
					<tr>
						<td class="table-success">Edukasyon sa Pagpapakatao</td>
						<td><input type="text" name="EP1" class="form-control" id="EP1" value="<?php echo $row_EP1['quarter_grade']; ?>"></td>
						<td><input type="text" name="EP2" class="form-control" id="EP2" value="<?php echo $row_EP2['quarter_grade']; ?>"></td>
						<td><input type="text" name="EP3" class="form-control" id="EP3" value="<?php echo $row_EP3['quarter_grade']; ?>"></td>
						<td><input type="text" name="EP4" class="form-control" id="EP4" value="<?php echo $row_EP4['quarter_grade']; ?>"></td>
						<td label for="pwd"><?php echo (($row_EP1['quarter_grade']+$row_EP2['quarter_grade']+$row_EP3['quarter_grade']+$row_EP4['quarter_grade'])/4); ?></label></td>
					</tr>
			</table>
		</div>
		<div class="core" style="padding:20px;">
			<table class="table table-bordered table-hover" style="padding-top:2px;">
				<thead>
					<tr class="thead-light">
						<th rowspan="2" style="width:300px;">Core Values</th>
						<!-- <th rowspan="2" style="width:300px;"> Behavior Statements -->
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
		</div>
		<div class="attendance" style="padding:20px;">
			<table class="table table-bordered table-hover" style="padding-top:2px;">
				<thead>
				<
					//Days Present
						
						
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
			<button type="submit" class="btn btn-secondary" style="position:relative; right:-850px;"> FINISH</button>
		</form>
	</body>
</html>