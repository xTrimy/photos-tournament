<?php
session_start();
include('classes/DB.php');
include('classes/Login.php');
if(!Login::isLoggedIn()){
    header('Location: ./signin.php?word' );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos tournament</title>
</head>

<body data-round="1" data-stage="1">
    <img class="image" src="">
    <img class="image" src="">
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