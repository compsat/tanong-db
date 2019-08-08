<?php
	$school_year=filter_input(INPUT_POST, 'school_year');
	$quarter=filter_input(INPUT_POST, 'quarter');
	$year_level=filter_input(INPUT_POST, 'year_level');
	$section=filter_input(INPUT_POST, 'section');
	$button=$_POST['2button'];
	if ($button=='top_level'){
		header("Location: 10top_students_year.php");
	}
	else if ($button=='top_subject'){
		header("Location: 11top_students_subj.php");
	}
?>

<!DOCTYPE html> 
<head>  <link rel="stylesheet" href="bootstrap.css"> <link rel="stylesheet" href="gradescss.css"></head>
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
		<div class="container">
			<h1> <center> <br> Top 10 Students </center> </h1>
			<h2> <center> 
				<?php 
					if (!empty($section)){
						echo 'Section '.$section; 
					}
					else{
						echo 'No section chosen.';
					}
				?>
			</center> </h2>
			<div class="form-inline">
                <input type="text" class="form-control" placeholder="Search Student" id="Search" onKeyUp="aa();" style="width:300px;">
				<!--<button type="submit" class="btn btn-primary" style="width:80px;">Search</button>-->
				<button type="button" class="btn btn-secondary" style="position: relative; width: 100px; right: -710px; padding: 6px;" onclick="window.print();">Print</button>
			</div>
			<div class="table table-bordered table-hover" style="padding-top:2px; visibility:hidden;" id="d1"></div>
			<script type="text/javascript">
			//reference: https://www.w3schools.com/howto/howto_js_filter_table.asp
			function aa() {
			  // Declare variables 
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("Search");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("names-table");
			  tr = table.getElementsByTagName("tr");

			  // Loop through all table rows, and hide those who don't match the search query
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					tr[i].style.display = "none";
				  }
				} 
			  }
			}
			</script>
			<?php 
				if (!empty($school_year) and !empty($quarter) and !empty($year_level) and !empty($section)){
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
						echo '<table id="names-table" class="table table-bordered table-hover" style="padding-top:2px;">';
						echo '<thead>
						<tr class="table-success">
							<th>Student Name</th>
							<th>Fil</th>
							<th>Eng</th>
							<th>Math</th>
							<th>Sci</th>
							<th>AP</th>
							<th>TLE</th>
							<th colspan="4"> <center> MAPEH<br> Music, Arts, PE, Health </center></th>
							<th>EP</th>
						</tr>
						</thead>';
						$sql_student_name="SELECT s.student_id, student_name 
							FROM student_t s, student_academic_level sa 
							WHERE s.student_id=sa.student_id 
							AND school_year='$school_year' 
							AND quarter='$quarter' 
							AND year_level='$year_level' 
							AND section_name='$section'
							ORDER BY sa.student_id";
						$query=mysqli_query($conn,$sql_student_name); 
						while ($row=mysqli_fetch_array($query)){
							$id=$row['student_id'];
							$sql_grade="SELECT ss.quarter_grade 
							FROM student_t st, student_subject_t ss, student_academic_level sa, subject_t su
							WHERE st.student_id=ss.student_id
							AND ss.subject_name=su.subject_name
							AND st.student_id=sa.student_id
							AND ss.student_id=sa.student_id
							AND ss.school_year=sa.school_year
							AND ss.quarter=sa.quarter
							AND ss.school_year='$school_year' 
							AND ss.quarter='$quarter' 
							AND sa.year_level='$year_level' 
							AND sa.section_name='$section'
							AND ss.student_id='$id'";
							echo '<tr>';
							echo '<td>'; 
							echo '<form method="post" action="4studentinfo.php">';
							echo '<input type="text" name="student_id" id="student_id" value="'.$id.'" visibility: hidden>';
							echo '<input type="text" name="quarter" id="quarter" value="'.$quarter.'" visibility: hidden>';
							echo '<input type="text" name="year_level" id="year_level" value="'.$year_level.'" visibility: hidden>';
							echo '<input type="text" name="section" id="section" value="'.$section.'" visibility: hidden>';
							echo '<input type="text" name="school_year" id="school_year" value="'.$school_year.'" visibility: hidden>';
							echo '<input type="submit" style="background:none; border:none; margin:0; padding:0; cursor: pointer;" value="'.$row['student_name'].'">';
							echo '<p visibility: hidden>'.$row['student_name'].'</p>';
							echo '</form>';
							echo '</td>';
							echo '<td>'; 
							//Filipino
							$sql_fil= $sql_grade.' AND su.subject_name=\'Filipino\'';
							$query_fil=mysqli_query($conn,$sql_fil) or die(mysqli_error($conn)); 
							$row_fil=mysqli_fetch_array($query_fil);
							echo $row_fil['quarter_grade'];
							echo '</td>';
							echo '<td>'; 
							//English
							$sql_en= $sql_grade.' AND su.subject_name=\'English\'';
							$query_en=mysqli_query($conn,$sql_en) or die(mysqli_error($conn)); 
							$row_en=mysqli_fetch_array($query_en);
							echo $row_en['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//Math
							$sql_math= $sql_grade.' AND su.subject_name=\'Mathematics\'';
							$query_math=mysqli_query($conn,$sql_math) or die(mysqli_error($conn)); 
							$row_math=mysqli_fetch_array($query_math);
							echo $row_math['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//Science
							$sql_sci= $sql_grade.' AND su.subject_name=\'Science\'';
							$query_sci=mysqli_query($conn,$sql_sci) or die(mysqli_error($conn)); 
							$row_sci=mysqli_fetch_array($query_sci);
							echo $row_sci['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//AP
							$sql_ap= $sql_grade.' AND su.subject_name=\'AP\'';
							$query_ap=mysqli_query($conn,$sql_ap) or die(mysqli_error($conn)); 
							$row_ap=mysqli_fetch_array($query_ap);
							echo $row_ap['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//TLE
							$sql_tle= $sql_grade.' AND su.subject_name=\'TLE\'';
							$query_tle=mysqli_query($conn,$sql_tle) or die(mysqli_error($conn)); 
							$row_tle=mysqli_fetch_array($query_tle);
							echo $row_tle['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//Music
							$sql_music= $sql_grade.' AND su.subject_name=\'Music\'';
							$query_music=mysqli_query($conn,$sql_music) or die(mysqli_error($conn)); 
							$row_music=mysqli_fetch_array($query_music);
							echo $row_music['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//Arts
							$sql_arts= $sql_grade.' AND su.subject_name=\'Art\'';
							$query_arts=mysqli_query($conn,$sql_arts) or die(mysqli_error($conn)); 
							$row_arts=mysqli_fetch_array($query_arts);
							echo $row_arts['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//PE
							$sql_pe= $sql_grade.' AND su.subject_name=\'PE\'';
							$query_pe=mysqli_query($conn,$sql_pe) or die(mysqli_error($conn)); 
							$row_pe=mysqli_fetch_array($query_pe);
							echo $row_pe['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//Health
							$sql_health= $sql_grade.' AND su.subject_name=\'Health\'';
							$query_health=mysqli_query($conn,$sql_health) or die(mysqli_error($conn)); 
							$row_health=mysqli_fetch_array($query_health);
							echo $row_health['quarter_grade'];
							echo '</td>';
							echo '<td>';
							//EP
							$sql_ep= $sql_grade.' AND su.subject_name=\'EP\'';
							$query_ep=mysqli_query($conn,$sql_ep) or die(mysqli_error($conn)); 
							$row_ep=mysqli_fetch_array($query_ep);
							echo $row_ep['quarter_grade'];
							echo '</td>';
							echo '</tr>';
						}
						echo '</table>';
						$conn->close();
					}
				}
				else{
					echo 'Selections should not be empty';
					die();
				}
			?>
		</div>
	</body>
</html>
					
					