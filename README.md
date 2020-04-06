# inveniet
To inveniet is a program for locating computers tablets and mobile phones

Details inveniet <br><br>
finding location of computers, latops, tablets  and mobile phones <br>
Live follow-up of multi-device locations <br>
plan of all devices connected to the system <br>
plan of the device separately on the map <br>
device search <br>
block any device <br>
set time for sending the locations <br>

1) Installation instructions <br><br>
   
  i) Import the file database.sql from sql folder to your database system <br>
  ii) View locations in map save to 9 locations <br>
      For view multiple locations <br>
      INSERT into phpmyadmin from administrator account <br>
      Go to home and go to variables tab <br>
      Insert end find group_concat_max_len <br>
      Press edit and change value <br>
      SET variables group_concat_max_len = 1000000; <br>
  iii) Copy the inveniet program and paste in one folder into /var/www/ <br>
  iiv) The inveniet program is ready for use <br><br> <br>
  
 
2) To find the location of the devices <br><br>
   
   i) Send the following link to the user you want to locate <br>
      The link is your url and your username api key <br>
      
      example url: https://localhost/view.php?=makdosx <br><br>      
      
  ii) Create case for track a target <br>
      The link is your url and your set target name <br><br>
      Create case for track a target group <br>
      The link is your url and your set target group name <br><br>
      After find tha target or target groups view results <br>
      The results is ip,instant, longitude and latitude and other informations <br>
      The informations of this links are encrypted <br>
      Example url target:  https://192.168.2.30/view_tar.php?=Vrqit4ytnKysj6rApr6%2B <br>
      Example url target group: https://192.168.2.30/view_tar_gro.php?=Vrqit4yepZppYpQ%3D <br>
      
     

      
   iii)  Find tablet and mobile phone location <br>
    To run the program on tablets and mobile phones, the user should have an Internet connection such as wifi or cellular data and have opened its location or the gps to your find its exact location <br><br>
   
   iv) Finding a Computer Location <br>
   To identify computers and laptops you need one connection to the Internet. The location here may vary a few meters because you do not use gps as on tablets and cell phones <br><br>
  
![screenshots/0](screenshots/0.png) <br><br>
![screenshots/1-1](screenshots/1-1.png) <br><br>
![screenshots/2-2](screenshots/2-2.png) <br><br>
![screenshots/3-3](screenshots/3-3.png) <br><br>
![screenshots/4-4](screenshots/4-4.png) <br><br>
![screenshots/5-5](screenshots/5-5.png) <br><br>
![screenshots/6-6](screenshots/6-6.png) <br><br>
![screenshots/8-8](screenshots/8-8.png) <br><br>
![screenshots/2](screenshots/2.png) <br><br>
![screenshots/3](screenshots/3.png) <br><br>
![screenshots/4](screenshots/4.png) <br><br>
![screenshots/5](screenshots/5.png) <br><br>
![screenshots/6](screenshots/6.png) <br><br>
![screenshots/7](screenshots/7.png) <br><br>
![screenshots/8](screenshots/8.png) <br><br>
