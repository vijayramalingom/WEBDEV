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
    
<main >
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
		<?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ( isset($_GET['id']) ) {
                    $results = getPaintingById($_GET['id']);
                        $painting = $results->fetch();  
                }
                else {
                    $results = getPaintingById(5);
                        $painting = $results->fetch();  
                }
            }
        ?>  
            <div class="nine wide column">
                <?php
                    echo '<img src="images/art/works/medium/' . $painting['ImageFileName'] . '.jpg" alt="..." class="ui big image" id="artwork">';
                ?>
                <div class="ui fullscreen modal">
                  <div class="image content">
                    <?php
                        echo '<img src="images/art/works/large/' . $painting['ImageFileName'] . '.jpg" alt="..." class="image" >';
                    ?>
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                
                
            </div>	<!-- END LEFT Picture Column --> 
			
            <div class="seven wide column">
                
                <!-- Main Info -->
                <div class="item">
					<h2 class="header"><?php echo $painting['Title'] ?></h2>
                    <?php $artist = getArtistFromId((int)$painting['ArtistID'])->fetch(); ?>
					<h3 ><?php echo $artist['LastName'] ?></h3>
					<div class="meta">
						<p>
                        <?php
                            $reviews = getReviews((int)$painting['PaintingID']);
                            $reviewAvg = 0;
                            $count = 0;
                            foreach($reviews as $review) {
                                $reviewAvg = $reviewAvg + $review['Rating'];
                                $count++; 
                            }
                            if($count != 0) {
                                $reviewAvg = round($reviewAvg/$count);
                            }
                            for ($i = 1; $i <= 5; $i++) {
                                if($i <= $reviewAvg) {
                                    echo '<i class="orange star icon"></i>';
                                }
                                else {
                                    echo '<i class="empty star icon"></i>';
                                }
                            }
                        ?>
						</p>
						<p><?php echo $painting['Excerpt']; ?></p>
					</div>  
                </div>                          
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
					  <tbody>
						  <tr>
						 <td>
							  Artist
						  </td>
						  <td>
							<a href="#"><?php echo $artist['LastName'];?></a>
						  </td>                       
						  </tr>
						<tr>                       
						  <td>
							  Year
						  </td>
						  <td>
                            <?php echo $painting['YearOfWork'];?>
						  </td>
						</tr>       
						<tr>
						  <td>
							  Medium
						  </td>
						  <td>
                            <?php echo $painting['Medium'];?>
						  </td>
						</tr>  
						<tr>
						  <td>
							  Dimensions
						  </td>
						  <td>
                            <?php echo $painting['Width'] . 'cm x ' . $painting['Height'] . 'cm';?>
						  </td>
						</tr>        
					  </tbody>
					</table>
                </div>
				
                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                      <tbody>
                        <tr>
                          <td>
                              Museum
                          </td>
                          <?php $museum = getMuseumById((int)$painting['GalleryID'])->fetch(); ?>
                          <td>
                            <?php echo $museum['GalleryName'];?>
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              Assession #
                          </td>
                          <td>
                            <?php echo $painting['AccessionNumber'];?>
                          </td>
                        </tr>  
                        <tr>
                          <td>
                              Copyright
                          </td>
                          <td>
                            <?php echo $painting['CopyrightText'];?>    
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              URL
                          </td>
                          <td>
                            <a href=<?php echo '"' . $painting['MuseumLink'] . '"';?>>View painting at museum site</a>
                          </td>
                        </tr>        
                      </tbody>
                    </table>    
                </div>     
                <div class="ui bottom attached tab segment" data-tab="genres">
 
                        <ul class="ui list">
                            <?php
                                $genres = getGenreById((int)$painting['PaintingID']);
                                foreach($genres as $genre) {
                                    echo '<li class="item"><a href="#">' . $genre['GenreName'] . '</a></li>';
                                }
                            ?>
                        </ul>

                </div>  
                <div class="ui bottom attached tab segment" data-tab="subjects">
                    <ul class="ui list">
                        <?php
                            $subjects = getSubjectsById((int)$painting['PaintingID']);
                            foreach($subjects as $subject) {
                                echo '<li class="item"><a href="#">' . $subject['SubjectName'] . '</a></li>';
                            }
                        ?>
                        </ul>
                </div>  
                
                <!-- Cart and Price -->
                <div class="ui segment">
                    <div class="ui form">
                        <div class="ui tiny statistic">
                          <div class="value">
                            <?php echo '$' . round($painting['MSRP'], 2);?>
                          </div>
                        </div>
                        <div class="four fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number">
                            </div>                               
                            <div class="four wide field">
                                <label>Frame</label>
                                <select id="frame" class="ui search dropdown">
                                    <?php
                                        $frames = getFrames();
                                        foreach($frames as $frame) {
                                            echo '<option>' . $frame['Title'] . '[$' . round($frame['Price'], 2) . ']</option>';
                                        }
                                    ?>
                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Glass</label>
                                <select id="glass" class="ui search dropdown">
                                    <?php
                                        $glasses = getGlass();
                                        foreach($glasses as $glass) {
                                            echo '<option>' . $glass['Title'] . '[$' . round($glass['Price'], 2) . ']</option>';
                                        }
                                    ?>
                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Matt</label>
                                <select id="matt" class="ui search dropdown">
                                    <?php
                                        $matts = getMatt();
                                        foreach($matts as $matt) {
                                            echo '<option>' . $matt['Title'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>           
                        </div>                     
                    </div>

                    <div class="ui divider"></div>

                    <button class="ui labeled icon orange button">
                      <i class="add to cart icon"></i>
                      Add to Cart
                    </button>
                    <button class="ui right labeled icon button">
                      <i class="heart icon"></i>
                      Add to Favorites
                    </button>        
                </div>     <!-- END Cart -->                      
                          
            </div>	<!-- END RIGHT data Column --> 
        </div>		<!-- END Grid --> 
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
			
            <div class="ui bottom attached active tab segment" data-tab="first">
              <?php echo $painting['Description'] ?>
            </div>	<!-- END DescriptionTab --> 
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                        Wikipedia Link
                      </td>
                      <td>
                        <a href="<?php echo $painting['WikiLink'] ?>">View painting on Wikipedia</a>
                      </td>                       
                      </tr>                       
                      
                      <tr>
                     <td>
                        Google Link
                      </td>
                      <td>
                        <a href="<?php echo $painting['GoogleLink'] ?>">View painting on Google Art Project</a>
                      </td>                       
                      </tr>
                      
                      <tr>
                     <td>
                          Google Text
                      </td>
                      <td>
                        <?php echo $painting['GoogleDescription'] ?>
                      </td>                       
                      </tr>                      
                      
   
       
                  </tbody>
                </table>
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">
				<?php
                    $reviews = getReviews((int)$painting['PaintingID']);
                    foreach($reviews as $rev) {
                        echo '<div class="event">';
					        echo '<div class="content">';
						        echo '<div class="date">' . $rev['ReviewDate'] .'</div>';
						        echo '<div class="meta">';
							        echo '<a class="like">';
                                        for ($i = 1; $i <= 5; $i++) {
                                            if(isset($rev['Rating'])) {
                                                if($i <= (int)$rev['Rating']) {
                                                    echo '<i class="star icon"></i>';
                                                }
                                                else {
                                                    echo '<i class="empty star icon"></i>';
                                                }
                                            }
                                            else {
                                                echo '<i class="empty star icon"></i>';
                                            }
                                        }
							        echo '</a>';
						        echo '</div>';                    
						        echo '<div class="summary">';
							        echo $rev['Comment'];        
						        echo '</div>';       
					        echo '</div>';
				        echo '</div>';
					
				        echo '<div class="ui divider"></div>';
                    }
                ?>
            </div>   <!-- END Reviews Tab -->          
        
        </div>        
    </section> <!-- END Description, On the Web, Reviews Tabs --> 
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>        
	</section>  
	
</main>    
    

    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>