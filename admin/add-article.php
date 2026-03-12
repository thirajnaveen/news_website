<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_article'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = $_POST['category_id'];
    $author_id = 1;                           // Admin ID 

    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" .$image);

    $sql = "INSERT INTO articles (title, content, image, category_id, author_id)
            VALUES ('$title', '$content', '$image', '$category_id', '$author_id')";
    $conn->query($sql);

    header("Location: manage-articles.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Article</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/style.css" ref="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <div class="card p-4 card-shadow">
            <h3 class="mb-3">Add New Article</h3>

            <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                    $cat = $conn->query("SELECT * FROM categories");
                    while($c = $cat->fetch_assoc()) {
                        echo "<option value='".$c['id']."'>".$c['category_name']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Upload Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <button type="submit" name="add_article" class="btn btn-success">Publish</button>
            <a href="manage-articles.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>

<script>
function validateForm() {
    let title = document.getElementById("title").value;
    if(title.length < 5) {
        alert("Title must be at least 5 characters long!");
        return false;
    }
    return true;
}
</script>

</body>
</html>