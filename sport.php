<?php
include "includes/header.php";
include "includes/db.php";
?>

<style>

/* Container */
.container{
    width:90%;
    margin:auto;
    padding:20px;
}

/* Category Title */
.category-title{
    text-align:center;
    font-size:32px;
    margin-bottom:30px;
    color:#222;
    border-bottom:3px solid #e63946;
    display:inline-block;
    padding-bottom:5px;
}

/* News Grid */
.news-container{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

/* News Card */
.news-card{
    background:#ffffff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.news-card:hover{
    transform:translateY(-5px);
}

/* Image */
.news-card img{
    width:100%;
    height:180px;
    object-fit:cover;
}

/* Title */
.news-card h3{
    font-size:20px;
    margin:15px;
    color:#333;
}

/* Content */
.news-card p{
    margin:0 15px 15px;
    font-size:14px;
    color:#555;
}

/* Read More Button */
.news-card a{
    display:inline-block;
    margin:0 15px 15px;
    padding:8px 15px;
    background:#e63946;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
}

.news-card a:hover{
    background:#c1121f;
}

</style>


<div class="container">
<h2 class="category-title">Sport News</h2>

<div class="news-container">

<?php

$sql = "SELECT articles.*, categories.category_name
        FROM articles
        JOIN categories ON articles.category_id = categories.id
        WHERE categories.category_name = 'Sport'
        ORDER BY articles.created_at DESC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>

<div class="news-card">
    <img src="assets/images/<?php echo $row['image']; ?>" alt="">
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo substr($row['content'],0,120); ?></p>
    <a href="single-news.php?id=<?php echo $row['id']; ?>">Read More</a>
</div>

<?php
    }
}else{
    echo "<p>No Sport news available</p>";
}
?>

</div>
</div>

<?php include "includes/footer.php"; ?>