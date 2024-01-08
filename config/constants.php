<?php
    //Start Session
    session_start();

    //Create Constants to store Non repeating Values
       define('SITEURL', 'http://localhost/dr%c3%a6st%c9%aakWeb/');
       define('LOCALHOST', 'localhost');
       define('DB_USERNAME', 'root');
       define('DB_PASSWORD', '');
       define('DB_NAME', 'clothes-order');


       $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//DB connection
       $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//Selecting DB


?>