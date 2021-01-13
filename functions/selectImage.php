<?php
    session_start();
    if( isset($_POST['image']) ){
        $image = $_POST['image'];
        array_push($_SESSION['selected_image'][$_SESSION['stage'] - 1], $image);
        var_dump($_SESSION['selected_image'][$_SESSION['stage'] - 1]);
        echo $image;

        if($_SESSION['round'] == 1 && $_SESSION['stage'] == 4){
            $_SESSION['winner'] = $image;
            echo "winner: ". $image . "\n";
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

    echo "round: " . $_SESSION['round'] . ' - ' . "stage:" . $_SESSION['stage'];

    }
?>