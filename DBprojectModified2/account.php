<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['profilepic'])) {
    $imageData = base64_encode($_SESSION['profilepic']);
    // $profilePicSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    // header("Location: inde.php");
    // exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="accountstyles.css">
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
                    <li><a href="about.php">About</a></li>
                    <li><a href="logout.php" id="logout-link">Logout</a></li>
                </ul>
            </nav>
        </div>
        
    </header>
    <main>
        <h2>User Details</h2>
        <div class="login-container" id="login-container">
            <?php include 'accountconnect.php'; ?>

            <?php if ($user): ?>
                <div class="user-details">
                    <div class="profile">
                    <img id="profilepic" src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Profile Picture">
                    </div>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                    <p><strong>Country:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                    <p><strong>Study Level:</strong> <?php echo htmlspecialchars($user['studylevel']); ?></p>
                    <p><strong>Interests:</strong> <?php echo htmlspecialchars($user['interests']); ?></p>
                </div>
            <?php else: ?>
                <p>No user data found.</p>
            <?php endif; ?>
            
            <h2>Book Reviews</h2>
            <?php if (!empty($reviews)): ?>
                <div class="review-list">
                    <?php foreach ($reviews as $review): ?>
                        <div class="review">
                            <h3><?php echo htmlspecialchars($review['bookname']); ?></h3>
                            <p><strong>Review:</strong> <?php echo htmlspecialchars($review['reviewtext']); ?></p>
                            <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rate']); ?>/5</p>
                        </div>
                    <?php endforeach; ?>
                    <br><br><br><br>
                </div>
            <?php else: ?>
                <p>No reviews found.</p>
            <?php endif; ?>
        </div>

    </main>
    <footer>
        <p>&copy; 2024 Tman Book Reviews</p>
    </footer>
</body>
</html>
