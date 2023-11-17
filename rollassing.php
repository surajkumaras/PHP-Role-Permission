<?php 
    include_once 'conn.php'; 

    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '1')
    {
        
    }
    else 
    {
        header("Location:login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--bootstrap pooper-->
    
    <title>Student Information</title>
</head>
<body>
    <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
            <div class="main" style="width:70%">
                <div class="report-container">     
        <div class="container">
    <div class="row">
        <table id="table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT s.id, s.name, GROUP_CONCAT(r.role_name)
                            FROM tbl_student_info AS s
                            LEFT JOIN tbl_student_role AS sr ON s.id = sr.student_id
                            LEFT JOIN tbl_roles AS r ON sr.role_id = r.id where is_admin = 0
                            group by s.id,s.name;";
                    $res = mysqli_query($conn, $sql) or die("Query Failed");
                    if($res)
                    {
                        while($r = mysqli_fetch_array($res))
                        {
                            echo "<tr>";
                            echo "<td>$r[0]</td>";
                            echo "<td>$r[1]</td>";
                            echo "<td>$r[2]</td>";
                            echo "<td><a href='StudentRollAssign.php?id=$r[0]'><button class='btn btn-info' id='update'>Update</button></td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
                </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $("#table").DataTable();
    });
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