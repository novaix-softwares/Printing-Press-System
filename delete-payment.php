<?php

require_once("../code.php");

// =========================
// CHECK PAYMENT ID
// =========================

if(
    !isset($_GET['id']) ||
    !isset($_GET['customer_id'])
){
    die("Invalid Request");
}

$conn = connection();

$payment_id = intval($_GET['id']);
$customer_id = intval($_GET['customer_id']);


// =========================
// DELETE PAYMENT
// =========================

mysqli_query(

$conn,

"DELETE FROM payments
WHERE id='$payment_id'
LIMIT 1"

);


// =========================
// REDIRECT
// =========================

header(

"Location: admin.php?payment_history&id=".$customer_id

);

exit;

?>