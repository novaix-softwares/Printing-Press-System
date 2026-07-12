<?php

// STARTING SESSIONS
session_start();
// CONNECTION WITH DATABASE

function connection(){
    return mysqli_connect("localhost","root","","premiumprint_db");
}
// LOGIN PROCCES

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

// MATCH DATA FROM DATABASE

        $query2 = "SELECT * FROM admin_users WHERE username='$username' AND password_hash ='$password'";

         $query = mysqli_query(connection(),$query2);

        //  DATA ROWS MAI CHAECK KARY GA 0 SY ZIADA TOU NHI HAI


if(mysqli_num_rows($query) > 0){

    $array = mysqli_fetch_array($query);

if($array['role'] == "admin"){

// STORING DATA INTO SESSIONS

    $_SESSION['name'] = $array['username'];
    $_SESSION['email'] = $array['email'];

    header("location:admin/admin.php?home");

}}
else{
?>
 <script>
    alert('Email Or Password Not Correct')
     location.assign('admin/admin-login.php')
 </script>
 <?php 
}}


// USER REGISTER FUNCTION

if(isset($_POST['user-register'])){

    $fullname = $_POST['full_name'];
    $username = $_POST['userName'];
    $mobnum = $_POST['mob_num'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $re_password = sha1($_POST['re-password']);

    if($password === $re_password){

    $checkquery = "SELECT * FROM users_table WHERE username = '$username'";

    $result = mysqli_query(connection(), $checkquery);

    if(mysqli_num_rows ($result) > 0 ){

        echo "usernmae is already Exist";

    }else{

    $insertQuery = "INSERT INTO users_table (full_name, username, mob_num, email, password_hash) VALUES ('$fullname','$username','$mobnum','$email','$password')";

    $sql = mysqli_query(connection(),$insertQuery);

    header("location:public.php?login");

    }}
}

// USER LOGIN FUNCTION

if(isset($_POST['user-login'])){

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $check = "SELECT * FROM users_table WHERE username = '$username' AND password_hash = '$password'";

    $sql = mysqli_query(connection(), $check);

    if(mysqli_num_rows ($sql) > 0){

        $array = mysqli_fetch_array($sql);

    if($array['role'] == "user"){

    $_SESSION['user_id'] = $array['id'];
    $_SESSION['full_name'] = $array['full_name'];
    $_SESSION['username'] = $array['username'];
    $_SESSION['email'] = $array['email'];

    $_SESSION['login_success'] = "Login Successfully";

    header("location:public.php?index");
}
    }else{
        $_SESSION ['login_failed'];
        ?>
            <script>
                alert("Inncorect Username and Password")
                location.assign('public.php?login')
            </script>
            <?php 
    }
}

// ADD CATEGORY FUNCTION

if(isset($_POST['categoryadd'])){

    $categoryname = $_POST['categoryName'];
    $categorydes = $_POST['categoryDescribtion'];

    $imagename = $_FILES['CategoryImage']['name'];
    $imagesize = $_FILES['CategoryImage']['size'];
    $temp_name = $_FILES['CategoryImage']['tmp_name'];

$extension = strtolower(pathinfo($imagename, PATHINFO_EXTENSION));

    $imagename = time()."_".$imagename;
    $destination = "admin/images/".$imagename;

if($imagesize <= 5000000){

    if($extension == "png" || $extension == "jpg" || $extension == "jpeg"){

        if(move_uploaded_file($temp_name, $destination)){

            $query2 = "INSERT INTO category (category_name, category_image, description) 
                       VALUES ('$categoryname','$imagename','$categorydes')";

            mysqli_query(connection(),$query2);

            $_SESSION['success'] ="CATEGORY ADDED SUCCESSFULLY";
            header("location:admin/admin.php?services");
            exit();

        } else {
            $_SESSION['retry']= "CAN'T BE ADDED";
        }

    } else {
        $_SESSION['file-error'] = "File Type Should Be PNG, JPG, JPEG";
    }

} else {
    $_SESSION['size-error']= "File should be less than 5MB.";
}
}

// ADD ADMIN FUNCTION

if(isset($_POST['add-Admin'])){

    $username = $_POST['userName'];
    $fullname = $_POST['fullName'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = sha1($_POST['password']);
    $re_password = sha1($_POST['re-password']);

       $query = "SELECT * FROM admin_users WHERE username = '$username'";

    $admin_exist = mysqli_query(connection(), $query);

    if(mysqli_num_rows($admin_exist) > 0){

    $_SESSION['admin-already-exist'] = "Admin Already Exist";
        header("location:admin/admin.php?add_admin");

    }

if($password == $re_password){
    
    $query1 = "INSERT INTO admin_users (username, password_hash, full_name, email, role) VALUES(' $username', '$password', '$fullname', '$email', '$role')";

    $run = mysqli_query(connection(),$query1) ;
    
    header ("location:admin/admin.php?reports");
}
}

// ADD NEW customer

if(isset($_POST['customeradd'])){

    $customername = mysqli_real_escape_string(connection(), $_POST['customerName']);

    // Check if customer already exists
    $check = "SELECT * FROM customers WHERE customer_name ='$customername'";
    $result = mysqli_query(connection(), $check);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['already-exist'] = "CUSTOMER ALREADY EXISTS";
        header("location:admin/admin.php?addbrand");
        exit();

    }else{

        $query = "INSERT INTO customers (customer_name) VALUES ('$customername')";

        if(mysqli_query(connection(), $query)){

            $_SESSION['success'] = "CUSTOMER ADDED SUCCESSFULLY";
            header("location:admin/admin.php?brand");
            exit();

        }else{

            $_SESSION['retry'] = "CAN'T BE ADDED";
            header("location:admin/admin.php?addbrand");
            exit();

        }

    }
}

// ADD NEW WORKER

if(isset($_POST['workeradd'])){

    $workername = mysqli_real_escape_string(connection(), $_POST['workerName']);
    $monthlysalary = mysqli_real_escape_string(connection(), $_POST['monthlySalary']);

    // Check if worker already exists
    $check = "SELECT * FROM workers WHERE worker_name = '$workername'";
    $result = mysqli_query(connection(), $check);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['already-exist'] = "WORKER ALREADY EXISTS";
        header("location:admin/admin.php?addworker");
        exit();

    }else{

        $query = "INSERT INTO workers (worker_name, monthly_salary) 
                  VALUES ('$workername', '$monthlysalary')";

        if(mysqli_query(connection(), $query)){

            $_SESSION['success'] = "WORKER ADDED SUCCESSFULLY";
            header("location:admin/admin.php?workers");
            exit();

        }else{

            $_SESSION['retry'] = "CAN'T BE ADDED";
            header("location:admin/admin.php?addworker");
            exit();

        }

    }
}


