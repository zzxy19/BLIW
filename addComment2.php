<?php
    printHeader('Add Movie-Actor Relation');
    $title = $_GET["movie"];
    $id = $_GET["id"];
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addComment2db" />
        <?php
            if ($id) {
                $title = getMovieTitleFromId($id);
                print "<div><b>Movie to leave a comment:</b></div>";
                print "<div>$title</div>";
                print "<input type=\"hidden\" name=\"movieId\" value=\"$id\" />";
            }
            else {
                if (!$title)
                    print "Please specify a movie title.";
                $rsMovie = searchMovie($title);
                printMovieOption($rsMovie);
            }
        ?>
        <div>
            <b>Username</b>
            <input type="text" class="form-control" placeholder="Enter your username" name="user" />
        </div>
        <div>
            <b>Your Rating (1-5)</b>
            <input type="number" class="form-control" placeholder="Your rating" name="score" min="1" max="5" />
        </div>
        <div>
            <b>Comment</b>
            <textarea class="form-control" name="comment" style="width: 100%; height:150px; resize: none;"></textarea>
        </div>
        <div>
            <input type="submit" value="Add" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>