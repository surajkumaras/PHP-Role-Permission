<?php
    include_once '../conn.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data =  $_POST;
   
  $subname = $data['name'];
   //echo $data['name']; <--- FOR CHECK INPUT VALUE ---<<
  
  $sql = "insert into tbl_subjects (name)values('$subname')";
  $res = mysqli_query($conn,$sql) or die("Failed query");
  
  if($res)
  {
      echo "Subject added";
  }
  else 
  {
      echo "Failed to add";
  }
  
}

