<?php
session_start();
include '../includes/db.php';

// Redirect if not admin
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// FETCH STATISTICS
$total_articles = $conn->query("SELECT COUNT(*) AS count FROM articles")->fetch_assoc()['count'];
$total_categories = $conn->query("SELECT COUNT(*) AS count FROM categories")->fetch_assoc()['count'];
$total_messages = $conn->query("SELECT COUNT(*) AS count FROM contact_messages")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-stats {
            border-left: 5px solid #0d6efd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-stats .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-stats .icon {
            font-size: 2.5rem;
            opacity: 0.3;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <span class="navbar-brand">Admin Dashboard</span>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</nav>

<div class="container mt-4">
    <h3>Welcome, Admin</h3>
    <hr>

    <div class="row g-4">

        <!-- Articles Card -->
        <div class="col-md-4">
            <div class="card card-stats border-primary">
                <div class="card-body">
                    <div>
                        <h5>Total Articles</h5>
                        <h3><?php echo $total_articles; ?></h3>
                    </div>
                    <div class="icon text-primary">
                        📄
                    </div>
                </div>
                <a href="manage-articles.php" class="card-footer text-decoration-none text-center">Manage Articles</a>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="col-md-4">
            <div class="card card-stats border-success">
                <div class="card-body">
                    <div>
                        <h5>Total Categories</h5>
                        <h3><?php echo $total_categories; ?></h3>
                    </div>
                    <div class="icon text-success">
                        🗂️
                    </div>
                </div>
                <a href="manage-categories.php" class="card-footer text-decoration-none text-center">Manage Categories</a>
            </div>
        </div>

        <!-- Messages Card -->
        <div class="col-md-4">
            <div class="card card-stats border-warning">
                <div class="card-body">
                    <div>
                        <h5>Messages</h5>
                        <h3><?php echo $total_messages; ?></h3>
                    </div>
                    <div class="icon text-warning">
                        ✉️
                    </div>
                </div>
                <a href="view-messages.php" class="card-footer text-decoration-none text-center">View Messages</a>
            </div>
        </div>

    </div>
</div>

</body>
</html>