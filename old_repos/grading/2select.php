<?php
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="gradingsystem";
			
	//create connection
	$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);
?>
<!DOCTYPE html>
<html>
<head>  <link rel="stylesheet" href="bootstrap.css"> <link rel="stylesheet" href="select1css.css"> 
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
		<div class="d-flex">
		<form action="3grades.php" method="post">
		<div class="flex-fill text-center" style="margin-left: 325px;">
			<div class="dropdown">
				<p> School Year: </p>
				<!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				</div> -->
				<select name="school_year" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT school_year FROM student_academic_level ORDER BY school_year";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["school_year"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Quarter: </p>
				 <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="quarter" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT quarter FROM student_academic_level ORDER BY quarter";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["quarter"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Year Level: </p>
				  <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="year_level" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT year_level FROM student_academic_level ORDER BY year_level";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["year_level"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Section: </p>
				  <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="section" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT section_name FROM student_academic_level ORDER BY section_name";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["section_name"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<br>
		</div>
		<div class="buttons">
			<button name="2button" value="view_section" type="submit" class="btn btn-secondary">  VIEW SECTION </button>
		</div>
		</form>
		
		<form action="10top_students_year.php" method="post">
		<div class="flex-fill text-center" style="margin-left:200px; margin-top:100px;">
			<div class="dropdown">
				<p> School Year: </p>
				<!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				</div> -->
				<select name="school_year" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT school_year FROM student_academic_level ORDER BY school_year";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["school_year"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Year Level: </p>
				  <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="year_level" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT year_level FROM student_academic_level ORDER BY year_level";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["year_level"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<br>
		</div>
		<div class="buttons2">
			<button name="2button" value="top_level" type="submit" class="btn btn-secondary">  VIEW TOP 10 OF LEVEL </button>
		</div>
		</form>
		
		<form action="11top_students_subj.php" method="post">
		<div class="flex-fill text-center" style="margin-left:200px; margin-top:100px;"">
			<div class="dropdown">
				<p> School Year: </p>
				<!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				</div> -->
				<select name="school_year" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT school_year FROM student_academic_level ORDER BY school_year";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["school_year"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Quarter: </p>
				 <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="quarter" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT quarter FROM student_academic_level ORDER BY quarter";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["quarter"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<div class="dropdown">
				<p> Year Level: </p>
				  <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					[Select]
				  </button>
				  <div class="dropdown-menu">
					<a class="dropdown-item" href="#">Link 1</a>
					<a class="dropdown-item" href="#">Link 2</a>
					<a class="dropdown-item" href="#">Link 3</a>
				  </div> -->
				<select name="year_level" class="btn btn-success dropdown-toggle">
				<?php
				$sql="SELECT DISTINCT year_level FROM student_academic_level ORDER BY year_level";
				$query=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_array($query)){
				?>
				<option><?php echo $row["year_level"];?></option>
				<?php
				}
				?>
				</select>
			</div>
			<br>
		</div>
		<div class="buttons3">
			<button name="2button" value="top_subject" type="submit" class="btn btn-secondary">  VIEW TOP STUDENTS PER SUBJECT </button>
		</div>
		</form>
	</div>
	</body>
</html>