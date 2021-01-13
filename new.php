<?php
    session_start();
    unset($_SESSION['selected_image']);
    unset($_SESSION['images']);
    unset($_SESSION['winner']);
    header('Location:./');
    ?>