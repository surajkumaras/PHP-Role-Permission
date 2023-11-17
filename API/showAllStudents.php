<?php

    include_once '../conn.php';
    $sql ="SELECT student.id, student.name, student.age, student.gender, student.course, student.email, student.mobile, student.city, GROUP_CONCAT(subject.name) as subjects FROM tbl_student_info AS student JOIN tbl_student_subject AS ss ON student.id = ss.student_id JOIN tbl_subjects AS subject ON ss.subject_id = subject.id GROUP BY student.id;";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        $data  = array();
        while($r = mysqli_fetch_array($res))
        {
            $data[] = $r;
        }
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else 
    {
        echo json_encode(array('message' => 'No record found'));
    }
?>

