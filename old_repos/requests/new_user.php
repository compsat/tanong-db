<?php
include "config.php";
$id_number = filter_input(INPUT_POST, 'id_number');
$user_type = filter_input(INPUT_POST, 'user_type');
$first_name = filter_input(INPUT_POST, 'first_name');
$mi = filter_input(INPUT_POST, 'mi');
$last_name = filter_input(INPUT_POST, 'last_name');
$password = filter_input(INPUT_POST, 'password');
if (!empty($id_number)){
if (!empty($user_type)){
if (!empty($first_name)){
if (!empty($mi)){
if (!empty($last_name)){
if (!empty($password)){
$host = "localhost";
$dbusername = "root";
$dbpassword="";
$dbname="request_system";
$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
if (mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errorno().') '. mysqli_connect_error());
}

else{
	$sql = "INSERT INTO login_t(id_number, user_type,first_name,mi,last_name,password)
	values ('$id_number','$user_type','$first_name','$mi','$last_name','$password')";
	if($conn->query($sql)){
		echo "New record is inserted sucessfully";
	}
	else{
	echo "Error conn query";
	}
	
	$conn->close();
	
}
}
else{
	echo "Password should not be empty";
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
	echo "User Type should not be empty";
	die();
}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
		<title> New User </title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div align = "center" id="container">
					<header>
                    <h1>New User</h1>
                    </header>
					<div id="input">
					<form method="post" action="">
					<br />
                        <input type="text" class="textbox" id="id_number" name="id_number" placeholder="ID Number" />
                    <br />
                        <input type="text" class="textbox" id="user_type" name="user_type" maxlength = "1" placeholder="User Type"/>
                    <br />
						<input type="text" class="textbox" id="first_name" name="first_name" placeholder="First Name"/>
                    <br />
						<input type="text" class="textbox" id="mi" name="mi" maxlength = "1" placeholder="Middle Initial"/>
                    <br />
						<input type="text" class="textbox" id="last_name" name="last_name" placeholder="Last Name"/>
                    <br />
					 <input type="password" class="textbox" id="password" name="password" placeholder="Password"/>
                    <br />
                        <input type="submit" class="but_submit" value="Submit" name="but_submit" id="but_submit" />
					<br />
					<p>Go back to login page? <a href="login.php">Click this</a>.</p>
					<br />
                    </form>
					</div>
        </div>
    </body>
</html>
