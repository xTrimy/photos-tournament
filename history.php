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
    <title>User History</title>
</head>

<body>
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
                <td><img src="<?php echo $h['image_url']; ?>"></td>
                </tr>
                <?php
                $i++;
            }
        ?>
    </table>
</body>

</html>