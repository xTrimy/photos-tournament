<?php 
include('classes/DB.php');
include('classes/user.php');
User::signin();
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
    <title>Signin</title>
</head>
<body>
<h1>Sign In</h1>
    <!-- Regular form inputs  -->
    <form action="signin.php" method="POST">
        <p>Email</p>
        <input type="email" name="email" placeholder="Enter Your Email .." required>
        <br>
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Your Password .." required>
        <br>
        <br>
        <input type="submit" name="signin" value="Signin">
    </form>
</body>
</html>