<?php

$conn = connection();

/* ==========================================
   MONTHLY REVENUE
========================================== */

$monthly_query = mysqli_query(connection(),

"SELECT

MONTH(job_date) AS month_no,

DATE_FORMAT(job_date,'%b') AS month_name,

IFNULL(SUM(total_amount),0) AS revenue

FROM jobs

GROUP BY MONTH(job_date)

ORDER BY MONTH(job_date)"

);

$monthLabels = [];
$monthRevenue = [];

while($row = mysqli_fetch_assoc($monthly_query)){

    $monthLabels[]  = $row['month_name'];
    $monthRevenue[] = $row['revenue'];

}


/* ==========================================
   TOP CUSTOMERS
========================================== */

$top_customers = mysqli_query(connection(),

"SELECT

customer_name,

COUNT(*) total_jobs,

SUM(total_amount) total_amount

FROM jobs

GROUP BY customer_name

ORDER BY total_amount DESC

LIMIT 5"

);


/* ==========================================
   RECENT PAYMENTS
========================================== */

$recent_payments = mysqli_query(connection(),

"SELECT

payments.*,

customers.customer_name

FROM payments

INNER JOIN customers

ON customers.id = payments.customer_id

ORDER BY payments.id DESC

LIMIT 5"

);


// TOTAL BUSINESS (Revenue + Jobs based summary)
$total_business_query = mysqli_query(connection(),
"SELECT IFNULL(SUM(total_amount),0) AS total_business FROM jobs");

$total_business = mysqli_fetch_assoc($total_business_query)['total_business'];



// TOTAL REVENUE (ALL TIME)
$total_revenue_query = mysqli_query(connection(),
"SELECT IFNULL(SUM(total_amount),0) AS total_revenue FROM jobs");

$total_revenue = mysqli_fetch_assoc($total_revenue_query)['total_revenue'];


// TODAY REVENUE
$today_revenue_query = mysqli_query(connection(),
"SELECT IFNULL(SUM(total_amount),0) AS today_revenue
FROM jobs
WHERE DATE(job_date)=CURDATE()");

$today_revenue = mysqli_fetch_assoc($today_revenue_query)['today_revenue'];



/* ==========================================
   OUTSTANDING BALANCE
========================================== */

$total_payment_query = mysqli_query(connection(),

"SELECT IFNULL(SUM(amount),0) total
FROM payments"

);

$total_payment = mysqli_fetch_assoc($total_payment_query)['total'];

$outstanding_balance = $total_business - $total_payment;



/* =========================================
   EXPENSE STATISTICS
========================================= */

// TOTAL EXPENSES

$total_expense_query = mysqli_query(

connection(),

"SELECT IFNULL(SUM(amount),0) AS total_expense

FROM expenses"

);

$total_expense = mysqli_fetch_assoc($total_expense_query)['total_expense'];



// TODAY EXPENSE

$today_expense_query = mysqli_query(

connection(),

"SELECT IFNULL(SUM(amount),0) AS today_expense

FROM expenses

WHERE DATE(expense_date)=CURDATE()"

);

$today_expense = mysqli_fetch_assoc($today_expense_query)['today_expense'];



// TOTAL EXPENSE RECORDS

$total_expense_records_query = mysqli_query(

connection(),

"SELECT COUNT(*) AS total

FROM expenses"

);

$total_expense_records = mysqli_fetch_assoc($total_expense_records_query)['total'];



// NET PROFIT

$net_profit = $total_revenue - $total_expense;



/*=========================================
TOTAL CUSTOMERS
=========================================*/

$total_customers = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) total FROM customers")

)['total'];


/*=========================================
TOTAL WORKERS
=========================================*/

$total_workers = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) total FROM workers")

)['total'];


/*=========================================
TOTAL JOBS
=========================================*/

$total_jobs = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) total FROM jobs")

)['total'];


/*=========================================
TOTAL QUANTITY
=========================================*/

$total_qty = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT IFNULL(SUM(total_qty),0) total
FROM jobs")

)['total'];


/*=========================================
TOTAL BUSINESS
=========================================*/

