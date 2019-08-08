<?php
	$student_id=filter_input(INPUT_POST, 'student_id');
	$student_name=filter_input(INPUT_POST, 'name');
	$year_level=filter_input(INPUT_POST, 'lvl');
	$section=filter_input(INPUT_POST, 'section');	
	$school_year=filter_input(INPUT_POST, 'school_year');
	$quarter=filter_input(INPUT_POST, 'quarter');
	
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="gradingsystem";
	//create connection
	$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);
	
	$button=$_POST['4button'];
	if ($button=='form138'){
		header("Location: 9form.php");
	}
	else if ($button=='change'){
		header("Location: 2select.php");
	}
	else if ($button=='editgrades'){
	?>
	<!DOCTYPE html>
	<html>
		<head> <link rel="stylesheet" href="bootstrap.css"> </head>
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
				<form method="post" action="6core.php">
				<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
				<h1> LEARNING PROGRESS AND ACHIEVEMENT
					<button type="submit" class="btn btn-secondary" style="position:relative; right:-50px;">NEXT </button>
				</h1>
				<h2> <?php echo $student_name; ?> <br> <?php echo 'Year '.$year_level.' Section '.$section?></h2>
				<table class="table table-bordered table-hover" style="padding-top:2px;">
					<thead>
						<tr class="thead-light">
							<th style="width:500px;">Learning Areas</th>
							<th colspan="4">Quarter</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
						</tr>
						<tr>
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
							?>
							<td class="table-info">Filipino</td>
							<td><input type="text" name="FIL1" class="form-control" id="FIL1" value="<?php echo $row_FIL1['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL2" class="form-control" id="FIl2" value="<?php echo $row_FIL2['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL3" class="form-control" id="FIL3" value="<?php echo $row_FIL3['quarter_grade']; ?>"></td>
							<td><input type="text" name="FIL4" class="form-control" id="FIL4" value="<?php echo $row_FIL4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-success">English</td>
							<td><input type="text" name="EN1" class="form-control" id="EN1" value="<?php echo $row_EN1['quarter_grade']; ?>"></td>
							<td><input type="text" name="EN2" class="form-control" id="EN2" value="<?php echo $row_EN2['quarter_grade']; ?>"></td>
							<td><input type="text" name="EN3" class="form-control" id="EN3" value="<?php echo $row_EN3['quarter_grade']; ?>"></td>
							<td><input type="text" name="EN4" class="form-control" id="EN4" value="<?php echo $row_EN4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-info">Mathematics</td>
							<td><input type="text" name="MA1" class="form-control" id="MA1" value="<?php echo $row_MA1['quarter_grade']; ?>"></td>
							<td><input type="text" name="MA2" class="form-control" id="MA2" value="<?php echo $row_MA2['quarter_grade']; ?>"></td>
							<td><input type="text" name="MA3" class="form-control" id="MA3" value="<?php echo $row_MA3['quarter_grade']; ?>"></td>
							<td><input type="text" name="MA4" class="form-control" id="MA4" value="<?php echo $row_MA4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-success">Science</td>
							<td><input type="text" name="SCI1" class="form-control" id="SCI1" value="<?php echo $row_SCI1['quarter_grade']; ?>"></td>
							<td><input type="text" name="SCI2" class="form-control" id="SCI2" value="<?php echo $row_SCI2['quarter_grade']; ?>"></td>
							<td><input type="text" name="SCI3" class="form-control" id="SCI3" value="<?php echo $row_SCI3['quarter_grade']; ?>"></td>
							<td><input type="text" name="SCI4" class="form-control" id="SCI4" value="<?php echo $row_SCI4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-info">Araling Panlipunan (AP)</td>
							<td><input type="text" name="AP1" class="form-control" id="AP1" value="<?php echo $row_AP1['quarter_grade']; ?>"></td>
							<td><input type="text" name="AP2" class="form-control" id="AP2" value="<?php echo $row_AP2['quarter_grade']; ?>"></td>
							<td><input type="text" name="AP3" class="form-control" id="AP3" value="<?php echo $row_AP3['quarter_grade']; ?>"></td>
							<td><input type="text" name="AP4" class="form-control" id="AP4" value="<?php echo $row_AP4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-success">Technology and Livelihood Education (TLE)</td>
							<td><input type="text" name="TLE1" class="form-control" id="TLE1" value="<?php echo $row_TLE1['quarter_grade']; ?>"></td>
							<td><input type="text" name="TLE2" class="form-control" id="TLE2" value="<?php echo $row_TLE2['quarter_grade']; ?>"></td>
							<td><input type="text" name="TLE3" class="form-control" id="TLE3" value="<?php echo $row_TLE3['quarter_grade']; ?>"></td>
							<td><input type="text" name="TLE4" class="form-control" id="TLE4" value="<?php echo $row_TLE4['quarter_grade']; ?>"></td>
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
						</tr>
						<tr>
							<td class="table-warning" style="text-indent:50px;">Arts</td>
							<td><input type="text" name="A1" class="form-control" id="A1" value="<?php echo $row_Arts1['quarter_grade']; ?>"></td>
							<td><input type="text" name="A2" class="form-control" id="A2" value="<?php echo $row_Arts2['quarter_grade']; ?>"></td>
							<td><input type="text" name="A3" class="form-control" id="A3" value="<?php echo $row_Arts3['quarter_grade']; ?>"></td>
							<td><input type="text" name="A4" class="form-control" id="A4" value="<?php echo $row_Arts4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-warning" style="text-indent:50px;">Physical Education</td>
							<td><input type="text" name="PE1" class="form-control" id="PE1" value="<?php echo $row_PE1['quarter_grade']; ?>"></td>
							<td><input type="text" name="PE2" class="form-control" id="PE2" value="<?php echo $row_PE2['quarter_grade']; ?>"></td>
							<td><input type="text" name="PE3" class="form-control" id="PE3" value="<?php echo $row_PE3['quarter_grade']; ?>"></td>
							<td><input type="text" name="PE4" class="form-control" id="PE4" value="<?php echo $row_PE4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-warning" style="text-indent:50px;">Health</td>
							<td><input type="text" name="H1" class="form-control" id="H1" value="<?php echo $row_Health1['quarter_grade']; ?>"></td>
							<td><input type="text" name="H2" class="form-control" id="H2" value="<?php echo $row_Health2['quarter_grade']; ?>"></td>
							<td><input type="text" name="H3" class="form-control" id="H3" value="<?php echo $row_Health3['quarter_grade']; ?>"></td>
							<td><input type="text" name="H4" class="form-control" id="H4" value="<?php echo $row_Health4['quarter_grade']; ?>"></td>
						</tr>
						<tr>
							<td class="table-success">Edukasyon sa Pagpapakatao</td>
							<td><input type="text" name="EP1" class="form-control" id="EP1" value="<?php echo $row_EP1['quarter_grade']; ?>"></td>
							<td><input type="text" name="EP2" class="form-control" id="EP2" value="<?php echo $row_EP2['quarter_grade']; ?>"></td>
							<td><input type="text" name="EP3" class="form-control" id="EP3" value="<?php echo $row_EP3['quarter_grade']; ?>"></td>
							<td><input type="text" name="EP4" class="form-control" id="EP4" value="<?php echo $row_EP4['quarter_grade']; ?>"></td>
						</tr>
				</table>
				</form>
			</div>
			</body>
		</html>
	<?php } ?>