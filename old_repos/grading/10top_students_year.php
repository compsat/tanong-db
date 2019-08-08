<?php
	$school_year=filter_input(INPUT_POST, 'school_year');
	$year_level=filter_input(INPUT_POST, 'year_level');
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
			
			<div class="form-inline">
                <input type="text" class="form-control" placeholder="Search Student" id="Search" onKeyUp="aa();" style="width:300px;">
				<!--<button type="submit" class="btn btn-primary" style="width:80px;">Search</button>-->
				<button type="button" class="btn btn-secondary" style="position: relative; width: 100px; right: -710px; padding: 6px;">Print</button>
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
							
							<th>Final Grade</th>
							
						</tr>
						</thead>';
						$sql_student_name="SELECT DISTINCT sa.student_id, ss.final_grade 
							FROM student_academic_level sa, student_subject_t ss
							WHERE sa.student_id=ss.student_id
							AND ss.school_year=$school_year
							AND sa.year_level=$year_level
							ORDER BY final_grade DESC";
						$query=mysqli_query($conn,$sql_student_name); 
						$i=0;
						
						while ($row=mysqli_fetch_array($query) AND $i<10){
							$id=$row['student_id'];
							$sqlname="SELECT DISTINCT student_name FROM student_t 
							WHERE student_id=$id;";
							$query_name=mysqli_query($conn,$sqlname);
							$row_name=mysqli_fetch_array($query_name);

							$sql_grade="SELECT final_grade
							FROM student_subject_t ss,student_academic_level sa
							WHERE ss.student_id=sa.student_id
							AND ss.student_id=$id
							AND sa.school_year=$school_year
							AND sa.year_level=$year_level";
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
							
							echo $row_grade['final_grade'];
							echo '</td>';
							echo '</tr>';
							$i=$i+1;
						}
						echo '</table>';
						$conn->close();
					}
				
			?>
		</div>
	</body>
</html>