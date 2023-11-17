<?php
include_once '../conn.php';
$sql = "select id,name from tbl_subjects";
$res = mysqli_query($conn,$sql);

$data = array();
if(mysqli_num_rows($res) > 0)
{
    while($r = mysqli_fetch_assoc($res))
    {
        $data[] = $r;
    }
    
    $json_data = json_encode($data);
    
    echo $json_data;
}
