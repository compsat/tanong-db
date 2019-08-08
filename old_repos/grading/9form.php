<?php
$student_id=filter_input(INPUT_POST, 'student_id');
$school_year=filter_input(INPUT_POST, 'school_year');
$year_level=filter_input(INPUT_POST, 'year_level');
$section=filter_input(INPUT_POST, 'section');

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="gradingsystem";

//create connection
$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form 138</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
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
			<li class="nav-item">
				<button type="button" class="btn btn-light text-center"><a titlt="print screen" alt="print screen" onclick="window.print();" target="_blank" style="cursor:pointer;">Print Form 138</a></button>
			</li>
		</ul>
	</nav>

	  <div class="container-fluid bg-white mt-2"> <!--first page-->

	  	<div class="d-flex text-center">
	  		<div class="flex-fill">
	  			<img src="sdo.png" class="float-right" style="width:100px;">
	  		</div>
	  		<div class="flex-fill">
	  			<p>Republic of the Philippines<br/>
	  				<strong>DEPARTMENT OF EDUCATION</strong><br/>
	  				National Capital Region<br/>
	  				Marikina City<br/>
	  				District 1
					<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
	  			</p>
	  		</div>
	  		<div class="flex-fill">
	  			<img src="tanong.png" class="float-left" style="width:100px;">
	  		</div>
	  	</div>
	  	<h4 class="text-center">TA&#0209ONG HIGH SCHOOL</h4>
	  	<h3 class="text-center">LEARNER'S PROGRESS REPORT CARD</h3>

	  	<div class="d-flex mt-4 ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="name">Name:</label>
	  			<div class="form-group ml-5 w-75">
	  				<input type="text" class="form-control-plaintext" id="name" placeholder="blank" value = "<?php $sqlname="SELECT student_name FROM student_t 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['student_name'];?>">
	  			</div>
	  		</div>
	  	</div>
	 
	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="age">Age:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="age" placeholder="blank" value = "<?php $sqlname="SELECT birthdate FROM student_t 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['birthdate'];?>">
	  			</div>
	  		</div>
	  		<div class="flex-fill form-inline ml-5">
	  			<label for="sex">Sex:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="sex" placeholder="blank" value = "<?php $sqlname="SELECT sex FROM student_t 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['sex'];?>">
	  			</div>
	  		</div>
	  	</div>

	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="grade">Grade:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="grade" placeholder="blank"  value = "<?php $sqlname="SELECT year_level FROM student_academic_level 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['year_level'];?>">
	  			</div>
	  		</div>
	  		<div class="flex-fill form-inline ml-5">
	  			<label for="section" class="ml-2">Section:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="section" placeholder="blank" value = "<?php $sqlname="SELECT section_name FROM student_academic_level 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['section_name'];?>">
	  			</div>
	  		</div>
	  	</div>

	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="schoolyear">School Year:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="schoolyear" placeholder="blank" value = "<?php $sqlname="SELECT school_year FROM student_academic_level 
		WHERE student_id=$student_id;";
	$query_name=mysqli_query($conn,$sqlname);
