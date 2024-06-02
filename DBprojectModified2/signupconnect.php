<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST data
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $age = $_POST['age'];
    $studylevel = $_POST['study-level'];
    $interests = $_POST['interests'];

    // Retrieve and process the profile picture
    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] == UPLOAD_ERR_OK) {
        $profilepic = $_FILES['profilepic']['tmp_name'];
        $imgContent = file_get_contents($profilepic);
    } 

    else {
        $_SESSION['error'] = "Profile picture upload failed.";
        header("Location: signup.php");
        exit();
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'tmanbookreview');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO user (profilepic, name, gender, email, password, phone, country, age, studylevel, interests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // $null is a placeholder for the binary data
        $null = NULL;
        $stmt->bind_param("bssssssiss", $null, $name, $gender, $email, $password, $phone, $country, $age, $studylevel, $interests);

        // Send binary data for the profile picture
        $stmt->send_long_data(0, $imgContent);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: login.php?success=Account Created Successfully!");
        } else {
            $_SESSION['error'] = "Account creation failed. Please try again.";
            header("Location: signup.php");
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
