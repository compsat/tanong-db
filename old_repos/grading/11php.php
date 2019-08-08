<?php
	$school_year=filter_input(INPUT_POST, 'school_year');
	$year_level=filter_input(INPUT_POST, 'year_level');
	$subject=filter_input(INPUT_POST, 'subj');
	$quarter=filter_input(INPUT_POST, 'quarter');
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
	<title>Tanong High School</title>
  	<link rel="stylesheet" href="bootstrap.css">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="popper.js"></script>
	<script type="text/javascript" src="min.js"></script>
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
    </ul>
  </nav>
  <form method="post">
  <h3 class="text-center text-dark">Year <?php echo $year_level;?> TOP 5 STUDENTS PER SUBJECT PER QUARTER</h2>
  <div class="dropdown text-center" style="margin:10px;">
        <select name="subj" class="btn btn-success dropdown-toggle">
			<?php
			$sql="SELECT DISTINCT subject_name FROM subject_t ORDER BY subject_name";
			$query2=mysqli_query($conn,$sql);
			while ($row2=mysqli_fetch_array($query2)){
				?>
				<option><?php echo $row2["subject_name"];?></option>
				<?php
			}
			?>
		</select>
  </div>
  <div class="container" style="margin-top:50px;">
    <table class="table table-bordered table-striped">
      <thead class="text-center">
        <tr class="table-info">
          <th>Name</th>
          <th>General Average</th>
        </tr>
      </thead>
      <?php $sql_student_name="SELECT DISTINCT sa.student_id, ss.quarter_grade 
							FROM student_academic_level sa, student_subject_t ss
							WHERE sa.student_id=ss.student_id
							AND sa.school_year=ss.school_year
							AND sa.quarter=ss.quarter
							AND ss.school_year=$school_year
							AND sa.year_level=$year_level
							AND sa.quarter=$quarter
							AND ss.subject_name='$subject'
							ORDER BY quarter_grade DESC";
						$query=mysqli_query($conn,$sql_student_name); 
						$i=0;
						$max=5;
						while ($row=mysqli_fetch_array($query) AND $i<$max){
							$id=$row['student_id'];
							$sqlname="SELECT DISTINCT student_name FROM student_t 
							WHERE student_id=$id;";
							$query_name=mysqli_query($conn,$sqlname);
							$row_name=mysqli_fetch_array($query_name);

							$sql_grade="SELECT quarter_grade
							FROM student_subject_t ss,student_academic_level sa
							WHERE ss.student_id=$id
							AND sa.student_id=ss.student_id
							AND ss.school_year=$school_year
							AND sa.year_level=$year_level
							AND sa.quarter=$quarter
							AND ss.subject_name='$subject'";
							$query_grade=mysqli_query($conn,$sql_grade);
							$row_grade=mysqli_fetch_array($query_grade);
							echo '<tr>';
							echo '<td>'; 
							echo '<form>';
							/* echo '<input type="text" name="student_id" id="student_id" value="'.$id.'" visibility: hidden>';
							echo '<input type="text" name="quarter" id="quarter" value="'.$quarter.'" visibility: hidden>';
							echo '<input type="text" name="year_level" id="year_level" value="'.$year_level.'" visibility: hidden>';
							echo '<input type="text" name="section" id="section" value="'.$section.'" visibility: hidden>';
							echo '<input type="text" name="school_year" id="school_year" value="'.$school_year.'" visibility: hidden>'; */
							echo '<input type="submit" style="background:none; border:none; margin:0; padding:0; cursor: pointer;" value="'.$row_name['student_name'].'">';
							
							echo '</form>';
							echo '</td>';
							echo '<td>'; 
							
							echo $row_grade['quarter_grade'];
							echo '</td>';
							echo '</tr>';
							$i=$i+1;
						} ?>
	</form>
</body>
</html>