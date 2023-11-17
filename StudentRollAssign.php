<?php
    include_once 'conn.php';
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
?>
<?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php';  ?>
            <div class="report-container">
                <div class="container">
        <form action = "API/changeRole.php" method="post">
            <table border="1">
            <tr>
                <th>Id</th>
                <td>Name</td>
                <td>Roles</td>
                <td>Action</td>
            </tr>
            <?php
                $sql = "SELECT s.id, s.name, GROUP_CONCAT(r.role_name),GROUP_CONCAT(r.id)
                        FROM tbl_student_info AS s
                        LEFT JOIN tbl_student_role AS sr ON s.id = sr.student_id
                        LEFT JOIN tbl_roles AS r ON sr.role_id = r.id
                        WHERE is_admin = 0 AND s.id = $id
                        GROUP by s.id,s.name;";
                $res = mysqli_query($conn, $sql);
              
                if($res)
                {
                    while($r = mysqli_fetch_array($res))
                    {
                        echo "<input type='hidden' name='id' value='$r[0]'>";
                        echo "<tr>";
                        echo "<td>$r[0]</td>";
                        echo "<td>$r[1]</td>";
                        echo "<td>$r[2]</td>";

                        // Display checkboxes for roles in a single column
                        echo "<td>";
                        $sql1 = "SELECT id,role_name FROM tbl_roles";
                        $res1 = mysqli_query($conn, $sql1);
                        
                        if($res1) 
                        {
                            $existingRoles = explode(',', $r[3]);
                            $first = true; // Variable to keep track of the first radio button

                            while($i = mysqli_fetch_array($res1)) 
                            {
                                if(in_array($i[0], $existingRoles)) 
                                {
                                    echo "<input type='radio' name='roles' value='{$i['id']}' checked> {$i['role_name']}<br>";
                                } 
                                else 
                                {
                                    if ($first) 
                                    {
                                        echo "<input type='radio' name='roles' value='{$i['id']}' checked> {$i['role_name']}<br>";
                                        $first = false; // Set $first to false after the first radio button is printed
                                    } 
                                    else 
                                    {
                                        echo "<input type='radio' name='roles' value='{$i['id']}'> {$i['role_name']}<br>";
                                    }
                                }
                            }
                        }

                        echo "</td>";
                        echo "<td><button type='submit'>Update Role</button></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
        </form>
   </div></div></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" " crossorigin="anonymous"></script>
<script>
    
</script>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #f2f2f2;
    }

    input[type='radio'] {
        margin-right: 5px;
    }

    button {
        padding: 8px 16px;
        background-color: #007bff;
        border: none;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
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