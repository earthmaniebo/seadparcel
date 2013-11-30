<?php   
    $hostname = "localhost";
    $username = "root";
    $password = "maniebo12";
    $testLogin = false;
    
    //connection to the database
    $con = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");       
    
    //selects the database a4361616_sp
    mysql_select_db("seadparcel", $con);
?>