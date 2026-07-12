<?php

// ===============================
// CHECK CUSTOMER ID
// ===============================

if (!isset($_GET['id']) || empty($_GET['id'])) {
?>
    <div class="alert alert-danger">
        Customer ID Not Found.
    </div>
<?php
    return;
}

$id = intval($_GET['id']);


// ===============================
// GET CUSTOMER
// ===============================

$conn = connection();

$sql = "SELECT * FROM customers WHERE id='$id' LIMIT 1";

$query = mysqli_query($conn, $sql);

if (!$query) {
?>
    <div class="alert alert-danger">
        Database Error.
    </div>
<?php
    return;
}

if (mysqli_num_rows($query) == 0) {
?>
    <div class="alert alert-danger">
        Customer Not Found.
    </div>
<?php
    return;
}

$customer = mysqli_fetch_assoc($query);

?>


<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Payment History

            </h2>

            <p class="text-muted">

                Customer :
                <strong><?php echo $customer['customer_name']; ?></strong>

            </p>

        </div>

        <a href="admin.php?customer_jobs&id=<?php echo $customer['id']; ?>"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

</div>

<?php

// ===============================
// GET PAYMENT HISTORY
// ===============================

$payment_query = mysqli_query(

$conn,

"SELECT *
FROM payments
WHERE customer_id='$id'
ORDER BY payment_date DESC, id DESC"

);

?>

<div class="payment-card">

    <div class="card-header">

        <h5 class="mb-0">

            <i class="bi bi-clock-history"></i>

            Payment History

        </h5>

    </div>

    <div class="card-body payment-body p-0">

        <div class="table-responsive">

           <table class="table payment-table mb-0">

             <thead class="payment-head">

                    <tr>

                        <th>ID</th>

                        <th>Date</th>

                        <th>Amount</th>

                        <th>Method</th>

                        <th>Remarks</th>

                        <th>Created</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

<?php

if(mysqli_num_rows($payment_query)>0){

while($payment=mysqli_fetch_assoc($payment_query)){

?>

<tr>

<td>

<?php echo $payment['id']; ?>

</td>

<td>

<?php echo date("d M Y",strtotime($payment['payment_date'])); ?>

</td>

<td>

<span class="payment-amount">
    Rs. <?php echo number_format($payment['amount']); ?>
</span>

</td>

<td>

<span class="payment-method">
    <?php echo $payment['payment_method']; ?>
</span>

</td>

<td>

<?php echo $payment['remarks']; ?>

</td>

<td>

<?php echo date("d M Y",strtotime($payment['created_at'])); ?>

</td>

<td>

<a

href="delete-payment.php?id=<?php echo $payment['id']; ?>&customer_id=<?php echo $id; ?>"

class="btn btn-delete-payment btn-sm"

onclick="return confirm('Delete this payment?')"

>

Delete

</a>

<a
href="admin.php?edit_payment&id=<?php echo $payment['id']; ?>&customer_id=<?php echo $id; ?>"
class="btn btn-edit-payment btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" class="text-center py-4">

No Payment Found

</td>

</tr>

<?php

}

?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<style>

    /*=========================================
PAYMENT HISTORY PAGE
=========================================*/

.payment-body{

    background: var(--bg-primary);

}

.payment-card{

    background:var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:16px;
    overflow:hidden;
    box-shadow:var(--shadow-md);

}

.payment-card .card-header{

    background:var(--bg-secondary) !important;
    border-bottom:1px solid var(--border-color);
    padding:18px 22px;

}

.payment-card .card-header h5{

    margin:0;
    color:var(--text-primary);
    font-weight:700;

}


/*=========================================
TABLE
=========================================*/

.payment-table{

    width:100%;
    min-width:1100px;
    margin:0;

}

.payment-table thead{

    background:var(--bg-secondary);

}

.payment-table thead th{

    padding:16px;
    text-align:center;
    border:none;
    white-space:nowrap;
    color:var(--text-primary);
    font-weight:700;

}

.payment-table tbody td{

    padding:16px;
    vertical-align:middle;
    text-align:center;
    border-top:1px solid var(--border-color);
    color:var(--text-primary);

}

.payment-table tbody tr{

    transition:.25s;

}

.payment-table tbody tr:hover{

    background:var(--bg-secondary);

}

.payment-table.table-hover tbody tr:hover td{

    color:var(--text-primary) !important;

}


/*=========================================
BADGES
=========================================*/

.payment-amount{

    display:inline-block;

    background:rgba(39,174,96,.15);
    color:#27ae60;

    padding:7px 14px;

    border-radius:30px;

    font-weight:700;

}

.payment-method{

    display:inline-block;

    background:rgba(52,152,219,.15);
    color:#3498db;

    padding:6px 14px;

    border-radius:30px;

    font-size:13px;

    font-weight:600;

}


/*=========================================
BUTTONS
=========================================*/

.btn-edit-payment{

    background:#3498db;
    color:#fff;
    border:none;

}

.btn-edit-payment:hover{

    background:#2980b9;
    color:#fff;

}

.btn-delete-payment{

    background:#e74c3c;
    color:#fff;
    border:none;

}

.btn-delete-payment:hover{

    background:#c0392b;
    color:#fff;

}


/*=========================================
DARK MODE
=========================================*/

.dark-theme .payment-card{

    background:var(--bg-primary);

}

.dark-theme .payment-card .card-header{

    background:var(--bg-secondary) !important;

}

.dark-theme .payment-card .card-header h5{

    color:var(--text-primary);

}

.dark-theme .payment-table{

    color:var(--text-primary);

}

.dark-theme .payment-table thead th{

    color:var(--text-primary);

}

.dark-theme .payment-table tbody td{

    color:var(--text-primary);

}

.dark-theme .payment-table tbody tr:hover{

    background:var(--bg-secondary);

}


/*=========================================
RESPONSIVE
=========================================*/

@media(max-width:768px){

.payment-table{

    min-width:1000px;

}

.payment-table th,
.payment-table td{

    padding:12px;
    font-size:13px;

}

}

/* =====================================
FORCE PAYMENT TABLE
===================================== */

.payment-table thead,
.payment-table thead tr,
.payment-table thead th{

    background: var(--bg-secondary) !important;
    color: var(--text-primary) !important;

}

.payment-table tbody,
.payment-table tbody tr{

    background: var(--bg-primary) !important;

}

.payment-table tbody td{

    background: transparent !important;
    color: var(--text-primary) !important;

}

.payment-table tbody tr:hover{

    background: var(--bg-secondary) !important;

}

.payment-table tbody tr:hover td{

    background: var(--bg-secondary) !important;
    color: var(--text-primary) !important;

}

.payment-table tfoot,
.payment-table tfoot tr,
.payment-table tfoot th{

    background: var(--bg-secondary) !important;
    color: var(--text-primary) !important;

}

</style>