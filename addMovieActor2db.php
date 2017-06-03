<?php
    printHeader("Adding New Movie-Actor Relation");
    $movieId = $_GET["movieId"];
    $actorId = $_GET["actorId"];
    $role = $_GET["role"];
?>

<div class="result">
<?php
    if (!$role)
        print "Actor role cannot be empty.";
    else if (!$movieId)
        print "Please select a movie.";
    else if (!$actorId)
        print "Please select an actor.";
    else {
        $insertMovieActorQuery = "insert into MovieActor values($movieId, $actorId, '$role');";
        $rs = runQuery($insertMovieActorQuery);
        if (!$rs)
            print "Adding movie-actor relation failed: the actor is already a cast in the movie.";
        else
            print "Adding movie-actor relation successful!";
    }
?>
</div>

<?php
    printFooter();
?>