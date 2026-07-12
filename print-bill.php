<?php

ob_start();

include("../code.php");
require("../fpdf/fpdf.php");

/*=========================================
CHECK REQUEST
=========================================*/

if (
    !isset($_GET['id']) ||
    !isset($_GET['from']) ||
    !isset($_GET['to'])
) {
    die("Invalid Request");
}

$conn = connection();

$id = intval($_GET['id']);

$from = mysqli_real_escape_string($conn, $_GET['from']);
$to   = mysqli_real_escape_string($conn, $_GET['to']);


/*=========================================
GET CUSTOMER
=========================================*/

$customer_query = mysqli_query($conn, "
SELECT *
FROM customers
WHERE id='$id'
LIMIT 1
");

if (mysqli_num_rows($customer_query) == 0) {
    die("Customer Not Found");
}

$customer = mysqli_fetch_assoc($customer_query);

$customer_name = mysqli_real_escape_string(
    $conn,
    $customer['customer_name']
);


/*=========================================
GENERATE BILL NUMBER
=========================================*/

$bill_no = "BILL-" . date("YmdHis");


/*=========================================
GET JOBS
=========================================*/

$jobs_query = mysqli_query($conn, "
SELECT *
FROM jobs
WHERE customer_name='$customer_name'
AND job_date BETWEEN '$from' AND '$to'
ORDER BY job_date ASC
");


/*=========================================
CALCULATE TOTALS
=========================================*/

$total_query = mysqli_query($conn, "
SELECT
COUNT(*) AS total_jobs,
IFNULL(SUM(job_qty),0) AS grand_job_qty,
IFNULL(SUM(total_qty),0) AS grand_print_qty,
IFNULL(SUM(total_amount),0) AS grand_amount
FROM jobs
WHERE customer_name='$customer_name'
AND job_date BETWEEN '$from' AND '$to'
");

$total = mysqli_fetch_assoc($total_query);

$total_jobs      = $total['total_jobs'];
$grand_job_qty   = $total['grand_job_qty'];
$grand_print_qty = $total['grand_print_qty'];
$grand_amount    = $total['grand_amount'];

/*=========================================
TOTAL PAYMENT RECEIVED
=========================================*/

$payment_query = mysqli_query(

$conn,

"SELECT IFNULL(SUM(amount),0) AS total_payment

FROM payments

WHERE customer_id='$id'"

);

$payment = mysqli_fetch_assoc($payment_query);

$total_payment = $payment['total_payment'];

$remaining_balance = $grand_amount - $total_payment;


/*=========================================
CREATE PDF
=========================================*/

$pdf = new FPDF("P", "mm", "A4");

$pdf->AddPage();

$pdf->SetAutoPageBreak(true,20);
/*=========================================
COMPANY HEADER
=========================================*/

$pdf->SetFont("Arial","B",18);
$pdf->Cell(190,10,"PREMIUM PRINT PRO",0,1,"C");

$pdf->SetFont("Arial","",11);
$pdf->Cell(190,6,"CUSTOMER BILLING REPORT",0,1,"C");

$pdf->Ln(2);

$pdf->Line(10,28,200,28);

$pdf->Ln(6);


/*=========================================
CUSTOMER DETAILS
=========================================*/

$pdf->SetFont("Arial","B",16);
$pdf->Cell(190,8,strtoupper($customer['customer_name']),0,1,"C");

$pdf->Ln(3);

$pdf->SetFont("Arial","",11);

$pdf->Cell(95,7,"Bill No : ".$bill_no,0,0);

$pdf->Cell(95,7,"Bill Date : ".date("d M Y"),0,1,"R");

$pdf->Cell(95,7,"From : ".date("d M Y",strtotime($from)),0,0);

$pdf->Cell(95,7,"To : ".date("d M Y",strtotime($to)),0,1,"R");

$pdf->Ln(6);


/*=========================================
TABLE HEADER
=========================================*/

$pdf->SetFillColor(45,62,80);
$pdf->SetTextColor(255);

$pdf->SetFont("Arial","B",9);

$pdf->Cell(10,10,"#",1,0,"C",true);

$pdf->Cell(60,10,"Job Name",1,0,"C",true);

$pdf->Cell(30,10,"Sample No",1,0,"C",true);

$pdf->Cell(25,10,"Job Qty",1,0,"C",true);

$pdf->Cell(35,10,"Amount",1,0,"C",true);

$pdf->Cell(30,10,"Date",1,1,"C",true);


/*=========================================
TABLE DATA
=========================================*/

$pdf->SetTextColor(0);
$pdf->SetFont("Arial","",9);

$sr = 1;

while($job = mysqli_fetch_assoc($jobs_query)){

    $pdf->Cell(10,9,$sr++,1,0,"C");

    $pdf->Cell(
        60,
        9,
        substr($job['job_name'],0,28),
        1,
        0
    );

    $pdf->Cell(
        30,
        9,
        $job['sample_no'],
        1,
        0,
        "C"
    );

    $pdf->Cell(
        25,
        9,
        number_format($job['job_qty']),
        1,
        0,
        "C"
    );

    $pdf->Cell(
        35,
        9,
        "Rs. ".number_format($job['total_amount']),
        1,
        0,
        "R"
    );

    $pdf->Cell(
        30,
        9,
        date("d-m-Y",strtotime($job['job_date'])),
        1,
        1,
        "C"
    );

}
/*=========================================
GRAND TOTALS
=========================================*/

$pdf->Ln(6);

$pdf->SetFont("Arial","B",11);

// Total Jobs
$pdf->Cell(110);
$pdf->Cell(40,10,"Total Jobs",1,0,"C");
$pdf->Cell(40,10,$total_jobs,1,1,"C");

// Job Qty
$pdf->Cell(110);
$pdf->Cell(40,10,"Job Qty",1,0,"C");
$pdf->Cell(
    40,
    10,
    number_format($grand_job_qty),
    1,
    1,
    "C"
);

// Print Qty
$pdf->Cell(110);
$pdf->Cell(40,10,"Print Qty",1,0,"C");
$pdf->Cell(
    40,
    10,
    number_format($grand_print_qty),
    1,
    1,
    "C"
);

// Grand Total
$pdf->Cell(110);

$pdf->SetFillColor(230,230,230);

$pdf->Cell(
    40,
    12,
    "Grand Total",
    1,
    0,
    "C",
    true
);

$pdf->Cell(
    40,
    12,
    "Rs. ".number_format($grand_amount,2),
    1,
    1,
    "C",
    true
);




$pdf->Cell(110);

$pdf->Cell(
40,
10,
"Balance",
1,
0,
"C"
);

$pdf->Cell(
40,
10,
"Rs. ".number_format($remaining_balance),
1,
1,
"C"
);


/*=========================================
SIGNATURE
=========================================*/

$pdf->Ln(18);

$pdf->SetFont("Arial","",10);

$pdf->Cell(120);

$pdf->Cell(
    60,
    6,
    "Authorized Signature",
    0,
    1,
    "C"
);

$pdf->Cell(120);

$pdf->Cell(
    60,
    0,
    "__________________________",
    0,
    1,
    "C"
);


/*=========================================
FOOTER
=========================================*/

$pdf->Ln(18);

$pdf->SetFont("Arial","I",10);

$pdf->Cell(
    190,
    6,
    "Thank You For Your Business",
    0,
    1,
    "C"
);

$pdf->Cell(
    190,
    6,
    "Premium Print Pro",
    0,
    1,
    "C"
);

$pdf->Cell(
    190,
    6,
    date("d M Y h:i A"),
    0,
    1,
    "C"
);


/*=========================================
DOWNLOAD PDF
=========================================*/

if(ob_get_length()){
    ob_end_clean();
}

$pdf->Output(
    "D",
    "Bill_".$customer['customer_name']."_".$bill_no.".pdf"
);

exit;