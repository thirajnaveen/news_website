<?php
session_start();
include 'includes/header.php';
include 'includes/db.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user by email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        // Verify password (supports admin using md5 too)
        $passwordMatch = false;

        // Check if admin account with md5 password
        if($user['role'] === 'admin' && $user['password'] === md5($password)){
            $passwordMatch = true;
        }

        // Check normal user hashed password
        if(password_verify($password, $user['password'])){
            $passwordMatch = true;
        }

        if($passwordMatch){

            // Store session
            if($user['role'] === 'admin'){
                $_SESSION['admin'] = $user['email'];  // for admin-dashboard.php
                header("Location: admin/dashboard.php");
                exit;
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit;
            }

        } else {
            echo "<script>alert('Incorrect Password');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: black;
}

.login-box{
    width:500px;
    margin:80px auto;
    background: black;
    color: white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.btn-success {
    background-color: #1a73e8;
}
</style>

</head>

<body>

<div class="login-box">

<h3 class="text-center">Login</h3>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-success w-100">
Login
</button>

<p class="text-center mt-3">
Don't have an account? <a href="register.php">Register</a>
</p>

</form>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>