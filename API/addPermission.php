<?php

include_once '../conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//    print_r($_POST);
//    exit();
    $r_id = $_POST['role'];
    if(empty($_POST['permissions']))
    {
        $sql= "delete from tbl_role_permission where role_id = $r_id";
        $res = mysqli_query($conn,$sql) or die("Deletion failed");
        
        if($res)
        {
            echo "All Permission removed";
        }
        
    }
    else 
    {
        $sql2= "delete from tbl_role_permission where role_id = $r_id";
        $res2 = mysqli_query($conn,$sql2) or die("Query failed");
        if($res2)
        {
            $data = $_POST['permissions'];
            foreach($data as $per )
            {
                $sql3 = "insert into tbl_role_permission(role_id,permission_id)values($r_id,$per) ;";
                $res3 = mysqli_query($conn,$sql3);
                
            }

            /* new code  */
            $sql = "select rp.permission_id, p.name
                    from tbl_role_permission AS rp 
                    join tbl_permission AS p 
                    on rp.permission_id = p.id where role_id = $r_id";

            $res = mysqli_query($conn,$sql)or die("Query failed");
            $permissions = array();
            while($row = mysqli_fetch_assoc($res))
                { 
                    $permissions[$row['name']] = $row['name']; 

                } 

                $_SESSION['permissions'] = $permissions;
                
            /* end new code  */
            
            if($res3)
            {
                echo "Permission added";

            }
        }
        
        //$role_id = $_POST['role'];
        

        
    }
    
}

/*
 * 
 * 
 * $permissions = array(); 
                    while($row = mysqli_fetch_assoc($res))
                    { 
                        $permissions[$row['name']] = $row['name']; 

                    } 
                    // Store the permissions array in the session 
                    $_SESSION['permissions'] = $permissions;
 */