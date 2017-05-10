<?php 
    $keyword = $_GET["keyword"];
?>

<div class="panel panel-primary">

<div class="panel-heading">Search Movie</div>

<div class="panel-body">

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="browseMovie" />
        <input type="text" class="form-control" placeholder="Search For ..." name="keyword" id="keyword" />
        <input type="submit" value="Submit Query" class="btn btn-primary" />
    </form>
</div>

<div class="result">
<?php
    if ($keyword) {
        $queryBrowseMovie = 
        "select id, title as Title, year as Year, rating as Rating, company as Company
         from Movie
         having Title like \"%";
        $queryBrowseActor .= $keyword;
        $queryBrowseActor .= "%\";";
        $db_connection = mysql_connect($db_addr, $username, $password);
        mysql_select_db($db, $db_connection);
        $rs = mysql_query($queryBrowseActor, $db_connection);
        displayTable("showMovieDetail", $rs);
        mysql_close($db_connection);
    }
?>
</div>

</div>
</div>

