<?php

// =========================
// CHECK CUSTOMER ID
// =========================

if (!isset($_GET['id']) || empty($_GET['id'])) {
?>

<div class="alert alert-danger">
    Customer ID Not Found.
</div>

<?php
return;
}

$id = intval($_GET['id']);


// =========================
// GET CUSTOMER
// =========================

$sql = "SELECT * FROM customers WHERE id='$id'";
$query = mysqli_query(connection(), $sql);

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

$customer_name = mysqli_real_escape_string(
    connection(),
    $customer['customer_name']
);


// =========================
// DASHBOARD SUMMARY
// =========================

// Total Jobs
$total_jobs_query = mysqli_query(
    connection(),
    "SELECT COUNT(*) AS total
     FROM jobs
     WHERE customer_name='$customer_name'"
);

$total_jobs = mysqli_fetch_assoc($total_jobs_query);


// Total Quantity
$total_qty_query = mysqli_query(
    connection(),
    "SELECT IFNULL(SUM(total_qty),0) AS total
     FROM jobs
     WHERE customer_name='$customer_name'"
);

$total_qty = mysqli_fetch_assoc($total_qty_query);


// Total Amount
$total_amount_query = mysqli_query(
    connection(),
    "SELECT IFNULL(SUM(total_amount),0) AS total
     FROM jobs
     WHERE customer_name='$customer_name'"
);

$total_amount = mysqli_fetch_assoc($total_amount_query);


// Average Amount
$avg_amount_query = mysqli_query(
    connection(),
    "SELECT IFNULL(AVG(total_amount),0) AS total
     FROM jobs
     WHERE customer_name='$customer_name'"
);

$avg_amount = mysqli_fetch_assoc($avg_amount_query);

// =========================
// TOTAL PAYMENT RECEIVED
// =========================

$total_payment_query = mysqli_query(
    connection(),
    "SELECT IFNULL(SUM(amount),0) AS total
     FROM payments
     WHERE customer_id='$id'"
);

$total_payment = mysqli_fetch_assoc($total_payment_query);


// =========================
// OUTSTANDING BALANCE
// =========================

$outstanding = $total_amount['total'] - $total_payment['total'];

?>

<style>

/* =========================================
   CUSTOMER JOBS PAGE
========================================= */

.stats-card{

    background:var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:var(--radius-lg);
    padding:24px;
    box-shadow:var(--shadow-sm);
    transition:.3s;
    height:100%;

}

.stats-card:hover{

    transform:translateY(-4px);
    box-shadow:var(--shadow-lg);

}

.stats-icon{

    width:60px;
    height:60px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
    font-size:24px;

}

.primary-icon{

    background:rgba(52,152,219,.12);
    color:#3498db;

}

.success-icon{

    background:rgba(39,174,96,.12);
    color:#27ae60;

}

.warning-icon{

    background:rgba(243,156,18,.12);
    color:#f39c12;

}

.info-icon{

    background:rgba(155,89,182,.12);
    color:#9b59b6;

}

.jobs-card{

    background:var(--bg-primary);
    border-radius:var(--radius-lg);
    border:1px solid var(--border-color);
    overflow:hidden;
    box-shadow:var(--shadow-md);

}

.jobs-card .card-header{

    background:var(--bg-secondary);
    border-bottom:1px solid var(--border-color);
    padding:20px;

}

.jobs-card .card-header h5{

    margin:0;
    font-weight:700;
    color:var(--text-primary);

}

.jobs-table{

    margin:0;
    vertical-align:middle;

}

.jobs-table thead{

    background:var(--bg-secondary);

}

.jobs-table thead th{

    padding:15px;
    font-weight:700;
    white-space:nowrap;
    border:none;

}

.jobs-table tbody td{

    padding:14px;
    vertical-align:middle;

}

.jobs-table tbody tr:hover{

    background:var(--bg-secondary);

}

.job-name{

    font-weight:700;
    color:var(--text-primary);

}

.qty-badge{

    background:rgba(39,174,96,.12);
    color:#27ae60;
    padding:6px 12px;
    border-radius:30px;
    font-weight:700;

}

.price-badge{

    background:rgba(52,152,219,.12);
    color:#3498db;
    padding:6px 12px;
    border-radius:30px;
    font-weight:700;

}

.action-buttons{

    display:flex;
    gap:8px;

}

.btn-edit{

    background:rgba(39,174,96,.12);
    color:#27ae60;
    border:none;
    border-radius:8px;
    padding:8px 14px;

}

.btn-delete{

    background:rgba(231,76,60,.12);
    color:#e74c3c;
    border:none;
    border-radius:8px;
    padding:8px 14px;

}

.table-responsive{

    overflow-x:auto;

}

@media(max-width:768px){

.jobs-table thead th,
.jobs-table tbody td{

font-size:12px;
padding:10px;

}

}

/* =========================================
   JOB TABLE FIX
========================================= */

