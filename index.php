<?php
session_start();
include('classes/DB.php');
include('classes/Login.php');
if (!Login::isLoggedIn()) {
    header('Location: ./signin.php?word');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link To Google Fonts  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Link To CSS File  -->
    <link rel="stylesheet" href="layout/css/main.css">
    <title>Photos tournament</title>
</head>

<body data-round="1" data-stage="1">
    <div class="img-view">
        <h1 style="color:red" id="error-msg"></h1>
        <h1>Choose one from the images below</h1>

        <h1 id="winner-text" style="display:none;">Winner</h1>
        <img class="image img111" src="https://photo-voting.hiring.ipums.org/images/083.jpg">
        <img class="image img222" src="https://photo-voting.hiring.ipums.org/images/083.jpg">
        <div id="winner-button" style="display:none;">
            <a href="./new.php">Start new tournament</a><br>
            <a href="./history.php?u=<?php echo Login::isLoggedIn(); ?>">View my history</a>
        </div>
</body>

<script>
    // Get the images elements on the page
    var images = document.getElementsByClassName('image');

    // Function to fetch the current images to be displayed
    var getImages = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myImages = JSON.parse(this.responseText);
                // Display the images in the array fetched from getImage.php
                images[0].setAttribute('src', myImages[0]);
                if (myImages[1] != null) { // If no winning image
                    images[1].setAttribute('src', myImages[1]);
                } else { // If winning image
                    images[0].classList.add('winner');
                    document.getElementById('winner-text').style.display = "block";
                    document.getElementById('winner-button').style.display = "block";
                    images[1].style.display = "none";
                }
            } else if (this.status != 200) {
                document.getElementById('error-msg').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "functions/getImage.php", true);
        xhttp.send();
    }
    getImages();
</script>


<script>
    for (let i = 0; i < images.length; i++) {
        let myImage = images[i];
        // Select a prefered image and fetch new images 
        myImage.addEventListener('click', function() {
            if (!myImage.classList.contains('winner')) {
                let imageURL = myImage.getAttribute('src');
                var currentRound = document.body.getAttribute('data-round');
                var currentStage = document.body.getAttribute('data-stage');
                var xhttp = new XMLHttpRequest();
                var data = new FormData();
                data.append('image', imageURL);
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        getImages();
                    }
                };
                xhttp.open("POST", "functions/selectImage.php", true);
                xhttp.send(data);
            }

        });

    }
</script>

</html>