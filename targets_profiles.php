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


<html>
<head>

<meta charset="utf-8">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

       	<title> Inveniet </title> 



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">



<style>

body{
   /* background: -webkit-linear-gradient(left, #3931af, #00c6ff);*/
background: #141A00;
}
.emp-profile{
    height: 80%;
    width: 100%;
    padding: 4%;
    margin-top: 2%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 80%;
    height: 30%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}

</style>


</head>


<body>


<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// if(isset($_POST['target_profile_id']))
   //  {

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

 define("TARGET_PROFILE_ID",input($_POST['target_profile_id']));     

 //define("TARGET_PROFILE_ID", $target_profile_id);
 
//echo TARGET_PROFILE_ID;
 
  
 $sql_profil = "select * from targets where admin = '$admin' 
                         and target_id ='" . TARGET_PROFILE_ID . "' 
                         and last_ip != '0.0.0.0' "; 
 $result_profil = $conn->query($sql_profil); 



   while ($row_profil = $result_profil->fetch_assoc())
          { 
         $instant  = $row_profil['instant'];
         $target_id =  $row_profil['target_id']; 
         $target_real =  $row_profil['target_real']; 
         $target_desc =  $row_profil['target_desc']; 
         $link = $row_profil['link']; 
         $link= wordwrap($link, 30, "\n", true);
         $link = htmlentities($link);
         $link = nl2br($link);
         $last_ip   = $row_profil['last_ip'];
         $location  = $row_profil['latitude']  .' , ' .$row_profil['longitude'];
         $location2  = $row_profil['latitude']  .','.$row_profil['longitude'];
         $location_on_map = $row_profil['latitude']  .',' .$row_profil['longitude'] .'-' .$row_profil['target_id'] .'-' .$row_profil['address'] .'-' .$row_profil['last_ip'];



echo"
<div class='container emp-profile'>
            <form method='post'>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='profile-img'>
                            <img src='assets/img/prof1.png'>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='profile-head'>
                                    <h5>
                                       ID: $target_id
                                    </h5>
                                    <h6>
                                      Full Name: $target_real
                                    </h6>
                                    <p class='proile-rating'> CRIME : <span> Pedophilia </span></p>
                            <ul class='nav nav-tabs' id='myTab' role='tablist'>
                                <li class='nav-item'>
                                    <a class='nav-link active' id='home-tab' data-toggle='tab' role='tab' aria-controls='home' aria-selected='true'> 
                               <img src='assets/img/prof4.png' height='30' width='20%'>
                                  &nbsp; &nbsp;
                            Criminal card: &nbsp; &nbsp; Investigation Results: 
                                   </a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>

                    <div class='col-md-2' align='left'>
                          <img src='assets/img/prof3.png' height='90' width='110'>
                    </div>


                </div>
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='profile-work'>
                            <p> Description </p>
                            <a>  $target_desc </a>
                            <p> Tracking Link </p>
                            <a> $link </a>
                        </div>
                    </div>
                    <div class='col-md-8'>
                        <div class='tab-content profile-tab' id='myTabContent'>
                            <div class='tab-pane fade show active' id='home' role='tabpanel' aria-labelledby='home-tab'>
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label> Target ID </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p>  $target_id </p>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label> Real Name </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p>  $target_real </p>
                                            </div>
                                        </div>


                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label> Instant </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p>  $instant </p>
                                            </div>
                                        </div>


                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label> Fingerprint </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p> $last_ip </p>
                                            </div>
                                        </div>


                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label> Coordinates </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p> $location </p>
                                            </div>
                                        </div>
 

                                       <div class='row'>
                                            <div class='col-md-6'>
                                                <label> <font size='6'> Internal Map </font>  </label>
                                            </div>
                                            <div class='col-md-6'>
                                                <p>   

                          <form>
                   
                          </form>

  <form action='targets_locations_map.php' method='post' target='_blank'>
                             <button type='submit' name='map_location' class='btn btn-primary btn-sm' value='$location_on_map'> View Target <i class='fa fa-eye'></i> 
                           </button>
                          </form>

                          </form>

                                  </p>
                                            </div>
                                        </div>

                                      <div class='row'>
                                            <div class='col-md-6'>
                                                <label> <font size='6'> External Map </font>  </label>
                                            </div>
                                            <div class='col-md-6'>
                                        
                                                <p> 
                     
                          <form>
                   
                          </form>

  <form action='https://www.mapquest.com/latlng/$location2?zoom=16' target='_blank'>
                             <button type='submit' class='btn btn-primary btn-sm'>  
                              View Target <i class='fa fa-eye'></i> 
                           </button>
                          </form>

                          </form>
                                            </p>
                                            </div>
                                        </div>


                            </div>


                          <!--
                              <br><br>               
                                    
                       <div align='left'>
                         <img src='assets/img/prof5.jpg' height='60' width='15%'> 
                               &nbsp; 
                         <img src='assets/img/prof6.png' height='60' width='15%'>
                              &nbsp;
                            <img src='assets/img/prof6.jpg' height='60' width='15%'>
                        </div>
                        -->
 
                        </div>
                    </div>
                </div>
            </form>           
        </div>";


    } // end of while

 
 } // end else of connect


// } // end if isset target profile

?>

</body>
</html>

