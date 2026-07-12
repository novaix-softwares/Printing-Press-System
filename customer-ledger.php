<?php

// ===============================
// CHECK CUSTOMER ID
// ===============================

if(!isset($_GET['id'])){

    die("Customer Not Found");

}

$id = intval($_GET['id']);

$conn = connection();


// ===============================
// GET CUSTOMER
// ===============================

$customer_query = mysqli_query(

$conn,

"SELECT *

FROM customers

WHERE id='$id'

LIMIT 1"

);

if(mysqli_num_rows($customer_query)==0){

    die("Customer Not Found");

}

$customer = mysqli_fetch_assoc($customer_query);

$customer_name = mysqli_real_escape_string(
$conn,
$customer['customer_name']
);


// ===============================
// GET LEDGER
// ===============================

$ledger_query = mysqli_query(

$conn,

"

SELECT

job_date AS entry_date,

'Job' AS entry_type,

job_name AS details,

total_amount AS debit,

0 AS credit

FROM jobs

WHERE customer_name='$customer_name'

UNION ALL

SELECT

payment_date AS entry_date,

'Payment' AS entry_type,

payment_method AS details,

0 AS debit,

amount AS credit

FROM payments

WHERE customer_id='$id'

ORDER BY entry_date ASC

"

);

?>

<div class="container-fluid mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

Customer Ledger

</h2>

<p class="text-muted">

<?php echo $customer['customer_name']; ?>

</p>

</div>

<a
href="admin.php?customer_jobs&id=<?php echo $id; ?>"
class="btn btn-secondary">

Back

</a>

</div>

<div class="ledger-card">

<div class="card-header bg-dark text-white">

<h5 class="mb-0">

Ledger Report

</h5>

</div>

<div class="card-body p-0">

<div class="table-responsive">

<table class="table ledger-table table-hover mb-0">

<thead class="table-dark">

<tr>

<th>Date</th>

<th>Type</th>

<th>Details</th>

<th>Debit</th>

<th>Credit</th>

<th>Balance</th>

</tr>

</thead>

<tbody>

<?php

$balance = 0;

while($row = mysqli_fetch_assoc($ledger_query)){

    $balance = $balance + $row['debit'] - $row['credit'];

?>

<tr>

    <td>

        <?php echo date("d M Y",strtotime($row['entry_date'])); ?>

    </td>

    <td>

        <?php

        if($row['entry_type']=="Job"){

           echo '<span class="badge-job">Job</span>';

        }else{

         echo '<span class="badge-payment">Payment</span>';

        }

        ?>

    </td>

    <td>

        <?php echo $row['details']; ?>

    </td>

    <td class="text-end">

        <?php

        if($row['debit']>0){

            echo "Rs. ".number_format($row['debit']);

        }else{

            echo "-";

        }

        ?>

    </td>

    <td class="text-end">

        <?php

        if($row['credit']>0){

            echo "Rs. ".number_format($row['credit']);

        }else{

            echo "-";

        }

        ?>

    </td>

    <td class="text-end fw-bold">

        Rs. <?php echo number_format($balance); ?>

    </td>

</tr>

<?php

}

?>

</tbody>

<tfoot class="table-dark">

<?php

$total_debit_query = mysqli_query(

$conn,

"SELECT IFNULL(SUM(total_amount),0) AS total

FROM jobs

WHERE customer_name='$customer_name'"

);

$total_debit = mysqli_fetch_assoc($total_debit_query);



$total_credit_query = mysqli_query(

$conn,

"SELECT IFNULL(SUM(amount),0) AS total

FROM payments

WHERE customer_id='$id'"

);

$total_credit = mysqli_fetch_assoc($total_credit_query);

?>

<tr>

    <th colspan="3" class="text-end">

        Total

    </th>

    <th class="text-end">

        Rs. <?php echo number_format($total_debit['total']); ?>

    </th>

    <th class="text-end">

        Rs. <?php echo number_format($total_credit['total']); ?>

    </th>

    <th class="text-end">

        Rs. <?php echo number_format($balance); ?>

    </th>

</tr>

</tfoot>

</table>

</div>

</div>

</div>


<div class="row g-4 mt-3">

    <div class="col-lg-4 col-md-6">

        <div class="ledger-summary-card border-red">

            <h6>Total Jobs Amount</h6>

            <h3 class="amount-red">
                Rs. <?php echo number_format($total_debit['total']); ?>
            </h3>

        </div>

    </div>


    <div class="col-lg-4 col-md-6">

        <div class="ledger-summary-card border-green">

            <h6>Total Payments</h6>

            <h3 class="amount-green">
                Rs. <?php echo number_format($total_credit['total']); ?>
            </h3>

        </div>

    </div>


    <div class="col-lg-4 col-md-6">

        <div class="ledger-summary-card border-blue">

            <h6>Outstanding Balance</h6>

            <h3 class="<?php echo ($balance>0)?'amount-red':'amount-green'; ?>">
                Rs. <?php echo number_format($balance); ?>
            </h3>

        </div>

    </div>

