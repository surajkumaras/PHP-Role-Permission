<?php
    include_once 'conn.php';
    
    if(isset($_SESSION['permissions']['View Students']) && $_SESSION['permissions']['View Students'] == 'View Students')
        { 
            
        }
        else
        { 
            header("location:index.php"); 
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="main-container">
            
            <?php include_once 'sidenav.php';  ?>
            <div class="main" style="width:100%">
                <div class="report-container">
                    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="d-none d-sm-table-cell">Roll No.</th>
                <th scope="col" class="d-none d-sm-table-cell">Student Name</th>
                <th scope="col" class="d-none d-sm-table-cell">Age</th>
                <th scope="col" class="d-none d-sm-table-cell">Gender</th>
                <th scope="col" class="d-none d-sm-table-cell">Class</th>
                <th scope="col" class="d-none d-sm-table-cell">Email</th>
                <th scope="col" class="d-none d-sm-table-cell">Mobile</th>
                <th scope="col" class="d-none d-sm-table-cell">City</th>
                <th scope="col" class="d-none d-sm-table-cell">Subjects</th>
                <th scope="col" class="d-none d-sm-table-cell">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $sql ="SELECT student.id, student.name, student.age, student.gender, student.course, student.email, student.mobile, student.city, GROUP_CONCAT(subject.name) as subjects FROM tbl_student_info AS student JOIN tbl_student_subject AS ss ON student.id = ss.student_id JOIN tbl_subjects AS subject ON ss.subject_id = subject.id GROUP BY student.id;";
                    $res = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($res)>0)
                    {
                        while($r = mysqli_fetch_array($res))
                        {
                            echo "<tr>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[0]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[1]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[2]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[3]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>" . strtoupper($r[4]) . "</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[5]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[6]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[7]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>$r[8]</td>";
                                echo "<td scope='col' class='d-none d-sm-table-cell'>";
                                if(isset($_SESSION['permissions']['Edit Student']) && $_SESSION['permissions']['Edit Student'] == 'Edit Student')
                                {
                                    echo "<a><button class='btn btn-info edit-student' student-id = '$r[0]'>Edit</button></a>";
                                }
                                
                                if(isset($_SESSION['permissions']['Delete Student']) && $_SESSION['permissions']['Delete Student'] == 'Delete Student')
                                {
                                    echo "&nbsp<button class='btn btn-danger delete-student' student-id = '$r[0]'>Delete</button></td>";
                                }
                                
                            echo "</tr>";
                        }
                    }
                    else 
                    {
                        echo "No record found!";
                    }
                ?>
            </tbody>
          </table>
                    </div></div></div></div></div>
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JS -->
        
        <script>
            $(document).ready(function()
            {
                $(".table").DataTable();
            })
        </script>
    </body>
</html>
<script>
    $(document).ready(function()
    {
        
        
        //**************** SHOW STUDENT LIST ***********//
        showStudentAll();
        $(".table").DataTable();
        function showStudentAll()
        {
            $.ajax({
                url:'API/showAllStudents.php',
                headers: {'Content-Type': 'application/json'},
                success:function(data)
                {
                    console.log(data);
                    var dataBody = $('#dataBody');
                            var output = "";
                            console.log(data.length)
                            console.log(data)
                            for(let i=0;i< data.length;i++)
                            {
                                output += "<tr><td>"+data[i].id+"</td><td>"+data[i].name+
                                        "</td><td>"+data[i].age+"</td><td>"+data[i].gender+
                                        "</td><td>"+data[i].course+"</td><td>"+data[i].email+
                                        "</td><td>"+data[i].mobile+"</td><td>"+data[i].city+
                                        "</td><td>"+data[i].subjects+"</td><td><button class='btn btn-warning edit-student' student-id="+data[i].id+
                                        ">Update </button><button class='btn btn-danger delete-student' student-id="+data[i].id+">Delete</button>";

                                    
                            }

                            dataBody.html(output);
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
        }
        
        
        //**************** DELETE STUDENT **************//
        
        $(document).on('click', '.delete-student', function() 
        {
            <?php  if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] =='0') { ?>
                  swal({
                        title: "You don't allow to delete this!",
                        text: "You clicked the button!",
                        icon: "error",
                      });      
            <?php }else{ ?>
            var studentID = $(this).attr('student-id');

            console.log(studentID);
            
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) 
                    {
                      swal("Poof! Student record has been deleted!", {
                        icon: "success",
                
                        
                      });
                      window.location.href="API/deleteStudent.php?id="+studentID;
                    } 
                    else {
                      swal("Student data safe!");
                    }
                  });
                  
           <?php }?>
        });
        
        //**************   EDIT-UPDATE STUDENT *********//
        
        $(document).on('click', '.edit-student', function()
        {
           
            <?php if(isset($_SESSION['permissions']['Edit Student']) && $_SESSION['permissions']['Edit Student'] == 'Edit Student') {  ?>
                    let id = $(this).attr('student-id');
                    window.location.href="editStudent.php?id=" +id;
            <?php }else { ?>
                
                       swal({
                        title: "You don't allow to edit this!",
                        text: "You clicked the button!",
                        icon: "error",
                      }); 
            <?php }?>
        });
        
        //**************** ADD NEW STUDENT *************//
        
        $(document).on('click','.add-student',function()
        {
            window.location.href="studentRegister.php";
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
    
    .table-responsive {
    overflow-x: auto;
}
</style>