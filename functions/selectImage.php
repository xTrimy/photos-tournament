<?php
    session_start();
    include('../classes/DB.php');
    include('../classes/Login.php');

    if( isset($_POST['image']) ){
        $image = $_POST['image'];

        // Add prefered images into array seperated into stages (each stage has a new array)
        array_push($_SESSION['selected_image'][$_SESSION['stage'] - 1], $image);

        // Check if it's the winner stage
        if($_SESSION['round'] == 1 && $_SESSION['stage'] == 4){
            $_SESSION['winner'] = $image;
            // Add the winner image to the history of the user
            $timenow = date('Y-m-d H:i:s');
            DB::query('INSERT INTO history VALUES (\'\',:user_id,:image_url,:_date)',array(':user_id'=>Login::isLoggedIn(), ':image_url'=>$image,':_date'=> $timenow));
        }

        // If stage 3 end
        else if( $_SESSION['round'] == 2 && $_SESSION['stage'] == 3){
          $_SESSION['stage']++;
          $_SESSION['round'] = 1;
        }
        
        // If stage 1 or 2 end
        else if($_SESSION['round']*2*$_SESSION['stage'] == 16){
         $_SESSION['stage']++;
         $_SESSION['round'] = 1;

        // If user selected an image continue to the next ones
        }else{
         $_SESSION['round']++;
        }
    }
?>