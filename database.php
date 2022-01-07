<?php
function setConnectionInfo() {
  try {
      $pdo = new PDO('mysql:host=localhost;dbname=art', 'testuser', 'mypassword');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $e) { 
      die( $e->getMessage() ); 
  }
  return $pdo;
}

function runQuery($pdo, $sql) {
    $result = $pdo->query($sql); 
    return $result;
}


function getTop20Paintings() {
    $pdo = setConnectionInfo();
    try {
        $sql = ("select * from paintings limit 20");
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getArtistFromId($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from artists where ArtistID =' . $id);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getPaintingById($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from paintings where PaintingID =' . $id);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getReviewById($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from reviews where PaintingID =' . $id);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getMuseumById($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from galleries where GalleryID =' . $id);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}
function getGenreById($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from paintinggenres where PaintingID =' . $id);
        $genreIds = runQuery($pdo, $sql);
        $sql = ('select * from genres where GenreID in (');
        foreach($genreIds as $genreId) {
            $sql = $sql . $genreId['GenreID'] . ',';
        }
        $sql = $sql . ')';
        $sql = str_replace(',)', ')', $sql);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getSubjectsById($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from paintingsubjects where PaintingID =' . $id);
        $subjectIds = runQuery($pdo, $sql);
        $sql = ('select * from subjects where SubjectID in (');
        foreach($subjectIds as $subjectId) {
            $sql = $sql . $subjectId['SubjectID'] . ',';
        }
        $sql = $sql . ')';
        $sql = str_replace(',)', ')', $sql);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getFrames() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from typesframes');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}
function getGlass() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from typesglass');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getMatt() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from typesmatt');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getReviews($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from reviews where PaintingId = ' . $id);
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getArtists() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from artists');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getMuseums() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from galleries');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getShapes() {
    $pdo = setConnectionInfo();
    try {
        $sql = ('select * from shapes');
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getPaintingsByArtist($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ("select * from paintings where ArtistID = " . $id . " limit 20");
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getPaintingsByMuseum($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ("select * from paintings where GalleryID = " . $id . " limit 20");
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

function getPaintingsByShape($id) {
    $pdo = setConnectionInfo();
    try {
        $sql = ("select * from paintings where ShapeID = " . $id . " limit 20");
        $result = runQuery($pdo, $sql);
    } 
    catch (PDOException $e) { 
        die( $e->getMessage() ); 
    }
    return $result;
}

