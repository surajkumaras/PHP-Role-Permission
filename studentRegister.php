<?php
    include_once 'conn.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="css/register.css">
        <link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/responsive.css">
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php 
                if(isset($_SESSION['is_admin']))
                {
                   include_once 'sidenav.php'; 
                }
             ?>
            <div class="main" style="width:70%">
        <center><h2>Registration Form</h2></center>
<form id="regFrmevent" method="post">
    <div class="form-container">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" />
            <span class="errors" id="name_err"></span>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" id="age" name="age" placeholder="Enter your age" />
            <span class="errors"></span>
        </div>
        <div class="form-group">
            <label for="stream">Class</label>
            <select id="stream" name="stream">
                <option value="0">Select stream</option>
                <option value="bca">BCA</option>
                <option value="mca">MCA</option>
                <option value="dca">DCA</option>
            </select>
            <span class="errors" ></span>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="gender-options">
                <input type="radio" name="gender" value="male" /> Male
                <input type="radio" name="gender" value="female" /> Female
            </div>
            <span class="error"></span>
        </div>
        <div class="form-group">
            <label>Subjects</label>
            <div class="subject-options">
                        <?php
        
                            $result = mysqli_query($conn, "SELECT * FROM tbl_subjects");

                            if (mysqli_num_rows($result) > 0) 
                            {
                                while ($row = mysqli_fetch_assoc($result)) 
                                {
                                    $subjectName = $row['name'];
                                    $subjectId = $row['id'];
                                    echo "<input type='checkbox' name='sub[]' id='sub_$subjectId' value='$row[id]'/>$subjectName<br>";
                                    //echo "<input type='checkbox' name='sub[]' id='sub_$' value='$subjectId'/>$subjectName<br>";
                                }
                            } 
                            else 
                            {
                                echo "No subjects available.";
                            }
                        ?>
                        </div>
            <span class="errors"></span>
        </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" />
                <span class="errors"></span>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Enter your city" />
                <span class="errors"></span>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile no.</label>
                <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile no" />
                <span class="errors"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" />
                <span class="errors"></span>
            </div>
            <div class="form-group">
                <label for="conpassword">Confirm password</label>
                <input type="password" id="conpassword" name="conpassword" placeholder="Enter confirm password" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info">Register</button>
            </div>
            <div class="form-group">
                <p id="err" style="color:red;text-align: center;"></p>
            </div>
        </div>
            </div></div></div>
    </form>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" referrerpolicy="no-referrer"></script>
    </body>
</html>
<script>
$(document).ready(function()
{
    //************* CHECK EMAIL ***********//
    $("#email").keyup(function()
    {
        let email_id = $(this).val();

        $.ajax({
            url:'API/EmailCheck.php',
            type:'post',
            data:{email:email_id},
            success:function(response)
            {
                let val = $.trim(response); 
                if (val) {
                    $("#err").html(response);
                }
                else 
                {
                    $("#err").html("");
                }
            },
            error:function(xhr,status,error)
            {
                console.log("error");


            }
        });
    });
    
    //************* CHECK MOBILE ***********//
    $("#mobile").keyup(function()
    {
        let mobile = $(this).val();

        $.ajax({
            url:'API/MobileCheck.php',
            type:'post',
            data:{mobile:mobile},
            success:function(response)
            {
                let val = $.trim(response); 
                if (val) {
                    $("#err").html(response);
                }
                else 
                {
                    $("#err").html("");
                }
            },
            error:function(xhr,status,error)
            {
                console.log("error");


            }
        });
    });
    
        //******** Validation Plugin Jquery *******//
        let formValid = true;
        $("#name").keyup(function()
        {
            let name = $("#name").val();
            let regex = /^[a-zA-Z]+$/;

            if(regex.test(name))
            {
                $("#name_err").html("");
                formValid = true;
            }
            else 
            {
                $("#name_err").html("Only character allowed!");
                formValid = false;
            }
        });
        $("#yourForm").submit(function(event) 
        {
            if (!formValid) 
            {
                event.preventDefault(); 
                alert("Please fix the errors in the form before submitting.");
            }
        });
        
    jQuery("#regFrmevent").validate({
            rules:{
                name:{
                    
                    required:true,
                    minlength:2,
                    
                },
                email:{
                    required:true,
                    email:true
                },
                age:{
                    required:true,
                    digits:true
                },
                city:{
                    required:true,
                },
     
                mobile:{
                    required:true,
                    digits:true,
                    minlength:10,
                    maxlength:12,
                },
                gender:{
                    required:true
                },
                password:{
                    required:true,
                    minlength:6
                },
                conpassword:{
                    equalTo:"#password",
                }
            },
            
            submitHandler:function(form)
            {
                var selectedValues = [];
                $('input[name="sub[]"]:checked').each(function() 
                {
                  selectedValues.push($(this).val());
                });
                //console.log(selectedValues);
               
                let name = $("#name").val();
                let regex = /^[a-zA-Z]+$/;
                
                if(regex.test(name))
                {
                    let email = $("#email").val();
                    let age = $("#age").val();
                    let mobile = $("#mobile").val();
                    let city = $("#city").val();
                    let sub = selectedValues;
                    let gender = $("input[name='gender']:checked").val();
                    let cls = $("#stream").val();
                    let pass = $("#password").val();
                    const formData = {
                        name:name,
                        email:email,
                        age:age,
                        mobile:mobile,
                        city:city,
                        sub:sub,
                        gender:gender,
                        cls:cls,
                        pass:pass,
                    }
                    console.log(formData);
                    $.ajax({
                        url:'API/registerStudent.php',
                        type:'post',
                        data:formData,
                        success:function(xhr, status,data)
                        {
                            swal({
                                title: "Registration Done!",
                                text: "success!",
                                icon: "success",
                                button: "Aww yiss!",
                              });

                                console.log(data);
                                setTimeout(() => {
                                    window.location.href = "login.php"; 
                                }, 5000);


                            console.log("Return Data",data);
                        },
                        error: function(xhr, status, error) 
                        {

                            if (xhr.status === 400) 
                            {
                                console.log("Bad Request: " + xhr.responseText);
                                $("#err").text(xhr.responseText);
                            } else if (xhr.status === 500) {
                                console.log("Internal Server Error: " + xhr.responseText);
                            } else {
                                console.log("Error: " + error);
                            }


                        }
                    })
                }
                else 
                {
                    $("#name_err").html("Only character allowed!");
                }
            }
    })
});
</script>
<style>
    .errors, .error
    {
        color:red;
    }
    
body 
    {
        background-image: url("images/edu2.jpeg");
        background-repeat: no-repeat;
    }
    .form-container
    {
        opacity: 0.7;
    }
</style>