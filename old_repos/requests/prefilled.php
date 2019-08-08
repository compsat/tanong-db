<?php
include "config.php";
$requested_by = filter_input(INPUT_POST, 'requested_by');
$gender = filter_input(INPUT_POST, 'gender');
$first_name = filter_input(INPUT_POST, 'first_name');
$mi = filter_input(INPUT_POST, 'mi');
$last_name = filter_input(INPUT_POST, 'last_name');
$school_year = filter_input(INPUT_POST, 'school_year');
$grade = filter_input(INPUT_POST, 'grade');
$current_section = filter_input(INPUT_POST, 'current_section');
$adviser = filter_input(INPUT_POST, 'adviser');
$contact_number = filter_input(INPUT_POST, 'contact_number');
$purpose = filter_input(INPUT_POST, 'purpose');

if (!empty($requested_by)){
if (!empty($gender)){
if (!empty($first_name)){
if (!empty($mi)){
if (!empty($last_name)){
if (!empty($school_year)){
if (!empty($grade)){
if (!empty($current_section)){
if (!empty($adviser)){
if (!empty($contact_number)){
if (!empty($purpose)){
if (!empty($document_type)){
if (!empty($id_number)){
if (!empty($remarks)){
	
$host = "localhost";
$dbusername = "root";
$dbpassword="";
$dbname="request_system";
$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
if(isset($_POST['document_type'])) {
	$document_type = $_POST['document_type'];
} else {
	$document_type = NULL;
}
if (mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errorno().') '. mysqli_connect_error());
}

else{
	$sql = "INSERT INTO request_user_t(requested_by, gender,first_name,mi,last_name,school_year,grade,current_section,adviser,contact_number,purpose)
	values ('$requested_by','$gender','$first_name','$mi','$last_name','$school_year','$grade','$current_section','$adviser','$contact_number','$purpose')";
	if($conn->query($sql)){
		echo "New record is inserted into request user sucessfully";
	}
	else{
	echo "Error conn query";
	}
	
	$conn->close();
	
	$sql = "INSERT INTO request_t(document_type,requested_by,id_number, contact_number, remarks)
	values ('$document_type','$requested_by','$id_number','$contact_number','$remarks')";
	if($conn->query($sql)){
		echo "New record is inserted into request sucessfully";
	}
	else{
	echo "Error conn query";
	}
	
	$conn->close();
	
}
}
else{
	echo "Remarks should not be empty";
	die();
}
}
else{
	echo "ID Number should not be empty";
	die();
}
}
else{
	echo "Document Type should not be empty";
	die();
}
}
else{
	echo "Purpose should not be empty";
	die();
}
}
else{
	echo "Contact Number should not be empty";
	die();
}
}
else{
	echo "Adviser should not be empty";
	die();
}
}
else{
	echo "Current Section should not be empty";
	die();
}
}
else{
	echo "Grade should not be empty";
	die();
}
}
else{
	echo "School Year should not be empty";
	die();
}
}
else{
	echo "Last Name should not be empty";
	die();
}
}
else{
	echo "Middle Initial should not be empty";
	die();
}
}
else{
	echo "First Name should not be empty";
	die();
}
}
else{
	echo "Gender should not be empty";
	die();
}
}

?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8" />
		<title>REQUEST FORM</title>
		<link rel = "stylesheet" href = "css/style.css" type = "text/css" />
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
					<?php
						date_default_timezone_set('Asia/Manila');
						echo date("Y/m/d");
					?>
					</i></span>
				
					<label for = "lrn"> <b> LRN: </b> </label>
					<input type = "text" class = "lrn" name = "lrn">
							
					<label for = "gender"> <b> Gender: </b> </label>
					<select name = "gender">
						<option value="male"> Male </option>
						<option value="female"> Female </option>
						<option value="other"> Other </option>
					</select>
				</div>
				
				<div id = "name">
					<label for = "last_name"> <b> Last Name: </b> </label>
					<input type = "text" class = "last_name" name = "last_name">
					
					<label for = "first_name"> <b> First Name: </b> </label>
					<input type = "text" class = "first_name" name = "first_name">
					
					<label for = "mi"> <b> Middle Initial: </b> </label>
					<input type = "text" class = "mi" maxlength = "1" name = "mi">
					
					
				</div>
				
				<div id = "school">
					<label for = "sy"> <b>School Year:</b> </label>
					<input type = "text" class = "sy" name = "school_year">
							
					<label for = "grade"> <b>Grade: </b> </label>
					<select name = "grade">
						<option value = "grade1"> 1 </option>
						<option value = "grade2"> 2 </option>
						<option value = "grade3"> 3 </option>
					</select>
					
					<label for = "section"> <b> Section: </b> </label>
					<select name = "current_section">
						<option value = "sectiona"> A </option>
						<option value = "sectionb"> B </option>
						<option value = "sectionc"> C </option>
					</select>
					
					<label for = "adviser"> <b> Adviser: </b> </label>
					<input type = "text" class = "adviser" name = "adviser">
				</div>
			</div>
			
			<div id = "row2">
			<b>Document Requested: </b> <br>
				
				<input type="radio" name="document_type" value="f137" checked> F137<br>
				<input type="radio" name="document_type" value="f138"> F138<br>
				<input type="radio" name="document_type" value="dd"> Duplicate Diploma<br>
				<input type="radio" name="document_type" value="coe"> Certification of Enrollment<br>
				<input type="radio" name="document_type" value=""> Other <input type="text" name="document_type" />
				
			</div>
			
			<div id = "row3">
				<div id = "requester">
					<label for = "id_number"> <b> Student ID Number: </b> </label>
					<input type = "text" class = "id_number" maxlength = "6" name = "id_number">
					
					<label for = "contact"> <b>Contact No.:</b> </label>
					<input type = "text" class = "contact"	name = "contact_number">
				</div>
					
				<div id = "purpose">
					<label for = "purposes"> <b>School/Purpose:</b> </label> <br>
					<input type = "text" id = "purposes" name = "purpose">
				</div>
			</div>
			
			<div id = "row4">
				<div id = "receive">
					<b>Recieved by: </b> <i><span>placeholder</i></span>
					<label><b>Due Date:</b></label> <i><span>11/11/11</span></i>
				</div>
					
				<div id = "remarks">
					<label for = "remarks"> <b>Remarks:</b> </label> <br>
					<input type = "textarea" id = "remarks" name = "remarks">
				</div>
			</div>
			
			<div id = "row5">
				<form method = "post" action = "process.php">
					<input class = "submit-btn" type = "submit" name = "submit" value = "Submit" />
				</form>
			</div>
			</form>
		</div>
	</body>
</html>