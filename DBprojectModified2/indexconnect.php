<?php
header('Content-Type: application/json');

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

$sql = "SELECT bookID, coverpic, bookdescription FROM books";
$result = $conn->query($sql);

$slides = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $link = $row['bookID'];
        // Encode the binary data to base64
        $imageData = base64_encode($row['coverpic']);
        $description = $row['bookdescription'];

        $slides[] = array(
            'image' => 'data:image/jpeg;base64,' . $imageData,
            'description' => $description,
            'link'  => $link
        );
    }
} else {
    echo json_encode([]);
    exit();
}

$conn->close();
echo json_encode($slides);
?>
