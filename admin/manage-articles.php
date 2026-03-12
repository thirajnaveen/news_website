<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/*-----DELETE ARTICLE------*/  
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM articles WHERE id=$id");
    header("Location: manage-articles.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manage Articles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href=".../assets/css/style.css" rel="stylesheet">
    </head>
     
    <body>

    <nav class="navbar navbar-dark bg-dark p-3">
        <span class="navbar-brand">Manage Articles</span>
        <a href="dashboard.php" class="btn btn-light btn-custom">Back</a>
    </nav>

    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h3 class="admin-title">All Articles</h3>
            <a href="add-article.php" class="btn btn-success btn-custom">Add New Article</a>
        </div>

        <div class="card card-shadow p-3">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Data</th>
                    <th>Action</th>
                </tr>

                <?php
                $sql = "SELECT articles.*, categories.category_name
                        FROM articles
                        LEFT JOIN  categories ON articles.category_id = categories.id
                        ORDER BY articles.id DESC";
               
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                ?>
                
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="edit-article.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>

                <?php } ?>
            </table>
        </div>
    </div>
    
    <script>
        function confirmDelete(id) {
            if(confirm("Are you sure you want to delete this articles?")) {
                window.location.href = "manage-articles.php?delete=" + id;
            }
    }
    </script>
    </body>
</html>