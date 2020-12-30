<?php
    header('Content-Type:application/json');
    header('Acess-Control-Allow_Origin: *');
    // header('Acess-Control-Methods: POST');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Authorization,X-Requested-With');
    $data=json_decode(file_get_contents("php://input"),true);
    $student_id=$data['sid'];
    include "dbconnect.php";
    
    $sql="SELECT * FROM `students` WHERE id={$student_id}";
    $query=mysqli_query($conn,$sql) or die("Query is not done");
    // echo var_dump($query);
    if(mysqli_num_rows($query)>0){
        $output=mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode($output);
    }else{
        echo json_encode(array('massage'=>'NO record found','status'=>false));
    }
?>
