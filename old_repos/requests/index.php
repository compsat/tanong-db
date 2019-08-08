<?php
include "config.php";
$requested_by = filter_input(INPUT_POST, 'requested_by');
$lrn = filter_input(INPUT_POST, 'lrn');
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
$remarks = filter_input(INPUT_POST, 'remarks');
$other_document = filter_input(INPUT_POST, 'other_document');

if(isset($_POST['document_type'])) {
	$document_type = $_POST['document_type'];
} else {
	$document_type = NULL;
}
if($document_type == 'other') {
	$document_id = '5';
} else if ($document_type == 'f137') {
	$document_id = '1';
}  else if ($document_type == 'f138') {
	$document_id = '2';
}  else if ($document_type == 'dd') {
	$document_id = '3';
}  else if ($document_type == 'coe') {
	$document_id = '4';
}
session_start();
$id_number = $_SESSION['id'];
//Checking if its empty then null
$futureDate = mktime(0, 0, 0, date("m"), date("d") + 5, date("Y"));
$request_date = date("Y/m/d");
$due_date = date("Y/m/d", $futureDate);
$status = "P";
//Inserting
if (!empty($requested_by)){
if (!empty($lrn)){
if (!empty($gender)){
if (!empty($first_name)){
//if (!empty($mi)){
if (!empty($last_name)){
if (!empty($school_year)){
if (!empty($grade)){
//if (!empty($current_section)){
//if (!empty($adviser)){
//if (!empty($contact_number)){
if (!empty($purpose)){
if (!empty($document_id)){
if (!empty($id_number)){
if (!empty($request_date)){
if (!empty($due_date)){
if (!empty($purpose)){
if (!empty($status)){
//if (!empty($remarks)){
	
	if(empty(trim($mi))) {
		$mi = NULL;
	}
	if(empty(trim($current_section))) {
		$current_section = NULL;
	}
	if(empty(trim($adviser))) {
		$adviser = NULL;
	}
	if(empty(trim($contact_number))) {
		$contact_number = NULL;
	}
	if(empty(trim($remarks))) {
		$remarks = NULL;
	}
	
	$host = "localhost";
	$dbusername = "root";
	$dbpassword="";
	$dbname="request_system";
	$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);

	if (mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_errorno().') '. mysqli_connect_error());
	} else {
		//select requestedby from request user 
		//where requested by is equal to $requested_by
		//
		$sql= "
		SELECT request_user_t.requested_by
		FROM request_user_t
		WHERE request_user_t.requested_by = '$requested_by'";
		$result = mysqli_query($conn,$sql) or die("Failed to load".mysql_error());
		$row = mysqli_fetch_array($result);
		if($row['requested_by']==NULL){
			$sql = "INSERT INTO request_user_t(requested_by,lrn, gender,first_name,mi,last_name,school_year,grade,current_section,adviser,contact_number)
			VALUES ('$requested_by','$lrn','$gender','$first_name','$mi','$last_name','$school_year','$grade','$current_section','$adviser','$contact_number')";
			if($conn->query($sql)){
				echo "New record is inserted into request user sucessfully";
			}
			else{
				echo "Error conn query";
				echo "LINE 103";
 			}
		}
		$sql = "INSERT INTO request_t(request_no, document_id,requested_by,id_number, contact_number, request_date, due_date, purpose, remarks, status)
			VALUES (NULL, '$document_id','$requested_by','$id_number','$contact_number','$request_date','$due_date','$purpose','$remarks','$status')";
		if($conn->query($sql)){
			echo "New record is inserted into request sucessfully";
		}
		else{
			echo "Error conn query";
			echo "LINE 113";
		}
		
		
		//Close connection only after everything is done
		$conn->close();
	}
}
else{
	echo "Status should not be empty";
	die();
}
}
else{
	echo " Purpose should not be empty";
	die();
}
}
else{
	echo "Due Date should not be empty";
	die();
}
}
else{
	echo "Request Date should not be empty";
	die();
}
}
/*
else{
	echo "Remarks should not be empty";
	die();
}
}
*/
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
/*
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
*/
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
/*
else{
	echo "Middle Initial should not be empty";
	die();
}
}
*/
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
else{
	echo "LRN should not be empty";
	die();
}
}

?>
<!DOCTYPE html>

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
					<?php
						date_default_timezone_set('Asia/Manila');
						echo date("Y/m/d");
					?>
					</i></span>
				
					<label for = "lrn"> <b> LRN: </b> </label>
					<input type = "text" class = "lrn" name = "lrn">
							
					<label for = "gender" class = "space"> <b> Gender: </b> </label>
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
							
					<label for = "grade" class = "space"> <b>Grade: </b> </label>
					<select name = "grade">
						<option value = "1"> 1 </option>
						<option value = "2"> 2 </option>
						<option value = "3"> 3 </option>
						<option value = "4"> Alumni </option>
					</select>
					
					<label for = "section" class = "space"> <b> Section: </b> </label>
					<select name = "current_section">
						<option value = "A"> A </option>
						<option value = "B"> B </option>
						<option value = "C"> C </option>
						<option value = "D"> Alumni </option>
					</select>
					
					<label for = "adviser" class = "space"> <b> Adviser: </b> </label>
					<input type = "text" class = "adviser" name = "adviser">
				</div>
			</div>
			
			<div id = "row2">
			<b>Document Requested: </b> <br>
				
				<input type="radio" name="document_type" value="f137" checked> F137<br>
				<input type="radio" name="document_type" value="f138"> F138<br>
				<input type="radio" name="document_type" value="dd"> Duplicate Diploma<br>
				<input type="radio" name="document_type" value="coe"> Certification of Enrollment<br>
				<input type="radio" name="document_type" value="other"> Other <input type="text" name="other_document" />
				
			</div>
			
			<div id = "row3">
				<div id = "requester">
					<label for = "requested_by"> <b> Student ID Number: </b> </label>
					<input type = "text" class = "requested" maxlength = "6" name = "requested_by">
					
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
					<b>Recieved by: </b> <i><span><?php echo $id_number; ?></i></span>
					<label class = "space"><b>Due Date:</b></label> <i><span><?php echo date("Y/m/d", $futureDate);?></span></i>
				</div>
					
				<div id = "remarks">
					<label for = "remarks"> <b>Remarks:</b> </label> <br>
					<input type = "textarea" id = "remarks" name = "remarks">
				</div>
			</div>
			
			<div id = "row5">
				<form method = "post" action = "process.php">
					<input class = "submit-btn" type = "submit" name = "submit" value = "Submit" /><br>
					<p>Go to status page? <a href="registrar.php">Click this to go the status page</a>.</p>
					<p>Go back to login page? <a href="login.php">Click this to logout</a>.</p>
				</form>
			</div>
			</form>
		</div>
	</body>
</html>