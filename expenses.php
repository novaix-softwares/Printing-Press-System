<?php

$conn = connection();

/*=========================================
TOTAL EXPENSE
=========================================*/

$total_expense_query = mysqli_query(

$conn,

"SELECT IFNULL(SUM(amount),0) AS total_expense
FROM expenses"

);

$total_expense = mysqli_fetch_assoc($total_expense_query);


/*=========================================
EXPENSE LIST
=========================================*/

$expense_query = mysqli_query(

$conn,

"SELECT *
FROM expenses
ORDER BY expense_date DESC, id DESC"

);

?>

<!-- Dashboard Header -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="h3">

            Expense Management

        </h1>

        <p class="text-muted mb-0">

            Manage all business expenses.

        </p>

    </div>

    <div>

        <a href="admin.php?add_expense"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Add Expense

        </a>

    </div>

</div>


<div class="card admin-table fade-in">

    <div class="card-header d-flex justify-content-between align-items-center bg-light">

        <h5 class="mb-0 text-primary fw-bold">

            Expense List

        </h5>

        <span class="badge bg-success">

            Total :
            Rs. <?php echo number_format($total_expense['total_expense']); ?>

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table expense-table table-hover align-middle mb-0">

                <thead class="bg-light">

                    <tr>

                        <th>ID</th>

                        <th>Date</th>

                        <th>Category</th>

                        <th>Expense</th>

                        <th>Amount</th>

                        <th>Method</th>

                        <th>Remarks</th>

                        <th>Created</th>

                        <th class="text-center">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>
                    <?php

if(mysqli_num_rows($expense_query)>0){

while($expense = mysqli_fetch_assoc($expense_query)){

?>

<tr>

    <td class="fw-bold text-primary">

        <?php echo $expense['id']; ?>

    </td>

    <td>

        <?php echo date("d M Y",strtotime($expense['expense_date'])); ?>

    </td>

    <td>

        <span class="badge bg-info">

            <?php echo $expense['expense_category']; ?>

        </span>

    </td>

    <td>

        <?php echo $expense['expense_title']; ?>

    </td>

    <td>

        <span class="fw-bold text-danger">

            Rs. <?php echo number_format($expense['amount']); ?>

        </span>

    </td>

    <td>

        <?php echo $expense['payment_method']; ?>

    </td>

    <td>

        <?php

        if(empty($expense['remarks'])){

            echo "-";

        }else{

            echo $expense['remarks'];

        }

        ?>

    </td>

    <td class="text-muted">

        <?php echo date("d M Y",strtotime($expense['created_at'])); ?>

    </td>

    <td class="text-center">

        <a href="admin.php?edit_expense&id=<?php echo $expense['id']; ?>"
           class="btn btn-outline-primary btn-sm me-1">

            <i class="bi bi-pencil-square"></i>

        </a>

        <a href="delete-expense.php?id=<?php echo $expense['id']; ?>"
           class="btn btn-outline-danger btn-sm"
           onclick="return confirm('Are you sure you want to delete this expense?')">

            <i class="bi bi-trash"></i>

        </a>

    </td>

</tr>

<?php

}

}else{

?>

<tr>

    <td colspan="9" class="text-center py-5">

        <i class="bi bi-wallet2 display-5 d-block mb-3 text-muted"></i>

        <h5>No Expense Found</h5>

    </td>

</tr>

<?php

}

?>

</tbody>

            </table>

        </div>

    </div>

</div>


<style>

/*=========================================
EXPENSE PAGE
=========================================*/

.expense-table{

    width:100%;
    min-width:1100px;

}

.expense-table thead th{

    background:var(--bg-secondary);
    color:var(--text-primary);
    font-weight:700;
    border-bottom:1px solid var(--border-color);
    padding:16px;
    white-space:nowrap;

}

.expense-table tbody td{

    padding:15px;
    color:var(--text-primary);
    border-color:var(--border-light);
    vertical-align:middle;

}

.expense-table tbody tr{

    transition:.25s;

}

.expense-table tbody tr:hover{

    background:var(--bg-secondary);

}

.expense-table tbody tr:hover td{

    color:inherit !important;

}

.expense-table .badge{

    padding:8px 12px;
    font-size:12px;
    border-radius:30px;

}


/*=========================================
BUTTONS
=========================================*/

.btn-outline-primary,
.btn-outline-danger{

    width:38px;
    height:38px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:10px;

}

.btn-outline-primary:hover{

    transform:translateY(-2px);

}

.btn-outline-danger:hover{

    transform:translateY(-2px);

}


/*=========================================
CARD
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

.admin-table .card-header h5{

    margin:0;

}


/*=========================================
TOTAL BADGE
=========================================*/

.card-header .badge{

    font-size:15px;
    padding:10px 16px;

}


/*=========================================
EMPTY DATA
=========================================*/

.display-5{

    font-size:50px;

}


/*=========================================
RESPONSIVE
=========================================*/

@media(max-width:992px){

.expense-table{

min-width:1100px;

}

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

.dark-theme .table{

color:var(--text-primary);

}

.dark-theme .table td,
.dark-theme .table th{

color:var(--text-primary);

border-color:var(--border-color);

}

.dark-theme .table-hover tbody tr:hover{

background:var(--bg-secondary);

}

.dark-theme .badge.bg-info{

background:#0dcaf0 !important;

color:#fff;

}

</style>


<hr class="my-4">

