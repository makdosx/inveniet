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



  class data
    {
    public $connect = array();

    public function __construct()
        {
          $this->connect[0]="host";
          $this->connect[1]="username";
          $this->connect[2]="password";
          $this->connect[3]="database";
           }


   public function __destruct()
        {
         $this->connect[0]=null;
         $this->connect[1]=null;
         $this->connect[2]=null;
         $this->connect[3]=null;
           }


      } // end of coonect class
  


   class security extends data
       { 
        public $connect = array();

        public function __construct()
           {
          $this->connect[0]="host";
          $this->connect[1]="username";
          $this->connect[2]="password";
          $this->connect[3]="database";
         } // end of class extends of connect with parent and child


       public function __destruct()
        {
         $this->connect[0]=null;
         $this->connect[1]=null;
         $this->connect[2]=null;
         $this->connect[3]=null;
           }


    }       
 
 
?>  

