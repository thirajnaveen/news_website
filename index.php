<?php 
include 'includes/db.php';
include 'includes/header.php';
?>

<link rel="stylesheet" href="/news_website/assets/css/style.css">

<div class="container">

<h2 class="latest-title">Latest News</h2>

<div class="news-grid">

<?php

$sql = "SELECT * FROM articles ORDER BY created_at DESC LIMIT 20";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

<div class="news-card">

<img src="assets/images/<?php echo $row['image']; ?>" class="news-img">

<div class="news-body">

<h4 class="news-title">
<?php echo $row['title']; ?>
</h4>

<p class="news-text">
<?php echo substr($row['content'],0,80); ?>...
</p>

<a href="single-news.php?id=<?php echo $row['id']; ?>" class="read-btn">
Read More
</a>

</div>

</div>

<?php
    }

}else{
    echo "<p>No news available</p>";
}

?>

</div>

</div>

<?php include 'includes/footer.php'; ?>