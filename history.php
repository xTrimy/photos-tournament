<?php
include('classes/DB.php');
include('classes/Login.php');

if (!isset($_GET['u'])) {
    die('User not found');
}
$u_id = $_GET['u'];
if (!DB::query('SELECT 1 FROM users WHERE id=:id', array(':id' => $u_id))) {
    die('User not found');
}
$history = DB::query('SELECT * FROM history WHERE user_id=:id', array(':id' => $u_id));
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
    <title>User History</title>
</head>

<body>
<h1>My History</h1>
    <table>
        <tr>
            <th>#</th>
            <th>Image</th>
        </tr>
        <?php
            $i=1;
            foreach($history as $h){
                ?>
                <tr>
                <td><?php echo $i; ?></td>
                <td><a href="<?php echo $h['image_url']; ?>" target="_blank"><img src="<?php echo $h['image_url']; ?>"></a></td>
                </tr>
                <?php
                $i++;
            }
        ?>
    </table>
</body>

</html>