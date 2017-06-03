<?php
    printHeader("Adding New Role");
    $role = $_GET["role"];
    $first = $_GET["first"];
    $last = $_GET["last"];
    $bd = $_GET["birthdate"];
    $dd = $_GET["deathdate"];
    $sex = $_GET["sex"];
?>

<div class="result">
<?php
    if ($role != "Actor" && $role != "Director")
        print "Invalid role selection.";
    else if (!$first)
        print "First name cannot be empty.";
    else if (!$last)
        print "Last name cannot be empty.";
    else if (!$bd)
        print "Birthday cannot be empty.";
    else if ($dd && strcmp($bd, $dd) > 0)
        print "Date of decease cannot precede date of birth.";
    else if ($role == "Actor" && !$sex)
        print "Actor sex is not specified.";
    else {
        $maxPersonId = getMaxPersonId();
        if ($dd)
            $dd = "'" . $dd . "'";
        else
            $dd = "NULL";
        if ($role == "Actor")
            $insertActorQuery = "insert into Actor values($maxPersonId, '$last', '$first', '$sex', '$bd', $dd);";
        else
            $insertActorQuery = "insert into Director values($maxPersonId, '$last', '$first', '$bd', $dd);";
        $rs = runQuery($insertActorQuery);
        if ($rs)
            print "Adding $role successful! <a href=\"?action=show" . "$role" ."Detail&id=$maxPersonId\">View Detail</a>";
        else
            print "Adding $role failed.";
    }
?>
</div>

<?php
    printFooter();
?>