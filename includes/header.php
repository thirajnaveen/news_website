<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>NEWS</title>

        <!--Font Awesome Icon-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="/news_website/assets/css/style.css">
    </head>
    <body>
        <header class="top-header">
            <div class="logo">
                <span class="news-box">N</span>
                <span class="news-box">E</span>
                <span class="news-box">W</span>
                <span class="news-box">S</span>
            </div>

            <div class="auth">
                <a href="register.php">
                    <button>Register</button>
                </a>
            </div>

            <div class="auth2">
                <a href="login.php">
                    <button>Sign In</button>
                </a>
            </div>

        </header>

        <!--Navigation-->
        <nav>
            <div class="navbar button">
                <button onclick="window.location.href='index.php'">Home</button>
                <button onclick="window.location.href='news.php'">News</button>
                <button onclick="window.location.href='sport.php'">Sport</button>
                <button onclick="window.location.href='business.php'">Business</button>
                <button onclick="window.location.href='technology.php'">Technology</button>
                <button onclick="window.location.href='health.php'">Health</button>
                <button onclick="window.location.href='politics.php'">Politics</button>
            </div>
        </nav>
        
        <label>
            <input type="checkbox">
            <div class="toggle">
                <span class="top_line common"></span>
                <span class="middle_line common"></span>
                <span class="bottom_line common"></span>
            </div>
            
            <div class="slide">
                <h1>MENU</h1>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i>Home</a></li>
                    <li><a href="news.php"><i class="fas fa-newspaper"></i>News</a></li>
                    <li><a href="sport.php"><i class="fas fa-futbol"></i>Sport</a></li>
                    <li><a href="business.php"><i class="fas fa-chart-line"></i>Business</a></li>
                    <li><a href="technology.php"><i class="fas fa-microchip"></i>Technology</a></li>
                    <li><a href="health.php"><i class="fas fa-globe"></i>Health</a></li>
                    <li><a href="politics.php"><i class="fas fa-globe"></i>Politics</a></li>
                    <!--<li><a href="user-profile.php"><i class="far fa-user"></i>User Profile</a></li>-->
                    <li><a href="contact.php"><i class="fas fa-envelope"></i>Contact</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i>about</a></li>
                </ul>
            </div>
        </label>
    