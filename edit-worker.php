<?php

$conn = connection();

if(!isset($_GET['id'])){
    die("Invalid Worker ID");
}

$id = intval($_GET['id']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM workers WHERE id='$id' LIMIT 1"
);

if(mysqli_num_rows($query)==0){
    die("Worker Not Found");
}

$worker = mysqli_fetch_assoc($query);

?>

<div class="container-fluid mt-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="edit-worker-card">
                <div class="card-header">

                    <h5>

                        <i class="bi bi-pencil-square me-2"></i>

                        Edit Worker

                    </h5>

                </div>

                <div class="card-body">

                    <form action="update-worker.php" method="POST">

                        <input
                        type="hidden"
                        name="id"
                        value="<?php echo $worker['id']; ?>">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Worker Name

                            </label>

                            <input
                            type="text"
                            name="worker_name"
                            class="form-control"
                            value="<?php echo htmlspecialchars($worker['worker_name']); ?>"
                            required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Monthly Salary

                            </label>

                            <input
                            type="number"
                            name="monthly_salary"
                            class="form-control"
                            value="<?php echo $worker['monthly_salary']; ?>"
                            required>

                        </div>

                        <div class="d-flex gap-2">

                            <button
                            type="submit"
                            class="btn btn-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Worker

                            </button>

                            <a
                            href="admin.php?workers"
                            class="btn btn-secondary">

                                Back

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* ===================================
EDIT WORKER PAGE
=================================== */

.edit-worker-card{

    background:var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:18px;
    overflow:hidden;
    box-shadow:var(--shadow-lg);

}

.edit-worker-card .card-header{

    background:var(--bg-secondary);
    padding:22px 28px;
    border-bottom:1px solid var(--border-color);

}

.edit-worker-card .card-header h4{

    margin:0;
    font-weight:700;
    color:var(--text-primary);

}

.edit-worker-card .card-body{

    padding:30px;

}

.form-label{

    font-weight:600;
    color:var(--text-primary);
    margin-bottom:8px;

}

.form-control{

    height:52px;
    border:1px solid var(--border-color);
    border-radius:12px;
    background:var(--bg-primary);
    color:var(--text-primary);
    transition:.3s;

}

.form-control:focus{

    border-color:var(--secondary-color);
    box-shadow:0 0 0 .2rem rgba(52,152,219,.15);

}

.worker-icon{

    width:90px;
    height:90px;
    margin:0 auto 25px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    color:#fff;
    background:linear-gradient(135deg,#3498db,#6c5ce7);

}

.btn-update{

    background:#27ae60;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:12px 28px;
    font-weight:600;
    transition:.3s;

}

.btn-update:hover{

    background:#219150;
    color:#fff;
    transform:translateY(-2px);

}

.btn-back{

    background:#6c757d;
    color:#fff;
    border-radius:12px;
    padding:12px 28px;
    transition:.3s;

}

.btn-back:hover{

    background:#5c636a;
    color:#fff;

}

.dark-theme .form-control{

    background:var(--bg-secondary);
    color:var(--text-primary);

}

@media(max-width:768px){

.edit-worker-card .card-body{

    padding:20px;

}

}

</style>