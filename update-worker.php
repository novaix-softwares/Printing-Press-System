<?php

require_once("../code.php");

$conn = connection();

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Invalid Request");
}

$id = intval($_POST['id']);

$worker_name = mysqli_real_escape_string(
    $conn,
    trim($_POST['worker_name'])
);

$monthly_salary = floatval($_POST['monthly_salary']);

$sql = "

UPDATE workers SET

worker_name='$worker_name',

monthly_salary='$monthly_salary'

WHERE id='$id'

LIMIT 1

";

$result = mysqli_query($conn,$sql);

if($result){

    header("Location: admin.php?workers");

    exit;

}else{

    die("Update Failed : ".mysqli_error($conn));

}

?>