$total_business = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT IFNULL(SUM(total_amount),0) total
FROM jobs")

)['total'];


/*=========================================
TOTAL PAYMENTS RECEIVED
=========================================*/

$total_received = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT IFNULL(SUM(amount),0) total
FROM payments")

)['total'];


/*=========================================
OUTSTANDING BALANCE
=========================================*/

$outstanding = $total_business - $total_received;


/*=========================================
TODAY JOBS
=========================================*/

$today_jobs = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM jobs
WHERE DATE(job_date)=CURDATE()")

)['total'];


/*=========================================
TODAY INCOME
=========================================*/

$today_income = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT IFNULL(SUM(total_amount),0) total
FROM jobs
WHERE DATE(job_date)=CURDATE()")

)['total'];


/*=========================================
TOTAL MACHINES
=========================================*/

$total_machines = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(DISTINCT machine) total
FROM jobs")

)['total'];


/*=========================================
TOTAL PAYMENTS COUNT
=========================================*/

$total_payments = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM payments")

)['total'];


/*=========================================
LATEST JOBS
=========================================*/

$recent_jobs = mysqli_query(

$conn,

"SELECT *

FROM jobs

ORDER BY id DESC

LIMIT 10"

);


$today_query = mysqli_query(
    connection(),
    "SELECT
        COUNT(*) AS total_jobs,
        IFNULL(SUM(total_qty),0) AS qty,
        IFNULL(SUM(total_amount),0) AS revenue
     FROM jobs
     WHERE DATE(job_date)=CURDATE()"
);

$today = mysqli_fetch_assoc($today_query);



/* =========================================
   MONTHLY ANALYTICS
========================================= */

// CURRENT MONTH REVENUE

$monthly_revenue_query = mysqli_query(

connection(),

"SELECT IFNULL(SUM(total_amount),0) AS revenue

FROM jobs

WHERE MONTH(job_date)=MONTH(CURDATE())

AND YEAR(job_date)=YEAR(CURDATE())"

);

$monthly_revenue = mysqli_fetch_assoc($monthly_revenue_query)['revenue'];



// CURRENT MONTH EXPENSE

$monthly_expense_query = mysqli_query(

connection(),

"SELECT IFNULL(SUM(amount),0) AS expense

FROM expenses

WHERE MONTH(expense_date)=MONTH(CURDATE())

AND YEAR(expense_date)=YEAR(CURDATE())"

);

$monthly_expense = mysqli_fetch_assoc($monthly_expense_query)['expense'];



// MONTHLY PROFIT

$monthly_profit = $monthly_revenue - $monthly_expense;


/* =========================================
   TOP CUSTOMERS
========================================= */

$top_customers = mysqli_query(

connection(),

"SELECT

customer_name,

COUNT(*) AS total_jobs,

SUM(total_amount) AS total_business

FROM jobs

GROUP BY customer_name

ORDER BY total_business DESC

LIMIT 5"

);


/* =========================================
   TOP WORKERS
========================================= */

$top_workers = mysqli_query(

connection(),

"SELECT

worker_name,

COUNT(*) AS total_jobs,

SUM(total_amount) AS total_business

FROM jobs

GROUP BY worker_name

ORDER BY total_business DESC

LIMIT 5"

);


/* =========================================
   TOP MACHINES
========================================= */

$top_machines = mysqli_query(

connection(),

"SELECT

machine,

COUNT(*) AS total_jobs,

SUM(total_qty) AS total_qty

FROM jobs

GROUP BY machine

ORDER BY total_jobs DESC

LIMIT 5"

);



/*=========================================
LATEST PAYMENTS
=========================================*/

$recent_payments = mysqli_query(

$conn,

"SELECT

payments.*,

customers.customer_name

FROM payments

LEFT JOIN customers

ON customers.id = payments.customer_id

ORDER BY payments.id DESC

LIMIT 5"

);


$top_machine_query = mysqli_query(
    connection(),
    "SELECT machine, COUNT(*) AS total
     FROM jobs
     GROUP BY machine
     ORDER BY total DESC
     LIMIT 1"
);

