<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
        <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<?php
    session_start();
    if(isset($_SESSION['favorites'])) {
        $paintings = $_SESSION['favorites'];
        echo '<table>';
            echo '<tr>';
                echo '<th>Title</th><th>Image</th><th>Remove</th>';
            echo '</tr>';
        echo '<ul class="ui divided items" id="paintingsList">';
            foreach($paintings as $painting) {
                echo '<tr>';
                    echo '<td>' . $painting["Title"] . '</td>';
                    echo '<td><a href="single-painting.php?id=' . $painting["id"] .'"><img src="images/art/works/square-small/' . $painting["ImageFileName"] . '.jpg"></a></td>';
                    echo '<td><a class="ui icon button" href="remove-favorites.php?id=' . $painting['id'] .'"><i class="heart icon"></i></a></td>';
                echo '</tr>';
            }

        echo '</table>';
    }

?>