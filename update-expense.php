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

$expense_id = intval($_POST['expense_id']);

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
// UPDATE EXPENSE
// =========================================

$sql = "

UPDATE expenses SET

expense_date='$expense_date',

expense_category='$expense_category',

expense_title='$expense_title',

amount='$amount',

payment_method='$payment_method',

remarks='$remarks'

WHERE id='$expense_id'

LIMIT 1

";

$result = mysqli_query($conn, $sql);


// =========================================
// REDIRECT
// =========================================

if($result){

    header("Location: admin.php?expenses&updated=1");

    exit;

}else{

    die(

        "Expense Update Failed : " . mysqli_error($conn)

    );

}

?>