// ADD NEW JOB

if(isset($_POST['jobadd'])){

    $jobname      = mysqli_real_escape_string(connection(), $_POST['jobName']);
    $sampleno     = mysqli_real_escape_string(connection(), $_POST['sampleNo']);
    $jobdate      = mysqli_real_escape_string(connection(), $_POST['jobDate']);
    $customername = mysqli_real_escape_string(connection(), $_POST['customerName']);
    $workername   = mysqli_real_escape_string(connection(), $_POST['workerName']);
    $machine      = mysqli_real_escape_string(connection(), $_POST['machine']);
    $jobqty       = mysqli_real_escape_string(connection(), $_POST['jobQty']);
    $jobcolor     = mysqli_real_escape_string(connection(), $_POST['jobColor']);
    $totalqty     = mysqli_real_escape_string(connection(), $_POST['totalQty']);
    $totalamount  = mysqli_real_escape_string(connection(), $_POST['totalAmount']);

    $query = "INSERT INTO jobs
    (
        job_name,
        sample_no,
        job_date,
        customer_name,
        worker_name,
        machine,
        job_qty,
        job_color,
        total_qty,
        total_amount
    )
    VALUES
    (
        '$jobname',
        '$sampleno',
        '$jobdate',
        '$customername',
        '$workername',
        '$machine',
        '$jobqty',
        '$jobcolor',
        '$totalqty',
        '$totalamount'
    )";

    if(mysqli_query(connection(), $query)){

        $_SESSION['success'] = "JOB ADDED SUCCESSFULLY";
        header("Location: admin/admin.php?job");
        exit();

    }else{

        $_SESSION['retry'] = "CAN'T BE ADDED";
        header("Location: admin/admin.php?add_job");
        exit();

    }

}

// SEARCH FUNCTION 

if(isset($_POST['query'])){

    $search = mysqli_real_escape_string(connection(), $_POST['query']);

    $sql = "SELECT * FROM products 
            WHERE product_name LIKE '%$search%' 
            OR generic_name LIKE '%$search%' 
            OR category LIKE '%$search%' 
            OR brand_name LIKE '%$search%'";

    $run = mysqli_query(connection(), $sql);

    if(mysqli_num_rows($run) > 0){

        foreach($run as $data){
?>

<div class="col-md-4 col-lg-3">
    <div class="service-card">
        <div class="service-image">
            <img src="admin/product/<?php echo $data['image']?>" alt="<?php echo $data['product_name']?>">
        </div>
        <div class="service-content">
            <h3><?php echo $data['product_name']?></h3>
            <p><?php echo $data['category']?></p>
            <div class="price mb-2" style="color:#00ff99; font-weight:bold;">
                Rs. <?php echo $data['price']?>
            </div>
            <a href="public.php?detail-page=<?php echo $data['id']?>" class="btn btn-sm btn-outline-primary">
                View Product
            </a>
        </div>
    </div>
</div>

<?php
        }

    } else {
        echo "<p class='text-center'>No products found</p>";
    }
}

