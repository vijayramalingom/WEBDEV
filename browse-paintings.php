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
<body >
    
    <?php 
        include 'header.php';
        include 'database.php';
    ?>
    
<main class="ui segment doubling stackable grid container">

    <section class="five wide column">
        <form class="ui form" method="GET">
          <h4 class="ui dividing header">Filters</h4>

          <div class="field">
            <label>Artist</label>
            <select class="ui fluid dropdown" name="artist">
                <option value="">Select Artist</option>  
                <?php
                  $artists = getArtists();
                  foreach($artists as $artist) {
                    echo '<option value="' . $artist['ArtistID'] . '">' . $artist['LastName'] . '</option>';
                  } 
                ?>
            </select>
          </div>  
          <div class="field">
            <label>Museum</label>
            <select class="ui fluid dropdown" name="museum">
                <option value="">Select Museum</option>  
                <?php
                  $museums = getMuseums();
                  foreach($museums as $museum) {
                    echo '<option value="' . $museum['GalleryID'] . '">' . $museum['GalleryName'] . '</option>';
                  } 
                ?>
            </select>
          </div>   
          <div class="field">
            <label>Shape</label>
            <select class="ui fluid dropdown" name="shape">
                <option value="">Select Shape</option>  
                <?php
                  $shapes = getShapes();
                  foreach($shapes as $shape) {
                    echo '<option value="' . $shape['ShapeID'] . '">' . $shape['ShapeName'] . '</option>';
                  } 
                ?>
            </select>
          </div>   

            <button class="small ui orange button" type="submit">
              <i class="filter icon"></i> Filter 
            </button>    

        </form>
    </section>

    <?php
     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['artist']) && $_GET['artist'] !="") {
          $paintings = getPaintingsByArtist((int)$_GET['artist']);
        }
        else if(isset($_GET['museum']) && $_GET['museum'] !="") {
          $paintings = getPaintingsByMuseum((int)$_GET['museum']);
        }
        else if(isset($_GET['shape']) && $_GET['shape'] !="") {
          $paintings = getPaintingsByShape((int)$_GET['shape']);
        }
        else {
          $paintings = getTop20paintings();
        } 
     }
    ?>
    
    <section class="eleven wide column">
        <h1 class="ui header">Paintings</h1>
        <ul class="ui divided items" id="paintingsList">
        <?php
            foreach($paintings as $painting) {
                echo '<li class="item">';
                  echo '<a class="ui small image" href="single-painting.php?id=' . $painting['PaintingID'] .'"><img src="images/art/works/square-medium/' . $painting['ImageFileName'] . '.jpg"></a>';
                  echo '<div class="content">';
                    echo '<a class="header" href="single-painting.php?id=' . $painting['PaintingID'] .'">' . $painting['Title'] . '</a>';
                    $artists = getArtistFromId((int)$painting['ArtistID']);
                    foreach($artists as $artist) {
                      echo '<div class="meta"><span class="cinema">' . $artist['LastName'] . '</span></div>';
                    }
                    echo '<div class="description">';
                      echo'<p>' . $painting['Excerpt'] . '</p>';
                    echo '</div>';
                    echo '<div class="meta">';     
                      echo'<strong>$' . round($painting['MSRP'], 2) . '</strong>';        
                    echo '</div>';        
                    echo '<div class="extra">';
                      echo '<a class="ui icon orange button" href="cart.php?id=' . $painting['PaintingID'] .'"><i class="add to cart icon"></i></a>';
                      echo '<a class="ui icon button" href="addToFavorites.php?id=' . $painting['PaintingID'] .'"><i class="heart icon"></i></a>';          
                    echo '</div>';        
                  echo '</div>';      
                echo '</li>';
            }
        ?>
        </ul>        
    </section>  
    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
  </footer>
</body>
</html>