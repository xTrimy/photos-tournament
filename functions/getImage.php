<?php
    session_start();
    if(!isset($_SESSION['images'])){

        $_SESSION['selected_image'] = [];
        $_SESSION['selected_image'][0] = [];
        $_SESSION['selected_image'][1] = [];
        $_SESSION['selected_image'][2] = [];
        $_SESSION['selected_image'][3] = [];
        $_SESSION['round'] = 1;
        $_SESSION['stage'] = 1; 
        $json = file_get_contents('https://photo-voting.hiring.ipums.org/images/');
        $myImages = json_decode($json);
        $_SESSION['images'] = $myImages->data;
    }
    $current_images = [
        0 => $_SESSION['images'][($_SESSION['round'] - 1) * 2],
        1 => $_SESSION['images'][($_SESSION['round'] - 1) * 2 + 1]
    ];
    if(isset($_SESSION['winner'])){
    $current_images = [
        0 => $_SESSION['winner'],
        1 => NULL
    ];
    }
    else if($_SESSION['stage'] > 1){
        $current_images = [
        0 => 
            $_SESSION['selected_image'][$_SESSION['stage'] - 2][($_SESSION['round'] - 1) * 2]
         ,
        1 => 
            $_SESSION['selected_image'][$_SESSION['stage'] - 2][($_SESSION['round'] - 1) * 2 + 1]
         
        ];
    }

    echo json_encode($current_images);
    
?>

