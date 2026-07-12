<div class="container-fluid mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

Add Expense

</h2>

<p class="text-muted mb-0">

Add a new business expense.

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

Expense Information

</h5>

</div>

<div class="card-body">

<form
action="insert-expense.php"
method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Expense Date

</label>

<input
type="date"
name="expense_date"
class="form-control"
value="<?php echo date('Y-m-d'); ?>"
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

<option value="">Select Category</option>

<option>Electricity</option>

<option>Rent</option>

<option>Salary</option>

<option>Fuel</option>

<option>Maintenance</option>

<option>Office Supplies</option>

<option>Internet</option>

<option>Transport</option>

<option>Printing Material</option>

<option>Other</option>

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
placeholder="Enter Expense Title"
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
placeholder="0"
required>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">

Payment Method

</label>

<select
name="payment_method"
class="form-select">

<option>Cash</option>

<option>Bank</option>

<option>JazzCash</option>

<option>EasyPaisa</option>

<option>Cheque</option>

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
rows="4"
placeholder="Optional..."></textarea>

</div>


<div class="d-flex gap-2">

<button
type="submit"
class="btn btn-success">

<i class="bi bi-check-circle"></i>

Save Expense

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
ADD EXPENSE PAGE
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
FORM
=========================================*/

.form-label{

    font-weight:600;
    color:var(--text-primary);
    margin-bottom:8px;

}

.form-control,
.form-select{

    height:48px;
    border-radius:10px;
    border:1px solid var(--border-color);

}

textarea.form-control{

    height:auto;
    min-height:120px;

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

.btn{

width:100%;
margin-bottom:10px;

}

.d-flex.gap-2{

display:block !important;

}

}

</style>


