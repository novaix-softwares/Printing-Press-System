<!-- Admin Login Container -->
<div class="text-center mb-4">
    <h2>ADD NEW CUSTOMER</h2>
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
        <label class="form-label">CUSTOMER Name</label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>

            <input
                type="text"
                name="customerName"
                class="form-control"
                placeholder="Enter Customer Name"
                autofocus
                required>
        </div>
    </div>

    <div class="d-grid mb-4">
        <button type="submit" name="customeradd" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>
            ADD CUSTOMER
        </button>
    </div>

    <div class="text-center">
        <a href="public.php?index" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Website
        </a>
    </div>

</form>