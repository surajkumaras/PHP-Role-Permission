<?php
    include_once 'conn.php';
    
    if(isset($_SESSION['is_admin']))
    {
        
    }
    else
    {
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/responsive.css">
        
        <!--bootstrap notification-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	<?php include_once 'header.php'; ?>
        <div class="main-container">
            <?php include_once 'sidenav.php'; ?>
<!--            <div class="alert alert-success alert-dismissible fade show" style="height:60px;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Login Success!</strong> .
              </div>
            <div class="main" >
               
               
            </div>-->
	</div>
        <script src="js.js"></script>
</body>
</html>
<style>
    body 
    {
        background-image: url("images/edu2.jpeg");
        background-repeat: no-repeat;
    }
    
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        margin-left: 30%;
        
    }
</style>