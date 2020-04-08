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

session_start();


if (!isset($_SESSION['login']))
    {
      header("Location: index.php");
      }


?>



<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

       	<title> Inveniet </title> 

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <link href="assets/css/demo.css" rel="stylesheet" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">


<style>

#backup
{
height: 80px;
width: 200px;
background-color: #141A00;
color: white;

}


#backup:hover
{
height: 80px;
width: 200px;
background-color: #212120;
color: white;
}


#set_time
{
height: 41px;
width: 150px;
background-color: #141A00;
color: white;

}


#set_time:hover
{
height: 41px;
width: 150px;
background-color: #212120;
color: white;
}


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


</head>


<body>


<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$admin = $_SESSION['login'];

$sql_mode = "select mode from system_settings where admin = '$admin'";
$result_mode = $conn->query($sql_mode); 


   while ($row_mode = $result_mode->fetch_array(MYSQLI_NUM))
          {
          $mode_type = $row_mode[0];
           }

      

echo'  
    <div class="wrapper"> 
    <div class="sidebar" data-background-color="black" data-active-color="danger">


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="home.php" class="simple-text">
                   INVENIET
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="home.php">
                        <i class="fa fa-desktop"></i>
                        <p>Desktop</p>
                    </a>
                </li>

                 <li>
                    <a href="cases.php">
                        <i class="fas fa-id-card"></i>
                        <p>Cases</p>
                    </a>
                </li>

                 <li>
                    <a href="targets.php">
                        <i class="fas fa-user-shield"></i>
                        <p>Targets</p>
                    </a>
                </li>

               <li>
                    <a href="targets_group.php">
                        <i class="fa fa-users"></i>
                        <p>Targets Group</p>
                    </a>
                </li>

                 <li>
                    <a href="search_device.php">
                        <i class="fa fa-tablet"></i>
                        <p>Search Device</p>
                    </a>
                </li>
                <li>
                    <a href="devices_locations.php">
                        <i class="fa fa-microchip""></i>
                        <p>Devices Locations</p>
                    </a>
                </li>
               <li>
                    <a href="all_locations.php">
                        <i class="fa fa-globe"></i>
                        <p>All Locations</p>
                    </a>
                </li>
                <li>
                    <a href="remote_control.php">
                        <i class="fa fa-plug"></i>
                        <p>Remote control</p>
                    </a>
                </li>             
                <li>
                     <a href="task_manager.php">
                        <i class="fa fa-tasks"></i>
                        <p> Task Manager </p>
                    </a>
                </li>

                  <li class="active">
                    <a href="settings.php">
                         <i class="fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>

                 <li>
                   <a href="instructions.php">
                         <i class="fa fa-linode"></i>
                        <p> instructions </p>
                    </a>
                </li> 

            </ul>
    	</div>
    </div>


    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"> Settings </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li> 
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="ti-panel"></i>
			       <p> Mode '.$mode_type.' </p>
                           </a>
                        </li>

                        <li class="dropdown">

                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-connectdevelop"></i>
				  <p> Interfaces </p>
				  <b class="caret"></b>
                              </a>

                     <ul class="dropdown-menu">
                      <li><a href="home.php"> Desktop <i class="fa fa-desktop"></i> </a></li>
                      <li><a href="cases.php"> Cases <i class="fa fa-id-card"></i> </a></li>
               <li><a href="targets.php"> Targets <i class="fa fa-user-shield"></i> </a></li>
               <li><a href="targets_group.php"> Targets Group <i class="fa fa-users"></i> </a></li>
                      <li><a href="search_device.php"> Search Device <i class="fa fa-tablet"></i> </a></li>
          <li><a href="devices_locations.php"> Devices Locations <i class="fa fa-microchip"></i> </a></li>
                      <li><a href="all_locations.php"> All Locations <i class="fa fa-globe"></i> </a></li>
                      <li><a href="remote_control.php"> Remote Control <i class="fa fa-plug"></i> </a></li>
                      <li><a href="task_manager.php"> Task Manager <i class="fa fa-tasks"></i> </a></li>
                      <li><a href="settings.php"> Settings <i class="fa fa-cogs"></i> </a></li>
                      <li><a href="instructions.php"> Instructions <i class="fa fa-linode"></i> </a></li>
                     </ul>

                        </li>

			<li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			    <i class="fa fa-power-off"></i>
			    <p lass="notification"> Power </p>
                            <b class="caret"></b>
                            </a>
              
                            <ul class="dropdown-menu">
                               <li><a href="logout.php"> Power off </a></li>
                             </ul>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height:600px;">
                            <div class="header" align="center">
                                <h4 class="title"> System settings </h4> 
                                   <hr>
                                <p class="category"> Time of Renewal </p>
                            </div>

                           <div class="content all-icons" align="center">

                              <form action="" method="post">
                   <select class="form-control" name="time_of_renewal"
                        style="width:300px; color:white; background:#141A00; display:inline">
                             
                               <option value="1"> Live (send locations real time) </option> 
                               <option value="2"> 2 Seconds </option>                              
                               <option value="3"> 3 Seconds </option>
                               <option value="5"> 5 Seconds </option>
                               <option value="10"> 10 Seconds </option>
                               <option value="30"> 30 Seconds </option>
                               <option value="60"> 1  Minute </option>
                               <option value="120"> 2  Minutes </option>
                               <option value="300"> 5  Minutes </option>
                               <option value="600"> 10 Minutes </option>
                               <option value="900"> 15 Minutes </option>
                               <option value="1800"> 30 Minutes </option>
                               <option value="3600"> 1 Hour </option>
                             </select>

                           <button type="submit" name="set_time_renewal" value="Set_time_enabled" 
                               id="set_time">
                             Set time
                              <i class="ti-timer"></i>
                             </button>
                            </form>

                               <br><br><br><br> 

                            <div class="header" align="center">
                                   <hr>
                                <p class="category"> Backup for all locations </p>
                                   <br>
                            </div>

                           <form action="backup.php" method="post" target="_blank">
                            <button type="submit" name="backup" id="backup" value="ready_for_use">
                              Backup Locations 
                             <i class="fa fa-download"></i> 
                           </button>  
                          </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
      

    </div>
</div>';



 if (isset($_POST['set_time_renewal']))
    {

    $time_of_renewal = input($_POST['time_of_renewal']);


 $sql_time = "update system_settings set time_of_renewal = '$time_of_renewal' where admin = '$admin'";
 $result_time = $conn->query($sql_time); 

  if ($result_time == true)
      {
      $mes = "<div align='center' id='alertMsg' class='alert alert-success'> The time has been activated </div>";
       }

  else 
     {
    $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

      
 } // end of isset submit set time





} // end of else connect

$conn->close();

?>



  <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<script src="assets/js/chartist.min.js"></script>

    <script src="assets/js/bootstrap-notify.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<script src="assets/js/paper-dashboard.js"></script>

	<script src="assets/js/demo.js"></script>



</body>

</html>
