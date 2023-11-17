<?php
    include_once 'conn.php';
    
    
    $id;
    if(isset($_SESSION['is_admin']))
    {
        if($_SESSION['is_admin'] === '0')
        {
            $id = $_SESSION['id'];
        }
        else 
        {
            header("Location:login.php");
        }
    }
    else 
    {
        header("Location:login.php");
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"  crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <title></title>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
        <!--Sweet alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
            <div class="main" style="width:70%">
            
        
        <?php
                
                $sql = "SELECT 
                        student.id, student.name, student.age, student.gender, student.course,
                        student.email, student.mobile, student.city, student.last_updated_by, student.updated_at,
                        GROUP_CONCAT(subject.name) as subjects,r.role_name
                    FROM 
                        tbl_student_info AS student
                    JOIN 
                        tbl_student_subject AS ss ON student.id = ss.student_id
                    JOIN 
                        tbl_subjects AS subject ON ss.subject_id = subject.id
                     LEFT JOIN
                        tbl_roles AS r ON r.id = (SELECT role_id from tbl_student_role WHERE student_id = $id )
                    WHERE 
                        student.id = $id
                    GROUP BY 
                        student.id;";
                $res = mysqli_query($conn,$sql);
                
                if($res)
                {
                    while($r = mysqli_fetch_array($res)) // <-- FETCH USERS DETAILS ---<<
                    {
        ?>
        <div class="student-profile py-4">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <img class="profile_img" src ="images/user1.jpeg" alt="student dp">
                      <h3><?php echo $r[1] ?></h3>
                    </div>
                    <div class="card-body">
                      <p class="mb-0"><strong class="pr-1">Student ID:</strong>STUDENT00<?php echo $r[0] ?></p>
                      <p class="mb-0"><strong class="pr-1">Age:</strong><?php echo $r[2] ?></p>
                      <p class="mb-0"><strong class="pr-1">Gender:</strong><?php echo $r[3] ?></p>
                      
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                      <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                    </div>
                    <div class="card-body pt-0">
                      <table class="table table-bordered">
                        <tr>
                          <th width="30%">Roll</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[0] ?></td>
                        </tr>
                        <tr>
                          <th width="30%">Class</th>
                          <td width="2%">:</td>
                          <td><?php echo strtoupper($r[4]) ?></td>
                        </tr>
                        <tr>
                          <th width="30%">Role</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[11] ?></td>
                        </tr>
                        <tr>
                          <th width="30%">Email</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[5] ?></td>
                        </tr>
                        <tr>
                          <th width="30%">Mobile no.</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[6] ?></td>
                        </tr>
                        <tr>
                          <th width="30%">City</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[7] ?></td>
                        </tr>
                        <tr>
                          <th width="30%">Subjects</th>
                          <td width="2%">:</td>
                          <td><?php echo $r[10] ?>
                              
                          </td>
                        </tr>
                        <tr>
                            <th width="30%">
                                <a href="editStudent.php?id=<?php echo $r[0]; ?>"><button type="button" class="btn btn-primary" >Edit</button></a>
                                <a ><button class="btn btn-danger" id="delete">Delete</button></a></th>
                            <td width="2%">:</td>
                            <td>Last Updated_at :<b><?php echo $r[9] ?></b>| Updated by:<b> <?php echo $r[8] ?></b></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                    <div style="height: 26px"></div>
                </div>
              </div>
            </div>
          </div>
        <?php
             }   // <--- CLOSE WHILE LOOP ---<<
           }     // <--- CLOSE IF BLOCK ----<<
        ?>
            </div></div>
    </body>
</html>

<script>
$(document).ready(function()
{
    
    $("#delete").click(function()
    {
        console.log("ok");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) 
            {
              swal("Poof! Your imaginary file has been deleted!", 
              {
                icon: "success",
              });
              
              //************** AJAX CODE IF CONFIRM DELETE ******//
              $.ajax({
                    url:'API/deleteStudent.php',
                    type:'post',
                    success:function(data)
                    {
                        console.log(data);
                        window.location.href="login.php";
                        
                    },
                    error:function(e)
                    {
                        console.log(e);
                    }
                })
              
            } else {
              swal("Your imaginary file is safe!");
            }
          });
          
        //let id = $("#").val();
        
        
    })
})
</script>
<style>
body 
    {
        background-image: url("images/edu2.jpeg");
        background-repeat: no-repeat;
    }
    .report-container
    {
        opacity: 0.6;
    }
</style>