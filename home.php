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

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">


<style>

#a
{
color: blue;
}


#a:hover
{
color:red;
}


</style>


</head>

<body>



<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#require('/__DEV__/function.php');
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


$sql_mode = "select mode,time_of_renewal from system_settings where admin = '$admin'";
$result_mode = $conn->query($sql_mode);


$sql_devices = "select count(distinct device_id) from devices where admin = '$admin'";
$result_devices = $conn->query($sql_devices);


$sql_locations = "select count(all_info) from devices where admin = '$admin'";
$result_locations = $conn->query($sql_locations);


$protocol = $_SERVER['SERVER_PORT'];

if ($protocol == '443')
    {
    $protocol = 'https://';
    }

else if ($protocol == '80')
         {
         $protocol = 'http://';
         }


$url = $_SERVER['SERVER_NAME'];

#$ip_wan = file_get_contents('https://api.ipify.org');



$link_url = $protocol .$url ."/view.php?=$admin"; 
$link_url = str_replace(" ","",$link_url);

#$link_wan = $protocol  .$ip_wan  ."/view.php?=$admin";
#$link_wan = str_replace(" ","",$link_wan);




    while ($row_mode = $result_mode->fetch_array(MYSQLI_NUM))
           { 
           $mode_type = $row_mode[0];
           $time_of_renewal = $row_mode[1];
            }  

  
    while ($row_devices = $result_devices->fetch_array(MYSQLI_NUM))
           {
            $devices = $row_devices[0];
            }


    while ($row_locations = $result_locations->fetch_array(MYSQLI_NUM))
           {
           $locations = $row_locations[0];
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Dashboard</a>
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="fa fa-sliders"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p> Mode </p>
                                            '.$mode_type.'
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-sliders"></i> Mode now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="fa fa-creative-commons"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p> Time </p>
                                             '.$time_of_renewal.'
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-creative-commons"></i> Time renewal
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p> Locations </p>
                                             '.$locations.'
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="fa fa-map-marker"></i> All locations
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="fa fa-tablet"></i>
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p> Devices </p>
                                             '.$devices.'
                                        </div>
                                    </div>
                                </div>

                                <div class="footer">
                                    <hr />
                                    <div class="stats"> 
                                        <i class="fa fa-desktop"></i>
                                        <i class="fa fa-tablet"></i>
                                        <i class="fa fa-mobile"></i> Devices types
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

           
               <div class="col-md-12">
                   <div class="card">
                     <div class="header">
                       <h4 class="title" align="center"> 
                         <i class="fa fa-link"></i> Links for find the location 
                       </h4>
                         <br>

                  <p align="center">
                     <i class="fa fa-external-link"></i>
                     Link on url: &nbsp;
                     <a href="" id="a" onclick="copy(this)"> '.$link_url.' </a>
                  </p>

                 <p>&nbsp;</p>
               </div>                     
             </div>
           </div>
          


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"> Devices Behavior</h4>
                                <p class="category"> All times performance </p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-timer"></i> Updated Now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"> Devices Statistics </h4>
                                <p class="category"> Devices types </p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-danger"></i> Desktop
                                        <i class="fa fa-circle text-warning"></i> Tablet
                                        <i class="fa fa-circle text-info"></i> Mobile
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-desktop"></i> 
                                        <i class="ti-tablet"></i> 
                                        <i class="ti-mobile"></i> All devices types
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title"> Year tracking </h4>
                                <p class="category"> All months devices tracking </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart ct-fourth"></div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle"></i> Desktop
                                        <i class="fa fa-circle text-warning"></i> Tablet
                                        <i class="fa fa-circle text-info"></i> Mobile
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-info-alt"></i> Devices informations has certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>';


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


      
	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-location-pin',
            	message: "Welcome to <b> INVENIET </b> &nbsp; &nbsp; All devices locations is here."

            },{
                type: 'success',
                timer: 100
            });

    	});
	</script>
         
 

       <script>
           function copy(that)
           {
            var inp =document.createElement('input');
            document.body.appendChild(inp)
            inp.value =that.textContent
            inp.select();
            document.execCommand('copy',false);
            alert("Copy link: " + inp.value);
            inp.remove();
             }

       </script>
 

</body>

</html>
