<?php
    $db = "CS143";
    $db_addr = "localhost";
    $username = "cs143";
    $password = "";

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

/*
    function printRows($rs) {
        while ($row = mysql_fetch_row($rs)) {
            print "<tr>";
            foreach($row as $value) {
                print "<td>$value</td>";
            }
            print "</tr>";
        }
    }*/

    function printRow($action, $rs) {
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

    function displayTable($rsActor, $rsMovie) {
        print "<div><h4>Actors matching the keyword:</h4>";
        printActors($rsActor);
        print "</div><div><h4>Movies matching the keyword:</h4>";
        printMovies($rsMovie);
        print "</div>";
    }
?>