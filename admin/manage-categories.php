<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/*-----INSERT CATEGORY-----*/  
if(isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    $conn->query($sql);
    header("Location: manage-categories.php");
}

/*-----DELETE CATEGORY-----*/   
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM categories WHERE id=$id";
    $conn->query($sql);
    header("Location: manage-categories.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manage Categories</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-dark bg-dark p-3">
        <span class="navbar-brand">Manage Categories</span>
        <a href="dashboard.php" class="btn btn-light">Back</a>
    </nav>
    
<div class="container mt-4">
    <h4>Add New Category</h4>
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" required>
            </div>
            
            <div class="col-md-4">
                <button type="submit" name="add_category" class="btn btn-success w-100">Add Category</button>
            </div> 
        </div>
    </form>
    
    <hr>

    <h4>All Categories</h4>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>    

        <?php
        $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");

        while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td>
                    <a href="?delete=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this category?')">
                       Delete
                    </a>
                </td>
            </tr>    
       <?php } ?>
    </table>

</div>
</body>
</html>