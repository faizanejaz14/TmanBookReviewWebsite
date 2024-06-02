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
    <title>Home</title>
    <link rel="stylesheet" href="aboutstyles.css">
    <script src="javascript1.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="logo2.jpg" alt="Book Review Website Logo"></a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <li><a href="favourites.php">Favourites</a><li>
                    <?php endif; ?>
                    <!-- <li><a href="signup.html">Signup/Login</a></li> -->
                    <!-- <li><a href="about.php">About</a></li> -->
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
            <h1>About Us</h1>
            <p>Welcome to our Book Review Website! This platform was created as part of a database engineering course project with the primary purpose of providing a space for book enthusiasts to read and write reviews on their favorite books.</p>
            <p>Our goal is to foster a community where readers can share their thoughts, discover new books, and connect with others who have similar interests. Whether you're looking for your next great read or wanting to share your insights on a book you've just finished, our website offers an easy and user-friendly way to do so.</p>
            <p>We believe in the power of books to educate, inspire, and entertain. By allowing users to write honest reviews and rate books, we hope to guide others in their reading journeys and promote a love for literature.</p>
            <p>Thank you for being a part of our community. Happy reading and reviewing!</p>
            <br>
            <h3>Faizan Ejaz</h3>
            <p>(CEO)</p>
        </div>
    </main>
    <footer>
        <div class= "footer-main">
        <p>&copy; 2024 Tman Book Reviews</p>
        </div>
    </footer>
</body>
</html>

