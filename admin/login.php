<?php
session_start();
include '../includes/db.php' ;

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $_SESSION['admin'] = $email;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Email or Password!";
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="big-light">

<div class="container mt-5">
    <div class="card mx-auto" style="max-width:400px;">
        <div class="card-body">
            <h3 class="text-center mb-3">Admin Login</h3>

            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form method="POST">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" name="login" class="btn btn-dark w-100">Login</button>
            </form>
        </div>   
    </div>
</div>

</body>
</html>