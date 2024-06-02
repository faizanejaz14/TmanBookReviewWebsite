<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['profilepic'])) {
    $imageData = base64_encode($_SESSION['profilepic']);
    // $profilePicSrc = 'data:image/jpeg;base64,' . $imageData;
} else {
    // header("Location: inde.php");
    // exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="indexstyles.css">
    <script src="javascript1.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('indexconnect.php')
            .then(response => response.json())
            .then(slides => {
                const container = document.getElementById('slideshow-container');
                slides.forEach((slide, index) => {
                    const slideDiv = document.createElement('div');
                    slideDiv.className = 'slide';
                    if (index === 0) slideDiv.classList.add('active');

                    link = "reviews.php?bookID=" + slide.link;

                    slideDiv.innerHTML = `
                        <div class="whitebox" id="whitebox">
                        <a href = ${link}><img src="${slide.image}" alt="Slide Image"></a>
                        <div class="description"><p>${slide.description}</p></div>
                        </div>
                    `;
                    container.appendChild(slideDiv);
                });

                let slideIndex = 0;
                const slideElements = document.getElementsByClassName('slide');

                function showSlides() {
                    for (let i = 0; i < slideElements.length; i++) {
                        slideElements[i].style.display = 'none';
                    }

                    slideElements[slideIndex].style.display = 'block';
                    plusSlides(1);
                    
                    setTimeout(showSlides, 10000); // Change image every 10 seconds
                }

                function plusSlides(n) {
                    slideIndex += n;
                    if (slideIndex >= slideElements.length) { slideIndex = 0; }
                    if (slideIndex < 0) { slideIndex = slideElements.length - 1; }
                    for (let i = 0; i < slideElements.length; i++) {
                        slideElements[i].style.display = 'none';
                    }
                    slideElements[slideIndex].style.display = 'block';

                }

                showSlides();

                window.plusSlides = plusSlides;
            })
            .catch(error => console.error('Error fetching images:', error));
    });
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
                <input type="text" name="query" placeholder="Search by author, book or genres (upto 3)" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="profile">
            <?php if (isset($_SESSION['id'])): ?>
                <img id="profile-pic" src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Profile Picture">
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
        <!-- <div class="whitebox" id="whitebox"> -->
        <div class="slideshow-container" id="slideshow-container">
            <!-- Slides will be dynamically inserted here -->
        </div>
        <!-- </div> -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </main>
    <br><br><br><br>
    <footer>
        <div class="footer-main">
            <p>&copy; 2024 Tman Book Reviews</p>
        </div>
    </footer>
</body>
</html>
