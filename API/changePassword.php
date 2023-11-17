<?php
    include_once '../conn.php';
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        
        $oldpass = $data['old_pass'];
        $newpass = $data['new_pass'];
        
        $hasOldPass = md5($oldpass);
        $sql = "select * from tbl_student_info where id= $id AND password = '$hasOldPass';";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0)
        {
            
            
            $hasNewPass = md5($newpass);
            $sql1 = "UPDATE tbl_student_info SET password = '$hasNewPass' WHERE id = $id";
            $res1 = mysqli_query($conn,$sql1)or die("Query Failed");
            
            if($res1)
            {
                session_unset();
                session_destroy();
                http_response_code(200); // Set status code to 200 (OK)
                echo json_encode(["status"=>"Password Changed!","userID"=>$id]);
            }
        }
        else 
        {
            http_response_code(401); // Set status code to 401 (Unauthorized)
            echo json_encode(["status"=>"Incorrect Old password !","userID"=>$id]);
        }
    }
    else 
    {
        http_response_code(400);
        echo json_encode(["status"=>"Failed, please login first!"]);
    }

//echo json_encode($data);

