<?php
    $db = "CS143";
    $db_addr = "localhost";
    $username = "cs143";
    $password = "";

    function runQuery($query) {
        global $db;
        global $db_addr;
        global $username;
        global $password;
        $db_connection = mysql_connect($db_addr, $username, $password);
        mysql_select_db($db, $db_connection);
        $rs = mysql_query($query, $db_connection);
        mysql_close($db_connection);
        return $rs;
    }

    function getMaxPersonId() {
        $query = "select id from MaxPersonID;";
        $rs = runQuery($query);
        $row = mysql_fetch_row($rs);
        return $row[0];
    }

    function getMaxMovieId() {
        $query = "select id from MaxMovieID;";
        $rs = runQuery($query);
        $row = mysql_fetch_row($rs);
        return $row[0];
    }

    function printHeader($title) {
        print "<div class=\"panel panel-primary\">
               <div class=\"panel-heading\">$title</div>
               <div class=\"panel-body\">";
    }

    function printFooter() {
        print "</div></div>";
    }

    function printFields($rs) {
        print "<tr>";
        $i = 1;
        while ($i < mysql_num_fields($rs)) {
            $field = mysql_field_name($rs, $i);
            print "<th>$field</th>";
            $i += 1;
        }
        print "</tr>";
    }

    function printSelect($name, $rs, $c) {
        print "<select class=\"form-control\" name=\"$name\">";
        while ($row = mysql_fetch_row($rs)) {
            if ($c) {
                $value = $row[0];
                $content = $row[1];
            }
            else {
                $value = $row[0];
                $content = $value;
            }
            print "<option value=\"$value\">$content</option>";
        }
        print "</select>";
    }

    function printGenreCheck($rs) {
        print "<div class=\"form-group\">";
        while ($row = mysql_fetch_row($rs)) {
            $value = $row[0];
            print "<input type='checkbox' name='genre[]' value=\"$value\">$value</input>";
        }
        print "</div>";
    }

    function printMovieOption($rsMovie) {
        print "<div><b>Movie to leave a comment:</b>";
        printSelect("movieId", $rsMovie, 1);
        print "</div>";
    }

    function printMovieActorOption($rsMovie, $rsActor) {
        print "<div><b>Select movies matching keyword:</b>";
        printSelect("movieId", $rsMovie, 1);
        print "</div><div><b>Select actors matching keyword:</b>";
        printSelect("actorId", $rsActor, 1);
        print "</div>";
    }

    function printMovieDirectorOption($rsMovie, $rsDirector) {
        print "<div><b>Select movies matching keyword:</b>";
        printSelect("movieId", $rsMovie, 1);
        print "</div><div><b>Select directors matching keyword:</b>";
        printSelect("directorId", $rsDirector, 1);
        print "</div>";
    }

    function printRow($action, $rs) {
        $out = "";
        while ($row = mysql_fetch_row($rs)) {
            print "<tr>";
            $i = 0;
            foreach($row as $value) {
                if ($i == 0) {
                    $id = $value;
                }
                elseif ($i == 1) {
                    print "<td><a href=\"?action=$action&id=$id\">$value</td>";
                }
                else {
                    print "<td>$value</td>";
                }
                $i += 1;
            }
            print "</tr>";
        }
    }

    function printActors($rs) {
        if (mysql_num_rows($rs) == 0) {
            print "No result.";
        }
        else {
            print "<table class=\"table\">";
            printFields($rs);
            printRow("showActorDetail", $rs);
            print "</table>";
        }
    }

    function printDirectors($rs) {
        if (mysql_num_rows($rs) == 0) {
            print "No result.";
        }
        else {
            print "<table class=\"table\">";
            printFields($rs);
            printRow("showDirectorDetail", $rs);
            print "</table>";
        }
    }

    function printMovies($rs) {
        if (mysql_num_rows($rs) == 0) {
            print "No result.";
        }
        else {
            print "<table class=\"table\">";
            printFields($rs);
            printRow("showMovieDetail", $rs);
            print "</table>";
        }
    }

    function printGenre($rs) {
        if (mysql_num_rows($rs) == 0) {
            print "No genre listed.";
        }
        else {
            $i = 0;
            while ($row = mysql_fetch_row($rs)) {
                $val = $row[0];
                if ($i == 0) {
                    $i = 1;
                    print "$val";
                }
                else {
                    print ", $val";
                }
            }
        }
    }

    function printReviews($rs) {
        if (mysql_num_rows($rs) == 0) {
            print "No one has reviewed this movie yet.";
        }
        else {
            while ($row = mysql_fetch_row($rs)) {
                $user = $row[0];
                $ts = $row[1];
                $score = $row[2];
                $comment = $row[3];
                print "<b><i>$user</i></b> rated this movie <b>$score</b> at $ts:";
                print "<br><i>$comment</i></br>";
            }
        }
    }

    function printAccordion($contents) {
        print "<div class=\"panel-group\" id=\"accordion\">";
        $i=0;
        foreach ($contents as $title => $content) {
            print"<div class=\"panel panel-default\">
                      <div class=\"panel-heading\">
                          <h4 class=\"panel-title\">
                              <a data-toggle=\"collapse\" href=\"#collapse$i\">
                              $title</a>
                          </h4>
                      </div>
                      <div id=\"collapse$i\" class=\"panel-collapse collapse in\">
                          <div class=\"panel-body\">
                              $content
                          </div>
                      </div>
                  </div>";
            $i += 1;
        }
    }

    function displaySearchResult($rsActorList, $rsMovieList) {
        print "<div><h4>Actors matching the keyword:</h4>";
        printActors($rsActorList);
        print "</div><div><h4>Movies matching the keyword:</h4>";
        printMovies($rsMovieList);
        print "</div>";
    }

    function displayActorDetail($rsActor, $rsMovieList) {
        print "<div><h4>Actor Information:</h4>";
        printActors($rsActor);
        print "</div><div><h4>Movies played:</h4>";
        printMovies($rsMovieList);
        print "</div>";
    }

    function displayDirectorDetail($rsDirector, $rsMovieList) {
        print "<div><h4>Director Information:</h4>";
        printDirectors($rsDirector);
        print "</div><div><h4>Movies directed:</h4>";
        printMovies($rsMovieList);
        print "</div>";
    }

    function displayMovieDetail($rsMovie, $rsGenre, $rsActorList, $rsDirector, $rsAvgScore, $rsReviewList) {
        print "<div><h4>Movie Information:</h4>";
        printMovies($rsMovie);
        print "</div><div><h4>Movie Genre:</h4>";
        printGenre($rsGenre);
        print "</div><div><h4>Director Information:</h4>";
        printDirectors($rsDirector);
        print "</div><div><h4>Cast in this movie:</h4>";
        printActors($rsActorList);
        $row = mysql_fetch_row($rsAvgScore);
        $score = $row[0];
        $cnt = $row[1];
        print "</div><div><h4>Average Review Score:</h4>";
        if ($score)
            print "<b>$score</b> based on <i>$cnt</i> feedback from reviewers.";
        else
            print "No one has rated this movie yet.";
        print "</div><div><h4>Movie Reviews:</h4>";
        printReviews($rsReviewList);
        print "</div>";

    }

    function getMovieTitleFromId($id) {
        $query = "select title from Movie where id = $id;";
        $rs = runQuery($query);
        $row = mysql_fetch_row($rs);
        return $row[0];
    }

    function searchActor($keyword) {
        $queryBrowseActor = 
        "select id, concat(first, \" \", last) as Name, sex as Sex, dob as DateOfBirth, dod as DateOfDeath
         from Actor
         having Name like \"%";
        
        $wordList = explode(" ", $keyword);
        $firstOne = 1;
        foreach($wordList as $word) {
            if ($firstOne == 1) {
                $queryBrowseActor .= $word;
                $queryBrowseActor .= "%\"";
                $firstOne = 0;
            }
            else {
                $queryBrowseActor .= " and Name like \"%";
                $queryBrowseActor .= $word;
                $queryBrowseActor .= "%\"";
            }
        }
        $queryBrowseActor .= ";";
        $rs = runQuery($queryBrowseActor);
        return $rs;
    }

    function searchMovie($keyword) {
        $queryBrowseMovie = 
        "select id, title as Title, year as ReleaseYear, rating as MPAARating, company as ProductionCompany
         from Movie
         where title like \"%";
        
        $wordList = explode(" ", $keyword);
        $firstOne = 1;
        foreach($wordList as $word) {
            if ($firstOne == 1) {
                $queryBrowseMovie .= $word;
                $queryBrowseMovie .= "%\"";
                $firstOne = 0;
            }
            else {
                $queryBrowseMovie .= " and title like \"%";
                $queryBrowseMovie .= $word;
                $queryBrowseMovie .= "%\"";
            }
        }
        $queryBrowseMovie .= ";";
        $rs = runQuery($queryBrowseMovie);
        return $rs;
    }

    function searchDirector($keyword) {
        $queryBrowseDirector = 
        "select id, concat(first, \" \", last) as Name, dob as DateOfBirth, dod as DateOfDeath
         from Director
         having Name like \"%";
        
        $wordList = explode(" ", $keyword);
        $firstOne = 1;
        foreach($wordList as $word) {
            if ($firstOne == 1) {
                $queryBrowseDirector .= $word;
                $queryBrowseDirector .= "%\"";
                $firstOne = 0;
            }
            else {
                $queryBrowseDirector .= " and Name like \"%";
                $queryBrowseDirector .= $word;
                $queryBrowseDirector .= "%\"";
            }
        }
        $queryBrowseDirector .= ";";
        $rs = runQuery($queryBrowseDirector);
        return $rs;
    }
?>