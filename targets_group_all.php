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

ini_set('display_errors',0);



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


#inputlg
{
text-align: center; 
border-style: solid;
border-width: 1px;;
border-radius: 25px;
border-color: black;
text-align: center; 
background-color: #eeede9;
color: black;
}


.form-control::-webkit-input-placeholder {
color: black;
text-align: center; 
}


#a
{
color: blue;
}


#a:hover
{
color:red;
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




<script>

function submitForm() {
  return confirm('Are you sure that you want to delete all the targets? \nIn this case all the targets informations will be permanently lost.');
}


function submitForm2() {
  return confirm('Are you sure that you want to delete this target? \nIn this case all the informations of targets will be permanently lost.');
}


</script>




</head>


<body>



<?php

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

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

 if (isset($_POST['targets_all']))
       {

       $targets_all = input($_POST['targets_all']); 

       $admin = $_SESSION['login'];


      $sql_mode = "select mode from system_settings where admin = '$admin'";
      $result_mode = $conn->query($sql_mode); 

     $sql_targets = "select * from targets_group 
                     where admin = '$admin' 
                     and target_id = '$targets_all'
                     and last_ip != '0.0.0.0'
                     group by last_ip
                     order by instant desc"; 
     $result_targets = $conn->query($sql_targets); 



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
                        <i class="fa fa-user-shield"></i>
                        <p>Targets</p>
                    </a>
                </li>

              <li class="active">
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
                                <h4 class="title" align="center"> 
                                  <i class="fa fa-users"></i> &nbsp; 
                                    Targets Group: 
                                    <font color="red"> '.$targets_all.' </font> 
                                   </h4>
                             <p class="category" align="center"> 
                                 Here is all the information about 
                                   <font color="red"> '.$targets_all.' </font> 
                                   targets group 
                             </p>

                           </div>

 
   

                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    	<th> Target Group ID </th>
                                        <th> Real Name </th>
                                        <th> Description </th>
                                        <th> Link </th>
                                        <th> Target Details </th>
                                        <th> Delete Targets </th>
                                    </thead>
                                  <tbody>';
                                   
   

   while ($row_targets = $result_targets->fetch_assoc())
          { 
         $delete_target_id = $row_targets['target_id'];
         $target_id =  $row_targets['target_id']; 
         $target_real =  $row_targets['target_real']; 
         $target_desc =  $row_targets['target_desc']; 
         $link = $row_targets['link']; 
         $last_ip   = $row_targets['last_ip'];
         //$fingerprint = $row_targets[8]; 
         $location  = $row_targets['latitude']  .' , ' .$row_targets['longitude'];
         $location_on_map = $row_targets['latitude']  .',' .$row_targets['longitude'] .'-' .$row_targets['target_id'] .'-' .$row_targets['address'] .'-' .$row_targets['last_ip'];


  echo"<tr> 
        <td> $target_id </td>
        <td> $target_real </td>
        <td> $target_desc </td>
        <td> <a id='a'> $link </a> </td>


       <td> 
        <form action='targets_group_profiles.php' method='post' target='_blank'>
        <input type='text' name='target_group_profile_ip' value='$last_ip' hidden>
    <button type='submit' name='target_group_profile_id' class='btn btn-primary btn-md' value='$target_id'>        
      Target Details <i class='fa fa-info'></i>
        </button>
     </form>
    </td> 


      <td>
         <form action='' method='post' onsubmit='return submitForm2(this);'>
          <button type='submit' name='delete_target_id' class='btn btn-dangerous btn-md' value='$delete_target_id'> Delete Target <i class='fa fa-trash'></i> </button>
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
     <form action="" method="POST" onsubmit="return submitForm(this);">
       <button type="submit" name="delete_targets" class="btn btn-dangerous btn-lg" value="all"> 
          Delete all targets group <i class="fa fa-trash"></i> 
       </button>
     </form>
   </div>


    </div>
</div>';

 


  if (isset($_POST['delete_target_id']))
      {

      $delete_target_id = input($_POST['delete_target_id']); 
      $sql_delete_target = "delete from targets_group where id = '$delete_target_id' and admin = '$admin'";
      $result_delete_target = $conn->query($sql_delete_target);

   if ($result_delete_target)
       {
   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> The target $delete_target_id location was deleted </div>";
       }

  else 
     {
    $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

     
     echo $mes;
     
     echo '<meta http-equiv="refresh" content="2;URL=\'targets_group.php\'">';
     
 
      } // end of isset submit delete device id





  if (isset($_POST['delete_targets']))
      {

      $sql_delete_targets = "delete from targets_group";
      $result_delete_targets = $conn->query($sql_delete_targets);

   if ($result_delete_targets = true)
       {
   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> The targets locations was deleted </div>";
       }

  else 
     {
    $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
     }

 
     echo $mes;
     
     echo '<meta http-equiv="refresh" content="2;URL=\'targets_group.php\'">';
 
 
      } // enf of isset submit delete all devices

    

  } // enf of isset targets all


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

