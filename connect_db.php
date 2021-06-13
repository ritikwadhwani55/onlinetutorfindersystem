<?php
    $username="root";
    $password="";
    $database="onlinetutorsystem";
    $servername="localhost:3307";
    $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("connection to this database failed due to" . mysqli_connect_error());
    }

?>