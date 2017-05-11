<?php 
    $keyword = $_GET["keyword"];
?>

<div class="panel panel-primary">

<div class="panel-heading">Search</div>

<div class="panel-body">
        
<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="search" />
        <input type="text" class="form-control" placeholder="Search For ..." name="keyword" id="keyword" />
        <input type="submit" value="Submit Query" class="btn btn-primary" />
    </form>
</div>

<div class="result">
<?php
    if ($keyword) {
        $queryBrowseActor = 
        "select id, concat(first, \" \", last) as Name, sex as Sex, dob as DateOfBirth, dod as DateOfDeath
         from Actor
         having Name like \"%";
        $queryBrowseMovie = 
        "select id, title as Title, year as Year, rating as Rating, company as Company
         from Movie
         where title like \"%";
        
        $wordList = explode(" ", $keyword);
        $firstOne = 1;
        foreach($wordList as $word) {
            if ($firstOne == 1) {
                $queryBrowseActor .= $word;
                $queryBrowseActor .= "%\"";
                $queryBrowseMovie .= $word;
                $queryBrowseMovie .= "%\"";
                $firstOne = 0;
            }
            else {
                $queryBrowseActor .= " and Name like \"%";
                $queryBrowseMovie .= " and title like \"%";
                $queryBrowseActor .= $word;
                $queryBrowseActor .= "%\"";
                $queryBrowseMovie .= $word;
                $queryBrowseMovie .= "%\"";
            }
        }
        $queryBrowseActor .= ";";
        $queryBrowseMovie .= ";";

        $db_connection = mysql_connect($db_addr, $username, $password);
        mysql_select_db($db, $db_connection);
        $rsActor = mysql_query($queryBrowseActor, $db_connection);
        $rsMovie = mysql_query($queryBrowseMovie, $db_connection);
        displayTable($rsActor, $rsMovie);
        mysql_close($db_connection);
    }
?>
</div>

</div>
</div>

