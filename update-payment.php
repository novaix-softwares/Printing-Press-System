<?php
require_once("../code.php");

// ===============================
// CHECK REQUEST
// ===============================

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Invalid Request");
}

$conn = connection();

$payment_id  = intval($_POST['payment_id']);
$customer_id = intval($_POST['customer_id']);

$payment_date = mysqli_real_escape_string(
$conn,
$_POST['payment_date']
);

$amount = floatval($_POST['amount']);

$payment_method = mysqli_real_escape_string(
$conn,
$_POST['payment_method']
);

$remarks = mysqli_real_escape_string(
$conn,
$_POST['remarks']
);


// ===============================
// UPDATE PAYMENT
// ===============================

$sql = "

UPDATE payments SET

payment_date='$payment_date',

amount='$amount',

payment_method='$payment_method',

remarks='$remarks'

WHERE id='$payment_id'

LIMIT 1

";

$result = mysqli_query($conn,$sql);


// ===============================
// REDIRECT
// ===============================

if($result){

header(

"Location: admin.php?payment_history&id=".$customer_id

);

exit;

}else{

die("Payment Update Failed");

}

?>