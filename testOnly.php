<?php
    include_once 'conn.php';
    
    if(isset($_SESSION['role_id'])) 
    { 
        $role_id = $_SESSION['role_id']; 
    }
    $sql = "select rp.permission_id, p.name
    from tbl_role_permission AS rp 
    join tbl_permission AS p 
    on rp.permission_id = p.id where role_id = 4";

    $res = mysqli_query($conn,$sql)or die("Query failed"); 
    // Store the permissions in an associative array with the module code as the key and the description as the value 

    $permissions = array(); 
    while($row = mysqli_fetch_assoc($res))
    { 
        $permissions[$row['name']] = $row['name']; 

    } 
    // Store the permissions array in the session 
    $_SESSION['permissions'] = $permissions; 


    //This way, you can access the permissions for the current user from the session and check them against the actions they want to perform. For example, if you want to check if the user can delete users, you can do something like this:

    if(isset($_SESSION['permissions']['USR']) && $_SESSION['permissions']['USR'] == 'Delete users')
    { 
        // Allow the user to delete users 
    }
    else
    { 
        // Deny the user to delete users 
    }
