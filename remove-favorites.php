<?php
    session_start();
    include 'database.php';
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ( isset($_GET['id']) ) {
            if(isset($_SESSION['favorites'][$_GET['id']])) {
                unset($_SESSION['favorites'][$_GET['id']]);
            }
        }
    }
    header('Location: view-favorites.php');
?>