<?php
    printHeader('Add Movie-Actor Relation');
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addMovieActor2" />
        <div>
            <b>Movie</b>
            <input type="text" class="form-control" placeholder="Search for movie title" name="movie" />
        </div>
        <div>
            <b>Actor</b>
            <input type="text" class="form-control" placeholder="Search for actor name" name="actor" />
        </div>
        <div>
            <input type="submit" value="Search" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>