// CART DELETE BUTTN  FUNCTION 

if(isset($_GET['delete_cart'])){

    $cart_id = intval($_GET['delete_cart']); // safe
    $user_id = $_SESSION['user_id']; // extra safety

    $query = "DELETE FROM cart 
              WHERE id = '$cart_id' 
              AND user_id = '$user_id'";

    mysqli_query(connection(), $query);

    header("Location: public.php?cart");
    exit();
}

// CART FUNCTION 

if(isset($_POST['cart'])){

    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $user_id = $_SESSION ['user_id'];

    $query = "INSERT INTO cart (user_id, product_id, qty) VALUES ('$user_id', '$product_id', '$qty')";

    mysqli_query(connection(),$query);

    header("location:public.php?cart");
}

// DELETE USER FUNCTION

if(isset($_GET['delete_user'])){

    $delete_id = intval($_GET['delete_user']);

    // Step 1: delete from cart
    mysqli_query(connection(), "DELETE FROM cart WHERE user_id = '$delete_id'");

    // Step 2: delete user
    $delete_query = "DELETE FROM users_table WHERE id = '$delete_id'";

    if(mysqli_query(connection(), $delete_query)){
        echo "<script>alert('User Deleted Successfully');</script>";
        header("location:admin.php?reports");
    } else {
        echo "<script>alert('Delete Failed');</script>";
    }
}

// DELETE ADMIN FUNCTION

if(isset($_GET['delete_admin'])){
    $id = intval($_GET['delete_admin']);
    mysqli_query(connection(), "DELETE FROM admin_users WHERE id = $id");
    header("Location: admin.php?reports");
}

// DELETE JOB FUNCTION

if(isset($_GET['delete_job'])){

    $id = intval($_GET['delete_job']);

    mysqli_query(connection(), "DELETE FROM jobs WHERE id = $id");

    $_SESSION['success'] = "JOB DELETED SUCCESSFULLY";

    header("Location: admin.php?job");
    exit();

}

// DELETE CATEGORY FUNCTION 


if(isset($_GET['delete_category'])){
    $id = intval($_GET['delete_category']);

    mysqli_query(connection(), "DELETE FROM category WHERE id = $id");

    header("Location: admin.php?services");
}


// DELETE BRANDS FUNCTION 


if(isset($_GET['delete_brand'])){
    $id = intval($_GET['delete_brand']);

    mysqli_query(connection(), "DELETE FROM customers WHERE id = $id");

    header("Location: admin.php?brand");
}

// DELETE BRANDS FUNCTION 


if(isset($_GET['delete_worker'])){
    $id = intval($_GET['delete_worker']);

    mysqli_query(connection(), "DELETE FROM workers WHERE id = $id");

    header("Location: admin.php?workers");
}


