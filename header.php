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
			<div class="logo">eClass</div>
			<img src= "https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
				class="icn menuicn" id="menuicn" alt="menu-icon">
		</div>

                <?php
                if (isset($_SESSION['role_id'])) 
                {
                    $role_id = $_SESSION['role_id'];
                    
                } 
                
                        
                $sql = "select rp.permission_id, p.name
                    from tbl_role_permission AS rp 
                    join tbl_permission AS p 
                    on rp.permission_id = p.id where role_id = $role_id";

                    $res = mysqli_query($conn,$sql)or die("Query failed"); 
                
                if($res)
                {                   //<--- DISPLAY ALL PERMISSION RELATED TO ITS ROLE ----<<
                    
                    echo "<b style='font-size: 18px;'>Permission:</b>";
                    while($r = mysqli_fetch_array($res))
                    {
                        
                        echo $r[1]."<b>|</b>";
                    }
                }
            
            
                ?>
            
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
            body, h1, h2, h3, p, div {
    margin: 0;
    padding: 0;
}
            .nav 
            {
                 opacity: 0.5;
            }
            .logo {
    white-space: normal; /* or white-space: nowrap; depending on your needs */
}
            .logo {
    width: 100%; /* or an appropriate width value */
}
        </style>