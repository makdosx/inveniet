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
       	<title> Inveniet </title> 

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

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>


<style>

#alertMsg {
  position: fixed;
  top: 0;
  left: 0;
  height: 3em;
  width: 100%;
  background-color: black;
  color: white;
  font-size: 16px;
  z-index: 999;
}


</style>



<script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 2000);
 
});
</script>

<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action="" method="post">
					<div class="login100-form-avatar">
						<img src="assets_log/images/radar2.gif">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						inveniet V 2.0
					</span>

			<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
		       <input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>



 <div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
	<input class="input100" type="email" name="email" placeholder="Email" required>
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
						<button class="login100-form-btn" name="submit_reg">
							Register
						</button>
					</div>

		
					<div class="text-center w-full p-t-25 p-b-230">
						<a class="txt1" href="index.php">
							Login
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


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 if (isset($_POST['submit_reg']))
  {

require('__DEV__/function.php');
require('__ROOT__/class_cn.php');


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
   $email = input($_POST['email']);
   $password = md5(input($_POST['password']));
   $uncr_pass = input($_POST['password']);


   $sql = "insert into administrators (username,email,password,uncr_pass,verify) 
                  values ('$username','$email','$password','$uncr_pass','yes')";


   $sql2 = "insert into system_settings (admin,mode,time_of_renewal) 
            values ('$username','on','1')";
            
            
   $sql3 = "insert into devices_blocked (admin,device_id) 
            values ('$username','0.0.0.0')";           
 

   $result  = $conn->query($sql);
   $result2  = $conn->query($sql2);
   $result3  = $conn->query($sql3);

 
     if ($result == true and $result2 == true) 
        {
       $mes = "<div align='center' id='alertMsg' class='alert alert-success'> Register user $username was successfully </div>";
       }
     else 
      {
      $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

  
     echo $mes;
     
     echo '<meta http-equiv="refresh" content="3;URL=\'index.php\'">';

    

   } // end of else connect


 $conn->close(); 


} // end of isset submit

?>