$top_machine = mysqli_fetch_assoc($top_machine_query);



?>

<!-- DASHBOARD HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>

        <h1 class="h3 fw-bold mb-1">DASHBOARD</h1>

        <p class="text-muted mb-0">
            WELLCOME BROO!
        </p>

    </div>

    <div class="d-flex align-items-center gap-2">

        <button id="themeToggle" class="btn btn-outline-secondary">
            <i class="bi bi-moon"></i>
        </button>

        <a href="admin.php?add_job" class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Add New Job

        </a>
<a href="backup-database.php" class="btn btn-success">
    <i class="bi bi-download me-1"></i>
    Database Backup
</a>


    </div>

</div>

<!-- =========================
     TODAY STATUS
========================= -->

<div class="row g-4 mb-4">

    <!-- Today Jobs -->
    <div class="col-xl-4 col-md-6">

        <div class="stats-card">

            <div class="stats-icon warning-icon">

                <i class="bi bi-calendar-event-fill"></i>

            </div>

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">
                        <?php echo number_format($today_jobs); ?>
                    </h3>

                    <p class="text-muted mb-0">
                        Today's Jobs
                    </p>

                </div>

                <span class="badge bg-warning fs-6">
                    Today
                </span>

            </div>

        </div>

    </div>


    <!-- Today Revenue -->

    <div class="col-xl-4 col-md-6">

        <div class="stats-card">

            <div class="stats-icon success-icon">

               <span class="fw-bold">Rs.</span>
            </div>

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">

                        Rs. <?php echo number_format($today_revenue); ?>

                    </h3>

                    <p class="text-muted mb-0">

                        Today's Revenue

                    </p>

                </div>

                <span class="badge bg-success fs-6">

                    Income

                </span>

            </div>

        </div>

    </div>


    <!-- Total Quantity -->

    <div class="col-xl-4 col-md-12">

        <div class="stats-card">

            <div class="stats-icon primary-icon">

                <i class="bi bi-box-seam-fill"></i>

            </div>

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="mb-1">

                        <?php echo number_format($total_qty); ?>

                    </h3>

                    <p class="text-muted mb-0">

                        Total Printed Quantity

                    </p>

                </div>

                <span class="badge bg-primary fs-6">

                    Qty

                </span>

            </div>

        </div>

    </div>

</div>



<!-- =========================
     RECENT JOBS TABLE
========================= -->

