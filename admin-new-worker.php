<!-- Admin Login Container -->
<div class="text-center mb-4">
    <h2>ADD NEW WORKER</h2>
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

    <div class="mb-3">
        <label class="form-label">WORKER Name</label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>

            <input
                type="text"
                name="workerName"
                class="form-control"
                placeholder="Enter Worker Name"
                autofocus
                required>
        </div>
    </div>
    <div class="mb-3">
    <label class="form-label">Monthly Salary</label>

    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-cash-stack"></i>
        </span>

        <input
            type="number"
            name="monthlySalary"
            class="form-control"
            placeholder="Enter Monthly Salary"
            min="0"
            step="0.01"
            required>
    </div>
</div>

    <div class="d-grid mb-4">
        <button type="submit" name="workeradd" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>
            ADD WORKER
        </button>
    </div>

    <div class="text-center">
        <a href="public.php?index" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Website
        </a>
    </div>

</form>