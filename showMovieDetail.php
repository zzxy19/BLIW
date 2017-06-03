<?php
    printHeader('Movie Information');
    $id = $_GET["id"];
?>

<div class="result">
<?php
    if ($id) {
        $movieDetailQuery = "select m.id, m.title as Title, m.year as ReleaseYear, m.rating as MPAARating, m.company as ProductionCompany
                             from Movie m
                             where m.id = $id;";
        $movieGenreQuery = "select genre
                            from MovieGenre mg
                            where mg.mid = $id;";
        $actorListQuery = "select a.id, concat(a.first, \" \", a.last) as ActorName, ma.role as ActorRole
                           from Movie m, MovieActor ma, Actor a
                           where ma.mid = m.id
                           and ma.aid = a.id
                           and m.id = $id;";
        $directorDetailQuery = "select d.id, concat(d.first, \" \", d.last) as Director, d.dob as DateOfBirth, d.dod as DateOfDeath
                                from MovieDirector md,  Director d
                                where md.mid = $id
                                and md.did = d.id;";
        $avgScoreQuery = "select avg(rating) as avgScore, count(rating) as cnt from Review where mid = $id;";
        $reviewListQuery = "select name, time, rating, comment from Review where mid = $id;";
        $rsMovie = runQuery($movieDetailQuery);
        $rsActorList = runQuery($actorListQuery);
        $rsGenre = runQuery($movieGenreQuery);
        $rsDirector = runQuery($directorDetailQuery);
        $rsAvgScore = runQuery($avgScoreQuery);
        $rsReviewList = runQuery($reviewListQuery);
        displayMovieDetail($rsMovie, $rsGenre, $rsActorList, $rsDirector, $rsAvgScore, $rsReviewList);
        print "<div><a class=\"btn btn-info\" href=\"?action=addComment2&id=$id\">Add Review</a></div>";
    }
?>

</div>


<?php
    printFooter();
?>