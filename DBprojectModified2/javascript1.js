document.addEventListener("DOMContentLoaded", function() {
    var profilePic = document.getElementById("profile-pic");
    var dropdownMenu = document.getElementById("dropdown-menu");

    profilePic.addEventListener("click", function() {
        dropdownMenu.classList.toggle("show");
    });

    // Close the dropdown menu when clicking outside of it
    window.addEventListener("click", function(event) {
        if (!event.target.matches("#profile-pic")) {
            var dropdowns = document.getElementsByClassName("dropdown");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains("show")) {
                    openDropdown.classList.remove("show");
                }
            }
        }
    });
});
var slideIndex = 1;
  showDivs(slideIndex);
  var slideInterval = setInterval(autoChangeSlides, 3000); // Auto change slides every 3 seconds

  function autoChangeSlides() {
    plusDivs(1);
  }

  function plusDivs(n) {
    clearInterval(slideInterval); // Clear previous interval
    slideInterval = setInterval(autoChangeSlides, 3000); // Reset interval
    showDivs(slideIndex += n);
  }

  function currentDiv(n) {
    clearInterval(slideInterval); // Clear previous interval
    slideInterval = setInterval(autoChangeSlides, 3000); // Reset interval
    showDivs(slideIndex = n);
  }

  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" w3-white", "");
    }
    x[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " w3-white";
  }
 document.addEventListener("DOMContentLoaded", function() {
    autoChangeSlides(); // Start the slideshow automatically on page load

    // Simulate click on the right arrow after a short delay (adjust as needed)
    setTimeout(function() {
        document.querySelector(".w3-right").click();
    }, 1000); // Adjust the delay as needed (in milliseconds)
});
