<?php

include_once '../conn.php'; 

if(isset($_SESSION['permissions']['Delete Student']) && $_SESSION['permissions']['Delete Student'] == 'Delete Student' )
{
    
}
else 
{
    
}
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    if(isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
    }
    //$id = $_POST['studentID'];
}

if(isset($_SESSION['is_admin']))  // <--- THIS PAGE ONLY ACCESSABLE BY LOGINED USER ---<<
{
    try
    {
        $admin_type = $_SESSION['is_admin']; 
        if(isset($id))              
        {
           $sql = "DELETE FROM tbl_student_info WHERE id = $id";
            $res = mysqli_query($conn, $sql) or die("Failed");

            if($res)
            {
              // <--- AFTER DELETING, IT WILL REDIRECTED TO USER PAGE IF USER IS ADMIN ELSE LOGIN PAGE ---<<
                if($admin_type === '1')
                {
                    echo "Student Deleted";
                    header("Location:../studentList.php");
                }else 
                {
                    session_unset();
                    session_destroy();
                    echo "User deleted";
                    exit();
                    //header("Location:../login.php");
                }
            }
        }
    } catch (Exception $ex) 
    {
        echo "Error:".$ex;
    }
}
else 
{
    echo "Please login first";
}