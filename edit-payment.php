<?php

if(
    !isset($_GET['id']) ||
    !isset($_GET['customer_id'])
){
    die("Invalid Request");
}

$conn = connection();

$payment_id  = intval($_GET['id']);
$customer_id = intval($_GET['customer_id']);

$query = mysqli_query(

$conn,

"SELECT *

FROM payments

WHERE id='$payment_id'

LIMIT 1"

);

if(mysqli_num_rows($query)==0){

    die("Payment Not Found");

}

$payment = mysqli_fetch_assoc($query);

?>

<div class="container mt-4">

<div class="payment-edit-card">

<div class="card-header">

<h4>

<i class="bi bi-pencil-square"></i>

Edit Payment

</h4>

</div>

<div class="card-body payment-edit-body">

<form
action="update-payment.php"
method="POST">

<input
type="hidden"
name="payment_id"
value="<?php echo $payment['id']; ?>">

<input
type="hidden"
name="customer_id"
value="<?php echo $customer_id; ?>">


<div class="mb-3">

<label class="form-label">

Payment Date

</label>

<input
type="date"
name="payment_date"
class="form-control"
value="<?php echo $payment['payment_date']; ?>"
required>

</div>


<div class="mb-3">

<label class="form-label">

Amount

</label>

<input
type="number"
name="amount"
class="form-control"
value="<?php echo $payment['amount']; ?>"
required>

</div>


<div class="mb-3">

<label class="form-label">

Payment Method

</label>

<select
name="payment_method"
class="form-select">

<option value="Cash"
<?php if($payment['payment_method']=="Cash") echo "selected"; ?>>
Cash
</option>

<option value="Bank"
<?php if($payment['payment_method']=="Bank") echo "selected"; ?>>
Bank Transfer
</option>

<option value="JazzCash"
<?php if($payment['payment_method']=="JazzCash") echo "selected"; ?>>
JazzCash
</option>

<option value="EasyPaisa"
<?php if($payment['payment_method']=="EasyPaisa") echo "selected"; ?>>
EasyPaisa
</option>

<option value="Cheque"
<?php if($payment['payment_method']=="Cheque") echo "selected"; ?>>
Cheque
</option>

</select>

</div>


<div class="mb-3">

<label class="form-label">

Remarks

</label>

<textarea
name="remarks"
class="form-control"
rows="4"><?php echo $payment['remarks']; ?></textarea>

</div>


<div class="d-flex justify-content-end gap-2 mt-4">

    <a
    href="admin.php?payment_history&id=<?php echo $customer_id; ?>"
    class="btn btn-back">

        <i class="bi bi-arrow-left"></i>

        Back

    </a>

    <button
    type="submit"
    class="btn btn-update">

        <i class="bi bi-check-circle"></i>

        Update Payment

    </button>

</div>

</form>

</div>

</div>

</div>

<style>

    /*=========================================
EDIT PAYMENT PAGE
=========================================*/

.payment-edit-card{

    background:var(--bg-primary);

    border:1px solid var(--border-color);

    border-radius:16px;

    overflow:hidden;

    box-shadow:var(--shadow-md);

}

.payment-edit-card .card-header{

    background:var(--bg-secondary);

    border-bottom:1px solid var(--border-color);

    padding:20px 25px;

}

.payment-edit-card .card-header h4{

    margin:0;

    color:var(--text-primary);

    font-weight:700;

}

.payment-edit-body{

    background:var(--bg-primary);

    padding:30px;

}


/*=========================================
FORM
=========================================*/

.payment-edit-body label{

    color:var(--text-primary);

    font-weight:600;

    margin-bottom:8px;

}

.payment-edit-body .form-control,
.payment-edit-body .form-select{

    height:50px;

    border-radius:10px;

    border:1px solid var(--border-color);

    background:var(--bg-primary);

    color:var(--text-primary);

}

.payment-edit-body textarea.form-control{

    height:120px;

    resize:none;

}

.payment-edit-body .form-control:focus,
.payment-edit-body .form-select:focus{

    border-color:#0d6efd;

    box-shadow:0 0 0 .15rem rgba(13,110,253,.2);

}


/*=========================================
BUTTONS
=========================================*/

.btn-update{

    background:#198754;

    color:#fff;

    border:none;

    padding:11px 25px;

    border-radius:10px;

    font-weight:600;

}

.btn-update:hover{

    background:#157347;

    color:#fff;

}

.btn-back{

    background:#6c757d;

    color:#fff;

    padding:11px 25px;

    border-radius:10px;

}

.btn-back:hover{

    background:#5c636a;

    color:#fff;

}


/*=========================================
DARK MODE
=========================================*/

.dark-theme .payment-edit-card{

    background:var(--bg-primary);

}

.dark-theme .payment-edit-body{

    background:var(--bg-primary);

}

.dark-theme .payment-edit-body .form-control,
.dark-theme .payment-edit-body .form-select{

    background:var(--bg-secondary);

    color:var(--text-primary);

    border-color:var(--border-color);

}

.dark-theme .payment-edit-body textarea{

    background:var(--bg-secondary);

    color:var(--text-primary);

}

.dark-theme .payment-edit-body label{

    color:var(--text-primary);

}


/*=========================================
RESPONSIVE
=========================================*/

@media(max-width:768px){

.payment-edit-body{

    padding:20px;

}

.btn-update,
.btn-back{

    width:100%;

}

.d-flex.justify-content-end{

    flex-direction:column;

}

}

</style>