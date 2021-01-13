<?php
    session_start();
    include('../classes/DB.php');
include('../classes/Login.php');

    if( isset($_POST['image']) ){
        $image = $_POST['image'];
        array_push($_SESSION['selected_image'][$_SESSION['stage'] - 1], $image);
        if($_SESSION['round'] == 1 && $_SESSION['stage'] == 4){
            $_SESSION['winner'] = $image;
            DB::query('INSERT INTO history VALUES (\'\',:user_id,:image_url)',array(':user_id'=>Login::isLoggedIn(), ':image_url'=>$image));
        }
        else if( $_SESSION['round'] == 2 && $_SESSION['stage'] == 3){
          $_SESSION['stage']++;
          $_SESSION['round'] = 1;
        }
        else if($_SESSION['round']*2*$_SESSION['stage'] == 16){
         $_SESSION['stage']++;
         $_SESSION['round'] = 1;
        }else{
         $_SESSION['round']++;
        }
    }
?>