<?php
    printHeader('Add Movie-Actor Relation');
    $movie = $_GET["movie"];
    $actor = $_GET["actor"];
?>


<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addMovieActor2db" />
        <?php
            $rsMovie = searchMovie($movie);
            $rsActor = searchActor($actor);
            printMovieActorOption($rsMovie, $rsActor);
        ?>
        <div>
            <b>Role</b>
            <input type="text" class="form-control" placeholder="Role" name="role" />
        </div>
        <div>
            <input type="submit" value="Add" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>