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
      
      
$device_bl =  $_SERVER["REMOTE_ADDR"];
$device_ad = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$device_adm = substr($device_ad, strpos($device_ad, "=") + 1);    

$sql_block = "select device_id, admin from devices_blocked";
$result_block = $conn->query($sql_block);
              
              
while ($row_block = $result_block->fetch_assoc())
          {
              
           $device_block = $row_block['device_id'];
           $device_admin = $row_block['admin'];
           
          } // end of while
          
          
          if ($device_block == $device_bl && $device_admin == $device_adm)
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
    //var admin     = window.location.href;

    var str = window.location.href;
    var admin = str.split('=').pop();

    $.ajax({
        type:'POST',
        url:'view.php',
        data:{
             admin : admin, 
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
body
{
background: url(assets/img/view_back.png);
background-repeat: no-repeat;
background-size:100%;
background-position: 50% 50%; 
}


.blink_me {
  animation: blinker 2s linear infinite;
  color: white;
  font-weight: bold;
  font-size: 50px;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

</style>

</head>

<body>
    
     
  <!-- <p>  <span id="location"></span></p> -->


   <!-- <div class="blink_me" align="center"> SEARCH LOCATION </div> -->

</body>
</html>

<?php

  $conn = new mysqli($host,$user,$pass,$db);


$device_id =  $_SERVER["REMOTE_ADDR"];

$last_ip   =  $_SERVER["REMOTE_ADDR"];

$length = 32;
$fingerprint = substr(str_shuffle(md5(time())), 0, $length);


$admin = $_POST['admin'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];



#$send_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude +"," + longitude + "?key=AIzaSyBlB92xDe6fwQJpCBh96Ic6PqpRNVOvnSM&callback=initMap"

#send_url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude +"," + longitude + "&sensor=true/false"

#send_url = "https://geocode.xyz/" + latitude +"," + longitude + "?json=1"

#request = requests.get(send_url)
#json = json.loads(request.text)


#send_url = "https://geocode.xyz/"38.4388185,21.3490225,16"?json=1" 

#address = json['poi']['amenity']



$address = "Here";

$all_info = "{ lat: " . $latitude . ", " . "lng: " . $longitude . ", " . "info: " . "''" . "Device Fingerprint: " . $device_id  . " <br> " . "Address: " . $address . "''" . " }"; 

$imprint = '<font color=green> <b> ON </b> </font>';

    
$sql_mode = "select mode, time_of_renewal from system_settings where mode = 'on' and admin = '$admin'";
$result_mode = $conn->query($sql_mode);

   while ($row_mode = $result_mode->fetch_array(MYSQLI_NUM))
          {

       $mode = $row_mode[0];
       $time_of_renewal = $row_mode[1];
       //$time_of_renewal = floatval($time_of_renewal)
 
           }

   
       if (!empty($admin . $latitude . $longitude))
             {

       $sql_norm_dev = "insert into devices(admin,device_id, last_ip, latitude, longitude, address,
                                            fingerprint, all_info,imprint, imprint_status) 
                                    values  
                               ('$admin','$device_id','$last_ip','$latitude','$longitude','$address',
                                '$fingerprint','$all_info','$imprint','ON')";


       $sql_back_dev = "insert into backup_devices(admin,device_id, last_ip, latitude, longitude, address, fingerprint, all_info,imprint) values ('$admin','$device_id','$last_ip','$latitude','$longitude','$address','$fingerprint','$all_info','ON')";


       $result_norm_dev = $conn->query($sql_norm_dev);
       $result_back_dev = $conn->query($sql_back_dev);

       sleep($time_of_renewal);

           } // check for empty fields
           
           
        } // end if for else block devices
       
               
   // } // end while for chech block devices
    

} // end of else connect

$conn->close();

?>
