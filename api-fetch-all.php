<?php
 header('Content-Type:application/json');
    header('Acess-Control-Allow_Origin: *');
include "dbconnect.php";

$sql="SELECT * FROM students";
$query=mysqli_query($conn,$sql);
// echo var_dump($query);
if(mysqli_num_rows($query)>0){
    $output=mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($output);
}else{
    echo json_encode(array('massage'=>'NO record found','status'=>false));
}
?>
