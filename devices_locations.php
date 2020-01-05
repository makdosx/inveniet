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


<style>


* {box-sizing: border-box} /* for th's width; display purpose */

table 
{
width: 100%;
display: block; /* to enable vertical scrolling */
max-height: 500px; /* e.g. */
overflow-y: scroll; /* keeps the scrollbar even if it doesn't need it; display purpose */
}

table, td {
  border-collapse: collapse;
}

th
{
background-color: #EEEDE9;
}


th, td {
  width: 20.33%; /* to enable "word-break: break-all" */
}


#map 
{
height: 100%;
}

      
html, body 
{
height: 100%;
margin: 0;
padding: 0;
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

$sql_devices = "select * from devices where admin = '$admin' order by instant desc"; 
$result_devices = $conn->query($sql_devices); 



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
                    <a href="search_device.php">
                        <i class="fa fa-tablet"></i>
                        <p>Search Device</p>
                    </a>
                </li>
                <li class="active">
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
                  <li>
                    <a href="settings.php">
                         <i class="fa fa-cogs"></i>
                        <p>Settings</p>
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
                    <a class="navbar-brand" href="#"> Devices Locations </a>
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
                      <li><a href="search_device.php"> Search Device <i class="fa fa-tablet"></i> </a></li>
                   <li><a href="devices_locations.php"> Devices Locations <i class="fa fa-microchip"></i> </a></li>
                      <li><a href="all_locations.php"> All Locations <i class="fa fa-globe"></i> </a></li>
                      <li><a href="remote_control.php"> Remote Control <i class="fa fa-plug"></i> </a></li>
                      <li><a href="task_manager.php"> Task Manager <i class="fa fa-tasks"></i> </a></li>
                      <li><a href="settings.php"> Settings <i class="fa fa-cogs"></i> </a></li>
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center"> Locations of devices </h4>
                             <p class="category" align="center"> Here is all the information about the devices </p>
                           </div>

                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th> Instant </th>
                                    	<th> Device ID </th>
                                    	<th> Last IP </th>
                                    	<th> Fingerprint </th>
                                    	<th> Location (lat, lon)</th>
                                        <th> On The Map </th>
                                        <th> Delete Devices </th>
                                    </thead>
                                  <tbody>';
                                   
   

   while ($row_devices = $result_devices->fetch_array(MYSQLI_NUM))
          { 
         $delete_device_id = $row_devices[0];
        // echo $delete_device_id .'<br>';
         $instant  = $row_devices[4];
         $device_id =  $row_devices[1];
         $last_ip   = $row_devices[3];
         $fingerprint = $row_devices[8]; 
         $location  = $row_devices[5]  .' , ' .$row_devices[6];
         $location_on_map = $row_devices[5]  .',' .$row_devices[6] .'-' .$row_devices[2] .'-' .$row_devices[7];

  echo"<tr>
       <td> $instant </td>
       <td> $device_id </td>
       <td> $last_ip </td>
       <td> $fingerprint </td>
       <td> $location </td>

       <td> <form action='devices_locations_map.php' method='post' target='_blank'>
             <button type='submit' name='map_location' class='btn btn-primary btn-md' value='$location_on_map'> View Device <i class='fa fa-eye'></i> </button>
           </form>
      </td> 

      <td>
         <form action='' method='post'>
          <button type='submit' name='delete_device_id' class='btn btn-dangerous btn-md' value='$delete_device_id'> Delete Device <i class='fa fa-trash'></i> </button>
        </form>
     </td>
      
     </tr>
    </tbody>"; 
   

 } // end of while for devices


  echo' </table>

       </div>
      </div>
     </div> ';


echo'
    <div align="center">
     <form action="" method="POST">
       <button type="submit" name="delete_devices" class="btn btn-dangerous btn-md" value="all"> 
          Delete all devices locations <i class="fa fa-trash"></i> 
       </button>
     </form>
   </div>


    </div>
</div>';

 


  if (isset($_POST['delete_device_id']))
      {

      $delete_device_id = input($_POST['delete_device_id']); 
      $sql_delete_device = "delete from devices where id = '$delete_device_id' and admin = '$admin'";
      $result_delete_device = $conn->query($sql_delete_device);

   if ($result_delete_device == true)
       {
   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> The device $delete_device_id location was deleted </div>";
       }

  else 
     {
    $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

 
      } // end of isset submit delete device id





  if (isset($_POST['delete_devices']))
      {

      $sql_delete_devices = "delete from devices";
      $result_delete_devices = $conn->query($sql_delete_devices);

   if ($result_delete_devices == true)
       {
   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> The devices locations was deleted </div>";
       }

  else 
     {
    $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

 
      } // enf of isset submit delete all devices




} // end of else connect

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

