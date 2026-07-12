<?php

// =========================================
// CHECK REQUEST
// =========================================

if(!isset($_GET['id'])){

    die("Expense Not Found");

}

$id = intval($_GET['id']);

$conn = connection();


// =========================================
// GET EXPENSE
// =========================================

$query = mysqli_query(

$conn,

"SELECT *

FROM expenses

WHERE id='$id'

LIMIT 1"

);

if(mysqli_num_rows($query)==0){

    die("Expense Not Found");

}

$expense = mysqli_fetch_assoc($query);

?>


<div class="container-fluid mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

Edit Expense

</h2>

<p class="text-muted mb-0">

Update expense information.

</p>

</div>

<a
href="admin.php?expenses"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

</div>


<div class="card admin-table shadow-sm">

<div class="card-header bg-light">

<h5 class="mb-0 text-primary fw-bold">

Expense Details

</h5>

</div>

<div class="card-body">

<form
action="update-expense.php"
method="POST">

<input
type="hidden"
name="expense_id"
value="<?php echo $expense['id']; ?>">
<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Expense Date

</label>

<input
type="date"
name="expense_date"
class="form-control"
value="<?php echo $expense['expense_date']; ?>"
required>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">

Expense Category

</label>

<select
name="expense_category"
class="form-select"
required>

<option value="Electricity" <?php if($expense['expense_category']=="Electricity") echo "selected"; ?>>Electricity</option>

<option value="Rent" <?php if($expense['expense_category']=="Rent") echo "selected"; ?>>Rent</option>

<option value="Salary" <?php if($expense['expense_category']=="Salary") echo "selected"; ?>>Salary</option>

<option value="Fuel" <?php if($expense['expense_category']=="Fuel") echo "selected"; ?>>Fuel</option>

<option value="Maintenance" <?php if($expense['expense_category']=="Maintenance") echo "selected"; ?>>Maintenance</option>

<option value="Office Supplies" <?php if($expense['expense_category']=="Office Supplies") echo "selected"; ?>>Office Supplies</option>

<option value="Internet" <?php if($expense['expense_category']=="Internet") echo "selected"; ?>>Internet</option>

<option value="Transport" <?php if($expense['expense_category']=="Transport") echo "selected"; ?>>Transport</option>

<option value="Printing Material" <?php if($expense['expense_category']=="Printing Material") echo "selected"; ?>>Printing Material</option>

<option value="Other" <?php if($expense['expense_category']=="Other") echo "selected"; ?>>Other</option>

</select>

</div>

</div>


<div class="mb-3">

<label class="form-label">

Expense Title

</label>

<input
type="text"
name="expense_title"
class="form-control"
value="<?php echo $expense['expense_title']; ?>"
required>

</div>


<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Amount

</label>

<input
type="number"
name="amount"
class="form-control"
value="<?php echo $expense['amount']; ?>"
required>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">

Payment Method

</label>

<select
name="payment_method"
class="form-select">

<option value="Cash" <?php if($expense['payment_method']=="Cash") echo "selected"; ?>>Cash</option>

<option value="Bank" <?php if($expense['payment_method']=="Bank") echo "selected"; ?>>Bank Transfer</option>

<option value="JazzCash" <?php if($expense['payment_method']=="JazzCash") echo "selected"; ?>>JazzCash</option>

<option value="EasyPaisa" <?php if($expense['payment_method']=="EasyPaisa") echo "selected"; ?>>EasyPaisa</option>

<option value="Cheque" <?php if($expense['payment_method']=="Cheque") echo "selected"; ?>>Cheque</option>

</select>

</div>

</div>


<div class="mb-3">

<label class="form-label">

Remarks

</label>

<textarea
name="remarks"
class="form-control"
rows="4"><?php echo $expense['remarks']; ?></textarea>

</div>

<div class="d-flex gap-2">

<button
type="submit"
class="btn btn-success">

<i class="bi bi-check-circle"></i>

Update Expense

</button>


<button
type="reset"
class="btn btn-warning">

<i class="bi bi-arrow-clockwise"></i>

Reset

</button>


<a
href="admin.php?expenses"
class="btn btn-secondary">

<i class="bi bi-x-circle"></i>

Cancel

</a>

</div>

</form>

</div>

</div>

</div>


<style>

/*=========================================
EDIT EXPENSE PAGE
=========================================*/

.admin-table{

    border:none;
    border-radius:16px;
    overflow:hidden;
    box-shadow:var(--shadow-md);

}

.admin-table .card-header{

    padding:18px 22px;

}

.admin-table .card-body{

    padding:30px;

}


/*=========================================
FORM LABELS
=========================================*/

.form-label{

    font-weight:600;
    color:var(--text-primary);
    margin-bottom:8px;

}


/*=========================================
INPUTS
=========================================*/

.form-control,
.form-select{

    height:48px;
    border-radius:10px;
    border:1px solid var(--border-color);
    transition:.3s;

}

textarea.form-control{

    min-height:120px;
    height:auto;
    resize:vertical;

}

.form-control:focus,
.form-select:focus{

    border-color:var(--secondary-color);
    box-shadow:0 0 0 .2rem rgba(13,110,253,.15);

}


/*=========================================
BUTTONS
=========================================*/

.btn{

    border-radius:10px;
    padding:10px 22px;
    font-weight:600;
    transition:.3s;

}

.btn:hover{

    transform:translateY(-2px);

}

.btn i{

    margin-right:6px;

}


/*=========================================
DARK MODE
=========================================*/

.dark-theme .admin-table{

    background:var(--bg-primary);
    border:1px solid var(--border-color);

}

.dark-theme .admin-table .card-header{

    background:var(--bg-secondary) !important;
    border-bottom:1px solid var(--border-color);

}

.dark-theme .card-header h5{

    color:var(--text-primary) !important;

}

.dark-theme .form-control,
.dark-theme .form-select{

    background:var(--bg-primary);
    color:var(--text-primary);
    border-color:var(--border-color);

}

.dark-theme textarea.form-control{

    background:var(--bg-primary);
    color:var(--text-primary);

}

.dark-theme .form-label{

    color:var(--text-primary);

}

.dark-theme .text-muted{

    color:var(--text-secondary) !important;

}


/*=========================================
RESPONSIVE
=========================================*/

@media(max-width:768px){

.admin-table .card-body{

    padding:20px;

}

.d-flex.gap-2{

    display:block !important;

}

.btn{

    width:100%;
    margin-bottom:10px;

}

}

</style>
