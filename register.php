<?php
include 'includes/header.php';
include 'includes/db.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username,email,password)
            VALUES ('$username','$email','$password')";

    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Registration Successful');</script>";
    }else{
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background: black;
}

.register-box{
width:500px;
margin:80px auto;
background: black;
color: white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="register-box">

<h3 class="text-center">Register</h3>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-primary w-100">
Register
</button>

<p class="text-center mt-3">
Already have an account? <a href="login.php">Login</a>
</p>

</form>

</div>
<?php include 'includes/footer.php'; ?>

</body>
</html>