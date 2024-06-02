<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyles.css">
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
                    <li><a href="signup.php">Signup</a></li>
                </ul>
            </nav>
        </div>
        <!-- <div class="profile">
            <img id="profile-pic" src="faizan.jpg" alt="Profile Picture">
            <div id="dropdown-menu" class="dropdown">
                <a href="account.html" id="my-account-link">My Account</a>
                <a href="#" id="logout-link">Logout</a>
            </div>
        </div> -->
    </header>
    <main>
        <h2>Login</h2>
        <div class="login-container">
        <form action="loginconnect.php" method="POST" class="login-form">
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        </div>

    </main>
    <footer>
        <p>&copy; 2024 Book Review Website</p>
    </footer>
</body>
</html>
