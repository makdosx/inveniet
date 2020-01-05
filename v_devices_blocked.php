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


else
{


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

$device_id = $_SERVER["REMOTE_ADDR"];


$sql_devices_blocked = "select device_id from devices_blocked where admin = '$admin'";
$result_devices_blocked = $conn->query($sql_devices_blocked);


   while ($row_devices_blocked = $result_devices_blocked->fetch_array(MYSQLI_NUM))
          {
           
          $device_id2 = $row_devices_blocked[0];
 
       if ($device_id == $device_id2)
           {
          print 'This device is blocked ';
          exit;
          }

    } // end of while devices blocked


} // end of else conect



$conn->close();

} // end of else login session

?>
