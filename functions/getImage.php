<?php
    session_start();
    if(!isset($_SESSION['images'])){
        // create array for the user prefered images
        $_SESSION['selected_image'] = [];
        $_SESSION['selected_image'][0] = [];
        $_SESSION['selected_image'][1] = [];
        $_SESSION['selected_image'][2] = [];
        $_SESSION['selected_image'][3] = [];

        // create sessions for rounds and stages
        // Round is the current image selection
        // Stage is the filtering of the image selection
        $_SESSION['round'] = 1;
        $_SESSION['stage'] = 1; 

        // Getting the object from the web server then extracting the images array from it
        $json = file_get_contents('https://photo-voting.hiring.ipums.org/images/');
        $myImages = json_decode($json);

        // Saving fetched images into session array
        $_SESSION['images'] = $myImages->data;
    }

    // Array for displaying images of rounds per stage
    $current_images = [
        0 => $_SESSION['images'][($_SESSION['round'] - 1) * 2],
        1 => $_SESSION['images'][($_SESSION['round'] - 1) * 2 + 1]
    ];

    // If an image won, display only the winner image
    if(isset($_SESSION['winner'])){
    $current_images = [
        0 => $_SESSION['winner'],
        1 => NULL
    ];
    }
    else if($_SESSION['stage'] > 1){ // For any stage other than the first one select from the prefered images instead of the API images
        $current_images = [
        0 => 
            $_SESSION['selected_image'][$_SESSION['stage'] - 2][($_SESSION['round'] - 1) * 2]
         ,
        1 => 
            $_SESSION['selected_image'][$_SESSION['stage'] - 2][($_SESSION['round'] - 1) * 2 + 1]
        ];
    }

    // Send the images array back to be displayed 
    echo json_encode($current_images);
    
?>

