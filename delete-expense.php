<?php

// =========================================
// CHECK REQUEST
// =========================================

if(!isset($_GET['id'])){

    die("Invalid Request");

}


// =========================================
// DATABASE
// =========================================

include("../code.php");

$conn = connection();


// =========================================
// GET ID
// =========================================

$expense_id = intval($_GET['id']);


// =========================================
// CHECK EXPENSE
// =========================================

$check = mysqli_query(

$conn,

"SELECT id

FROM expenses

WHERE id='$expense_id'

LIMIT 1"

);

if(mysqli_num_rows($check)==0){

    die("Expense Not Found");

}


// =========================================
// DELETE EXPENSE
// =========================================

$sql = "

DELETE FROM expenses

WHERE id='$expense_id'

LIMIT 1

";

$result = mysqli_query($conn,$sql);


// =========================================
// REDIRECT
// =========================================

if($result){

    header("Location: admin.php?expenses&deleted=1");

    exit;

}else{

    die(

        "Expense Delete Failed : ".mysqli_error($conn)

    );

}

?>