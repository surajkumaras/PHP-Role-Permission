<?php include_once 'conn.php'; 

    if(isset($_SESSION['is_admin']))
    {
        if(isset($_SESSION['permissions']['View Subjects']) && $_SESSION['permissions']['View Subjects'] == 'View Subjects')
        { 
            
        }
        else
        { 
            header("location:index.php"); 
        }
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- jquery cdn link -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/responsive.css">
        <link rel="stylesheet" href="CSS/addSubject.css">
    </head>
    <body>
        <?php include_once 'header.php';?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
            <div class="report-container">
            <center><h2>Subjects</h2></center>
            <div class="d-flex">
                <div class="d1 flex-fill p-3">
                <table class="table" id='table'>
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        
                      </tr>
                    </thead>
                    <tbody id='tbody'>
                       <!-- show data -->
                    </tbody>
                  </table>
           </div>
                
            <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '1')
            {
                
            
            ?>
            <div class="d2 flex-fill p-3">
                <form id='subfrm' method="post">
                    <div class="form-row align-items-center">
                      <div class="col-sm-8 my-1">
                        <label class="sr-only" for="inlineFormInputName">Subject Name</label>
                        <input type="text"  name="name" class="form-control" id="inlineFormInputName" placeholder="Enter New Subject" required>
                      </div>
                      
                      <div class="col-auto my-1">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                      </div>
                    </div>
                  </form>
            </div>
            <?php 
            
            }else {}
            
            ?>
            </div>
        </div>
            <script src='ajaxCallAPI.js'></script>
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