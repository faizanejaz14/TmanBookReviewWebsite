<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['profilepic'])) {
    $imageData = base64_encode($_SESSION['profilepic']);
    // $profilePicSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    // header("Location: inde.php");
    // exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmanbookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userID = $_SESSION['id'];

// Query to fetch book information
$sql_book = "
    SELECT books.bookname, books.coverpic, books.bookdescription, books.bookID
    FROM favouritebooks JOIN books ON favouritebooks.book_ID = books.bookID
    WHERE $userID = favouritebooks.user_ID
";

$result_book = $conn->query($sql_book);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="favouritesstyles.css">
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
        <h1>Favourites</h1>
        <div class="review-results">
        <?php
        if ($result_book->num_rows > 0) {
            // Output book information
            while ($row_book = $result_book->fetch_assoc()) {
                $link = "reviews.php?bookID=".$row_book['bookID'];

                echo "<div class='book-info'>";
                echo "<a href = $link><img src='data:image/jpeg;base64," . base64_encode($row_book['coverpic']) . "' alt='Book Cover'> </a>";
                echo "<div class='book-details'>";
                echo "<h2>" . htmlspecialchars($row_book['bookname']) . "</h2>";
                echo "<p>Description: " . htmlspecialchars($row_book['bookdescription']) . "</p>";
                echo "</div>";
                echo "</div>";

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