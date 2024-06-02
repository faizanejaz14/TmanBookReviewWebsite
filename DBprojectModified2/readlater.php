<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['profilepic'])) {
    $imageData = base64_encode($_SESSION['profilepic']);
    // $profilePicSrc = 'data:image/jpeg;base64,' . $imageData;
 ?>
<?php 
}else{
     // header("Location: inde.php");
     // exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Later</title>
    <link rel="stylesheet" href="readlaterstyles.css">
    <script src="javascript1.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="logo2.jpg" alt="Book Review Website Logo"></a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>
        <div class="search-bar">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Search by book name or author" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="profile">
        <?php if (isset($_SESSION['id'])): ?>
            <img id="profile-pic" src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Profile Picture">
            <div id="dropdown-menu" class="dropdown">
                <a href="account.php" id="my-account-link">My Account</a>
                <a href="logout.php" id="logout-link">Logout</a>
            </div>
        <?php else: ?>
                <a href="login.php" style="color: white;">Login | </a>
                <a href="signup.php" style="color: white;">Signup</a>
        <?php endif; ?>
        </div>
    </header>
    <main>
        <div class="about-content">
            
        </div>
    </main>
    <footer>
        <div class= "footer-main">
        <p>&copy; 2024 Tman Book Reviews</p>
        </div>
    </footer>
</body>
</html>

