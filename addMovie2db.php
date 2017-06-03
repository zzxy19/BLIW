<?php
    printHeader("Adding New Movie");
    $title = $_GET["title"];
    $company = $_GET["company"];
    $year = $_GET["year"];
    $rating = $_GET["rating"];
    $genre = $_GET["genre"];
?>

<div class="result">
<?php
    if (!ctype_digit($year))
        print "Year is not valid.";
    else if (!$title)
        print "Movie title cannot be empty.";
    else if (!$company)
        print "Production company cannot be empty.";
    else{
        $maxMovieId = getMaxMovieId();
        $insertMovieQuery = "insert into Movie values($maxMovieId, '$title', $year, '$rating', '$company');";
        $rs = runQuery($insertMovieQuery);
        if (!$rs)
            print "Adding movie failed.";
        else {
            $success = true;
            foreach ($genre as $g) {
                $insertMovieGenreQuery = "insert into MovieGenre values($maxMovieId, '$g');";
                $rs = runQuery($insertMovieGenreQuery);
                if (!$rs)
                    $success = false;
            }
            if ($success)
                print "Adding movie successful! <a href=\"?action=showMovieDetail&id=$maxMovieId\">View Detail</a>";
            else
                print "Adding movie genres incomplete.";
        }
    }
?>
</div>

<?php
    printFooter();
?>