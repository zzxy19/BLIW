<?php 
    $keyword = $_GET["keyword"];
    printHeader('Search');
?>
        
<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="search" />
        <input type="text" class="form-control" placeholder="Search For ..." name="keyword" id="keyword" />
        <input type="submit" value="Search" class="btn btn-primary" />
    </form>
</div>

<div class="result">
<?php
    if ($keyword) {
        $rsActor = searchActor($keyword);
        $rsMovie = searchMovie($keyword);
        displaySearchResult($rsActor, $rsMovie);
    }
?>
</div>

<?php
    printFooter();
?>