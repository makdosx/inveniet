<?php

/*
* Copyright (c) 2020 Barchampas Gerasimos <makindosx@gmail.com>.
* inveniet is a program for locating computers tablets and mobile phones.
*
* inveniet is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License as
* published by the Free Software Foundation, either version 3 of the
* License, or (at your option) any later version.
*
*
* inveniet is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License, version 3,
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*
*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title> inveniet </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets_log/images/radar2.gif"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets_log/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets_log/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets_log/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="" method="post">
					<div class="login100-form-avatar">
						<img src="assets_log/images/radar2.gif">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						inveniet
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" required>  
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" name="submit_log">
							Login
						</button>
					</div>

		
					<div class="text-center w-full p-t-25 p-b-230">
						<a class="txt1" href="register.php">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>


<?php


if (isset($_POST['submit_log']))
  {

 require('__ROOT__/class_cn.php');
 require('__DEV__/function.php');


 $obj = new security;
 
  $host=$obj->connect[0];
  $user=$obj->connect[1];
  $pass=$obj->connect[2];
  $db=$obj->connect[3];
  
  $conn = new mysqli($host,$user,$pass,$db);
  
  if($conn->connect_error)
     {
     die ("Cannot connect to server " .$conn->connect_error);
       }

else
{

  $username = input($_POST['username']);
  $password = md5(input($_POST['password']));

  $username = $conn->real_escape_string($username);
  $password = $conn->real_escape_string($password); 

  $sql ="select username,password,verify from administrators 
         where binary username='$username' and password='$password' and verify='yes'";

  $result=$conn->query($sql);
  $rows = $result->num_rows;

   if ($rows == 1) 
    {  
     
       session_start();
 
     //all sessions
      $_SESSION['login']=$username;

     echo ("<script>location.href='home.php'</script>");

    } // end id
 

}// end of else login


 $conn->close(); 

} // end of isset submit

?>
