<?php

include_once '../conn.php';

try
{
   if($_SERVER['REQUEST_METHOD']=== 'POST')
    {
       
//      print_r($_POST);
//       die();
        $isEmpty = false;
        $msg ="";
        
        if(empty($_POST['username']))
        {
            http_response_code(400);
            $msg .= "<br>Username is required!";
            $isEmpty =true;
        }

        if(empty($_POST['password']))
        {
            http_response_code(400);
            $msg .= "<br>Password is required!";
            $isEmpty =true;
        }

        if($isEmpty)
        {
            echo $msg;
            exit();
        }

        $uname = $_POST['username'];
        $pass = md5($_POST['password']);

        
        $sql = "select id,name,email,password,is_admin from tbl_student_info where email = '$uname' AND password = '$pass'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0)
        {
            $data = mysqli_fetch_assoc($res);
            if($data)
            {
                $id = $data['id'];
                $qry = "SELECT role_id from tbl_student_role WHERE student_id = $id;";
                $res = mysqli_query($conn,$qry);
                
                if($res)
                {
                    //******** FETCH ROLE ID***********//
                    while($r = mysqli_fetch_array($res))
                    {
                        $_SESSION['role_id'] = $r[0];
                    }
                    
                    if(isset($_SESSION['role_id'])) 
                    { 
                        $role_id = $_SESSION['role_id']; 
                    }
                   
                    $sql = "select rp.permission_id, p.name
                    from tbl_role_permission AS rp 
                    join tbl_permission AS p 
                    on rp.permission_id = p.id where role_id = $role_id";

                    $res = mysqli_query($conn,$sql)or die("Query failed"); 
                    // Store the permissions in an associative array with the module code as the key and the description as the value 

                    $permissions = array(); 
                    while($row = mysqli_fetch_assoc($res))
                    { 
                        $permissions[$row['name']] = $row['name']; 

                    } 
                    // Store the permissions array in the session 
                    $_SESSION['permissions'] = $permissions;
                }
                
                
                 $_SESSION['name'] = $data['name'];
                 $_SESSION['id'] = $data['id'];
                 $_SESSION['is_admin'] = $data['is_admin'];

                echo "Login Successfully";
                
            }
            else 
            {
                http_response_code(400);
            echo "Invalid Username or Password!";
            }
        }
        else 
        {
            http_response_code(400);
            echo "Invalid Username or Password!";
        }
    } 
} catch (Exception $ex) 
{
    echo "Error:".$ex;
}
