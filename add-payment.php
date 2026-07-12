<?php

include("../code.php");

if(isset($_POST['customer_id'])){

    $conn = connection();

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

    $insert = mysqli_query($conn,

    "INSERT INTO payments(

        customer_id,
        payment_date,
        amount,
        payment_method,
        remarks

    )

    VALUES(

        '$customer_id',
        '$payment_date',
        '$amount',
        '$payment_method',
        '$remarks'

    )"

    );

    if($insert){

        header("Location: admin.php?customer_jobs&id=".$customer_id);

        exit;

    }else{

        echo mysqli_error($conn);

    }

}else{

    die("Invalid Request");

}

?>