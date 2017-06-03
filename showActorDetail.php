<?php
    printHeader('Actor Information');
    $id = $_GET["id"];
?>

<div class="result">
<?php
    if (id) {
        $actorDetailQuery = "select id, concat(first, \" \", last) as Name, sex as Sex, dob as DateOfBirth, dod as DateOfDeath
                             from Actor
                             where id = $id;";
        $movieListQuery = "select m.id, m.title as Title, ma.role as ActorRole, m.year as ReleaseYear, m.rating as MPAARating, company as ProductionCompany
                           from Movie m, MovieActor ma
                           where m.id = ma.mid
                           and ma.aid = $id;";
        $rsActor = runQuery($actorDetailQuery);
        $rsMovie = runQuery($movieListQuery);
        displayActorDetail($rsActor, $rsMovie);
    }
?>
</div>

<?php
    printFooter();
?>