.jobs-card{
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.jobs-card .card-header{
    background: var(--bg-secondary);
    padding:18px 22px;
    border-bottom:1px solid var(--border-color);
}

.jobs-card .card-body{
    padding:0;
}

.table-responsive{
    width:100%;
    overflow-x:auto;
}

.jobs-table{
    width:100%;
    min-width:1300px;
    margin:0;
    border-collapse:collapse;
}

.jobs-table thead tr{
    background:var(--bg-secondary);
}

.jobs-table thead th{

    background:var(--bg-secondary) !important;
    color:var(--text-primary) !important;

    padding:16px;
    text-align:center;

    font-size:14px;
    font-weight:700;

    border:none;
    white-space:nowrap;

}

.jobs-table tbody tr{

    transition:.25s;
    border-bottom:1px solid var(--border-color);

}

.jobs-table tbody tr:hover{

    background:var(--bg-secondary);

}

.jobs-table tbody td{

    padding:16px;
    text-align:center;
    vertical-align:middle;

    color:var(--text-primary);

    border:none;
    white-space:nowrap;

}

.job-name{

    font-weight:700;
    color:var(--text-primary);

}

.qty-badge{

    display:inline-block;

    background:rgba(39,174,96,.12);
    color:#27ae60;

    padding:7px 14px;

    border-radius:30px;
    font-weight:700;

}

.price-badge{

    display:inline-block;

    background:rgba(52,152,219,.12);
    color:#3498db;

    padding:7px 14px;

    border-radius:30px;
    font-weight:700;

}

/* REMOVE BOOTSTRAP HOVER */

.jobs-table.table-hover tbody tr:hover td{

    color:var(--text-primary) !important;

}

.jobs-table.table-hover tbody tr:hover{

    background:var(--bg-secondary) !important;

}

/* REMOVE BLUE SELECTION */

.jobs-table th:focus,
.jobs-table td:focus{

    outline:none;
    box-shadow:none;

}

@media(max-width:768px){

.jobs-table{

min-width:1100px;

}

.jobs-table th,
.jobs-table td{

padding:12px;
font-size:12px;

}

}

</style>    
<!-- ===========================
     PAGE HEADER
============================ -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>

        <h2 class="fw-bold mb-1">
            <?php echo $customer['customer_name']; ?>
        </h2>

        <p class="text-muted mb-0">
            Customer Jobs History
        </p>

    </div>

    <div>

        <a href="admin.php?reports" class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Back

        </a>

    </div>

</div>



<!-- ===========================
     SUMMARY CARDS
============================ -->

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon primary-icon">

                <i class="bi bi-briefcase"></i>

            </div>

            <h3>

                <?php echo $total_jobs['total']; ?>

            </h3>

            <p class="text-muted mb-0">

                Total Jobs

            </p>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon success-icon">

                <i class="bi bi-box-seam"></i>

            </div>

            <h3>

                <?php echo $total_qty['total'] ? number_format($total_qty['total']) : 0; ?>

            </h3>

            <p class="text-muted mb-0">

                Total Quantity

            </p>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon warning-icon">

                <i class="bi bi-cash-stack"></i>

            </div>

            <h3>

                Rs.
                <?php echo $total_amount['total'] ? number_format($total_amount['total']) : 0; ?>

            </h3>

            <p class="text-muted mb-0">

                Total Amount

            </p>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon info-icon">

                <i class="bi bi-graph-up"></i>

            </div>

            <h3>

                Rs.
                <?php echo $avg_amount['total'] ? number_format($avg_amount['total']) : 0; ?>

            </h3>

            <p class="text-muted mb-0">

                Average Amount

            </p>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-icon success-icon">

            <i class="bi bi-wallet2"></i>

        </div>

        <h3>

            Rs. <?php echo number_format($total_payment['total']); ?>

        </h3>

        <p class="text-muted mb-0">

            Payment Received

        </p>

    </div>

</div>

<div class="col-lg-3 col-md-6">

    <div class="stats-card">

        <div class="stats-icon warning-icon">

            <i class="bi bi-exclamation-circle"></i>

        </div>

        <h3>

            Rs. <?php echo number_format($outstanding); ?>

        </h3>

        <p class="text-muted mb-0">

            Outstanding Balance

        </p>

    </div>

</div>

</div>





<!-- ===========================
     JOBS TABLE
============================ -->

<div class="jobs-card">

    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">

    <h5 class="mb-2 mb-lg-0">

        <i class="bi bi-list-check me-2"></i>

        All Jobs of <?php echo $customer['customer_name']; ?>

    </h5>

    <div class="d-flex align-items-center gap-2">

        <span class="badge bg-primary fs-6">

            Total :
            <?php echo $total_jobs['total']; ?>

        </span>

        <button
            type="button"
            class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#printBillModal">

            <i class="bi bi-printer"></i>

            Print Bill

        </button>

        <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#paymentModal">

    <i class="bi bi-cash-stack"></i>

    Add Payment

</button>

<a href="admin.php?payment_history&id=<?php echo $customer['id']; ?>"
class="btn btn-warning">

    <i class="bi bi-clock-history"></i>

    Payment History

</a>
<a
href="admin.php?ledger&id=<?php echo $customer['id']; ?>"
class="btn btn-dark">

<i class="bi bi-journal-text"></i>

Ledger

</a>

    </div>

</div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover jobs-table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Job Date</th>
                        <th>Job Name</th>
                        <th>Sample No</th>
                        <th>Worker</th>
                        <th>Machine</th>
                        <th>Job Qty</th>
                        <th>Color</th>
                        <th>Total Qty</th>
                        <th>Total Amount</th>
                        <th>Created</th>

                    </tr>

                </thead>

                <tbody>

<?php

$sql = "SELECT * FROM jobs
        WHERE customer_name='$customer_name'
        ORDER BY id DESC";

$query = mysqli_query(connection(), $sql);

if(mysqli_num_rows($query) > 0){

while($job = mysqli_fetch_assoc($query)){

?>
                    <tr>

                        <td>
                            #<?php echo $job['id']; ?>
                        </td>

                        <td>

                            <?php
                            echo date("d M Y", strtotime($job['job_date']));
                            ?>

                        </td>

                        <td>

                            <div class="job-name">
                                <?php echo $job['job_name']; ?>
                            </div>

                        </td>

                        <td>

                            <?php echo $job['sample_no']; ?>

                        </td>

                        <td>

                            <?php echo $job['worker_name']; ?>

                        </td>

                        <td>

                            <?php echo $job['machine']; ?>

                        </td>

                        <td>

                            <span class="qty-badge">

                                <?php echo number_format($job['job_qty']); ?>

                            </span>

                        </td>

                        <td>

                            <?php echo $job['job_color']; ?>

                        </td>

                        <td>

                            <span class="qty-badge">

                                <?php echo number_format($job['total_qty']); ?>

                            </span>

                        </td>

                        <td>

                            <span class="price-badge">

                                Rs.
                                <?php echo number_format($job['total_amount']); ?>

                            </span>

                        </td>

                        <td>

                            <?php
                            echo date("d M Y", strtotime($job['created_at']));
                            ?>

                        </td>

                    </tr>

<?php

    }

}else{

?>

<tr>

    <td colspan="11" class="text-center py-5">

        <img
        src="https://cdn-icons-png.flaticon.com/512/7466/7466141.png"
        width="120"
        class="mb-3">

        <h4 class="fw-bold">

            No Jobs Found

        </h4>

        <p class="text-muted">

            This customer has no jobs yet.

        </p>

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

<!-- PRINT BILL MODAL -->

<div class="modal fade"
id="printBillModal"
tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">

Generate Customer Bill

</h5>

<button
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>


<form action="print-bill.php" method="GET">

<div class="modal-body">

<input
type="hidden"
name="id"
value="<?php echo $customer['id']; ?>">

<div class="mb-3">

<label class="form-label">

Start Date

</label>

<input

type="date"

name="from"

class="form-control"

required>

</div>


<div class="mb-3">

<label class="form-label">

End Date

</label>

<input

type="date"

name="to"

class="form-control"

required>

</div>

</div>


<div class="modal-footer">

<button

type="button"

class="btn btn-secondary"

data-bs-dismiss="modal">

Cancel

</button>


<button

type="submit"

class="btn btn-success">

<i class="bi bi-printer"></i>

Generate PDF

</button>

</div>

</form>

</div>

</div>

</div>

<!-- ==========================
     ADD PAYMENT MODAL
========================== -->

<div class="modal fade"
id="paymentModal"
tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<form
action="add-payment.php"
method="POST">

<div class="modal-header">

<h5 class="modal-title">

<i class="bi bi-cash-stack"></i>

Add Payment

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>


<div class="modal-body">

<input
type="hidden"
name="customer_id"
value="<?php echo $customer['id']; ?>">

<div class="mb-3">

<label class="form-label">

Payment Date

</label>

<input
type="date"
name="payment_date"
class="form-control"
required>

</div>


<div class="mb-3">

<label class="form-label">

Amount

</label>

<input
type="number"
name="amount"
class="form-control"
placeholder="Enter Amount"
required>

</div>


<div class="mb-3">

<label class="form-label">

Payment Method

</label>

<select
name="payment_method"
class="form-select">

<option value="Cash">Cash</option>

<option value="Bank">Bank Transfer</option>

<option value="JazzCash">JazzCash</option>

<option value="EasyPaisa">EasyPaisa</option>

<option value="Cheque">Cheque</option>

</select>

</div>


<div class="mb-3">

<label class="form-label">

Remarks

</label>

<textarea
name="remarks"
class="form-control"
rows="3"
placeholder="Optional"></textarea>

</div>

</div>


<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancel

</button>

<button
type="submit"
class="btn btn-success">

<i class="bi bi-check-circle"></i>

Save Payment

</button>

</div>

</form>

</div>

</div>

</div>