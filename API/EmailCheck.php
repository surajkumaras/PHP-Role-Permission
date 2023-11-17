<?php

include_once '../conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $email = $_POST['email'];
    
    $qry = "select email from tbl_student_info where email = '$email'";
    $res = mysqli_query($GLOBALS['conn'], $qry);
    
    if(mysqli_fetch_row($res)> 0)
    {
        echo "Email already register";
    }
}
