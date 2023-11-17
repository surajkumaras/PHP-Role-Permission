<?php
session_start();
$hostname = 'localhost';
$uname = 'root';
$upass = '';
$dbname = 'studentsubjectdb';

$conn = mysqli_connect($hostname,$uname,$upass,$dbname);

if($conn)
{
   
}
else 
{
    echo "failed";
}
