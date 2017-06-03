<?php
    printHeader("Adding New Movie-Director Relation");
    $movieId = $_GET["movieId"];
    $directorId = $_GET["directorId"];
?>

<div class="result">
<?php
    if (!$movieId)
        print "Please select a movie.";
    else if (!$directorId)
        print "Please select a director.";
    else {
        $insertMovieDirectorQuery = "insert into MovieDirector values($movieId, $directorId);";
        $rs = runQuery($insertMovieDirectorQuery);
        if (!$rs)
            print "Adding movie-director relation failed: the director is already directing this movie.";
        else
            print "Adding movie-director relation successful!";
    }

?>
</div>

<?php
    printFooter();
?>