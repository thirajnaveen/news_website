<?php
session_start();
include '../includes/db.php';

/* -------- SESSION CHECK -------- */
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/* -------- CHECK ID EXISTS -------- */
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage-articles.php");
    exit();
}

$id = intval($_GET['id']);

/* -------- FETCH ARTICLE -------- */
$result = $conn->query("SELECT * FROM articles WHERE id=$id");

if($result->num_rows == 0) {
    header("Location: manage-articles.php");
    exit();
}

$article = $result->fetch_assoc();

/* -------- UPDATE ARTICLE -------- */
if(isset($_POST['update_article'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    if(empty($title) || empty($content) || empty($category_id)) {
        $error = "All fields are required!";
    } else {

        // If new image uploaded
        if(!empty($_FILES['image']['name'])) {

            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            move_uploaded_file($tmp_name, "../assets/images/".$image);

            $sql = "UPDATE articles 
                    SET title='$title',
                        content='$content',
                        image='$image',
                        category_id='$category_id',
                        updated_at=NOW()
                    WHERE id=$id";
        } else {

            $sql = "UPDATE articles 
                    SET title='$title',
                        content='$content',
                        category_id='$category_id',
                        updated_at=NOW()
                    WHERE id=$id";
        }

        if($conn->query($sql)) {
            header("Location: manage-articles.php");
            exit();
        } else {
            $error = "Update failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <span class="navbar-brand">Edit Article</span>
    <a href="manage-articles.php" class="btn btn-light">Back</a>
</nav>

<div class="container mt-5">
    <div class="card p-4 card-shadow">

        <h3 class="mb-4">Update Article</h3>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

            <!-- TITLE -->
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" id="title" name="title" 
                       value="<?php echo $article['title']; ?>" 
                       class="form-control" required>
            </div>

            <!-- CONTENT -->
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="6" required><?php echo $article['content']; ?></textarea>
            </div>

            <!-- CATEGORY -->
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-control" required>

                    <?php
                    $categories = $conn->query("SELECT * FROM categories");

                    while($cat = $categories->fetch_assoc()) {

                        $selected = ($cat['id'] == $article['category_id']) ? "selected" : "";

                        echo "<option value='".$cat['id']."' $selected>"
                              .$cat['category_name'].
                             "</option>";
                    }
                    ?>

                </select>
            </div>

            <!-- CURRENT IMAGE -->
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <?php if(!empty($article['image'])) { ?>
                    <img src="../assets/images/<?php echo $article['image']; ?>" width="200" class="img-thumbnail">
                <?php } else { ?>
                    <p>No image available</p>
                <?php } ?>
            </div>

            <!-- CHANGE IMAGE -->
            <div class="mb-3">
                <label class="form-label">Change Image (Optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <!-- BUTTONS -->
            <button type="submit" name="update_article" class="btn btn-primary">
                Update Article
            </button>

            <a href="manage-articles.php" class="btn btn-secondary">
                Cancel
            </a>

        </form>
    </div>
</div>

<!-- JAVASCRIPT VALIDATION -->
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