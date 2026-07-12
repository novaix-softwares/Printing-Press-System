<?php
        include "../code.php";

        // USER BLOCK ADMIN Dashboard

        if(!isset($_SESSION['name'])){
            header("location:admin-login.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Premium Print Pro</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../images/logo2.png">

        <style>
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            padding: 20px 0;
            z-index: 1000;
        }
        
        .admin-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background: var(--bg-primary);
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .admin-content {
                margin-left: 0;
            }
        }
        
        .sidebar-brand {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }
        
        .sidebar-nav {
            padding: 0 20px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: var(--primary-color);
            color: white;
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .stats-card {
            background: var(--bg-primary);
            border-radius: 10px;
            padding: 20px;
            border: 1px solid var(--border-color);
            transition: transform 0.3s;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
    </style>

    </head>
<body>

    <!-- Admin Content -->
    <div class="admin-content">
        <!-- Mobile Header -->
        <div class="d-md-none mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    <img src="images/logo.png" alt="Logo" height="30" class="me-2">
                    Admin Panel
                </h4>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

   

   <!-- Admin Sidebar -->
    <div class="admin-sidebar d-none d-md-block">
        <div class="sidebar-brand">
            <h4>
                Admin Panel
            </h4>
            <small class="text-muted">PRINTING PRESS</small>
        </div>
        
        <div class="sidebar-nav">
            <a href="admin.php?home" class="nav-link ">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
       
            <a href="admin.php?job" class="nav-link">
                <i class="bi bi-box-seam"></i> Jobs
            </a>
           
            <a href="admin.php?brand" class="nav-link">
                <i class="bi bi-grid-3x3-gap"></i> Customer
            </a>
            <a href="admin.php?workers" class="nav-link">
                <i class="bi bi-grid-3x3-gap"></i> Workers
            </a>
            <a href="admin.php?reports" class="nav-link">
                <i class="bi bi-graph-up"></i> Reports
            </a>


    <a href="admin.php?expenses" class="nav-link">

        <i class="bi bi-wallet2"></i>

        <span>Expenses</span>

    </a>
            <a href="admin.php?logout
            " class="nav-link text-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
        
        <div class="sidebar-user mt-4 px-3">
            <div class="d-flex align-items-center">
                <div class="user-avatar me-3">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                         style="width: 40px; height: 40px;">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div>
                    <h6 class="mb-0"><?php
                    if(isset($_SESSION["name"])){
                        echo $_SESSION["name"];
                    }
                    ?></h6>
                    <small class="text-muted">Super Admin</small>
                </div>
            </div>
        </div>
    </div>


        <?php

        if(isset($_GET['home'])){
            include 'admin-dashboard.php';
        }
        if(isset($_GET['brand'])){
            include "admin-brand.php";
        }
        if(isset($_GET['workers'])){
            include "admin-worker.php";
        }
        if(isset($_GET['reports'])){
            include "admin-reports.php";
        }
        if(isset($_GET['logout'])){
            include "logout.php";
        }
        if(isset($_GET['addbrand'])){
            include "admin-new-brand.php";
        }
        if(isset($_GET['addworker'])){
            include "admin-new-worker.php";
        }
        if(isset($_GET['add_admin'])){
            include "admin-add-new.php";
        }
        if(isset($_GET['job'])){
            include "admin-job.php";
        }
        if(isset($_GET['add_job'])){
            include "admin-new-job.php";
        }
        if(isset($_GET['customer_jobs'])){
            include("customer_jobs.php");
        }
        if(isset($_GET['payment_history'])){
            include("payment_history.php");
        }
        if(isset($_GET['edit_payment'])){
            include("edit-payment.php");
        }
        if(isset($_GET['ledger'])){
            include("customer-ledger.php");
        }
        if(isset($_GET['expenses'])){
            include("expenses.php");
        }
        if(isset($_GET['add_expense'])){
            include("add-expense.php");
        }
        if(isset($_GET['edit_expense'])){
            include("edit-expense.php");
        }
        elseif(isset($_GET['edit_job'])){
            include("edit-job.php");
        }
        if(isset($_GET['edit_worker'])){
            include("edit-worker.php");
        }
        if(isset($_GET['edit_customer'])){
            include("edit-customer.php");
        }
       




?>


  </div>



    <!-- Mobile Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">
                <img src="images/logo.png" alt="Logo" height="30" class="me-2">
                Admin Panel
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="sidebar-nav">
                <a href="#dashboard" class="nav-link active" data-bs-dismiss="offcanvas">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="#orders" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-cart"></i> Orders
                </a>
                <a href="#messages" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-envelope"></i> Messages
                </a>
                <a href="#services" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-printer"></i> Services
                </a>
                <a href="#reports" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-graph-up"></i> Reports
                </a>
                
                <a href="#settings" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-gear"></i> Settings
                </a>
                
                <hr class="my-4">
                
                <a href="index.html" class="nav-link" data-bs-dismiss="offcanvas">
                    <i class="bi bi-house"></i> View Website
                </a>
                <a href="admin.php?logout" class="nav-link text-danger" data-bs-dismiss="offcanvas">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
            
            <div class="sidebar-user mt-4">
                <div class="d-flex align-items-center">
                    <div class="user-avatar me-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0">Admin User</h6>
                        <small class="text-muted">Super Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Theme Toggle JS -->
    <script src="../js/theme-toggle.js"></script>
</body>
</html>