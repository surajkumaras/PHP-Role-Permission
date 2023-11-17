<?php
include_once '../conn.php'; 

if(isset($_POST))                   // <---- CHECK GLOBAL VARIABLE --<<
{
//    echo "<pre>";
//    print_r($_POST);           
//    echo "</pre>";
//    die();

    if(isset($_SESSION['is_admin']) )           // <--- CHECK IS ADMIN SESSION IS CREATED OR NOT ---<<
        {
            if(isset($_SESSION['role_id']))
            {
                $role_id = $_SESSION['role_id'];
                
                $sql_1 = "select role_name FROM tbl_roles WHERE id = $role_id ";
                $res_1 = mysqli_query($conn,$sql_1) or die("Role not found");
                
                if($res_1)
                {
                    while($r_name = mysqli_fetch_array($res_1))
                    {
                        $role_name = $r_name[0];
                    }
                }
            }
        if($_SESSION['name'])
        {
            $username = $_SESSION['name'];
        }
        
            
        
        $id = $_SESSION['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $city = $_POST['city'];
        $gender = $_POST['gender'];
        $cls = $_POST['stream'];
        $subjects = $_POST['sub'];                  // <---- ARRAY DATA -----<<
        
        try
        {
            date_default_timezone_set('Asia/Kolkata');  // <--- TO CHANGE DEFAULT TIMEZONE TO INDIA ---<<
            $currentDateTime = date('Y-m-d H:i:s');
            $qry = "UPDATE tbl_student_info SET name= '$name', age = $age , email = '$email', mobile = '$mobile',city = '$city',gender = '$gender', course = '$cls',last_updated_by = '$role_name($username)',updated_at = '$currentDateTime'  where id = $id";
            $res = mysqli_query($conn,$qry) or die("Failed to update");
            if($res)
            {
                // Delete previous record of the student from tbl_student_subject
                $qry1 = "DELETE FROM tbl_student_subject where student_id = $id"; 
                $res1 = mysqli_query($conn,$qry1);

                if($res1)
                {
                    //Now inserting updated data with previous data into tbl_student_subject
                    foreach ($subjects as $value)
                    {
                        $sql2 = "INSERT INTO tbl_student_subject(student_id,subject_id) VALUES($id,$value)";
                        $res2 = mysqli_query($conn,$sql2) or die("Failed to Insert into db");
                    }

                    if($usertype === '0')
                    {
                        ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                           swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Aww yiss!",
                              });
                              window.location.href="../profile.php";
                        </script>
                        
                        
                        <?php
                    }
                    else 
                    {
                        ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                           swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Aww yiss!",
                              });
                              window.location.href="../studentList.php";
                        </script>
                        
                        
                        <?php
                        
                    }
                }
                else 
                {
                    echo "Failed to delete";
                }
            }
        } 
        catch (Exception $ex) {
            echo "Error:".$ex;
        }
    }
    else 
    {
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: $previousPage");
        exit;
    }
}

?>