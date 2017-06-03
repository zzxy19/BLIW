<?php
    printHeader('Add Comment');
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addComment2" />
        <div>
            <b>Movie</b>
            <input type="text" class="form-control" placeholder="Search for movie title to add a comment" name="movie" />
        </div>
        <div>
            <input type="submit" value="Search" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>