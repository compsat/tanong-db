<?php
	$username=filter_input(INPUT_POST, 'username');
	$password=filter_input(INPUT_POST, 'password');
	if (!empty($username)){
		if (!empty($password)){
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
				$sql="SELECT username,password FROM user_t WHERE username='$username' AND password='$password'";
				$query=mysqli_query($conn,$sql);
				if(mysqli_num_rows($query)==1){
					header("Location: 2select.php");
				}
				else{
					echo "Error: " .$sql."\n".$conn->error;
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
		echo "Username should not be empty";
		die();
	}
?>