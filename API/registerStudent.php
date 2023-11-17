<?php


include_once '../conn.php';

if(isset($_SESSION['is_admin'])&& $_SESSION['is_admin'] == '1')
{
    $is_admin = 1;
}
    
    if($_SERVER['REQUEST_METHOD']=== 'POST')
    {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender =$_POST['gender'];
        $cls = $_POST['cls'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $mobile = $_POST['mobile'];
        $pass = md5($_POST['pass']);
        
        //$sub = '';
        if(isset($_POST['sub']))
        {
            $sub = $_POST['sub'];   //<----- ARRAY DATA ----<<
        }
          
        
        //  ******************* VALIDATION START **********//
        
        $valid = true;
        $errors = array();
        function test_input($data) 
        {
          $data = trim($data);
          $data = stripslashes($data);
          
          return $data;
        }
                
        if (empty($_POST["name"])) 
        {
            $errors[] = " *Name is required";
            $valid =false;
        }else 
        {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["age"])) 
        {
          $errors[] =  " *Age is required";
          $valid =false;
        } else {
          $age = test_input($_POST["age"]);
        }
        
        if (empty($_POST["gender"])) 
        {
            $errors[] =  " *Gender is required";
            $valid =false;
        }else 
        {
          $gender = test_input($_POST["gender"]);
        }

        if ($_POST["cls"] == "0") 
        {
          $errors[] =  " *Stream is required";
          $valid =false;
        } else {
          $cls = test_input($_POST["cls"]);
        }
        
        if (empty($_POST["email"])) 
        {
            $errors[] = " *Email is required";
            $valid =false;
        }
        elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
            $errors[] =  " *Invalid email format";
            $valid =false;
        }
        else 
        {
          $email = test_input($_POST["email"]);
        }

        if (empty($_POST["city"])) 
        {
          $errors[] =  " *City is required<br>";
          $valid =false;
        } else {
          $city = test_input($_POST["city"]);
        }
        
        if (empty($_POST["mobile"])) 
        {
            $errors[] =  " *Mobile is required";
            $valid =false;
        }else 
        {
          $mobile = test_input($_POST["mobile"]);
        }

        if (empty($_POST["pass"])) 
        {
          $errors[] =  " *password is required";
          $valid =false;
        } else {
          $pass = test_input($_POST["pass"]);
          $pass = md5($pass);
        }
         if (empty($_POST["sub"])) 
        {
          $errors[] = " *Subject is required";
          $valid =false;
        } else {
          $sub = $_POST["sub"];
        }
        
        //**************** EMAIL AND MOBILE VALIDATION SECETION ***************//
        
        
        $qry = "select email,mobile from tbl_student_info where email = '$email' OR '$mobile'";
        $result = mysqli_query($conn,$qry);
        
        if($qry) 
        {
            while($r = mysqli_fetch_array($result)) 
            {
                if($r['email'] === $email) 
                {
                    $errors[] = "Email already exists";
                    
                }

                if($r['mobile'] === $mobile) 
                {
                    $errors[] = "Mobile no. already exists";
                    
                }
            }
        }
        
        //**************** END VALIDATION *******************//
        
        if($valid)
        {
            try{
                $sql = "INSERT INTO tbl_student_info(name,age,gender,course,email,city,mobile,password) VALUES('$name','$age','$gender','$cls','$email','$city','$mobile','$pass')";
                $res = mysqli_query($conn,$sql) or die("Failed");


                if($res)
                {

                    $student_id = mysqli_insert_id($conn);
                    $subjects = $sub ;

                    foreach ($subjects as $value)
                    {
                        $sql2 = "INSERT INTO tbl_student_subject(student_id,subject_id) VALUES($student_id,$value)";
                        $res2 = mysqli_query($conn,$sql2) or die("student subject insertion failed");
                    }

                    $qry3 = "insert into tbl_student_role(student_id,role_id)values($student_id,3)";
                    $res3 = mysqli_query($conn,$qry3);
                    
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '1')
                    {
                        header("location:../studentList.php");
                    }
                    
                    http_response_code(200); // Return a 200 OK status code
                    echo "Registration Done";
                }
                else 
                {
                    http_response_code(500); // Return a 500 Internal Server Error status code
                    echo "No data inserted";
                }


            } 
            catch (Exception $ex) {
                http_response_code(500); // Return a 500 Internal Server Error status code
                echo "Error:$ex";
            }
        }
        else 
        {
            http_response_code(400);
            $errors = json_encode($errors);
            //print_r($errors);
            echo $errors;
        }
    }
    
?>
