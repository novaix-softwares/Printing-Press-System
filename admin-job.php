<style>

/* =========================
   JOBS PAGE STYLING
========================= */

.jobs-card{
    background: var(--bg-primary);
    border-radius: var(--radius-lg);
    border:1px solid var(--border-color);
    box-shadow:var(--shadow-md);
    overflow:hidden;
}

.jobs-card .card-header{
    background:var(--bg-secondary);
    border-bottom:1px solid var(--border-color);
    padding:1rem 1.5rem;
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
    border:none;
    padding:16px 14px;
    font-size:14px;
    font-weight:700;
    color:var(--text-primary);
    white-space:nowrap;
}

.jobs-table tbody tr{
    transition:.3s;
}

.jobs-table tbody tr:hover{
    background:var(--bg-secondary);
    transform:scale(1.002);
}

.jobs-table tbody td{
    padding:14px;
    border-color:var(--border-color);
    color:var(--text-secondary);
    font-size:14px;
    vertical-align:middle;
}

.job-name{
    font-weight:700;
    color:var(--text-primary);
}

.price-badge{
    background:rgba(52,152,219,.12);
    color:var(--secondary-color);
    padding:6px 12px;
    border-radius:30px;
    font-weight:700;
    font-size:13px;
}

.qty-badge{
    background:rgba(39,174,96,.12);
    color:var(--success-color);
    padding:6px 12px;
    border-radius:30px;
    font-weight:700;
    font-size:13px;
}

.date-badge{
    background:rgba(155,89,182,.12);
    color:#8e44ad;
    padding:6px 12px;
    border-radius:30px;
    font-weight:700;
    font-size:13px;
}

.action-buttons{
    display:flex;
    gap:8px;
}

.btn-edit{
    background:rgba(39,174,96,.1);
    color:var(--success-color);
    border:none;
    border-radius:10px;
    padding:8px 14px;
    transition:.3s;
}

.btn-edit:hover{
    background:var(--success-color);
    color:#fff;
    transform:translateY(-2px);
}

.btn-delete{
    background:rgba(231,76,60,.1);
    color:var(--danger-color);
    border:none;
    border-radius:10px;
    padding:8px 14px;
    transition:.3s;
}

.btn-delete:hover{
    background:var(--danger-color);
    color:#fff;
    transform:translateY(-2px);
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

</style>
<!-- DASHBOARD HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>

        <h1 class="h3 fw-bold mb-1">Jobs</h1>

        <p class="text-muted mb-0">
            Manage all printing jobs from here.
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

    </div>

</div>



<!-- JOBS TABLE -->

<div class="jobs-card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-briefcase me-2"></i>

            Jobs List

        </h5>

        <?php

        $count_query = mysqli_query(connection(),"SELECT COUNT(*) AS total FROM jobs");

        $count_data = mysqli_fetch_assoc($count_query);

        ?>

        <span class="badge bg-primary">

            Total : <?php echo $count_data['total']; ?>

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table jobs-table align-middle">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Job Name</th>
                        <th>Sample No</th>
                        <th>Job Date</th>
                        <th>Customer</th>
                        <th>Worker</th>
                        <th>Machine</th>
                        <th>Job Qty</th>
                        <th>Job Color</th>
                        <th>Total Qty</th>
                        <th>Total Amount</th>
                        <th>Created</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $sql = "SELECT * FROM jobs ORDER BY id DESC";

                $query = mysqli_query(connection(), $sql);

                if(mysqli_num_rows($query) > 0){

                foreach($query as $job){

                ?>

                    <tr>
                        <td>

    #<?php echo $job['id']; ?>

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

    <span class="date-badge">

        <?php echo date("d M Y", strtotime($job['job_date'])); ?>

    </span>

</td>

<td>

    <?php echo $job['customer_name']; ?>

</td>

<td>

    <?php echo $job['worker_name']; ?>

</td>

<td>

    <?php echo $job['machine']; ?>

</td>

<td>

    <span class="qty-badge">

        <?php echo $job['job_qty']; ?>

    </span>

</td>

<td>

    <?php echo $job['job_color']; ?>

</td>

<td>

    <span class="qty-badge">

        <?php echo $job['total_qty']; ?>

    </span>

</td>

<td>

    <span class="price-badge">

        Rs. <?php echo number_format($job['total_amount']); ?>

    </span>

</td>

<td>

    <?php echo date("d M Y", strtotime($job['created_at'])); ?>

</td>

<td>

    <div class="action-buttons">

        <a href="admin.php?edit_job&id=<?php echo $job['id']; ?>"
   class="btn-edit text-decoration-none">

    <i class="bi bi-pencil-square"></i>

</a>

        <a href="admin.php?delete_job=<?php echo $job['id']; ?>"
           class="btn-delete text-decoration-none"
           onclick="return confirm('Delete this Job?')">

            <i class="bi bi-trash"></i>

        </a>

    </div>

</td>

</tr>

<?php

    }

}else{

?>
<tr>

    <td colspan="13" class="text-center py-5">

        <img
            src="https://cdn-icons-png.flaticon.com/512/7466/7466141.png"
            width="120"
            class="mb-3">

        <h5 class="mb-2">

            No Jobs Found

        </h5>

        <p class="text-muted">

            Add your first Job now.

        </p>

    </td>

</tr>

<?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>