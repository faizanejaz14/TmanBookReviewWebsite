<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="signupstyles.css">
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
                     <li><a href="login.php">Login</a></li>
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
        <h2>Sign up</h2>
        <form action="signupconnect.php" method="post" class="signup-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profilepic">Profile Picture:</label>
                <input type="file" id="profilepic" name="profilepic" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" placeholder="minimum 8 characters" id="password" name="password" min="8" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" placeholder="0xxx-xxxxxxx" id="phone" name="phone" pattern="0[0-9]{3}-[0-9]{7}" min="12" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" required>
            </div>
            <div class="form-group">
                <label for="study-level">Current Study Level:</label>
                <select id="study-level" name="study-level" required>
                    <option value="high-school">High School</option>
                    <option value="bachelor">Bachelor's Degree</option>
                    <option value="master">Master's Degree</option>
                    <option value="phd">PhD</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="interests">Interests (Book Types):</label>
                <input type="text" placeholder="interest1,interest2,interest3" id="interests" name="interests" required>
            </div>
            <button type="submit">Sign up</button>
            <!-- <input type="submit" class="btn" id="btn" value="sign-up"> -->
            
        </form> 
    </main>
    <footer>
        <p>&copy; 2024 Book Review Website</p>
    </footer>
</body>
</html>