$row_name=mysqli_fetch_array($query_name);
echo $row_name['school_year'];?>"> 
	  			</div>
	  		</div>
	  		<div class="flex-fill form-inline">
	  			<label for="lrn">LRN:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="lrn">
	  			</div>
	  		</div>
	  	</div>

	  	<div class="ml-5 mt-1">
	  		<p>Dear Parent:</p>
	  		<p class="ml-5">This report card shows the ability and progress your child has made in the different learning areas as well as his/her core values.</p>
	  		<p class="ml-5">The school welcomes you should you desire to know more about your child's progress.</p>
	  	</div>
	  	<div class="d-flex">
	  		<div class="flex-fill text-center"><u><strong>__NERISSA S. ESTRELLA__</strong></u><br/>
	  			<p class="small">Officer-in-Charge<br/>
	  			Office of the Principal</p>
	  		</div>
	  		<div class="flex-fill text-center">__________________________________________<br/>
	  			<p class="small">Teacher</p>
	  		</div>
	  	</div>

	  	<h5 class="text-center mt-1">Certificate of Transfer</h5>
	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="admitted">Admitted to Grade:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="admitted" >
	  			</div>
	  		</div>
	  		<div class="flex-fill form-inline">
	  			<label for="admittedsection">Section:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="admittedsection" >
	  			</div>
	  		</div>
	  	</div>
	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="isEligible">Eligible for Admission to Grade:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="isEligible" >
	  			</div>
	  		</div>
	  	</div>
	  	<div class="d-flex mt-1 ml-5 mr-1">
	  		<div class="flex-fill">Approved:</div>
	  	</div>
	  	<div class="d-flex mt-">
	  		<div class="flex-fill text-center"><u><strong>__NERISSA S. ESTRELLA__</strong></u><br/>
	  			<p class="small">Officer-in-Charge<br/>
	  			Office of the Principal</p>
	  		</div>
	  		<div class="flex-fill text-center">__________________________________________<br/>
	  			<p class="small">Teacher</p>
	  		</div>
	  	</div>

	  	<h5 class="text-center mt-1">Cancellation of Eligibility to Transfer</h5>
	  	<div class="d-flex ml-5 mr-1">
	  		<div class="flex-fill form-inline">
	  			<label for="cancelAdmitted">Admitted in:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="cancelAdmitted" >
	  			</div>
	  		</div>
	  		<div class="flex-fill form-inline">
	  			<label for="date">Date:</label>
	  			<div class="form-group ml-5 w-50">
	  				<input type="text" class="form-control-plaintext" id="date" >
	  			</div>
	  		</div>
	  	</div>
	  	<div class="d-flex mt-2">
	  		<div class="flex-fill text-center"><u><strong>__NERISSA S. ESTRELLA__</strong></u><br/>
	  			<p class="small">Officer-in-Charge<br/>
	  			Office of the Principal</p>
	  		</div>
	  	</div>

	  </div> <!--end of first page-->

	  <div class="container-fluid bg-white mb-5"><!--learning progress and achievement-->

	  	<h5 class="text-center">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</h5>

	  	<div class="d-flex justify-content-center">
	  		<div class="flex-inline-block">
	  			<table class="table-bordered table-striped" style="margin:auto; width: 80%;">
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
						//Filipino
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
						$genave=($finalma+$finalfil+$finalen+$finalsci+$finalap+$finaltle+$finalMusic+$finalPE+$finalArts+$finalHealth+$finalEP)/11
						?>
	  				<thead class="text-center">
	  					<tr>
	  						<th rowspan="2">Learning Areas</th>
	  						<th colspan="4">Quarter</th>
	  						<th rowspan="2">Final Grade</th>
	  						<th rowspan="2">Remarks</th>
	  					</tr>
	  					<tr>
	  						<th>1</th>
	  						<th>2</th>
	  						<th>3</th>
	  						<th>4</th>
	  					</tr>
	  				</thead>

	  				<tbody class="text-left">
	  					<tr>
	  						<td>Filipino</td>
	  						<td label for="pwd"><?php echo $row_FIL1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_FIL2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_FIL3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_FIL4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalfil?></label></td>
							<td label for="pwd"><?php if ($finalfil>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>English</td>
							<td label for="pwd"><?php echo $row_EN1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_EN2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_EN3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_EN4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalen ?></label></td>
							<td label for="pwd"><?php if ($finalen>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>Mathematics</td>
	  						<td label for="pwd"><?php echo $row_MA1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_MA2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_MA3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_MA4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalma; ?></label></td>
							<td label for="pwd"><?php if ($finalma>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>Science</td>
	  						<td label for="pwd"><?php echo $row_SCI1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_SCI2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_SCI3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_SCI4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalsci ?></label></td>
							<td label for="pwd"><?php if ($finalsci>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>Aralin Panlipunan (AP)</td>
	  						<td label for="pwd"><?php echo $row_AP1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_AP2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_AP3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_AP4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalap?></label></td>
							<td label for="pwd"><?php if ($finalap>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>Technology and Livelihood Education (TLE)</td>
	  						<td label for="pwd"><?php echo $row_TLE1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finaltle ?></label></td>
							<td label for="pwd"><?php if ($finaltle>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>MAPEH</td>
	  						<td>&nbsp</td>
	  						<td>&nbsp</td>
	  						<td>&nbsp</td>
	  						<td>&nbsp</td>
	  						<td>&nbsp</td>
	  						<td>&nbsp</td>
	  					</tr>
	  					<tr>
	  						<td>&nbsp&nbsp&nbsp&nbsp Music</td>
	  						<td label for="pwd"><?php echo $row_TLE1['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE2['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE3['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $row_TLE4['quarter_grade']; ?></label></td>
							<td label for="pwd"><?php echo $finalMusic ?></label></td>
							<td label for="pwd"><?php if ($finalMusic>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>&nbsp&nbsp&nbsp&nbsp Art</td>
	  						<td label for="pwd"><?php echo $row_Arts1['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Arts2['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Arts3['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Arts4['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $finalArts ?></label></td>
							<td label for="pwd"><?php if ($finalArts>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>&nbsp&nbsp&nbsp&nbsp Physical Education</td>
	  						<td label for="pwd"><?php echo $row_PE1['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_PE2['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_PE3['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_PE4['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $finalPE ?></label></td>
							<td label for="pwd"><?php if ($finalPE>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>&nbsp&nbsp&nbsp&nbsp Health</td>
	  						<td label for="pwd"><?php echo $row_Health1['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Health2['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Health3['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_Health4['quarter_grade']; ?></td>
	  						<td label for="pwd"><?php echo $finalHealth ?></label></td>
							<td label for="pwd"><?php if ($finalHealth>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>&nbsp&nbsp&nbsp&nbsp Edukasyon sa Pagpapakatao</td>
	  						<td label for="pwd"><?php echo $row_EP1['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_EP2['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_EP3['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $row_EP4['quarter_grade']; ?></td>
							<td label for="pwd"><?php echo $finalEP ?></label></td>
							<td label for="pwd"><?php if ($finalEP>=75){ echo "PASSED";} else {echo "FAILED";} ?></label></td>
	  					</tr>
	  					<tr>
	  						<td></td>
	  						<td class="font-weight-bold" colspan="4">General Average</td>
	  						<td label for="pwd"><?php echo $genave ?></label></td>
	  				</tbody> 				
	  			</table>
	  		</div>

	  		<div class="flex-inline-block mt-5">
	  			<table class="table table-borderless" style="height:200px; width:500px;">

	  				<thead>
	  					<tr>
	  						<th>Descriptors</th>
	  						<th>Grading Scale</th>
	  						<th>Remarks</th>
	  					</tr>
	  				</thead>

	  				<tbody>
	  					<tr>
	  						<td>Oustanding</td>
	  						<td>90 - 100</td>
	  						<td>Passed</td>
	  					</tr>
	  					<tr>
	  						<td>Very Satisfactory</td>
	  						<td>85 - 89</td>
	  						<td>Passed</td>
	  					</tr>
	  					<tr>
	  						<td>Satisfactory</td>
	  						<td>80 - 84</td>
	  						<td>Passed</td>
	  					</tr>
	  					<tr>
	  						<td>Fairly Satisfactory</td>
	  						<td>75 - 79</td>
	  						<td>Passed</td>
	  					</tr>
	  					<tr>
	  						<td>Did Not Meet Expectation</td>
	  						<td>Below 75</td>
	  						<td>Failed</td>
	  					</tr>
	  				</tbody>
	  			</table>
	  		</div>		
	  	</div>
	  </div> <!--end of learning progress and achievement-->

	  <div class="container-fluid bg-white mt-5"><!--observed values-->
	  	<h5 class="text-center">REPORT ON LEARNER'S OBSERVED VALUES</h5>
	  	<div class="d-flex justify-content-center">
	  		<div class="flex-inline-block">
	  			<table class="table-bordered table-striped mt-2" style="margin:auto; width: 80%;">
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
	  				<thead class="center">
	  					<tr>
	  						<th rowspan="2">Core Values</th>
	  						<th rowspan="2">Behavior Statements</th>
	  						<th colspan="4">Quarter</th>
	  					</tr>
	  					<tr>
	  						<th>1</th>
	  						<th>2</th>
	  						<th>3</th>
	  						<th>4</th>
	  					</tr>
	  				</thead>

	  				<tbody>
	  					<tr>
	  						<td rowspan="2" class="text-center">1. Maka-Diyos</td>
	  						<td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others.</td>
	  					<td label for="pwd"><?php echo $row1_1A['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_1A['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_1A['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_1A['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td>Shows adherence to ethical principles by upholding truth.</td>
	  					<td label for="pwd"><?php echo $row1_1B['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_1B['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_1B['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_1B['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td rowspan="2" class="text-center">2. Makatao</td>
	  						<td>Is sensitive to individual, social, and cultural differences.</td>
	  					<td label for="pwd"><?php echo $row1_2A['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_2A['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_2A['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_2A['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td>Demonstrates contributions toward solidarity</td>
	  					<td label for="pwd"><?php echo $row1_2B['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_2B['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_2B['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_2B['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td class="text-center">3. Maka-Kalikasan</td>
	  						<td>Cares for the environment and utilizes resources wisely, judiciously, and economically.</td>
	  					<td label for="pwd"><?php echo $row1_3A['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_3A['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_3A['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_3A['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td rowspan="2" class="text-center">4. Maka-Bansa</td>
	  						<td>Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen.</td>
	  					<td label for="pwd"><?php echo $row1_4A['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_4A['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_4A['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_4A['marking']; ?></td>
	  					</tr>
	  					<tr>
	  						<td>Demonstrates appropriate behavior in carrying out activities in the school, community, and country.</td>
	  					<td label for="pwd"><?php echo $row1_4B['marking']; ?></td>
						<td label for="pwd"><?php echo $row2_4B['marking']; ?></td>
						<td label for="pwd"><?php echo $row3_4B['marking']; ?></td>
						<td label for="pwd"><?php echo $row4_4B['marking']; ?></td>
	  				</tbody>
	  			</table>
	  		</div>

	  		<div class="flex-inline-block mt-5">
	  			<table class="table table-borderless" style="height:200px; width:400px;">

	  				<thead>
	  					<tr>
	  						<th>Marking</th>
	  						<th>Non-numerical Rating</th>
	  					</tr>
	  				</thead>

	  				<tbody>
	  					<tr>
	  						<td>AO</td>
	  						<td>Always Observed</td>
	  					</tr>
	  					<tr>
	  						<td>SO</td>
	  						<td>Sometimes Observed</td>
	  					</tr>
	  					<tr>
	  						<td>RO</td>
	  						<td>Rarely Observed</td>
	  					</tr>
	  					<tr>
	  						<td>NO</td>
	  						<td>Never Observed</td>
	  					</tr>
	  				</tbody>

	  			</table>
	  		</div>
	  	</div>
	  </div> <!--end of observed values-->

	  <div class="container-fluid bg-white mt-5"> <!--attendance-->
	  	<h5 class="text-center">REPORT ON ATTENDANCE</h5>
	  	<div class="d-flex justify-content-center">
	  		<div class="flex-inline-block">
	  			<table class="table-bordered table-striped text-center mt-2" style="margin:auto; width: 800px; height:300px;">
	  				<thead>
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
							FROM  student_attendance_t ss,  attendance_t su
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
	  					<tr>
		  					<th>&nbsp</th>
		  					<th>Jun</th>
		  					<th>Jul</th>
		  					<th>Aug</th>
		  					<th>Sept</th>
		  					<th>Oct</th>
		  					<th>Nov</th>
		  					<th>Dec</th>
		  					<th>Jan</th>
		  					<th>Feb</th>
		  					<th>Mar</th>
		  					<th>Apr</th>
		  					<th>TOTAL</th>
		  				</tr>
	  				</thead>

	  				<tbody>
	  					<tr>
	  						<td>No. of School Days</td>
	  						
						<td label for="pwd"><?php echo $row_juntotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_jultotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_augtotsc['total_school_days'];?></label></td>
						<td label for="pwd"><?php echo $row_septotsc['total_school_days'];?></label></td>
						<td label for="pwd"><?php echo $row_octtotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_novtotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_dectotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_jantotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_febtotsc['total_school_days']; ?></label></td>
						<td label for="pwd"><?php echo $row_martotsc['total_school_days'];?></label></td>
						<td label for="pwd"><?php echo $row_aprtotsc['total_school_days'] ;?></label></td>
						</label></td><td label for="pwd"><?php echo ($row_juntotsc['total_school_days']+$row_jultotsc['total_school_days']+$row_augtotsc['total_school_days']+$row_septotsc['total_school_days']+$row_octtotsc['total_school_days']+$row_novtotsc['total_school_days']+$row_dectotsc['total_school_days']+$row_jantotsc['total_school_days']+$row_febtotsc['total_school_days']+$row_martotsc['total_school_days']+$row_aprtotsc['total_school_days']); ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>No. of Days Present</td>
	  						<td label for="pwd"><?php echo $row_junsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_julsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_augsc['days_present'];?></label></td>
						<td label for="pwd"><?php echo $row_sepsc['days_present'];?></label></td>
						<td label for="pwd"><?php echo $row_octsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_novsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_decsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_jansc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_febsc['days_present']; ?></label></td>
						<td label for="pwd"><?php echo $row_marsc['days_present'];?></label></td>
						<td label for="pwd"><?php echo $row_aprsc['days_present'] ;?></label></td>
						</label></td><td label for="pwd"><?php echo ($row_junsc['days_present']+$row_julsc['days_present']+$row_augsc['days_present']+$row_sepsc['days_present']+$row_octsc['days_present']+$row_novsc['days_present']+$row_decsc['days_present']+$row_jansc['days_present']+$row_febsc['days_present']+$row_marsc['days_present']+$row_aprsc['days_present']); ?></label></td>
	  					</tr>
	  					<tr>
	  						<td>No. of Days Absent</td>
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
	  				</tbody>
	  			</table>
	  		</div>
	  	</div> <!--end of attendance-->

	  	<h5 class="text-center mt-5">PARENT/GUARDIAN'S SIGNATURE</h5>
	  	<div class="d-flex text-center mt-5">
	  		<div class="flex-fill">1st Quarter</div>
	  		<div class="flex-fill">______________________________________________________________</div>
	  	</div>
	  	<div class="d-flex text-center mt-5">
	  		<div class="flex-fill">2nd Quarter</div>
	  		<div class="flex-fill">______________________________________________________________</div>
	  	</div>
	  	<div class="d-flex text-center mt-5">
	  		<div class="flex-fill">3rd Quarter</div>
	  		<div class="flex-fill">______________________________________________________________</div>
	  	</div>
	  	<div class="d-flex text-center mt-5">
	  		<div class="flex-fill">4th Quarter</div>
	  		<div class="flex-fill">______________________________________________________________</div>
	  	</div>
	  </div> 
</body>
</html>