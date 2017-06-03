<?php
    printHeader('Director Information');
    $id = $_GET["id"];
?>

<div class="result">
<?php
    if (id) {
        $directorDetailQuery = "select id, concat(first, \" \", last) as Name, dob as DateOfBirth, dod as DateOfDeath
                                from Director
                                where id = $id;";
        $movieListQuery = "select m.id, m.title as Title, m.year as ReleaseYear, m.rating as MPAARating, company as ProductionCompany
                           from Movie m, MovieDirector md
                           where m.id = md.mid
                           and md.did = $id;";
        $rsDirector = runQuery($directorDetailQuery);
        $rsMovie = runQuery($movieListQuery);
        displayDirectorDetail($rsDirector, $rsMovie);
    }
?>
</div>

<?php
    printFooter();
?>