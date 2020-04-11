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

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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
color: grey;
text-align: center; 
}


#btn_c1
{
text-align: center; 
border-style: solid;
border-width: 1px;;
border-radius: 25px;
border-color: black;
text-align: center; 
background-color:red;
color: white;
}


#btn_c2
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


#btn_c3
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


select
{ 
text-align-last:center;
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

$sql_targets = "select * from targets where admin = '$admin' order by instant desc"; 
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
                
                   <li class="active">
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
                    <a class="navbar-brand" href="#"> Cases </a>
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center"> Insert new case </h4>
                             <p class="category" align="center"> From here you can define new cases </p>
                             
                               <br>
   
          <form action="" method="post">


                <button class="btn btn-primary btn-block" id="btn_c1" disabled>  
                  <i class="fa fa-folder"></i> 
                  <i class="fa fa-folder-open"></i> 
                  <i class="fa fa-folder-minus"></i> 
                  <i class="fa fa-id-card-alt"></i> 
                  <i class="fa fa-address-card"></i>
                </button>

                       <br>

                <button class="btn btn-primary btn-block" id="btn_c2" disabled>  
                  <i class="fa fa-user-secret"></i> 
                  <i class="fa fa-user-tag"></i> 
                  <i class="fas fa-user-injured"></i> 
                  <i class="fa fa-user-tie"></i> 
                  <i class="fa fa-user-graduate"></i> 
                  <i class="fa fa-user-nurse"></i> 
                  <i class="fa fa-walking"></i> 
                  <i class="fa fa-running"></i> 
                </button>
          
                   <br>

                <button class="btn btn-primary btn-block" id="btn_c3" disabled>  
                  <i class="fa fa-calendar-alt"></i> 
                  <i class="fa fa-clock"></i> 
                  <i class="fa fa-hourglass-half"></i> 
                  <i class="fa fa-stopwatch"></i> 
                </button>

                       <br>

                
              <select name="target_type" class="form-control input-md" id="inputlg" required>
                 <option value="" hidden> Select Type of Target </option>
                 <option value="specific_target"> Specific Target </option>
                 <option value="group_target"> Group Target </option> 
              </select>

                       <br>

              <input type="text" name="target_nick_name" class="form-control input-md" id="inputlg" 
                     placeholder="Nickname of Target / Group" pattern="[a-zA-Z0-9-_.]{1,}" required>

                       <br>

        <input type="text" name="target_real_name" class="form-control input-md" id="inputlg" 
                     placeholder="Real name of Target / Group" pattern="{3,}" required>

                       <br>

      <input type="text" name="target_desc" class="form-control input-lg" id="inputlg" 
                     placeholder="Description of Target / Group" pattern="{10,}" required>

                       <br>

                  <button type="submit" name="submit_target" class="btn btn-success btn-block"> 
            Add Target <i class="fa fa-plus"></i> 
                </button>
                
                <br>

              </form>

                  </div>

 
  

       </div>
      </div>
     </div> ';


echo'
    


    </div>
</div>';



  
  if (isset($_POST['submit_target']))
      {

      $target_type = input($_POST['target_type']);
        
      $admin = $_SESSION['login']; 
      $target_nick_name = input($_POST['target_nick_name']); 
      $target_real_name = input($_POST['target_real_name']); 
      $target_desc = input($_POST['target_desc']); 
      $link = "!" .$admin ."-" .$target_nick_name ."_";

      $imprint = '<font color=red> <b> OFF </b> </font>';

      $protocol = $_SERVER['SERVER_PORT'];

      if ($protocol == '443')
         {
         $protocol = 'https://';
         }

      else if ($protocol == '80')
           {
           $protocol = 'http://';
           }


      

function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = array();
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}



         $url = $_SERVER['SERVER_NAME'];


         $link = encrypt_url($link);


         $tar_link = $protocol .$url ."/view_tar.php?=$link"; 

         $tar_link = str_replace(" ","",$tar_link); 



         $tar_link2 = $protocol .$url ."/view_tar_gro.php?=$link"; 

         $tar_link2 = str_replace(" ","",$tar_link2); 



       
      if ($target_type == "specific_target")
          {
      
      $sql_add_target = "insert into targets (admin,target_id,target_real,target_desc,link,
                                last_ip,latitude,longitude,address,fingerprint,
                                all_info,imprint,imprint_status) 
                              values('$admin','$target_nick_name','$target_real_name','$target_desc','$tar_link',
 '0.0.0.0','','','','','','$imprint','OFF')";
      $result_add_targets = $conn->query($sql_add_target);

   if ($result_add_targets == true)
       {

      $sql_add_target2 = "insert into backup_targets (admin,target_id,target_real,target_desc,link,
                                 last_ip,latitude,longitude,address,fingerprint,all_info,imprint) 
                               values('$admin','$target_nick_name','$target_real_name','$target_desc','$tar_link','0.0.0.0','','','','','','OFF')";
      $result_add_targets2 = $conn->query($sql_add_target2);

   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> Target has been registered: Start the investigation </div>";
     echo $mes;
     echo '<meta http-equiv="refresh" content="2;URL=\'targets.php\'">';
       }


  else 
     {
     //echo $conn->error;    
      $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
      echo $mes;
      echo '<meta http-equiv="refresh" content="2;URL=\'cases.php\'">'; 
     // echo $conn->error;
     }


     
     } // end of specific target







     if ($target_type == "group_target")
          {
      
        $length = 24;
        $fingerprint = substr(str_shuffle(md5(time())), 0, $length);
        $finger = "G-" .$fingerprint;


      $sql_add_target = "insert into targets_group (admin,target_id,target_real,target_desc,link,
                                last_ip,latitude,longitude,address,fingerprint,
                                all_info,imprint,imprint_status) 
                         values('$admin','$target_nick_name','$target_real_name','$target_desc',
                                 '$tar_link2','0.0.0.0','','','','$finger','','','')";
      $result_add_targets = $conn->query($sql_add_target);

   if ($result_add_targets == true)
       {

      $sql_add_target2 = "insert into backup_targets_group (admin,target_id,target_real,target_desc,link,
                                                      last_ip,latitude,longitude,address,fingerprint,all_info,imprint) 
                  values('$admin','$target_nick_name','$target_real_name','$target_desc','$tar_link2','0.0.0.0','','','','','','')";
      $result_add_targets2 = $conn->query($sql_add_target2);

   $mes = "<div align='center' id='alertMsg' class='alert alert-success'> Target Group has been registered: Start the investigation </div>";
     echo $mes;
     echo '<meta http-equiv="refresh" content="2;URL=\'targets_group.php\'">';
       }


  else 
     {
     //echo $conn->error;    
      $mes = "<div align='center' id='alertMsg' class='alert alert-danger'> Error! Please try again </ div>";
      echo $mes;
      echo '<meta http-equiv="refresh" content="2;URL=\'cases.php\'">';
     }


     
     } // end of specific target

 


 
 
      } // end of isset submit targets




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



