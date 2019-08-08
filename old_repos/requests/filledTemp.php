<?php
$host = "localhost";
$dbusername = "root";
$dbpassword="";
$dbname="request_system";
$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
if (mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errorno().') '. mysqli_connect_error());
}
session_start();
$currentReq = $_SESSION['request_no'];

$sql="SELECT ru.lrn, ru.gender, ru.first_name, ru.mi, ru.last_name, ru.school_year,
ru.school_year, ru.grade, ru.current_section, ru.adviser, ru.contact_number,
r.id_number, r.request_date, r.due_date, r.purpose, r.remarks, d.document_type, ru.requested_by
FROM request_t r, request_user_t ru, document_t d
WHERE r.request_no = '$currentReq' AND r.document_id = d.document_id AND r.requested_by = ru.requested_by";

$result = mysqli_query($conn,$sql) or die("Failed to load".mysql_error());
$row = mysqli_fetch_array($result);
?>
<!doctype html>

<html>
	<head>
		<meta charset = "utf-8" />
		<title>REQUEST FORM</title>
		<link rel = "stylesheet" href = "css/RequestForm.css" type = "text/css" />
	</head>
	
	<body>
		<div id = "container">
			<header>
				<h1>REQUEST FORM</h1>
			</header>
			<form method="post" action="">
			<div id = "row1">
				<div id = "details">
					<b>Date: </b> <span><i> 
					<?php echo $row['request_date'];?>
					</i></span>
				
					<label for = "lrn"> <b> LRN: </b> </label>
					<input type = "text" class = "lrn" name = "lrn" disabled="disabled" value = <?php echo $row['lrn'];?>>
							
					<label for = "gender" class = "space"> <b> Gender: </b> </label>
					<select name = "gender" value = <?php echo $row['gender'];?>>
						<option value="male"> Male </option>
						<option value="female"> Female </option>
						<option value="other"> Other </option>
					</select>
				</div>
				
				<div id = "name">
					<label for = "last_name"> <b> Last Name: </b> </label>
					<input type = "text" class = "last_name" name = "last_name" disabled="disabled" value = <?php echo $row['last_name'];?>>
					
					<label for = "first_name"> <b> First Name: </b> </label>
					<input type = "text" class = "first_name" name = "first_name" disabled="disabled" value = <?php echo $row['first_name'];?>>
					
					<label for = "mi"> <b> Middle Initial: </b> </label>
					<input type = "text" class = "mi" maxlength = "1" name = "mi" disabled="disabled" value = <?php echo $row['mi'];?>>
					
					
				</div>
				
				<div id = "school">
					<label for = "sy"> <b>School Year: </b> </label>
					<input type = "text" class = "sy" name = "school_year" disabled="disabled" value = <?php echo $row['school_year'];?>> 
							
					<label for = "grade" class = "space"> <b>Grade: </b> </label>
					<select name = "grade" disabled="disabled" value = <?php echo $row['grade'];?>>
						<option value = "1"> 1 </option>
						<option value = "2"> 2 </option>
						<option value = "3"> 3 </option>
						<option value = "4"> Alumni </option>
					</select>
					
					<label for = "section" class = "space"> <b> Section: </b> </label>
					<select name = "current_section" disabled="disabled" value = <?php echo $row['section'];?>>
						<option value = "A"> A </option>
						<option value = "B"> B </option>
						<option value = "C"> C </option>
						<option value = "D"> Alumni </option>
					</select>
					
					<label for = "adviser" class = "space"> <b> Adviser: </b> </label>
					<input type = "text" class = "adviser" name = "adviser" disabled="disabled" value = <?php echo $row['adviser'];?>>
				</div>
			</div>
			
			<div id = "row2">
			<b>Document Requested: </b> <br>
				
				<input type="radio" name="document_type" value="f137" disabled="disabled"> F137<br>
				<input type="radio" name="document_type" value="f138" disabled="disabled"> F138<br>
				<input type="radio" name="document_type" value="dd" disabled="disabled"> Duplicate Diploma<br>
				<input type="radio" name="document_type" value="coe" disabled="disabled"> Certification of Enrollment<br>
				<input type="radio" name="document_type" value="other" disabled="disabled"> Other <input type="text" name="other_document" disabled="disabled"/>
				
			</div>
			
			<div id = "row3">
				<div id = "requester">
					<label for = "requested_by"> <b> Student ID Number: </b> </label>
					<input type = "text" class = "requested" maxlength = "6" name = "requested_by" disabled="disabled" value = <?php echo $row['requested_by'];?>>
					
					<label for = "contact"> <b>Contact No.: </b> </label>
					<input type = "text" class = "contact"	name = "contact_number" disabled="disabled" value = <?php echo $row['contact_number'];?>>
				</div>
					
				<div id = "purpose">
					<label for = "purposes"> <b>School/Purpose: </b> </label> <br>
					<input type = "text" id = "purposes" name = "purpose" disabled="disabled" value = <?php echo $row['purpose'];?>>
				</div>
			</div>
			
			<div id = "row4">
				<div id = "receive">
					<b>Recieved by: </b> <i><span><?php echo $row['id_number'];?></i></span>
					<label class = "space"><b>Due Date:</b></label> <i><span><?php echo $row['due_date'];?></span></i>
				</div>
					
				<div id = "remarks">
					<label for = "remarks"> <b>Remarks: </b> </label> <br>
					<input type = "textarea" id = "remarks" name = "remarks" disabled="disabled" value = <?php echo $row['remarks'];?>>
				</div>
			</div>
			</form>
		</div>
	</body>
</html>
