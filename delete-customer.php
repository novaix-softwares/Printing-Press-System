<?php

require_once("../code.php");

$conn = connection();

if(!isset($_GET['id'])){
    die("Invalid Customer ID");
}

$id = intval($_GET['id']);

/* CHECK CUSTOMER EXISTS */
$check = mysqli_query(
    $conn,
    "SELECT id FROM customers WHERE id='$id' LIMIT 1"
);

if(mysqli_num_rows($check) == 0){
    die("Customer Not Found");
}

/* DELETE CUSTOMER */
$sql = "DELETE FROM customers WHERE id='$id' LIMIT 1";

$result = mysqli_query($conn,$sql);

if($result){

    header("Location: admin.php?brand");
    exit;

}else{

    die("Delete Failed : ".mysqli_error($conn));

}

?>