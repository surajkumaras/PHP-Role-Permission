<?php 
    include_once 'conn.php';
    
    if(isset($_SESSION['is_admin']))
    {
        header("location:index.php");
    }
    
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="CSS/login.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
        <form id="loginfrm" style="max-width:500px;margin:auto" method='post'>
            <h2 style="color:white"><center>Sign In</center></h2>
            <div class="input-container" >
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="text" placeholder="Email" id="email" name="email" >
            </div>

            <div class="input-container">
              <i class="fa fa-key icon"></i>
              <input class="input-field" type="password" placeholder="Password" id="pwd" name="pwd">
            </div>

            <button type="submit"  class="btn">Login</button><a href="studentRegister.php" style="color:#3399ff"><p>Create a new account</p></a>
            <div >
                <p id="err" style="color:red;text-align: center;" ></p>
            </div>
          </form>
<!--            <div>
                <div class="loader" id="loader" style="display:none;"></div>
            </div>-->
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" referrerpolicy="no-referrer"></script>
    </body>
</html>
<script>
$(document).ready(function()
{
    
    jQuery("#loginfrm").validate({
            rules:{
                email:{
                    required:true,
                    email:true
                },
                pwd:{
                    required:true
                }
            },
            messages:{
                email:{
                    required:" *Please enter your email**",
                    email:"*Please enter valid email**"
                },
                pwd:{
                    required:"*Please enter password**"
                }
            },
            
            submitHandler:function(form)
            {
                $("#loader").show();
                let name = $("#email").val();
                let pwd = $("#pwd").val();
                let data ={
                    username: name,
                    password:pwd
                } 
           
                    console.log("test",data);
                     $.ajax({
                        url:"API/login.php",
                        method:'post',
                        data:data,
                        success:function(response)
                        {
                            $("#loader").hide();
                            console.log(response);
                            window.location.href="index.php";
                        },
                        error:function(xhr,status,error)
                        {
                            console.log(xhr.status);
                            if(xhr.status === 400)
                            {
                                $("#err").html(xhr.responseText);
                               //check comment
                            }
                        }
                    });
            }
    });
    
})
</script>
<style>
body 
    {
        background-image: url("images/edu2.jpeg");
        background-repeat: no-repeat;
    }
 #loginfrm {
  
  opacity: 0.6;
}

.container {
    margin-top: 10%;
}
.error
{
    color: red;
}

#example-4 {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  width: 100vw;
}

.loader {
  border: 16px solid #f3f3f3; 
  border-top: 16px solid #3498db; 
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>