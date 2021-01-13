<?php
include('classes/DB.php');
include('classes/Login.php');
$history = "";
if (isset($_GET['u'])) {
    $u_id = $_GET['u'];
    if (!DB::query('SELECT 1 FROM users WHERE id=:id', array(':id' => $u_id))) {
        die('User not found');
    }
    $history = DB::query('SELECT * FROM history, users WHERE history.user_id = users.id AND user_id=:id ORDER BY history.ID DESC', array(':id' => $u_id));
} else {
    $history = DB::query('SELECT * FROM history, users WHERE history.user_id = users.id ORDER BY history.ID DESC');
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
    <title>User History</title>
</head>

<body>
    <h1>My History</h1>
    <?php
    if (isset($_GET['u'])) {
    ?>
        <a style="text-align:center;display:block;" href="?">View all user's history</a>
    <?php
    }
    ?>
    <table>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Image</th>
            <th>Time</th>
        </tr>
        <?php
        $i = 1;
        foreach ($history as $h) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $h['name']; ?></td>
                <td><a href="<?php echo $h['image_url']; ?>" target="_blank"><img src="<?php echo $h['image_url']; ?>"></a></td>
                <td><?php echo $h['win_time']; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </table>
</body>

</html>