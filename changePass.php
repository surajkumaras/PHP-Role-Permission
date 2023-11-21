<?php
    include_once 'conn.php';
    
    if(isset($_SESSION['is_admin']))
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
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .report-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 70%;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .errors {
            color: red;
        }
    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>         <!--  <--- LOAD HEADER NAVIGATION --<< -->
    <div class="main-container">
        <?php include_once 'sidenav.php'; ?>    <!--  <--- SIDE  NAVIGATION --<< -->
        <div class="report-container">
            <div class="main">
                <center><h2>Change Password</h2></center>
                <div class="container">
                    <form id="updatepass" method="post">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name='old_pass' class="form-control" id="oldpass" placeholder="Enter Old Password" >
                            <span class="errors"></span>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name='new_pass' class="form-control" id="newpass" placeholder="Enter New Password" >
                            <span class="errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name='con_pass' class="form-control" id="conpass" placeholder="Enter Confirm Password" >
                        </div>
                        <button type="button" id="checkbtn" class="btn btn-primary">Update</button>
                        <div>
                            <p id="err" style="color:red;text-align: center;"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script>
    
    $(document).ready(function() 
    {
        jQuery("#updatepass").validate({        //<----- LOGIN VALIDATION ----<<
            rules: {
                old_pass: {
                    required: true
                },
                new_pass: {
                    required: true,
                    minlength:5
                },
                con_pass: {
                    required: true,
                    equalTo:"#newpass"
                }
            },
        submitHandler: function(form) 
        {
            let oldpass = $("#oldpass").val();
            let newpass = $("#newpass").val();
            let conpass = $("#conpass").val();
            const formData = {                      // <--- PACK DATA VAIABLE INTO OBJECT FORM ---<<
                old_pass: oldpass,
                new_pass: newpass,
                con_pass: conpass
            }

            console.log(formData);

            $.ajax({                                //<----- AJAX---CODE----<<
                url:'API/changePassword.php',
                type:'post',
                data:JSON.stringify(formData),
                headers: {'Content-Type': 'application/json'},
                success:function(xhr,status,data)
                {
                    console.log("Backend Data:");
                    console.log(xhr.status);
                    console.log(data);
                    
                        $("#err").html("");
                        
                        swal({                              //<----- SWEET ALERT FOR SUCCESS ----<<
                            title: "Password Changed!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "OK!",
                          });
                          
                    setTimeout(()=>{window.location.href="login.php"},3000);    //<--- REDIRECT TO LOGIN IF PASSWORD CHANGED ---<<
                    
                },
                error:function(xhr,status,error)
                {
                    console.log(error);
                    if(xhr.status == '401')
                    {
                        console.log(xhr.status);
                        $("#err").html(xhr.responseJSON.status);        //<-----   ERROR MESSAGE FORM BACKEND --<<
                    }
                    
                    if(xhr.status == '400')
                    {
                        $("#err").html(xhr.responseJSON.status);        //<-----   ERROR MESSAGE FORM BACKEND --<<
                    }
                }
            })
        }
    });

    $("#checkbtn").click(function() 
    {
        $("#updatepass").submit();          //<---- SUBMIT FORM AFTER CLICK ON SUBMIT BUTTON ---<<
    });
});

    
</script>

<style>
    .error 
    {
        color:red;
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
