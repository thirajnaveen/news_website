<?php
include 'includes/db.php';
include 'includes/header.php';

/*--------CHECK ID--------*/
if(!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid Article!</div>";
    include 'includes/footer.php';
    exit();
}

$id = intval($_GET['id']);

/*--------FETCH ARTICLE WITH CATEGORY--------*/
$sql = "SELECT articles.*, categories.category_name 
        FROM articles
        LEFT JOIN categories 
        ON articles.category_id = categories.id
        WHERE articles.id = $id";

$result = $conn->query($sql);

if($result->num_rows == 0) {
    echo "<div class='alert alert-danger'>Article Not Found!</div>";
    include 'includes/footer.php';
    exit();
}

$article = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-lg-8 mx-auto">

        <div class="card shadow-sm">

            <!--Article Image-->
            <?php if(!empty($article['image'])) { ?>
                <img src="assets/images/<?php echo $article['image']; ?>" 
                     class="card-img-top"
                     style="max-height:400px; object-fit:cover;">
            <?php } ?>

            <div class="card-body">

                <!--Category-->
                <span class="badge bg-primary mb-2">
                    <?php echo $article['category_name']; ?>
                </span>

                <!--Title-->
                <h2 class="card-title">
                    <?php echo $article['title']; ?>
                </h2>

                <!--Date-->
                <p class="text-muted">
                    Published on: <?php echo date("F d, Y", strtotime($article['created_at'])); ?>
                </p>

                <hr>

                <!--Full Content-->
                <p class="card-text" style="line-height:1.8;">
                    <?php echo nl2br($article['content']); ?>
                </p>

                <hr>

                <a href="news.php" class="btn btn-dark">
                    ← Back to News
                </a>

            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>