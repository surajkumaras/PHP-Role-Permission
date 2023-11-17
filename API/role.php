<?php

include_once '../conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//    print_r($_POST);
//    die();
    
    $role_name = $_POST['name'];
    
    $sql = "insert into tbl_roles(role_name) value('$role_name')";
    $res = mysqli_query($conn,$sql) or die("Query Failed");
    if($res)
    {
        echo "Role Created";
    }
}
