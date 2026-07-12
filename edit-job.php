<?php

$conn = connection();

if (!isset($_GET['id'])) {
    die("Invalid Job ID");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM jobs WHERE id='$id' LIMIT 1";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) == 0) {
    die("Job Not Found");
}

$job = mysqli_fetch_assoc($query);

?>

<div class="container-fluid mt-4">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="jobs-card">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="bi bi-pencil-square me-2"></i>

                        Edit Job

                    </h5>

                </div>

                <div class="card-body">

                    <form action="update-job.php" method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $job['id']; ?>">

                        <div class="row">

                            <!-- Job Name -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Job Name

                                </label>

                                <input
                                    type="text"
                                    name="job_name"
                                    class="form-control"
                                    value="<?php echo $job['job_name']; ?>"
                                    required>

                            </div>

                            <!-- Sample No -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Sample No

                                </label>

                                <input
                                    type="text"
                                    name="sample_no"
                                    class="form-control"
                                    value="<?php echo $job['sample_no']; ?>">

                            </div>

                            <!-- Job Date -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Job Date

                                </label>

                                <input
                                    type="date"
                                    name="job_date"
                                    class="form-control"
                                    value="<?php echo $job['job_date']; ?>"
                                    required>

                            </div>

                            <!-- Customer -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Customer

                                </label>

                                <select
                                    name="customer_name"
                                    class="form-select"
                                    required>

                                    <option value="">Select Customer</option>

                                    <?php

                                    $customers = mysqli_query(
                                        $conn,
                                        "SELECT customer_name
                                         FROM customers
                                         ORDER BY customer_name ASC"
                                    );

                                    while ($customer = mysqli_fetch_assoc($customers)) {

                                    ?>

                                        <option
                                            value="<?php echo $customer['customer_name']; ?>"
                                            <?php if ($customer['customer_name'] == $job['customer_name']) echo "selected"; ?>>

                                            <?php echo $customer['customer_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <!-- Worker -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Worker

                                </label>

                                <select
                                    name="worker_name"
                                    class="form-select"
                                    required>

                                    <option value="">Select Worker</option>

                                    <?php

                                    $workers = mysqli_query(
                                        $conn,
                                        "SELECT worker_name
                                         FROM workers
                                         ORDER BY worker_name ASC"
                                    );

                                    while ($worker = mysqli_fetch_assoc($workers)) {

                                    ?>

                                        <option
                                            value="<?php echo $worker['worker_name']; ?>"
                                            <?php if ($worker['worker_name'] == $job['worker_name']) echo "selected"; ?>>

                                            <?php echo $worker['worker_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <!-- Machine -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Machine

                                </label>

                                <select
                                    name="machine"
                                    class="form-select"
                                    required>

                                    <option value="">Select Machine</option>

                                    <?php

                                    $machines = mysqli_query(
                                        $conn,
                                        "SELECT DISTINCT machine
                                         FROM jobs
                                         ORDER BY machine ASC"
                                    );

                                    while ($machine = mysqli_fetch_assoc($machines)) {

                                    ?>

                                        <option
                                            value="<?php echo $machine['machine']; ?>"
                                            <?php if ($machine['machine'] == $job['machine']) echo "selected"; ?>>

                                            <?php echo $machine['machine']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <!-- Job Qty -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">

                                    Job Qty

                                </label>

                                <input
                                    type="number"
                                    name="job_qty"
                                    id="job_qty"
                                    class="form-control"
                                    value="<?php echo $job['job_qty']; ?>"
                                    required>

                            </div>

                            <!-- Job Color -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">

                                    Job Color

                                </label>

                                <input
                                    type="number"
                                    name="job_color"
                                    id="job_color"
                                    class="form-control"
                                    value="<?php echo $job['job_color']; ?>"
                                    required>

                            </div>

                            <!-- Total Qty -->

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">

                                    Total Qty

                                </label>

                                <input
                                    type="number"
                                    name="total_qty"
                                    id="total_qty"
                                    class="form-control"
                                    value="<?php echo $job['total_qty']; ?>"
                                    readonly>

                            </div>

                            <!-- Total Amount -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Total Amount

                                </label>

                                <input
                                    type="number"
                                    name="total_amount"
                                    id="total_amount"
                                    class="form-control"
                                    value="<?php echo $job['total_amount']; ?>"
                                    required>

                            </div>

                        </div>

                        <hr>

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Job

                            </button>

                            <a
                                href="admin.php?job"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left me-1"></i>

                                Back

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function calculateQty(){

    let qty = parseFloat(document.getElementById("job_qty").value) || 0;

    let color = parseFloat(document.getElementById("job_color").value) || 0;

    document.getElementById("total_qty").value = qty * color;

}

document.getElementById("job_qty").addEventListener("keyup", calculateQty);
document.getElementById("job_color").addEventListener("keyup", calculateQty);
document.getElementById("job_qty").addEventListener("change", calculateQty);
document.getElementById("job_color").addEventListener("change", calculateQty);

</script>