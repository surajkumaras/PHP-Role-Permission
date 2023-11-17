<?php

include_once '../conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $mobile = $_POST['mobile'];
    
    $qry = "select mobile from tbl_student_info where mobile = '$mobile'";
    $res = mysqli_query($GLOBALS['conn'], $qry);
    
    if(mysqli_fetch_row($res)> 0)
    {
        echo "This mobile no. already register";
    }
}
