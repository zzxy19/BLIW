<?php
    printHeader('Add Movie-Director Relation');
    $movie = $_GET["movie"];
    $director = $_GET["director"];
?>


<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addMovieDirector2db" />
        <?php
            $rsMovie = searchMovie($movie);
            $rsDirector = searchDirector($director);
            printMovieDirectorOption($rsMovie, $rsDirector);
        ?>
        <div>
            <input type="submit" value="Add" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>