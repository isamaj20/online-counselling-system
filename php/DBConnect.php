<?php

 /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$host="localhost";
$user="root";
$password="your-db-password";//or leave blank if no password
$dbName="your-db-name"; //database name you created
$mysqli= new mysqli($host,$user,$password, $dbName);
//mysqli_select_db($con,$dbName);