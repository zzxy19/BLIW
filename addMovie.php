<?php
    printHeader('Add Movie');
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addMovie2db" />
        <div>
            <b>Movie Title</b>
            <input type="text" class="form-control" placeholder="Movie title" name="title" />
        </div>
        <div>
            <b>Production Company</b>
            <input type="text" class="form-control" placeholder="Production Company" name="company" />
        </div>
        <div>
            <b>Release Year</b>
            <input type="text" class="form-control" placeholder="Release Year" name="year" />
        </div>

        <?php
            $queryMPAA = "select distinct rating from Movie;";
            $queryGenre = "select distinct genre from MovieGenre;";
            $rsMPAA = runQuery($queryMPAA);
            $rsGenre = runQuery($queryGenre);
            print "<div><b>MPAA Rating</b>";
            printSelect("rating", $rsMPAA);
            print "</div>";
            print "<div><b>Movie Genre</b>";
            printGenreCheck($rsGenre);
            print "</div>";
        ?>
        <div>
            <input type="submit" value="Add" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>