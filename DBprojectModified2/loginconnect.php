<?php 
session_start(); 
$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "tmanbookreview";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	if (empty($email)) {
		header("Location: login.php?error=Email is required");
	    exit();
	}else if(empty($password)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
            	// $imageData = base64_encode($_SESSION['profilepic']);
   				// $profilePicSrc = 'data:image/jpeg;base64,' . $imageData;
            	$_SESSION['profilepic'] = $row['profilepic'];
            	// $_SESSION['profilepic'] = $profilePicSrc;
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: index.php?success= Login Successful !"); 
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}