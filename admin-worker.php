<style>

/* =========================
   BRANDS PAGE DESIGN
========================= */

.brand-card{
    background: var(--bg-primary);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.brand-card .card-header{
    background: var(--bg-secondary);
    padding: 18px 22px;
    border-bottom: 1px solid var(--border-color);
}

.brand-card .card-header h5{
    margin: 0;
    font-weight: 700;
    color: var(--text-primary);
}

.brand-table{
    margin: 0;
    vertical-align: middle;
}

.brand-table thead{
    background: var(--bg-secondary);
}

.brand-table thead th{
    padding: 16px;
    border: none;
    white-space: nowrap;
    color: var(--text-primary);
    font-size: 14px;
    font-weight: 700;
}

.brand-table tbody td{
    padding: 16px;
    border-color: var(--border-color);
    color: var(--text-secondary);
    vertical-align: middle;
}

.brand-table tbody tr{
    transition: 0.3s ease;
}

.brand-table tbody tr:hover{
    background: var(--bg-secondary);
    transform: scale(1.002);
}

.brand-logo{
    width: 90px;
    height: 60px;
    object-fit: contain;
    border-radius: 12px;
    background: white;
    border: 2px solid var(--border-color);
    padding: 8px;
}

.brand-name{
    font-size: 15px;
    font-weight: 700;
    color: var(--text-primary);
}

.action-buttons{
    display: flex;
    gap: 8px;
}

.btn-edit{
    background: rgba(39, 174, 96, 0.12);
    color: var(--success-color);
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
    transition: 0.3s;
    font-weight: 600;
}

.btn-edit:hover{
    background: var(--success-color);
    color: white;
    transform: translateY(-2px);
}

.btn-delete{
    background: rgba(231, 76, 60, 0.12);
    color: var(--danger-color);
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
    transition: 0.3s;
    font-weight: 600;
}

.btn-delete:hover{
    background: var(--danger-color);
    color: white;
    transform: translateY(-2px);
}

/* MOBILE */
@media(max-width:768px){

    .brand-table thead th,
    .brand-table tbody td{
        padding: 10px;
        font-size: 12px;
    }

    .brand-logo{
        width: 70px;
        height: 50px;
    }

}

</style>


<!-- PAGE HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>

        <h1 class="h3 fw-bold mb-1">
            Workers
        </h1>

        <p class="text-muted mb-0">
            Our most famous Workers. You can manage Workers from here!
        </p>

    </div>

    <div class="d-flex align-items-center gap-2">

        <button id="themeToggle" class="btn btn-outline-secondary">
            <i class="bi bi-moon"></i>
        </button>

        <a href="admin.php?addworker" class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Add New Worker

        </a>

    </div>

</div>


<!-- BRANDS TABLE -->
<div class="brand-card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5>

            <i class="bi bi-award me-2"></i>

            Workers List

        </h5>

        <?php

        $count_query = mysqli_query(connection(),"SELECT COUNT(*) as total FROM workers");

        $count_data = mysqli_fetch_assoc($count_query);

        ?>

        <span class="badge bg-primary">

            Total: <?php echo $count_data['total']; ?>

        </span>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table brand-table align-middle">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Worker Name</th>
                        <th>Monthly Salary</th>
                        <th>Created At</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $sql = "SELECT * FROM workers ORDER BY id DESC";

                $query = mysqli_query(connection(), $sql);

                if(mysqli_num_rows($query) > 0){

                    foreach($query as $brand){

                ?>

                    <tr>

                        <td>

                            #<?php echo $brand['id']; ?>

                        </td>

                        <td>

                            <div class="brand-name">

                                <?php echo $brand['worker_name']; ?>

                            </div>

                        </td>

                        <td>

                            <div class="brand-name">

                                <?php echo $brand['monthly_salary']; ?>

                            </div>

                        </td>

                        <td>

                            <?php

                            echo date("d M Y", strtotime($brand['created_at']));

                            ?>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="admin.php?edit_worker&id=<?php echo $brand['id']; ?>"
                                    class="btn-edit text-decoration-none">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                <a href="admin.php?delete_worker=<?php echo $brand['id']; ?>" 
                                class="btn-delete text-decoration-none"
                                onclick="return confirm('Delete this worker?')">

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

                    <td colspan="5" class="text-center py-5">

                        <img 
                        src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png"
                        width="110"
                        class="mb-3">

                        <h5 class="mb-2">

                            No worker Found

                        </h5>

                        <p class="text-muted">

                            Add your first worker now

                        </p>

                    </td>

                </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>