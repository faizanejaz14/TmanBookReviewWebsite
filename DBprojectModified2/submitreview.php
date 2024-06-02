<?php
session_start();

if (!isset($_SESSION['id'])) {
    die("You must be logged in to submit a review.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmanbookreview";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['id'];
$book_id = $_POST['book_id'];
$review_text = $_POST['review'];
$rating = $_POST['rating'];

$review_text = $conn->real_escape_string($review_text);
$rating = (int) $rating;

$sql = "
    SELECT book_ID FROM reviews WHERE reviews.book_ID = $book_id AND reviews.user_ID = $user_id
";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql =  "
            UPDATE reviews
            SET reviewtext = '$review_text',
                rate = '$rating'
            WHERE reviews.book_ID = '$book_id' AND reviews.user_ID = '$user_id';
            ";
    
    mysqli_query($conn, $sql);

    header("Location: reviews.php?bookID=" . $book_id);
    exit();
}

$sql = "INSERT INTO reviews (book_ID, user_ID, reviewtext, rate) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("iisi", $book_id, $user_id, $review_text, $rating);
    if ($stmt->execute()) {
        echo "Review submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

header("Location: reviews.php?bookID=" . $book_id);
exit();
?>
