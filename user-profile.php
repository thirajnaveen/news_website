<?php
include 'includes/db.php';
include 'includes/header.php';

session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<div class="profile-container">

    <h2>User Profile</h2>

    <div class="profile-card">

        <img src="uploads/<?php echo $user['profile_image']; ?>" class="profile-img">

        <h3><?php echo $user['name']; ?></h3>

        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

        <p><strong>Member Since:</strong> <?php echo $user['created_at']; ?></p>

        <a href="edit_profile.php" class="edit-btn">Edit Profile</a>

    </div>

</div>

<?php include 'includes/footer.php'; ?>