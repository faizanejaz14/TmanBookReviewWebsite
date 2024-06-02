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

$query = $_GET['query'];
$query = $conn->real_escape_string($query);

$sql = "
    SELECT books.bookID, books.bookname, books.genre, authors.authorname, books.coverpic, books.bookdescription
    FROM books
    JOIN authors ON books.author_ID = authors.authorID
    WHERE books.bookname LIKE '%$query%' OR authors.authorname LIKE '%$query%' OR books.genre LIKE '%$query%'
";
$result = $conn->query($sql);

function isFavorite($userID, $bookID, $conn) {
    $sql = "SELECT * FROM favouritebooks WHERE user_ID = $userID AND book_ID = $bookID";
    $res = $conn->query($sql);
    return $res->num_rows > 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="searchstyles.css">
    <script src="javascript1.js"></script>
    <script>
        function redirectToReviews(bookID) {
            window.location.href = "reviews.php?bookID=" + bookID;
        }

        function toggleFavorite(bookID, action) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "toggle_favorite.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send("bookID=" + bookID + "&action=" + action);
        }
    </script>
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
                <input type="text" name="query" placeholder="Search by book name, author or genre" value="<?php echo htmlspecialchars($query); ?>" required>
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
        <h1>Search Results</h1>
        <div class="search-results">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='book'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['coverpic']) . "' alt='Book Cover'>";
                    echo "<div class='book-details'>";
                    echo "<h2>" . htmlspecialchars($row['bookname']) . "</h2>";
                    echo "<p>Genre: " . htmlspecialchars($row['genre']) . "</p>";
                    echo "<p>Author: " . htmlspecialchars($row['authorname']) . "</p>";
                    echo "<p>Description: " . htmlspecialchars($row['bookdescription']) . "</p>";
                    echo "<button class='read-reviews' data-book-id='" . $row['bookID'] . "' onclick='redirectToReviews(" . $row['bookID'] . ")'>Read Reviews</button>";

                    if (isset($_SESSION['id'])) {
                        $userID = $_SESSION['id'];
                        $bookID = $row['bookID'];
                        $isFav = isFavorite($userID, $bookID, $conn);
                        $favAction = $isFav ? "remove" : "add";
                        $favText = $isFav ? "Remove from Favorites" : "Add to Favorites";
                        echo "<button class='favorite-toggle' onclick='toggleFavorite(" . $bookID . ", \"" . $favAction . "\")'>" . $favText . "</button>";

                        echo "<form class='review-form' method='POST' action='submitreview.php'>";
                        echo "<textarea name='review' placeholder='Write your review here...' required></textarea>";
                        echo "<label for='rating'>Rating:</label>";
                        echo "<select name='rating' required>";
                        echo "<option value='1'>1</option>";
                        echo "<option value='2'>2</option>";
                        echo "<option value='3'>3</option>";
                        echo "<option value='4'>4</option>";
                        echo "<option value='5'>5</option>";
                        echo "</select>";
                        echo "<input type='hidden' name='book_id' value='" . $bookID . "'>";
                        echo "<button type='submit'>Submit Review</button>";
                        echo "</form>";
                    }
                    echo  nl2br ("\n");
                    echo "</div>"; // Close book-details
                    echo "</div>"; // Close book
                }
            } else {
                echo "<p>No results found.</p>";
            }
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <div class="footer-main">
            <p>&copy; 2024 Tman Book Reviews</p>
        </div>
    </footer>
</body>
</html>
