<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "Unauthorized";
    exit;
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
$bookID = $_POST['bookID'];
$action = $_POST['action'];

if ($action == "add") {
    $sql = "INSERT INTO favouritebooks (user_ID, book_ID) VALUES ($userID, $bookID)";
} elseif ($action == "remove") {
    $sql = "DELETE FROM favouritebooks WHERE user_ID = $userID AND book_ID = $bookID";
}

if ($conn->query($sql) === TRUE) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
