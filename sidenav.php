<?php include_once 'conn.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/responsive.css">
    </head>
    <body>
        <div class="navcontainer">
            <nav class="nav" style="width:259px">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
                                class="nav-img"
                                alt="dashboard">
                        <h3> 
                        <?php  
                        if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == '1')
                        {
                            echo "Head Boy";
                        }
                        elseif(isset($_SESSION['role_id']) && $_SESSION['role_id'] == '2')
                        {
                            echo "CR";
                        }
                        elseif(isset($_SESSION['role_id']) && $_SESSION['role_id'] == '3')
                        {
                            echo "Normal User";
                        }
                        elseif(isset($_SESSION['role_id']) && $_SESSION['role_id'] == '4')
                        {
                            echo "Admin";
                        }
                        else 
                        {
                            echo "Dashboard";
                        }
                        ?>
                        
                        </h3>
                    </div>
                    <?php  if(isset($_SESSION['permissions']['View Students']) && $_SESSION['permissions']['View Students'] == 'View Students')
                    {  ?>
                    <div class="option2 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
                                class="nav-img"
                                alt="articles">
                        <h3 id='studentList'> Students</h3>
                    </div>
                    <?php  } ?>
                    
                    <?php  if(isset($_SESSION['permissions']['Add Student']) && $_SESSION['permissions']['Add Student'] == 'Add Student') {  ?>    
                    <div class="option2 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
                                class="nav-img"
                                alt="articles">
                        <h3 id='addStudent'>Add Student</h3>
                    </div>
                    <?php  } ?>
                    
                    <?php  if(isset($_SESSION['permissions']['View Subjects']) && $_SESSION['permissions']['View Subjects'] == 'View Subjects') {  ?>
                    <div class="nav-option option3">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png"
                                class="nav-img"
                                alt="report">
                        <h3 id='subclick'>Subjects</h3>
                    </div>
                    <?php  } ?>
                   
                    <?php if(isset($_SESSION['is_admin'])&& $_SESSION['is_admin'] == '0') { ?> 
                    
                    <div class="nav-option option5">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
                                class="nav-img"
                                alt="blog">
                        <h3 id='profile'> Profile</h3>
                    </div>
                    <?php }?>
                    
                    <?php if(isset($_SESSION['is_admin'])&& $_SESSION['is_admin'] == '1') { ?>
                        
                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
                                class="nav-img"
                                alt="settings">
                        <h3 id='rolesassign'> Roles Assign</h3>
                    </div>
                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
                                class="nav-img"
                                alt="settings">
                        <h3 id='roles'> Roles</h3>
                    </div>
                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
                                class="nav-img"
                                alt="settings">
                        <h3 id='permission'> Permission</h3>
                    </div>
                    <?php } ?>
                    
                    <?php if(isset($_SESSION['is_admin'])) { ?>
                      
                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
                                class="nav-img"
                                alt="settings">
                        <h3 id='changepass'> Change Password</h3>
                    </div>
                    <div class="nav-option logout">
                        
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" 
                                class="nav-img"
                                alt="logout"> 
                        <h3 id='logout'>Logout</h3>
                    </div>
                    <?php }?>
                    
                </div>
            </nav>
	</div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"  crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>
<script>
    $(document).ready(function()
    {
        $("#subclick").click(function(){
            window.location.href="subjects.php";
        })
        
        $("#studentList").click(function()
        {
            window.location.href="studentList.php";
        })
        
        $("#logout").click(function()
       {
           swal({
                title: "Are you sure to logout?",
                text: "Warning!",
                icon: "info",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => 
                {
                if (willDelete) 
                {
                  window.location.href="API/logout.php";
                } 
              });
        })
       
       $("#profile").click(function()
       {
           window.location.href="profile.php";
       })
       
       $("#changepass").click(function()
       {
           window.location.href="changePass.php";
       })
       $("#roles").click(function()
       {
           window.location.href="role.php";
       })
       $("#addStudent").click(function()
       {
           window.location.href="studentRegister.php";
       })
       $("#permission").click(function()
       {
           window.location.href="permission.php";
       })
       $("#rolesassign").click(function()
       {
           window.location.href="rollassing.php";
       })
    })
</script>