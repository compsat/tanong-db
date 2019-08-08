<?php
	$student_id=filter_input(INPUT_POST, 'student_id');
	$year_level=filter_input(INPUT_POST, 'year_level');
	$section=filter_input(INPUT_POST, 'section');
	$school_year=filter_input(INPUT_POST, 'school_year');
	$quarter=filter_input(INPUT_POST, 'quarter');
	
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
		$sql="SELECT * FROM student_t WHERE student_id='$student_id'";
		$query=mysqli_query($conn,$sql);
		$rows=mysqli_fetch_array($query);
	}
?>
<!DOCTYPE html> 
<head>  <link rel="stylesheet" href="bootstrap.css"> </head>
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
		<h1> <center> <br> STUDENT INFORMATION </h1>
		<div class="container">
			<form style="margin: 20px;" method="post" action="5progress.php" action="9form.php"  >
			<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
				<div class="form-check-inline">
					<label for="Student Name">Student Name:</label>
					<input type="text" class="form-control" id="name" name="name" style="width:600px;" value="<?php echo $rows['student_name']?>">
					<label for="photo" style="position:relative; right:-50px;"> Picture: </label>
					<input type="image" style="position:relative; right:-60px;" name="picture" value="<?php echo $rows['picture']?>"> 
				</div>
				<div class="form-check-inline" style="padding:7px;">
					<label for="lrn">LRN:</label>
					<input type="text" class="form-control" id="lrn" name="lrn" style="position:relative; width:300px;" value="<?php echo $rows['LRN']?>">
					<label for="birthdate">Birthdate:</label>
					<input type="text" class="form-control" style="position:relative; width:300px;" name="birthdate" value="<?php echo $rows['birthdate']?>">
				</div>
				<div class="form-check-inline" style="padding:7px;">
					<label for="sex">Sex:</label>
					<input type="text" class="form-control" id="sex" name="sex" style="width:50px" value="<?php echo $rows['sex']?>">
					<label for="currentlevel">Current Year Level:</label>
					<input type="text" class="form-control" id="lvl" name="lvl" style="width:190px" value="<?php echo $year_level?>">
					<label for="currentsection">Current Section:</label>
					<input type="text" class="form-control" id="section" name="section" style="width:190px" value="<?php echo $section?>">
				</div>
				<div class="buttons" style="padding:5px;">
				<center>
				 
				 
				 <button name="4button" value="editgrades" type="submit" class="btn btn-secondary">EDIT GRADES</button> <br><br>
				 <button name="4button" value="change" type="submit" class="btn btn-secondary"  >CHANGE CLASS</button>
				 <br><br><button name="4button" value="form138" type="submit" class="btn btn-secondary">View Form 138</button>
				 </center>
				 <input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
				 <input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
				</form>
				<form style="margin: 20px;" method="post" action="9form.php"  >
				<input type="text" name="student_id" id="student_id" value="<?php echo $student_id ?>" visibility: hidden>
			<input type="text" name="quarter" id="quarter" value="<?php echo $quarter ?>" visibility: hidden>
			<input type="text" name="school_year" id="school_year" value="<?php echo $school_year ?>" visibility: hidden>
			<input type="text" name="year_level" id="year_level" value="<?php echo $year_level ?>" visibility: hidden>
			<input type="text" name="section" id="section" value="<?php echo $section ?>" visibility: hidden>
				</form>
			</div>
		</div>
	</body>
</html>