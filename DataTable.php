<?php
    include_once 'conn.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php';  ?>
            
                <div class="report-container">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Roll No.</th>
                <th scope="col">Student Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Class</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">City</th>
                <th scope="col">Subjects</th>
                <th scope="col">Action</th>
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
                                echo "<td>$r[0]</td>";
                                echo "<td>$r[1]</td>";
                                echo "<td>$r[2]</td>";
                                echo "<td>$r[3]</td>";
                                echo "<td>" . strtoupper($r[4]) . "</td>";
                                echo "<td>$r[5]</td>";
                                echo "<td>$r[6]</td>";
                                echo "<td>$r[7]</td>";
                                echo "<td>$r[8]</td>";
                                echo "<td><a href='updatestudent.php?id=$r[0]'><button class='btn btn-info' >Edit</button></a>&nbsp<a class='deleteButton'  href='#'><button class='btn btn-danger'>Delete</button></a></td>";
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
                </div></div></div>
        
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
