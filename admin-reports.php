     <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3">Reports</h1>
                <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <button id="themeToggle" class="btn btn-outline-secondary">
                        <i class="bi bi-moon"></i>
                    </button>
                </div>
            </div>
        </div>

        
<div class="card admin-table mb-4 fade-in">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h5 class="mb-0 text-primary fw-bold">Admin Reports</h5>

        <a href="admin.php?add_admin" class="btn btn-primary btn-sm">
            + ADD NEW
        </a>
    </div>

    <!-- Body -->
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0 align-middle">

                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $sql = "SELECT * FROM admin_users";
                $query = mysqli_query(connection(), $sql);

                foreach ($query as $user) {
                ?>

                    <tr class="fade-in">

                        <td class="fw-bold text-primary">
                            <?php echo $user['id']; ?>
                        </td>

                        <td>
                            <?php echo $user['username']; ?>
                        </td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                <?php echo $user['password_hash']; ?>
                            </span>
                        </td>

                        <td>
                            <?php echo $user['full_name']; ?>
                        </td>

                        <td>
                            <?php echo $user['email']; ?>
                        </td>

                        <td>
                            <span class="badge bg-success">
                                <?php echo $user['role']; ?>
                            </span>
                        </td>

                        <td class="text-muted">
                            <?php echo $user['created_at']; ?>
                        </td>

                        <td class="text-center">

                            <button class="btn btn-outline-primary btn-sm me-1">
                                Edit
                            </button>

                            <a href="admin.php?delete_admin=<?php echo $user['id']; ?>"
                               class="btn btn-outline-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this admin?')">
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>
</div>


<!-- Customer Reports -->
<div class="card admin-table mb-4 fade-in">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h5 class="mb-0 text-primary fw-bold">Customer Reports</h5>
    </div>

    <!-- Body -->
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0 align-middle">

                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                $sql = "SELECT * FROM customers ORDER BY customer_name ASC";
                $query = mysqli_query(connection(), $sql);

                if(mysqli_num_rows($query) > 0){

                    foreach($query as $customer){

                ?>

                    <tr>

                        <td class="fw-bold text-primary">
                            <?php echo $customer['id']; ?>
                        </td>

                        <td>
                            <?php echo $customer['customer_name']; ?>
                        </td>

                        <td class="text-muted">
                            <?php echo date("d M Y", strtotime($customer['created_at'])); ?>
                        </td>

                        <td class="text-center">

                           <a href="admin.php?customer_jobs&id=<?php echo $customer['id']; ?>"
                            class="btn btn-primary btn-sm">
                                Show Details
                            </a>
                        </td>

                    </tr>

                <?php

                    }

                }else{

                ?>

                    <tr>

                        <td colspan="4" class="text-center py-4">

                            No Customers Found

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<style>/* ===== DARK THEME TABLE FIX ===== */
.dark-theme .table {
    color: var(--text-primary);
    background-color: var(--bg-primary);
    border-color: var(--border-color);
}

.dark-theme .table thead {
    background-color: var(--bg-secondary);
    color: var(--text-light);
}

.dark-theme .table thead th {
    color: var(--text-light) !important;
    border-color: var(--border-color);
}

/* .dark-theme .table tbody tr {
    background-color: var(--bg-primary);
    border-color: var(--border-color);
} */

/* .dark-theme .table tbody tr:hover {
    background-color: var(--bg-secondary);
} */

.dark-theme .table td {
    color: var(--text-primary);
    border-color: var(--border-color);
}

/* Scroll fix */
.dark-theme .table-responsive {
    background: var(--bg-primary);
}
.table.table-hover tbody tr:hover {
    color: inherit !important;
    background-color: var(--bg-secondary) !important;
}

/* FORCE: cells never change text color on hover */
.table.table-hover tbody tr:hover td,
.table.table-hover tbody tr:hover span,
.table.table-hover tbody tr:hover a {
    color: inherit !important;
}

/* Optional: keep badges stable */
.table tbody tr:hover .badge {
    color: #fff !important;
}

/* Fix links/buttons inside table */
.table tbody tr:hover .btn {
    color: inherit !important;
}


</style>