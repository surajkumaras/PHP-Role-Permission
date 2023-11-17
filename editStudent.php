<?php
    include_once 'conn.php';
    
    if(isset($_SESSION['is_admin']))
        { 
            
        }
        else
        { 
            header("location:index.php"); 
        }
    
    $id = '';
    if(isset($_GET['id']) && !empty($_GET['id'])) 
    {
        $id = (int)$_GET['id'];
        $_SESSION['id'] = $id;
        
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"  crossorigin="anonymous">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php';  ?>
            <div class="main" style="width:70%">
                <div class="report-container">
        <div class="container">
            <center><h2>Update Student Details</h2></center>
        <form action="API/updateStudent.php" method="post">
            <?php
                $sql = "SELECT 
                        student.id, student.name, student.age, student.gender, student.course,
                        student.email, student.mobile, student.city, 
                        GROUP_CONCAT(subject.name) as subjects
                    FROM 
                        tbl_student_info AS student
                    JOIN 
                        tbl_student_subject AS ss ON student.id = ss.student_id
                    JOIN 
                        tbl_subjects AS subject ON ss.subject_id = subject.id
                    WHERE 
                        student.id = $id
                    GROUP BY 
                        student.id";
                $res = mysqli_query($conn,$sql);
                if($res)
                {
                    while($r = mysqli_fetch_assoc($res))
                    {
                    
            ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="id" value="<?php echo $id  ?>"/>
                        <label for="inputEmail4">Student Name</label>
                        <input type="text" class="form-control" id="inputEmail4" name="name" value="<?php echo $r['name'];  ?>" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Age</label>
                        <input type="text" class="form-control" id="inputPassword4" value="<?php echo $r['age'];  ?>" name="age" placeholder="Age" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" value="<?php echo $r['email'];  ?>" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Mobile</label>
                        <input type="text" class="form-control" id="inputPassword4" value="<?php echo $r['mobile'];  ?>" name="mobile" placeholder="Mobile" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" name="city" value="<?php echo $r['city'];  ?>" id="inputCity" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($r['gender'] == 'male') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo ($r['gender'] == 'female') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                </div>
                 <div class="form-row">
                     <label for="inputCity">Class</label>
                    <select class="form-control" name="stream">
                        <option value="0">Select Stream</option>
                        <option value="bca" <?php echo ($r['course'] == 'bca') ? 'selected' : ''; ?>>BCA</option>
                        <option value="btech" <?php echo ($r['course'] == 'btech') ? 'selected' : ''; ?>>BTECH</option>
                        <option value="msc" <?php echo ($r['course'] == 'msc') ? 'selected' : ''; ?>>MSC</option>
                        <option value="mca" <?php echo ($r['course'] == 'mca') ? 'selected' : ''; ?>>MCA</option>
                      </select>
                </div>
                <div class="form-group">
                    <label>Subjects</label><br>
                    <?php 
                                //var_dump($r['subjects']);
                        include_once 'conn.php';
                        $result = mysqli_query($conn,"SELECT * FROM tbl_subjects");

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $subject_id = $row['id'];
                                $subject_name = $row['name'];
                                
                                
                                $checked = (in_array($subject_name, explode(',', $r['subjects']))) ? 'checked' : '';

                                echo "<div class='form-check form-check-inline'>";
                                echo "<input class='form-check-input' type='checkbox' name='sub[]' id='subject_$subject_id' value='$subject_id' $checked>";
                                echo "<label class='form-check-label'>$row[name]</label>";
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="<?php if($_SESSION['is_admin'] == '0'){ echo "profile.php";}else{echo "studentList.php";}  ?>"><button type="button" class="btn btn-secondary" >Cancel</button></a>
                <?php
                        
                        }
                    }
                ?>
                
        </div></div></div>
            </form>
        </div>
    </body>
</html>
<style>
    
    body {
/*    background: #67B26F;   fallback for old browsers 
    background: -webkit-linear-gradient(to right, #4ca2cd, #67B26F);   Chrome 10-25, Safari 5.1-6 
    background: linear-gradient(to right, #4ca2cd, #67B26F);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    padding: 0;
    margin: 0;
    font-family: 'Lato', sans-serif;
    color: #000;
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