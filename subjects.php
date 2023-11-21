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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <?php include_once 'header.php';?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
            <div class="report-container">
                <div class="alert alert-success alert-dismissible notify" id="notify">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> New subject add successfully.
                  </div>
            <center><h2>Available Subjects</h2></center>
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
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            
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

<script>
$(document).ready(function() 
    {
        $("#notify").hide();
        // ************** SHOW ALL AVAILABLE SUBJECTS *********//
        
        function updateTable()
        {
            $.ajax({
                url:'API/showAll.php',
                method:'post',
                dataType:'JSON',
                success:function(data)
                {
                     console.log(data);
                     var tbody = $('#tbody');
                     
                    
                    var output = "";
                    console.log(data.length);

                    for (let i = 0; i < data.length; i++) 
                    {
                        output += '<tr><th scope="row">' + data[i].id + '</th><td>SUB00' + data[i].id + '</td><td>' + data[i].name + '</td></tr>';
                    }

                    tbody.html(output);
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
        }
        
        updateTable();
        
        //<--- ADD NEW SUBJECT API CALL AJAX ----<<
        
        $('#subfrm').submit(function(e)  
        {
            e.preventDefault(); 

            // Get the form data
            var formData = $(this).serialize();

            $.ajax({
                url: 'API/addsubject.php',
                method: 'post',
                data: formData, 
                success: function(data) 
                {
                    console.log(data);
                    
                    
                        $("#notify").show();
                        updateTable();
                    setTimeout(()=>{
                        $("#notify").fadeOut();
                    },2000);
                },
                error: function(e) {
                    console.log(e);
                    console.log("error");
                }
            });
        });
    });

</script>