<?php
	$school_year=filter_input(INPUT_POST, 'school_year');
	$year_level=filter_input(INPUT_POST, 'year_level');
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
  <form method="post" action="11php.php">
  <input type="text" name="year_level" id="year_level" value="<?php echo $year_level;?>" visibility: hidden>
  <input type="text" name="school_year" id="school_year" value="<?php echo $school_year;?>" visibility: hidden>
  <input type="text" name="quarter" id="quarter" value="<?php echo $quarter;?>" visibility: hidden>
  <h3 class="text-center text-dark">Year <?php echo $year_level?> TOP 5 STUDENTS PER SUBJECT</h2>
  <div class="dropdown text-center" style="margin:10px;">
        <select name="subj" id="subj" class="btn btn-success dropdown-toggle">
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
  <center><button name="11button" value="top_subject" type="submit" class="btn btn-secondary" align=center>  Confirm </button></center>

  <div class="container" style="margin-top:50px;">
    <table class="table table-bordered table-striped">
      <thead class="text-center">
        <tr class="table-info">
          <th>Name</th>
          <th>General Average</th>
        </tr>
      </thead>
     
	</form>
</body>
</html>