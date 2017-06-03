<?php
    printHeader("Adding New Comment");
    $movieId = $_GET["movieId"];
    $user = $_GET["user"];
    $score = $_GET["score"];
    $comment = $_GET["comment"];
?>

<div class="result">
<?php
    if (!$movieId)
        print "No movie selected.";
    else if (!$score || !$comment)
        print "Rating and comment should be non-empty.";
    else {
        if (!$user)
            $user = "'Anonymous'";
        else
            $user = "'" . $user . "'";
        if (!$score)
            $score = "NULL";
        if (!$comment)
            $comment = "NULL";
        else
            $comment = "'" . $comment . "'";
        $dt = new DateTime();
        $strTime = $dt->format('Y-m-d H:i:s');
        $insertCommentQuery = "insert into Review values($user, '$strTime', $movieId, $score, $comment);";
        $rs = runQuery($insertCommentQuery);
        if (!$rs)
            print "Adding comment failed.";
        else
            print "Adding comment successful! <a href=\"?action=showMovieDetail&id=$movieId\">View Detail</a>";
    }
?>
</div>

<?php
    printFooter();
?>