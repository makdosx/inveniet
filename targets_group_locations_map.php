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


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> Target Location </title>


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
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

 if (isset($_POST['map_location']))
      {
       $map_location = input($_POST['map_location']);


       $lat = explode(",", $map_location, 2);
       $lat = $lat[0];

      $text_part1 = strstr($map_location, ',');
      $text_part1 = substr($text_part1, 1);

      $lng = explode("-", $text_part1, 2);
      $lng = $lng[0];

 
      $text_part2 = strstr($text_part1, '-');
      $text_part2 = substr($text_part2, 1);
   

      $target_id = explode("-", $text_part2, 2);
      $target_id = $target_id[0];


      $text_part3 = strstr($text_part2, '-');
      $text_part3 = substr($text_part3, 1);

      $address = explode("-", $text_part3, 2);
      $address = $address[0];
 

      $ip = strstr($text_part3, '-');
      $ip = substr($ip, 1);

    

   $all_info_marker  = "'User fingerprint: "  . $target_id . "<br>" . "IP Address: " . $ip . "<br>"  . "Address: " . $address . "'"; 



    echo'<div id="map"></div>';

  echo"
    <script>

      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.

      function initMap() {
        var uluru = {lat: $lat, lng: $lng};
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeId: 'hybrid',
          zoom: 16,
          center: uluru
        });

       var contentString = $all_info_marker;

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'Location Device'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
    </script>";


 } // end of isset submit location


} // end of else connect

$conn->close();

?>


    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initMap"></script>"

  </body>
</html>
