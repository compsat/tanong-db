<?php
include "config.php";
session_start();
if(isset($_POST['but_submit'])){
    $id = mysqli_real_escape_string($link,$_POST['txt_id']);
    $password = mysqli_real_escape_string($link,$_POST['txt_pwd']);
	
	if(isset($_POST['userType'])) {
		$userType = $_POST['userType'];
	} else {
		$userType = NULL;
	}
	
    if ($id != "" && $password != ""){
        $sql_query = "SELECT * FROM login_t WHERE id_number = '$id' AND password = '$password' AND user_type = '$userType'";				
        $result = mysqli_query($link,$sql_query)
			or die("Failed to load".mysql_error());
        $row = mysqli_fetch_array($result);

		if($row['id_number'] == $id && $row['password'] == $password && $row['user_type'] == 'R'){
			session_start();
            $_SESSION['id'] = $id;
            header('Location: home.php');
        } else if ($row['id_number'] == $id && $row['password'] == $password && $row['user_type'] == 'P') {
			$_SESSION['id'] = $id;
            header('Location: principal.php');
		} else{
            echo "Invalid ID Number, password, or user type";
        }

    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
		<title> LOG-IN </title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div align = "center" id="container">
					<header>
                    <h1>Log-in</h1>
                    </header>
					<div id="input">
					<form method="post" action="">
					<br />
                        <input type="text" class="textbox" id="txt_uname" name="txt_id" placeholder="ID Number" />
                    <br />
                        <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/>
                    <br />
						<input type="radio" value="R" name="userType" /> Registrar
					<br />
						<input type="radio" value="P" name="userType" /> Principal
					<br />
                        <input type="submit" class="but_submit" value="Submit" name="but_submit" id="but_submit" />
					<br />
					<p>Don't have an account? <a href="new_user.php">Sign up now</a>.</p>
                    </form>
					</div>
        </div>
    </body>
</html>