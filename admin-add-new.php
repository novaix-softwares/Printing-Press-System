
    <!-- Admin Login Container -->
            <div class="text-center mb-4">
                <h2>ADD NEW ADMIN</h2>
            </div>
            
            <!-- Login Form -->
            <form id="adminLoginForm" action="../code.php"  method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="adminServicename" class="form-label">User Name</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="userName"  autofocus class="form-control" id="adminUsername" 
                               placeholder="Enter User Name" required>
                    </div>
                </div>

                 <div class="mb-3">
                    <label for="adminServiceqty" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="fullName"  autofocus class="form-control" id="adminUsername" 
                               placeholder="Enter Full Name" required>
                    </div>
                </div>
    
                <div class="mb-3">
                    <label for="adminServiceqty" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="email" name="email"  autofocus class="form-control" id="adminUsername" 
                               placeholder="Enter Email" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="adminServiceqty" class="form-label">Role</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="role" class="form-control" id="adminUsername" 
                               placeholder="Enter Role" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="adminServicedescribtion" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="password" name="password"  autofocus class="form-control" id="adminUsername" 
                               placeholder="Enter Password" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="adminServicedescribtion" class="form-label">Re-Type Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="password" name="re-password"  autofocus class="form-control" id="adminUsername" 
                               placeholder="Enter Password" required>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" name="add-Admin" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i> ADD ADMIN
                    </button>
                </div>
                
                <div class="text-center">
                    <a href="public.php?index" class="text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i> Back to Website
                    </a>
                </div>
            </form>

