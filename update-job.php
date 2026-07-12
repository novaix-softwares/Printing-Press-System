<?php

require_once("../code.php");

$conn = connection();

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Invalid Request");
}

$id = intval($_POST['id']);

$job_name = mysqli_real_escape_string($conn,$_POST['job_name']);
$sample_no = mysqli_real_escape_string($conn,$_POST['sample_no']);
$job_date = mysqli_real_escape_string($conn,$_POST['job_date']);
$customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
$worker_name = mysqli_real_escape_string($conn,$_POST['worker_name']);
$machine = mysqli_real_escape_string($conn,$_POST['machine']);

$job_qty = intval($_POST['job_qty']);
$job_color = intval($_POST['job_color']);
$total_qty = intval($_POST['total_qty']);

$total_amount = floatval($_POST['total_amount']);

$sql = "

UPDATE jobs SET

job_name='$job_name',

sample_no='$sample_no',

job_date='$job_date',

customer_name='$customer_name',

worker_name='$worker_name',

machine='$machine',

job_qty='$job_qty',

job_color='$job_color',

total_qty='$total_qty',

total_amount='$total_amount'

WHERE id='$id'

LIMIT 1

";

$result = mysqli_query($conn,$sql);

if($result){

    header("Location: admin.php?job");

    exit;

}else{

    die("Job Update Failed : ".mysqli_error($conn));

}

?>