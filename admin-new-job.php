<!-- Admin Login Container -->
<div class="text-center mb-4">
    <h2>ADD NEW JOB</h2>
</div>

<div>
    <span class="text-danger">
        <?php
        if(isset($_SESSION['already-exist'])){
            echo $_SESSION['already-exist'];
            unset($_SESSION['already-exist']);
        }
        ?>
    </span>
</div>

<form action="../code.php" method="POST">

    <!-- Job Name -->
    <div class="mb-3">
        <label class="form-label">Job Name</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-briefcase"></i>
            </span>
            <input type="text" name="jobName" class="form-control"
            placeholder="Enter Job Name" required>
        </div>
    </div>

    <!-- Sample No -->
    <div class="mb-3">
        <label class="form-label">Sample No</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-hash"></i>
            </span>
            <input type="text" name="sampleNo" class="form-control"
            placeholder="Enter Sample Number" required>
        </div>
    </div>

    <!-- Job Date -->
    <div class="mb-3">
        <label class="form-label">Job Date</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-calendar-event"></i>
            </span>
            <input type="date" name="jobDate" class="form-control"
            value="<?php echo date('Y-m-d'); ?>" required>
        </div>
    </div>

    <!-- Customer -->
    <div class="mb-3">
        <label class="form-label">Customer Name</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>

            <select name="customerName" class="form-select" required>

                <option value="">Select Customer</option>

                <?php
                $sql="SELECT * FROM customers ORDER BY customer_name";
                $query=mysqli_query(connection(),$sql);

                while($row=mysqli_fetch_assoc($query)){
                ?>

                <option value="<?php echo $row['customer_name']; ?>">
                    <?php echo $row['customer_name']; ?>
                </option>

                <?php } ?>

            </select>

        </div>
    </div>

    <!-- Worker -->
    <div class="mb-3">
        <label class="form-label">Worker Name</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-person-workspace"></i>
            </span>

            <select name="workerName" class="form-select" required>

                <option value="">Select Worker</option>

                <?php
                $sql="SELECT * FROM workers ORDER BY worker_name";
                $query=mysqli_query(connection(),$sql);

                while($row=mysqli_fetch_assoc($query)){
                ?>

                <option value="<?php echo $row['worker_name']; ?>">
                    <?php echo $row['worker_name']; ?>
                </option>

                <?php } ?>

            </select>

        </div>
    </div>

    <!-- Machine -->
    <div class="mb-3">
        <label class="form-label">Machine</label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-gear"></i>
            </span>

            <input type="text"
            name="machine"
            class="form-control"
            placeholder="Enter Machine Name"
            required>

        </div>
    </div>

    <!-- Job Qty -->
    <div class="mb-3">
        <label class="form-label">Job Qty</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-123"></i>
            </span>

            <input type="number"
            name="jobQty"
            class="form-control"
            placeholder="Enter Job Quantity"
            required>

        </div>
    </div>

    <!-- Job Color -->
    <div class="mb-3">
        <label class="form-label">Job Color</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-palette"></i>
            </span>

            <input type="text"
            name="jobColor"
            class="form-control"
            placeholder="Enter Job Color"
            required>

        </div>
    </div>

    <!-- Total Qty -->
    <div class="mb-3">
        <label class="form-label">Total Qty</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-box"></i>
            </span>

            <input type="number"
            name="totalQty"
            class="form-control"
            placeholder="Enter Total Quantity"
            required>

        </div>
    </div>

    <!-- Total Amount -->
    <div class="mb-3">
        <label class="form-label">Total Amount</label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-cash"></i>
            </span>

            <input type="number"
            step="0.01"
            name="totalAmount"
            class="form-control"
            placeholder="Enter Total Amount"
            required>

        </div>
    </div>

    <div class="d-grid mb-4">

        <button type="submit"
        name="jobadd"
        class="btn btn-primary btn-lg">

            <i class="bi bi-plus-circle me-2"></i>
            ADD JOB

        </button>

    </div>

    <div class="text-center">

        <a href="public.php?index" class="text-decoration-none">

            <i class="bi bi-arrow-left me-1"></i>

            Back to Website

        </a>

    </div>

</form>