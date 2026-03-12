<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <span class="navbar-brand">Admin Dashboard</span>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</nav>

<div class="container mt-4">
    <h3>Welcome, Admin</h3>
    <hr>

    <div class="row">

        <div class="col-md-4">
            <a href="manage-articles.php" class="btn btn-primary w-100 mb-3">Manage Articles</a>
        </div>

        <div class="col-md-4">
            <a href="manage-categories.php" class="btn btn-success w-100 mb-3">Manage Categories</a>
        </div>

        <div class="col-md-4">
            <a href="view-messages.php" class="btn btn-warning w-100 mb-3">View Messages</a>
        </div>

         <div class="col-md-4">
            <a href="dashboard-statistics.php" class="btn btn-warning w-100 mb-3">Dashboard statistics</a>
        </div>

    </div>
</div>

</body>
</html>
