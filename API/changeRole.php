<?php
include_once '../conn.php';
//print_r($_POST);
//die();


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try
    {
        $id = $_POST['id'];

        if(isset($_POST['roles']))
        {   
            $role_id = $_POST['roles'];
            $check = "select * from tbl_student_role where student_id = $id";
           
            $resu = mysqli_query($conn, $check);
            if(mysqli_num_rows($resu) > 0)
            {
               // $qry = "delete from tbl_student_role where student_id = $id";
                $qry = "UPDATE tbl_student_role SET role_id = $role_id WHERE student_id = $id " ;
                $result = mysqli_query($conn,$qry) or die("Query Failed");
                if($result)
                {
                    header("Location:../rollassing.php");
                }
            }
            else 
            {
                $sql = "insert into tbl_student_role(student_id,role_id)values($id,$role_id)";
                $res = mysqli_query($conn,$sql)or die("Query Failed");

                if($res)
                {
                    header("Location:../rollassing.php");
                }
            }
        }
        else 
        {
            $qry = "delete from tbl_student_role where student_id = $id";
            $result = mysqli_query($conn,$qry) or die("Query Failed");

            if($result)
            {
                header("Location:../rollassing.php");
            }
        }
    
    } catch (Exception $ex) {
        echo $ex;
    }
}