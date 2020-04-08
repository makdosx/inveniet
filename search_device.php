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

#map {
  height: 70%;
  width: 100%;
  margin: 0px;
  padding: 0px
}

    </style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function(){    
    loadstation();
});

function loadstation(){
    $("#station_data").load("search_device.py");
    setTimeout(loadstation, 1000);
}
</script>

<style>


.form-control::-webkit-input-placeholder { color: grey; }  
.form-control:-moz-placeholder { color: grey; }  
.form-control::-moz-placeholder { color: grey; }  
.form-control:-ms-input-placeholder { color: grey; }  
.form-control::-ms-input-placeholder { color: grey; } 


.form-control:focus {
  border-color: black !important;
  box-shadow: 0 0 5px black !important;
}


</style>


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
 
                 <li class="active">
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
                    <a class="navbar-brand" href=""> Search Device </a>
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
 

           <br><br>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height:600px;">

                              <div id="map"></div>

                <div class="header" align="center">
                                <h4 class="title"> Search Device </h4> 
                                   <hr>

             <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

            <div class="input-group col-xs-8" style="background-color:black;">

             <span class="input-group-addon"><i class="fa fa-user"></i></span>
             <select id="search" type="text" class="form-control" name="search_id" 
                    style="height: 60px; font-size: 30px;"> 
                 <option value="" hidden> Select Search </option>
                 <option value="devices"> Devices </option>
                 <option value="targets"> Targets </option>
                 <option value="targets_group"> Targets Group </option>
             </select>

             <span class="input-group-addon"><i class="fa fa-microchip"></i></span>
             <input id="search" type="text" class="form-control" name="search_ip" 
                    style="height: 60px; font-size: 40px;" placeholder="Target IP">

            <button hidden type="submit" name="submit_search"></button>
            </form>
           </div>
             </div>
         

         </div>

        </div></div></div></div></div>

        </div>


     
                
                </div>
            </div>
        </div>

    </div>
</div>';



      if (isset($_POST['submit_search']))
          {
 
          $search_id = input($_POST['search_id']);

          $search_ip = input($_POST['search_ip']);


         if ($search_id == 'devices') 
               { 
            $sql_search = "SELECT GROUP_CONCAT(CONCAT(all_info))
                           AS 'combined_all_info'
                           FROM devices where device_id = '$search_ip' and admin = '$admin'";
                 }



         if ($search_id == 'targets') 
              { 
            $sql_search = "SELECT GROUP_CONCAT(CONCAT(all_info))
                           AS 'combined_all_info'
                           FROM targets where last_ip = '$search_ip' and admin = '$admin'";
                 }


            if ($search_id == 'targets_group') 
              { 
            $sql_search = "SELECT GROUP_CONCAT(CONCAT(all_info))
                           AS 'combined_all_info'
                           FROM targets_group where last_ip = '$search_ip' and admin = '$admin'";
                 }




       $result_search = $conn->query($sql_search);


    while ($row_search = $result_search->fetch_array(MYSQLI_NUM))
           {
           $all_info = $row_search[0];
               }



echo"
<script>
     
function initMap() {


  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeId: 'hybrid',
    zoom: 2,
    center: {
      lat: 40.000,
      lng: 30.000,
    }
  });
  var infoWin = new google.maps.InfoWindow();
  // Add some markers to the map.
  // Note: The code uses the JavaScript Array.prototype.map() method to
  // create an array of markers based on a given 'locations' array.
  // The map() method here has nothing to do with the Google Maps API.
  var markers = locations.map(function(location, i) {
    var marker = new google.maps.Marker({
      position: location
    });
    google.maps.event.addListener(marker, 'click', function(evt) {
      infoWin.setContent(location.info);
      infoWin.open(map, marker);
    })
    return marker;
  });

  // markerCluster.setMarkers(markers);
  // Add a marker clusterer to manage the markers.
  var markerCluster = new MarkerClusterer(map, markers, {
    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
  });

}

var locations = [{$all_info},];



google.maps.event.addDomListener(window, 'load', initMap);

    </script>";



 } // end if isset post submit




 } // end of else connect


 $conn->close();

?>



    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>

   <!-- hack the api key for cluster -->
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initMap"></script>


    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<script src="assets/js/chartist.min.js"></script>

    <script src="assets/js/bootstrap-notify.js"></script>


	<script src="assets/js/paper-dashboard.js"></script>

	<script src="assets/js/demo.js"></script>

</body>

</html>
