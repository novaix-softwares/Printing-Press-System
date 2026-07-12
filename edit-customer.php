<?php

$conn = connection();

if (!isset($_GET['id'])) {
    die("Invalid Customer ID");
}

$id = (int)$_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM customers WHERE id='$id' LIMIT 1"
);

if (mysqli_num_rows($query) == 0) {
    die("Customer Not Found");
}

$customer = mysqli_fetch_assoc($query);

?>

<div class="container-fluid mt-4">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="edit-card">

                <div class="card-header">

                    <h4>
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Customer
                    </h4>

                </div>

                <div class="card-body">

                    <form action="update-customer.php" method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?php echo $customer['id']; ?>">

                        <div class="mb-4">

                            <label class="form-label">
                                Customer Name
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                class="form-control"
                                value="<?php echo htmlspecialchars($customer['customer_name']); ?>"
                                required>

                        </div>

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Customer

                            </button>

                            <a
                                href="admin.php?customer"
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

.edit-card{
    background:var(--bg-primary);
    border:1px solid var(--border-color);
    border-radius:18px;
    overflow:hidden;
    box-shadow:var(--shadow-md);
}

.edit-card .card-header{
    background:var(--bg-secondary);
    padding:20px 25px;
    border-bottom:1px solid var(--border-color);
}

.edit-card .card-header h4{
    margin:0;
    font-weight:700;
}

.edit-card .card-body{
    padding:30px;
}

.form-control{
    height:50px;
    border-radius:12px;
}

</style>