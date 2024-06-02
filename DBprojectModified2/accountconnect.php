<?php
// session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmanbookreview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Prepare and execute the SQL statement to retrieve user details
$user_sql = "SELECT profilepic, name, gender, email, phone, country, age, studylevel, interests FROM user WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

$user = null;
if ($user_result->num_rows > 0) {
    // Fetch the user data
    $user = $user_result->fetch_assoc();
} else {
    echo "User data not found.";
}

$user_stmt->close();

// Prepare and execute the SQL statement to retrieve book reviews given by the user
$reviews_sql = "SELECT reviews.book_ID, books.bookname, reviews.reviewtext, reviews.rate FROM reviews INNER JOIN books ON reviews.book_ID = books.bookID WHERE reviews.user_ID = ?";
$reviews_stmt = $conn->prepare($reviews_sql);
$reviews_stmt->bind_param("i", $user_id);
$reviews_stmt->execute();
$reviews_result = $reviews_stmt->get_result();

$reviews = array();
if ($reviews_result->num_rows > 0) {
    // Fetch all reviews given by the user
    while ($row = $reviews_result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$reviews_stmt->close();
$conn->close();
?>
