<?php

require_once("../code.php");

$conn = connection();

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Invalid Request");
}

$id = intval($_POST['id']);

$customer_name = mysqli_real_escape_string(
    $conn,
    trim($_POST['customer_name'])
);

if($customer_name==""){
    die("Customer Name is Required");
}

$sql = "

UPDATE customers SET

customer_name='$customer_name'

WHERE id='$id'

LIMIT 1

";

$result = mysqli_query($conn,$sql);

if($result){

    header("Location: admin.php?brand");

    exit;

}else{

    die("Update Failed : ".mysqli_error($conn));

}

?>