if(isset($_POST['place_order'])){

    $user_id = $_SESSION['user_id'];

    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];
    $payment_method = $_POST['payment_method'];

    // CART TOTAL
    $subtotal = 0;

    $cart_query = mysqli_query(connection(),
    "SELECT * FROM cart 
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = $user_id");

    while($cart = mysqli_fetch_assoc($cart_query)){

        $subtotal += $cart['price'] * $cart['qty'];
    }

    $total = $subtotal;

    // INSERT ORDER
    mysqli_query(connection(), "
    
    INSERT INTO orders(
        user_id,
        full_name,
        phone,
        email,
        city,
        address,
        postal_code,
        payment_method,
        subtotal,
        total
    )

    VALUES(

        '$user_id',
        '$full_name',
        '$phone',
        '$email',
        '$city',
        '$address',
        '$postal_code',
        '$payment_method',
        '$subtotal',
        '$total'
    )
    
    ");

    // LAST ORDER ID
    $order_id = mysqli_insert_id(connection());

    // SAVE ORDER ITEMS
    $cart_query = mysqli_query(connection(),
    "SELECT * FROM cart 
     JOIN products ON cart.product_id = products.id
     WHERE cart.user_id = $user_id");

    while($cart = mysqli_fetch_assoc($cart_query)){

        $product_id = $cart['product_id'];
        $product_name = $cart['product_name'];
        $price = $cart['price'];
        $qty = $cart['qty'];

        mysqli_query(connection(), "

        INSERT INTO order_items(
            order_id,
            product_id,
            product_name,
            product_price,
            qty
        )

        VALUES(

            '$order_id',
            '$product_id',
            '$product_name',
            '$price',
            '$qty'
        )

        ");
    }

    // CLEAR CART
    mysqli_query(connection(),
    "DELETE FROM cart WHERE user_id = $user_id");

    echo "<script>
    alert('Order Placed Successfully');
    window.location.href='public.php?index';
    </script>";
}


// CHANGE PASSWORD FUNCTION

if(isset($_POST['change_password'])){

    $user_id = $_SESSION['user_id'];

    $current_password = sha1($_POST['current_password']);
    $new_password = sha1($_POST['new_password']);
    $confirm_password = sha1($_POST['confirm_password']);

    // CHECK CURRENT PASSWORD

    $check_query = "SELECT * FROM users_table 
                    WHERE id = '$user_id' 
                    AND password_hash = '$current_password'";

    $run = mysqli_query(connection(), $check_query);

    if(mysqli_num_rows($run) > 0){

        // CHECK NEW PASSWORD MATCH

        if($new_password == $confirm_password){

            $update_query = "UPDATE users_table 
                             SET password_hash = '$new_password'
                             WHERE id = '$user_id'";

            mysqli_query(connection(), $update_query);

            echo "
            <script>
                alert('Password Changed Successfully');
                window.location.href='public.php?index';
            </script>
            ";

        }else{

            echo "
            <script>
                alert('New Password Does Not Match');
                window.location.href='public.php?change-password';
            </script>
            ";

        }

    }else{

        echo "
        <script>
            alert('Current Password Incorrect');
            window.location.href='public.php?change-password';
        </script>
        ";

    }
}

// UPLOAD PRESCRIPTION FUNCTION

if(isset($_POST['upload_prescription'])){

    $user_id = $_SESSION['user_id'];

    $patient_name = $_POST['patient_name'];
    $doctor_name = $_POST['doctor_name'];
    $notes = $_POST['notes'];

    $file_name = $_FILES['prescription_file']['name'];
    $file_size = $_FILES['prescription_file']['size'];
    $temp_name = $_FILES['prescription_file']['tmp_name'];

    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $new_name = time().'_'.$file_name;

    $destination = "prescriptions/".$new_name;

    if($file_size <= 5000000){

        if(
            $extension == "jpg" ||
            $extension == "jpeg" ||
            $extension == "png" ||
            $extension == "pdf"
        ){

            if(move_uploaded_file($temp_name, $destination)){

                $insert = "

                INSERT INTO prescriptions(

                    user_id,
                    patient_name,
                    doctor_name,
                    notes,
                    prescription_file

                )

                VALUES(

                    '$user_id',
                    '$patient_name',
                    '$doctor_name',
                    '$notes',
                    '$new_name'

                )

                ";

                mysqli_query(connection(), $insert);

                echo "

                <script>

                    alert('Prescription Uploaded Successfully');

                    window.location.href='public.php?prescription';

                </script>

                ";

            }

        }else{

            echo "

            <script>

                alert('Only JPG, PNG, JPEG, PDF Allowed');

                window.history.back();

            </script>

            ";

        }

    }else{

        echo "

        <script>

            alert('File Size Must Be Less Than 5MB');

            window.history.back();

        </script>

        ";

    }
}

/* SEND MESSAGE */

if(isset($_POST['send_message'])){

    if(!isset($_SESSION['user_id'])){

        header("location:public.php?login");
        exit();

    }

    $user_id = $_SESSION['user_id'];

    $name = mysqli_real_escape_string(connection(), $_POST['name']);

    $email = mysqli_real_escape_string(connection(), $_POST['email']);

    $phone = mysqli_real_escape_string(connection(), $_POST['phone']);

    $service_type = mysqli_real_escape_string(connection(), $_POST['service_type']);

    $message = mysqli_real_escape_string(connection(), $_POST['message']);



    $query = "

    INSERT INTO messages(

        user_id,
        name,
        email,
        phone,
        service_type,
        message

    )

    VALUES(

        '$user_id',
        '$name',
        '$email',
        '$phone',
        '$service_type',
        '$message'

    )

    ";

    mysqli_query(connection(), $query);

    header("location:public.php?contact&success");

}

if(isset($_GET['delete_reaction'])){
    $id = intval($_GET['delete_reaction']);

    mysqli_query(connection(), "DELETE FROM risk_rules WHERE id = $id");

    header("Location: admin.php?reactions");
}

if(isset($_POST['add_allergy'])){

    $name = $_POST['allergy_name'];
    $severity = $_POST['severity'];
    $description = $_POST['description'];

    $query = "INSERT INTO allergy_reactions (allergy_name, severity, description)
              VALUES ('$name','$severity','$description')";

    mysqli_query(connection(), $query);

    header("Location: admin.php?allergy");
}

// CART FUNCTION 

if(isset($_POST['reactionadd'])){

    $keyword = $_POST['keywords'];
    $risk_level = $_POST['riskLevel'];

    $query = "INSERT INTO risk_rules (keyword, risk_level) VALUES ('$keyword', '$risk_level')";

    mysqli_query(connection(),$query);

    header("location:admin/admin.php?reactions");
}


?>
