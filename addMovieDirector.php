<?php
    printHeader('Add Movie-Director Relation');
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addMovieDirector2" />
        <div>
            <b>Movie</b>
            <input type="text" class="form-control" placeholder="Search for movie title" name="movie" />
        </div>
        <div>
            <b>Director</b>
            <input type="text" class="form-control" placeholder="Search for director name" name="director" />
        </div>
        <div>
            <input type="submit" value="Search" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>