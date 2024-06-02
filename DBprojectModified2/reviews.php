<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmanbookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the book ID from the URL parameters
$bookID = $_GET['bookID'];

// Query to fetch book information
$sql_book = "
    SELECT books.bookname, authors.authorname, books.coverpic, books.bookdescription
    FROM books
    JOIN authors ON books.author_ID = authors.authorID
    WHERE books.bookID = $bookID
";

$result_book = $conn->query($sql_book);

// Query to fetch reviews for the specified book ID
$sql_reviews = "
    SELECT reviews.reviewtext, reviews.rate, user.name
    FROM reviews
    JOIN user ON reviews.user_ID=user.id
    WHERE book_ID = $bookID
";

$result_reviews = $conn->query($sql_reviews);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews</title>
    <link rel="stylesheet" href="reviewsstyles.css">
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
             <img id="profile-pic" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['profilepic']); ?>" alt="Profile Picture">
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
        <h1>Reviews</h1>
        <div class="review-results">
        <?php
        if ($result_book->num_rows > 0) {
            // Output book information
            $row_book = $result_book->fetch_assoc();
            echo "<div class='book-info'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row_book['coverpic']) . "' alt='Book Cover'>";
            echo "<div class='book-details'>";
            echo "<h2>" . htmlspecialchars($row_book['bookname']) . "</h2>";
            echo "<p>Author: " . htmlspecialchars($row_book['authorname']) . "</p>";
            echo "<p>Description: " . htmlspecialchars($row_book['bookdescription']) . "</p>";
            echo "</div>";
            echo "</div>";

            // Output reviews
            echo "<div class='reviews'>";
            echo "<h2>Reviews:</h2>";
            if ($result_reviews->num_rows > 0) {
                while($row_review = $result_reviews->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<p><strong>Username:</strong> " . htmlspecialchars($row_review['name']) . "</p>";
                    echo "<p><strong>Rating:</strong> " . $row_review['rate'] . "</p>";
                    echo "<p><strong>Review:</strong> " . htmlspecialchars($row_review['reviewtext']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available for this book.</p>";
            }
            echo "</div>";
        } else {
            echo "<p>Book not found.</p>";
        }
        ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Tman Book Reviews</p>
    </footer>
</body>
</html>

