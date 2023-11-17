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
    <title>Permission Page</title>
    <!-- Add your custom styles here -->
    <link rel="stylesheet" href="CSS/style.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
            <div class="main" style="width:70%">
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Permission</h2>
                    </div>
                    <div class="card-body">
                        <form id="perfrm" method="post">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" onchange = 'GetRole(this.value)'>
                                    <option value="0">Select Role</option>
                                    <?php
                                    $rid = '';
                                    if(isset($_GET['r_id']))
                                    {
                                        $rid = $_GET['r_id'];
                                        
                                    }
                                    
                                        $sql = "select id, role_name as name from tbl_roles ";
                                        $res = mysqli_query($conn,$sql);
                                        if($res)
                                        {
                                            while($r = mysqli_fetch_assoc($res))
                                            {
                                                if($rid == $r['id'])
                                                {
                                                    echo "<option  value='$r[id]'  name='$r[id]' selected>$r[name]</option>";
                                                }
                                                else 
                                                {
                                                    echo "<option  value='$r[id]'  name='$r[id]'>$r[name]</option>";
                                                }
                                                
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="per">Permission</label>
                                <?php
                                if(isset($_GET['r_id'])) {
                                    $r_id = $_GET['r_id'];

                                    $sql1 = "SELECT p.id, p.name, rp.permission_id
                                             FROM tbl_permission AS p
                                             LEFT JOIN tbl_role_Permission AS rp ON rp.permission_id = p.id AND rp.role_id = $r_id;";

                                    $res1 = mysqli_query($conn, $sql1);

                                    if($res1) {
                                        while($r1 = mysqli_fetch_assoc($res1)) {
                                            echo "<div class='form-check'>";
                                            echo "<input class='form-check-input' type='checkbox' name='permissions[]' value='$r1[id]' id='permission$r1[id]'";

                                            if($r1['permission_id']) {
                                                echo " checked";
                                            }

                                            echo ">";
                                            echo "<label class='form-check-label' for='permission$r1[id]'>$r1[name]</label>";
                                            echo "</div>";
                                        }
                                    }
                                }
                                ?>
                            </div>

                            <button type="submit" class="btn btn-primary" name="addper">Update</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="text-center">Role and Permissions List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql1 = "SELECT r.id, r.role_name, GROUP_CONCAT(p.name) as permissions
                                                FROM tbl_roles AS r
                                                LEFT JOIN tbl_role_permission AS rp
                                                ON r.id = rp.role_id
                                                LEFT JOIN tbl_permission AS p
                                                ON p.id = rp.permission_id
                                                GROUP BY r.id, r.role_name;";
                                    $res1 = mysqli_query($conn,$sql1);
                                    if($res1)
                                    {
                                   
                                        while($row = mysqli_fetch_array($res1))
                                        {
                                            echo '<tr>';
                                           echo "<td>$row[0]</td>";
                                           echo "<td>$row[1]</td>";
                                           echo "<td>$row[2]</td>";
                                           echo '</tr>';
                                        
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div></div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        function GetRole(r_id)
            {
                window.location="permission.php?r_id="+r_id;
            }
        $(document).ready(function() 
        {
            
            
            //************* ADD NEW PERMISSION **********//
            $("#perfrm").submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                console.log(formData);
                $.ajax({
                    url:'API/addPermission.php',
                    type:'post',
                    data:formData,
                    success:function(data) {
                        console.log(data);
                        swal({
                            title: "Permisssion Assigned!",
                            text: "Done!",
                            icon: "success",
                          });
                        setTimeout(()=>{location.reload()},3000);
                        $("#name").val('');
                    },
                    error:function(e) {
                        console.log(e);
                    }
                })
            })
        })
    </script>
</body>
</html>
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