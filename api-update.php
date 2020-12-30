<?php

 header('Content-Type:application/json');
    header('Acess-Control-Allow_Origin: *');
    header('Acess-Control-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Authorization,X-Requested-With');
    $data=json_decode(file_get_contents("php://input"),true);
    $id=$data['sid'];
    $name=$data['sname'];
    $age=$data['sage'];
    $city=$data['scity'];
    include "dbconnect.php";
    

    $sql="UPDATE `students` SET `student_name` = '$name', `age` = '$age', `city` = '$city' WHERE `students`.`id` = $id
";
     
    if(mysqli_query($conn,$sql)){
        // $output=mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode(array('massage'=>'student record updated','status'=>true));
    }else{
        echo json_encode(array('massage'=>'student record not updated','status'=>false));
    }

?>
