<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db-connection.php';
$data=json_decode(file_get_contents("php://input"));
$username=$data->email;
$password=$data->password;
$userdata='';
$result=mysqli_query($db_conn,"select * from patient where email='$username'");
$rowCount=$result->num_rows;
if($rowCount>0){
$result1=mysqli_query($db_conn,"select * from patient where email='$username' and password='$password'");
if($result1->num_rows>0){
$userData=$result1->fetch_object();

echo json_encode(["patient_data"=>$userData]);
}
else{
echo json_encode(["error"=>"Email or Password is Wrong"]);
}
}
else{
echo '{"error":"User Doesnot Exist"}';
}
// echo json_encode(["sucess"=>1]);
?>