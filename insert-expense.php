<?php

// =========================================
// CHECK REQUEST
// =========================================

if($_SERVER['REQUEST_METHOD'] != "POST"){

    die("Invalid Request");

}


// =========================================
// DATABASE
// =========================================

include("../code.php");

$conn = connection();


// =========================================
// GET FORM DATA
// =========================================

$expense_date = mysqli_real_escape_string(

$conn,

$_POST['expense_date']

);


$expense_category = mysqli_real_escape_string(

$conn,

$_POST['expense_category']

);


$expense_title = mysqli_real_escape_string(

$conn,

$_POST['expense_title']

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
// =========================================
// INSERT EXPENSE
// =========================================

$sql = "

INSERT INTO expenses(

expense_date,

expense_category,

expense_title,

amount,

payment_method,

remarks

)

VALUES(

'$expense_date',

'$expense_category',

'$expense_title',

'$amount',

'$payment_method',

'$remarks'

)

";

$result = mysqli_query($conn,$sql);


// =========================================
// REDIRECT
// =========================================

if($result){

header(

"Location: admin.php?expenses&success=1"

);

exit;

}else{

die(

"Expense Insert Failed : ".mysqli_error($conn)

);

}

?>
