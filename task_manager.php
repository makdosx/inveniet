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

<style>


* {box-sizing: border-box} /* for th's width; display purpose */

table 
{
width: 100%;
display: block; /* to enable vertical scrolling */
max-height: 250px; /* e.g. */
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
  width: 25%; /* to enable "word-break: break-all" */
}



#th2 
{
  width: 48.5%; /* to enable "word-break: break-all" */
}

#td2
{
  width: 48.5%; /* to enable "word-break: break-all" */
}


#td3
{
  width: 48.5%; /* to enable "word-break: break-all" */
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


#text_admin
{
height: 50px;
width: 400px;
background-color: black;
color: white;
font-size: 30px;
}



#alertMsg {
  position: fixed;
  bottom: 0;
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
}, 1000);
 
});
</script>



</head>


<body>

   <div class="wrapper">
	<div class="sidebar" data-background-color="black" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="home.php" class="simple-text">
                   Inveniet
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
                <li class="active">
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
                    <a class="navbar-brand" href="#"> Task manager </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
				<p> Mode on </p>
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
                            <div class="header" align="center">
                                <h4 class="title" align="center"> Devices blocked </h4>
                                <p class="category" align="center"> Here is all the information about the blocked devices </p>
                                 <i class="fa fa-desktop"></i>
                                 <i class="fa fa-tablet"></i> 
                                 <i class="fa fa-mobile"></i> 
                           </div>
                             
                            <div class="content table-responsive table-full-width">
      
                        
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

  $sql_devices = "select * from devices_blocked 
                   where admin = '$admin' and device_id != '0.0.0.0' 
                   order by instant desc";   

  $result = $conn->query($sql_devices);

   while ($row = $result->fetch_assoc())
    {

    echo "  <table class=table table-striped'>
             <thead>
              <th> <i class='fa fa-signal'></i> </th>
              <th> Condition </th>
              <th> Instant </th>
              <th> Device ID </th>
              <th> <i class='fa fa-signal'></i> </th>
            </thead>
 
         <tbody>
                                   
   
    <tr>
    <td> <i class='fa fa-ban'></i> </td>
    <td> Blocked </td>
    <td> {$row['instant']} </td>
    <td> {$row['device_id']} </td>
    <td> <form action='' method='post'>
    <button type='submit' name='unblock' class='btn btn-primary btn-md' value='{$row['id']}'> Unblock Device <i class='fa fa-minus-circle'></i> </button>
  </form>
  </td>
  </tr>
 </tbody>


 </table>
";

    }



  
 if (isset($_POST['unblock']))
  {
  
   $unblock = input($_POST['unblock']);

   $sql_unblock = "delete from devices_blocked where id = '$unblock'";

   $result_unblock  = $conn->query($sql_unblock);

 
     if ($result_unblock == true) 
       {
       $mes = "<div align='center' id='alertMsg' class='alert alert-success'> Device $unblock was unblocked </div>";
       }
     else 
      {
      $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }
  
     echo $mes;

     echo '<meta http-equiv="refresh" content="2;URL=\'task_manager.php\'">';

    
    } // end if isset submit unblock device


 } // end of else connect

$conn->close();

?>

                            </div>
 

                        </div>
                    </div>
   

  

    </div>
</div>



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