</div>

</div>

</div>

<style>
/*=========================================
LEDGER PAGE
=========================================*/


.ledger-summary-card{

    height:170px;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

}

.ledger-card{

    background: var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:16px;
    overflow:hidden;
    box-shadow:var(--shadow-md);

}

.ledger-card .card-header{

    background:var(--bg-secondary);
    border-bottom:1px solid var(--border-color);
    padding:18px 22px;

}

.ledger-card .card-header h5{

    margin:0;
    font-weight:700;
    color:var(--text-primary);

}


/*=========================================
SUMMARY CARDS
=========================================*/

.summary-card{

    background:var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:16px;
    padding:22px;
    box-shadow:var(--shadow-sm);
    transition:.3s;
    height:100%;

}

.summary-card:hover{

    transform:translateY(-4px);
    box-shadow:var(--shadow-lg);

}

.summary-card h6{

    color:var(--text-secondary);
    font-size:15px;
    margin-bottom:10px;

}

.summary-card h3{

    font-weight:700;
    margin:0;

}


/*=========================================
TABLE
=========================================*/

.ledger-table{

    width:100%;
    min-width:900px;
    margin:0;

}

.ledger-table thead{

    background:var(--bg-secondary);

}

.ledger-table thead th{

    padding:16px;
    border:none;
    text-align:center;
    font-weight:700;
    color:var(--text-primary);
    white-space:nowrap;

}

.ledger-table tbody td{

    padding:15px;
    border-top:1px solid var(--border-color);
    color:var(--text-primary);
    vertical-align:middle;
    white-space:nowrap;

}

.ledger-table tbody tr:hover{

    background:var(--bg-secondary);

}

.ledger-table tfoot th{

    padding:16px;
    background:var(--bg-secondary);
    color:var(--text-primary);
    border-top:2px solid var(--border-color);

}


/*=========================================
BADGES
=========================================*/

.badge-job{

    background:#dc3545;
    color:#fff;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;

}

.badge-payment{

    background:#198754;
    color:#fff;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;

}


/*=========================================
AMOUNTS
=========================================*/

.debit{

    color:#dc3545;
    font-weight:700;

}

.credit{

    color:#198754;
    font-weight:700;

}

.balance{

    color:#0d6efd;
    font-weight:700;

}


/*=========================================
DARK MODE
=========================================*/

.dark-theme .ledger-card{

    background:var(--bg-primary);

}

.dark-theme .ledger-table{

    color:var(--text-primary);

}

.dark-theme .ledger-table thead{

    background:var(--bg-secondary);

}

.dark-theme .ledger-table thead th{

    color:var(--text-primary);

}

.dark-theme .ledger-table tbody td{

    color:var(--text-primary);

}

.dark-theme .ledger-table tbody tr:hover{

    background:var(--bg-secondary);

}

.dark-theme .ledger-table tfoot th{

    background:var(--bg-secondary);
    color:var(--text-primary);

}


/*=========================================
RESPONSIVE
=========================================*/

@media(max-width:768px){

.ledger-table{

min-width:850px;

}

.ledger-table th,
.ledger-table td{

padding:12px;
font-size:13px;

}

.summary-card{

margin-bottom:15px;

}

}

/* ===================================
LEDGER SUMMARY CARDS
=================================== */

.ledger-summary-card{

    background:#ffffff !important;
    border-radius:14px;
    padding:28px 20px;
    text-align:center;

    box-shadow:0 8px 20px rgba(0,0,0,.08);

    transition:.3s;

}

.ledger-summary-card:hover{

    transform:translateY(-5px);

}

.ledger-summary-card h6{

    color:#6c757d !important;

    font-size:15px;
    font-weight:600;

    margin-bottom:15px;

}

.ledger-summary-card h3{

    font-size:36px;
    font-weight:700;

    margin:0;

}

/* Border Colors */

.border-red{

    border-top:5px solid #dc3545;

}

.border-green{

    border-top:5px solid #198754;

}

.border-blue{

    border-top:5px solid #0d6efd;

}

/* Amount Colors */

.amount-red{

    color:#dc3545 !important;

}

.amount-green{

    color:#198754 !important;

}

.amount-blue{

    color:#0d6efd !important;

}


/* DARK MODE FIX */

.dark-theme .ledger-summary-card{

    background:var(--bg-primary) !important;
    border:1px solid var(--border-color);

}

.dark-theme .ledger-summary-card h6{

    color:var(--text-secondary) !important;

}

.dark-theme .ledger-summary-card h3{

    color:var(--text-primary) !important;

}

.dark-theme .amount-red{

    color:#ff6b6b !important;

}

.dark-theme .amount-green{

    color:#51cf66 !important;

}

.dark-theme .amount-blue{

    color:#4dabf7 !important;

}

</style>