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
            <center><h2>Roles</h2></center>
            <div class="d-flex">
                <div class="d1 flex-fill p-3">
                <table class="table" id='table'>
                    <thead class="thead-dark">
                      <tr>
                        
                        <th scope="col">Role Code</th>
                        <th scope="col">Role Name</th>
                        
                      </tr>
                    </thead>
                    <tbody id='rolelist'>
                       <!-- show data -->
                    </tbody>
                  </table>
           </div>
                
            
            <div class="d2 flex-fill p-3">
                <form id='rolefrm' method="post">
                    <div class="form-row align-items-center">
                      <div class="col-sm-8 my-1">
                        <label class="sr-only" for="inlineFormInputName">Role Name</label>
                        <input type="text"  name="name" class="form-control" id="inlineFormInputName" placeholder="Enter New Role" required>
                      </div>
                      
                      <div class="col-auto my-1">
                        <button type="submit" name="submit" class="btn btn-primary">Create</button>
                      </div>
                    </div>
                  </form>
            </div>
            
            </div>
        </div>
            
    </body>
</html>
<script>
    $(document).ready(function()
    {
        //************* SHOW ROLE *************//
        
        showall();
        
        function showall()
        {
           let table = $("#rolelist");
            
            $.ajax({
                url:'API/showAllRole.php',
                dataType:'JSON',
                success:function(data)
                {
                    console.log(data);
                     table.empty();

                
                        $.each(data, function(index, role) {
                            let row = `
                                <tr>
                                    
                                    <td>${role.id}</td>
                                    <td>${role.role_name}</td>
                                </tr>
                            `;
                            table.append(row);
                        });
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
        }
        
        //************* ADD NEW ROLE **********//
        $("#rolefrm").submit(function(e)
        {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url:'API/role.php',
                type:'post',
                data:formData,
                success:function(data)
                {
                    console.log(data);
                    $("#name").val('');
                    showall();
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
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