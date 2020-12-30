<?php

 header('Content-Type:application/json');
    header('Acess-Control-Allow_Origin: *');
    header('Acess-Control-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Methods,Access-Control-Allow-Headers,Access-Control-Allow-Origin,Content-Type,Authorization,X-Requested-With');
    $data=json_decode(file_get_contents("php//input"),true);
    $name=$data['sname'];
    $age=$data['sage'];
    $city=$data['scity'];
    
    include "dbconnect.php";
    
    $sql="INSERT INTO `students` (`student_name`, `age`, `city`) VALUES ( '$name', '$age', '$city')";
  
   
   if(mysqli_query($conn,$sql)){
        // $output=mysqli_fetch_all($query,MYSQLI_ASSOC);
        echo json_encode(array('massage'=>'student record inserted','status'=>true));
    }else{
        echo json_encode(array('massage'=>'student record not inserted','status'=>false));
    }

?>
