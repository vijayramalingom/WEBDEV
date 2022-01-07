<?php
    session_start();
    include 'database.php';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ( isset($_GET['id']) ) {
            $results = getPaintingById($_GET['id']);
            $painting = $results->fetch();
            if(!isset($_SESSION['favorites'])) {
                 $favorites = array(
                    (int)$_GET['id'] => array(
                        "id" => (int)$_GET['id'],
                        "ImageFileName" => $painting['ImageFileName'],
                        "Title" => $painting['Title'],
                     )
                );
                $_SESSION['favorites'] = $favorites;
            }
            else if(!isset($_SESSION['favorites'][(int)$_GET['id']])) {
                $_SESSION['favorites'][(int)$_GET['id']] = array(
                    "id" => (int)$_GET['id'],
                    "ImageFileName" => $painting['ImageFileName'],
                    "Title" => $painting['Title'],
                 );
            }  
        }
    }
    header('Location: view-favorites.php');
?>