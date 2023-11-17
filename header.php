<?php include_once 'conn.php';; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/responsive.css">
    </head>
    <body>
        <header>

		<div class="logosec">
			<div class="logo">E-Class</div>
			<img src= "https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
				class="icn menuicn" id="menuicn" alt="menu-icon">
		</div>

		<div class="searchbar">
			<input type="text" placeholder="Search">
			<div class="searchbtn">
			<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png" class="icn srchicn" alt="search-icon">
			</div>
		</div>

		<div class="message">
			
			<?php
                            if(isset($_SESSION['name']))
                            {
                        ?>
                        <div class="circle"></div>
			<img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
                        <div class="dp">
                            <a href="profile.php"><img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png" class="dpicn" alt="dp"> </a>
			</div>
                        <div>
                            Welcome! <b><?php echo $_SESSION['name']; ?> </b>
                        </div>
                        <?php 
                        
                            }else 
                            {
                                echo "<div><a href='login.php'>Login</a></div>";
                            }
                        ?>
		</div>
            </header>
        <style>
            .nav 
            {
                 opacity: 0.5;
            }
        </style>