<div class="dashboard-card mb-4">

    <div class="dashboard-card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-clock-history me-2"></i>

            Recent Jobs

        </h5>

        <a href="admin.php?reports"
           class="btn btn-sm btn-primary">

            View All

        </a>

    </div>

    <div class="table-responsive">

        <table class="dashboard-table">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Job</th>
                    <th>Worker</th>
                    <th>Machine</th>
                    <th>Amount</th>

                </tr>

            </thead>

            <tbody>

            <?php

            if(mysqli_num_rows($recent_jobs)>0){

                while($job=mysqli_fetch_assoc($recent_jobs)){

            ?>

                <tr>

                    <td>

                        <span class="order-id">

                            #<?php echo $job['id']; ?>

                        </span>

                    </td>

                    <td>

                        <?php echo date("d M Y",strtotime($job['job_date'])); ?>

                    </td>

                    <td>

                        <strong>

                            <?php echo $job['customer_name']; ?>

                        </strong>

                    </td>

                    <td>

                        <?php echo $job['job_name']; ?>

                    </td>

                    <td>

                        <?php echo $job['worker_name']; ?>

                    </td>

                    <td>

                        <span class="badge bg-secondary">

                            <?php echo $job['machine']; ?>

                        </span>

                    </td>

                    <td>

                        <span class="amount-badge">

                            Rs. <?php echo number_format($job['total_amount']); ?>

                        </span>

                    </td>

                </tr>

            <?php

                }

            }else{

            ?>

                <tr>

                    <td colspan="7" class="text-center py-5">

                        <h5 class="text-muted">

                            No Jobs Found

                        </h5>

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

<!-- =========================
     EXPENSE SUMMARY
========================= -->

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon danger-icon">

                <i class="bi bi-wallet2"></i>

            </div>

            <h3>

                Rs. <?php echo number_format($total_expense); ?>

            </h3>

            <p class="text-muted mb-0">

                Total Expenses

            </p>

        </div>

    </div>



    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon warning-icon">

                <i class="bi bi-calendar-minus"></i>

            </div>

            <h3>

                Rs. <?php echo number_format($today_expense); ?>

            </h3>

            <p class="text-muted mb-0">

                Today's Expenses

            </p>

        </div>

    </div>



    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon info-icon">

                <i class="bi bi-receipt"></i>

            </div>

            <h3>

                <?php echo $total_expense_records; ?>

            </h3>

            <p class="text-muted mb-0">

                Expense Entries

            </p>

        </div>

    </div>



    <div class="col-lg-3 col-md-6">

        <div class="stats-card">

            <div class="stats-icon success-icon">

                <i class="bi bi-graph-up-arrow"></i>

            </div>

            <h3 class="<?php echo ($net_profit>=0)?'text-success':'text-danger'; ?>">

                Rs. <?php echo number_format($net_profit); ?>

            </h3>

            <p class="text-muted mb-0">

                Net Profit

            </p>

        </div>

    </div>

</div>


<!-- ==========================================
     QUICK STATISTICS
========================================== -->

<div class="row g-4 mt-2">

    <!-- Quick Stats -->

    <div class="col-xl-6">

        <div class="dashboard-card h-100">

            <div class="dashboard-card-header">

                <h5>
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    Quick Statistics
                </h5>

            </div>

            <div class="dashboard-card-body">

                <div class="row text-center">

                    <div class="col-6 mb-4">

                        <div class="mini-stat">

                            <i class="bi bi-briefcase-fill text-warning fs-2"></i>

                            <h3 class="mt-2">
                                <?php echo number_format($total_jobs); ?>
                            </h3>

                            <small>Total Jobs</small>

                        </div>

                    </div>


                    <div class="col-6 mb-4">

                        <div class="mini-stat">

                            <i class="bi bi-people-fill text-primary fs-2"></i>

                            <h3 class="mt-2">
                                <?php echo number_format($total_customers); ?>
                            </h3>

                            <small>Customers</small>

                        </div>

                    </div>


                    <div class="col-6">

                        <div class="mini-stat">

                            <i class="bi bi-person-workspace text-success fs-2"></i>

                            <h3 class="mt-2">
                                <?php echo number_format($total_workers); ?>
                            </h3>

                            <small>Workers</small>

                        </div>

                    </div>


                    <div class="col-6">

                        <div class="mini-stat">

                            <i class="bi bi-currency-dollar text-danger fs-2"></i>

                            <h3 class="mt-2">

                                Rs. <?php echo number_format($total_revenue); ?>

                            </h3>

                            <small>Total Revenue</small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4 mt-4">

    <!-- Monthly Revenue -->

    <div class="col-lg-8">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <h5>

                    <i class="bi bi-bar-chart-line-fill"></i>

                    Monthly Revenue

                </h5>

            </div>

            <div class="dashboard-card-body">

                <canvas id="monthlyRevenueChart" height="120"></canvas>

            </div>

        </div>

    </div>


    <!-- =========================
     MONTHLY ANALYTICS
========================= -->

<div class="dashboard-card mb-4">

    <div class="dashboard-card-header">

        <h5>

            <i class="bi bi-bar-chart-fill"></i>

            Current Month Analytics

        </h5>

    </div>

    <div class="dashboard-card-body">

        <div class="row">

            <div class="col-md-4 text-center">

                <h6 class="text-muted">

                    Revenue

                </h6>

                <h2 class="text-primary">

                    Rs. <?php echo number_format($monthly_revenue); ?>

                </h2>

            </div>



            <div class="col-md-4 text-center">

                <h6 class="text-muted">

                    Expenses

                </h6>

                <h2 class="text-danger">

                    Rs. <?php echo number_format($monthly_expense); ?>

                </h2>

            </div>



            <div class="col-md-4 text-center">

                <h6 class="text-muted">

                    Profit

                </h6>

                <h2 class="<?php echo ($monthly_profit>=0)?'text-success':'text-danger'; ?>">

                    Rs. <?php echo number_format($monthly_profit); ?>

                </h2>

            </div>

        </div>

    </div>

</div>



    <!-- Outstanding -->

    <div class="col-lg-4">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <h5>

                    Outstanding Balance

                </h5>

            </div>

            <div class="dashboard-card-body text-center">

                <h2 class="text-danger">

                    Rs. <?php echo number_format($outstanding_balance); ?>

                </h2>

                <p class="text-muted">

                    Remaining Amount

                </p>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mt-4">

<div class="col-lg-6">

<div class="dashboard-card">

<div class="dashboard-card-header">

<h5>

Top Customers

</h5>

</div>

<div class="table-responsive">

<table class="dashboard-table">

<thead>

<tr>

<th>Customer</th>

<th>Jobs</th>

<th>Revenue</th>

</tr>

</thead>

<tbody>

<?php while($customer=mysqli_fetch_assoc($top_customers)){ ?>

<tr>

<td>

<?php echo $customer['customer_name']; ?>

</td>

<td>

<?php echo $customer['total_jobs']; ?>

</td>

<td>

Rs. <?php echo number_format($customer['total_business']); ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>



<div class="col-lg-6">

<div class="dashboard-card">

<div class="dashboard-card-header">

<h5>

Recent Payments

</h5>

</div>

<div class="table-responsive">

<table class="dashboard-table">

<thead>

<tr>

<th>Customer</th>

<th>Method</th>

<th>Amount</th>

</tr>

</thead>

<tbody>

<?php while($payment=mysqli_fetch_assoc($recent_payments)){ ?>

<tr>

<td>

<?php echo $payment['customer_name']; ?>

</td>

<td>

<?php echo $payment['payment_method']; ?>

</td>

<td>

<span class="amount-badge">

Rs. <?php echo number_format($payment['amount']); ?>

</span>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>




    <!-- System Summary -->

    <div class="col-xl-6">

        <div class="dashboard-card h-100">

            <div class="dashboard-card-header">

                <h5>

                    <i class="bi bi-clipboard-data-fill me-2"></i>

                    System Summary

                </h5>

            </div>

            <div class="dashboard-card-body p-0">

                <table class="table dashboard-summary-table mb-0">

                    <tbody>

                        <tr>

                            <td>

                                <i class="bi bi-cpu me-2 text-primary"></i>

                                Total Machines

                            </td>

                            <td class="text-end fw-bold">

                                <?php echo $total_machines; ?>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                <i class="bi bi-box-seam me-2 text-success"></i>

                                Total Quantity

                            </td>

                            <td class="text-end fw-bold">

                                <?php echo number_format($total_qty); ?>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                <i class="bi bi-calendar-check me-2 text-warning"></i>

                                Today's Jobs

                            </td>

                            <td class="text-end fw-bold">

                                <?php echo number_format($today_jobs); ?>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                <i class="bi bi-cash-stack me-2 text-danger"></i>

                                Today's Revenue

                            </td>

                            <td class="text-end fw-bold text-success">

                                Rs. <?php echo number_format($today_revenue); ?>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mt-4">

<!-- Machine Chart -->

<div class="col-lg-8">

<div class="dashboard-card">

<div class="dashboard-card-header">

<h5>

<i class="bi bi-cpu"></i>

Machine Wise Production

</h5>

</div>

<div class="dashboard-card-body">

<canvas id="machineChart" height="120"></canvas>

</div>

</div>

</div>



<!-- Today Summary -->

<div class="col-lg-4">

<div class="dashboard-card">

<div class="dashboard-card-header">

<h5>

<i class="bi bi-lightning-charge-fill"></i>

Today's Summary

</h5>

</div>

<div class="dashboard-card-body">

<div class="mini-stat">

<span>Today's Jobs</span>

<strong>

<?php echo $today['total_jobs']; ?>

</strong>

</div>


<div class="mini-stat">

<span>Today's Quantity</span>

<strong>

<?php echo number_format($today['qty']); ?>

</strong>

</div>


<div class="mini-stat">

<span>Today's Revenue</span>

<strong class="text-success">

Rs. <?php echo number_format($today['revenue']); ?>

</strong>

</div>


<div class="mini-stat">

<span>Top Machine</span>

<strong>

<?php echo $top_machine['machine'] ?? 'No Machine'; ?>

</strong>

</div>

</div>

</div>

</div>

</div>


<?php



/* ==========================================
   MONTHLY REVENUE
========================================== */

$monthly_revenue = mysqli_query(connection(),

"SELECT

MONTH(job_date) AS month,

SUM(total_amount) AS total

FROM jobs

WHERE YEAR(job_date)=YEAR(CURDATE())

GROUP BY MONTH(job_date)

ORDER BY MONTH(job_date)

");

$chartData = array_fill(1,12,0);

while($row=mysqli_fetch_assoc($monthly_revenue)){

    $chartData[$row['month']] = $row['total'];

}


/* ==========================================
TOP 5 CUSTOMERS
========================================== */

$top_customers = mysqli_query(connection(),

"SELECT

customer_name,

SUM(total_amount) total

FROM jobs

GROUP BY customer_name

ORDER BY total DESC

LIMIT 5"

);


/* ==========================================
TOP 5 WORKERS
========================================== */

$top_workers = mysqli_query(connection(),

"SELECT

worker_name,

COUNT(*) total_jobs

FROM jobs

GROUP BY worker_name

ORDER BY total_jobs DESC

LIMIT 5"

);

?>

<?php

/* ==========================================
   MACHINE WISE PRODUCTION
========================================== */

$machine_chart = mysqli_query(connection(),

"SELECT

machine,

SUM(total_qty) qty

FROM jobs

GROUP BY machine

ORDER BY qty DESC"

);

$machineLabels = [];
$machineQty = [];

while($row=mysqli_fetch_assoc($machine_chart)){

    $machineLabels[] = $row['machine'];
    $machineQty[]    = $row['qty'];

}




/* ==========================================
TODAY PERFORMANCE
========================================== */

$today = mysqli_fetch_assoc(

mysqli_query(connection(),

"SELECT

COUNT(*) total_jobs,

IFNULL(SUM(total_qty),0) qty,

IFNULL(SUM(total_amount),0) revenue

FROM jobs

WHERE DATE(job_date)=CURDATE()")

);


/* ==========================================
TOP MACHINE
========================================== */

$top_machine = mysqli_fetch_assoc(

mysqli_query(connection(),

"SELECT

machine,

COUNT(*) total

FROM jobs

GROUP BY machine

ORDER BY total DESC

LIMIT 1")

);



?>


<div class="row g-4 mt-4">

    <!-- Monthly Revenue -->

    <div class="col-xl-8">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <h5>

                    <i class="bi bi-graph-up-arrow me-2"></i>

                    Monthly Revenue

                </h5>

            </div>

            <div class="dashboard-card-body">

                <canvas id="revenueChart" height="100"></canvas>

            </div>

        </div>

    </div>


    <!-- Top Customers -->

    <div class="col-xl-4">

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <h5>

                    <i class="bi bi-trophy-fill me-2"></i>

                    Top Customers

                </h5>

            </div>

            <div class="dashboard-card-body">

<?php

while($customer=mysqli_fetch_assoc($top_customers)){

?>

<div class="top-item">

<div>

<strong>

<?php echo $customer['customer_name']; ?>

</strong>

</div>

<div class="text-success fw-bold">

Rs. <?php echo number_format($customer['total']); ?>

</div>

</div>

<?php } ?>

            </div>

        </div>

    </div>

</div>



<div class="row mt-4">

<div class="col-lg-12">

<div class="dashboard-card">

<div class="dashboard-card-header">

<h5>

<i class="bi bi-person-workspace me-2"></i>

Top Workers

</h5>

</div>

<div class="dashboard-card-body p-0">

<table class="table dashboard-table mb-0">

<thead>

<tr>

<th>#</th>

<th>Worker</th>

<th>Total Jobs</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($worker=mysqli_fetch_assoc($top_workers)){

?>

<tr>

<td>

<?php echo $no++; ?>

</td>

<td>

<?php echo $worker['worker_name']; ?>

</td>

<td>

<span class="badge bg-success">

<?php echo $worker['total_jobs']; ?>

</span>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('revenueChart');

new Chart(ctx,{

type:'line',

data:{

labels:[
'Jan','Feb','Mar','Apr','May','Jun',
'Jul','Aug','Sep','Oct','Nov','Dec'
],

datasets:[{

label:'Revenue',

data:[

<?php

for($i=1;$i<=12;$i++){

echo $chartData[$i];

if($i<12) echo ",";

}

?>

],

fill:true,

tension:.4,

borderWidth:3

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

},

scales:{

y:{

beginAtZero:true

}

}

}

});

</script>

<script>

const revenueCTX=document.getElementById("monthlyRevenueChart");

new Chart(revenueCTX,{

type:"line",

data:{

labels:[

<?php

foreach($monthLabels as $key=>$label){

echo "'".$label."'";

if($key<count($monthLabels)-1) echo ",";

}

?>

],

datasets:[{

label:"Revenue",

data:[

<?php

foreach($monthRevenue as $key=>$amount){

echo $amount;

if($key<count($monthRevenue)-1) echo ",";

}

?>

],

fill:false,

tension:.4,

borderWidth:3

}]

},

options:{

responsive:true,

plugins:{

legend:{display:false}

},

scales:{

y:{

beginAtZero:true

}

}

}

});

</script>



<script>

const machineCTX=document.getElementById("machineChart");

new Chart(machineCTX,{

type:"bar",

data:{

labels:[
<?php

foreach($machineLabels as $key=>$label){

echo "'".$label."'";

if($key<count($machineLabels)-1) echo ",";

}

?>

],

datasets:[{

label:"Quantity",

data:[

<?php

foreach($machineQty as $key=>$qty){

echo $qty;

if($key<count($machineQty)-1) echo ",";

}

?>

],

borderWidth:2

}]

},

options:{

responsive:true,

plugins:{

legend:{display:false}

},

scales:{

y:{

beginAtZero:true

}

}

}

});

</script>



<style>



/* ==========================================
   RECENT JOBS TABLE
========================================== */

.dashboard-card{
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.dashboard-card-header{
    background: var(--bg-secondary);
    padding: 18px 22px;
    border-bottom: 1px solid var(--border-color);
}

.dashboard-card-header h5{
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
}

.dashboard-table{
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.dashboard-table thead{
    background: var(--bg-secondary);
}

.dashboard-table thead th{
    padding: 16px;
    color: var(--text-primary);
    font-size: 14px;
    font-weight: 700;
    border-bottom: 1px solid var(--border-color);
    white-space: nowrap;
}

.dashboard-table tbody td{
    padding: 16px;
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

.dashboard-table tbody tr{
    transition: .3s ease;
}

.dashboard-table tbody tr:hover{
    background: var(--bg-secondary);
}

.order-id{
    font-weight: 700;
    color: var(--primary-color);
}

.amount-badge{
    display: inline-block;
    background: rgba(39,174,96,.12);
    color: var(--success-color);
    padding: 7px 14px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 13px;
}

.dashboard-table .badge{
    padding: 7px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

.dashboard-card .btn-primary{
    border-radius: 10px;
    padding: 7px 15px;
    font-size: 13px;
    font-weight: 600;
}

.dashboard-card .btn-primary:hover{
    transform: translateY(-2px);
}

.dashboard-table tbody tr:last-child td{
    border-bottom: none;
}

/* Responsive */

@media(max-width:992px){

    .dashboard-card-header{
        flex-direction: column;
        align-items: flex-start !important;
        gap: 10px;
    }

}

@media(max-width:768px){

    .dashboard-table thead th,
    .dashboard-table tbody td{
        padding: 12px;
        font-size: 12px;
    }

    .amount-badge{
        font-size: 12px;
        padding: 6px 10px;
    }

    .dashboard-card-header h5{
        font-size: 16px;
    }

}


/* =========================================
MONTHLY ANALYTICS
========================================= */

.dashboard-card-body h2{

    font-size:32px;

    font-weight:700;

    margin-top:10px;

}

.dashboard-card-body h6{

    font-size:15px;

    text-transform:uppercase;

    letter-spacing:.5px;

}

    /* ==========================================
MONTHLY REVENUE
========================================== */

#monthlyRevenueChart{

width:100%;

}

.dashboard-card-body h2{

font-size:38px;

font-weight:700;

}

.dashboard-card-body p{

margin-top:10px;

font-size:15px;

}

.dashboard-table td{

vertical-align:middle;

}

.dashboard-table tbody tr:hover{

background:var(--bg-secondary);

}

.amount-badge{

display:inline-block;

padding:6px 14px;

background:rgba(25,135,84,.12);

color:#198754;

border-radius:30px;

font-weight:700;

}

/* Expense Card */

.danger-icon{

    background:rgba(220,53,69,.12);

    color:#dc3545;

}



    /* ==========================================
TODAY SUMMARY
========================================== */

.mini-stat{

display:flex;

justify-content:space-between;

align-items:center;

padding:15px 0;

border-bottom:1px solid var(--border-color);

}

.mini-stat:last-child{

border-bottom:none;

}

.mini-stat span{

color:var(--text-secondary);

font-size:15px;

}

.mini-stat strong{

font-size:18px;

color:var(--text-primary);

font-weight:700;

}

/* Hover */

.mini-stat:hover{

padding-left:8px;

transition:.3s;

}

/* Chart */

#machineChart{

width:100%;

}

/* Dark Theme */

.dark-theme .mini-stat{

border-color:var(--border-color);

}

.dark-theme .mini-stat strong{

color:var(--text-primary);

}


/* ==========================================
TOP CUSTOMERS
========================================== */

.top-item{

display:flex;
justify-content:space-between;
align-items:center;

padding:15px 0;

border-bottom:1px solid var(--border-color);

}

.top-item:last-child{

border-bottom:none;

}

.top-item strong{

color:var(--text-primary);

}


/* ==========================================
CHART
========================================== */

canvas{

max-width:100%;

}


/* ==========================================
DARK MODE
========================================== */

.dark-theme .top-item{

border-color:var(--border-color);

}

.dark-theme canvas{

background:transparent;

}


    /* ==========================================
QUICK STATS
========================================== */

.mini-stat{

    padding:20px;
    border-radius:16px;
    transition:.3s;

}

.mini-stat:hover{

    background:var(--bg-secondary);

}

.mini-stat h3{

    font-size:28px;
    font-weight:700;
    color:var(--text-primary);

}

.mini-stat small{

    color:var(--text-secondary);
}


/* ==========================================
SYSTEM SUMMARY
========================================== */

.dashboard-summary-table{

    width:100%;
    margin:0;

}

.dashboard-summary-table tr{

    border-bottom:1px solid var(--border-color);

}

.dashboard-summary-table tr:last-child{

    border-bottom:none;

}

.dashboard-summary-table td{

    padding:18px 24px;
    color:var(--text-primary);

}

.dashboard-summary-table td:first-child{

    font-weight:600;

}

.dashboard-summary-table td:last-child{

    font-size:17px;
}


/* ==========================================
DARK MODE
========================================== */

.dark-theme .mini-stat:hover{

    background:var(--bg-secondary);

}

.dark-theme .dashboard-summary-table td{

    color:var(--text-primary);

}

.dark-theme .dashboard-summary-table tr{

    border-color:var(--border-color);

}


/* ==========================================
RESPONSIVE
========================================== */

@media(max-width:768px){

.dashboard-summary-table td{

    padding:14px;

}

.mini-stat{

    padding:15px;

}

.mini-stat h3{

    font-size:22px;

}

}
</style>

