<?php 
require 'includes/db.php';
require 'includes/header.php';
?>

<style>

/* page container */

.news-container{
max-width:1400px;
margin:auto;
padding:20px;
}

/* page title */

.news-title{
text-align:center;
font-size:28px;
margin-bottom:40px;
}

/* category title */

.category-title{
font-size:22px;
margin:40px 0 20px 0;
font-weight:bold;
}

/* news row */

.news-row{
display:flex;
flex-wrap:wrap;
justify-content:center;
gap:20px;
}

/* news card */

.news-card{
width:240px;
background:#fff;
border-radius:8px;
overflow:hidden;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
transition:0.3s;
}

.news-card:hover{
transform:translateY(-5px);
box-shadow:0 6px 15px rgba(0,0,0,0.2);
}

/* image */

.news-image{
width:100%;
height:150px;
object-fit:cover;
}

/* content */

.news-content{
padding:15px;
}

/* category text */

.news-category{
font-size:12px;
color:#777;
}

/* title */

.news-headline{
font-size:16px;
margin:10px 0;
}

/* text */

.news-text{
font-size:14px;
color:#555;
}

/* button */

.read-btn{
display:inline-block;
margin-top:10px;
padding:6px 12px;
background:black;
color:white;
text-decoration:none;
font-size:13px;
border-radius:4px;
}

.read-btn:hover{
background:#333;
}

</style>


<div class="news-container">

<h2 class="news-title">All News Articles</h2>

<?php

$category_order = ["Health","Technology","Business","Sport","Politics"];

foreach($category_order as $category){

?>

<h3 class="category-title"><?php echo $category; ?></h3>

<div class="news-row">

<?php

$sql = "SELECT articles.*, categories.category_name 
        FROM articles
        JOIN categories ON articles.category_id = categories.id
        WHERE categories.category_name = '$category'
        ORDER BY articles.created_at DESC";

$result = $conn->query($sql);

if($result && $result->num_rows > 0){

while($row = $result->fetch_assoc()){
?>

<div class="news-card">

<?php if(!empty($row['image'])){ ?>

<img src="assets/images/<?php echo $row['image']; ?>" class="news-image">

<?php } ?>

<div class="news-content">

<span class="news-category">
<?php echo $row['category_name']; ?>
</span>

<h4 class="news-headline">
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

echo "<p>No news available.</p>";

}
?>

</div>

<?php
}
?>

</div>

<?php require 'includes/footer.php'; ?>