<?php
session_start();
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
    <h1>Choose one from the images below</h1>
        <img class="image img111" src="https://photo-voting.hiring.ipums.org/images/083.jpg">
        <img class="image img222" src="https://photo-voting.hiring.ipums.org/images/083.jpg">
    </div>
</body>

<script>
    var images = document.getElementsByClassName('image');
    var getImages = function() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var myImages = JSON.parse(this.responseText);

                images[0].setAttribute('src', myImages[0]);
                if (myImages[1] != null) {
                    images[1].setAttribute('src', myImages[1]);
                } else {
                    images[1].style.display = "none";
                }
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
        myImage.addEventListener('click', function() {
            myImage.classList.add('selected');
            let imageId = myImage.getAttribute('src');
            var currentRound = document.body.getAttribute('data-round');
            var currentStage = document.body.getAttribute('data-stage');
            var xhttp = new XMLHttpRequest();
            var data = new FormData();
            data.append('image', imageId);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    getImages();
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "functions/selectImage.php", true);
            xhttp.send(data);
        });
    }
</script>

</html>