<?php
   $query = $_GET["query"];
   $db = "CS143";
   $db_addr = "localhost";
   $username = "cs143";
   $password = "";

   function printFields($rs) {
     print "<tr>";
     $i = 0;
     while ($i < mysql_num_fields($rs)) {
       $field = mysql_field_name($rs, $i);
       print "<th>$field</th>";
       $i = $i + 1;
     }
     print "</tr>";
   }

   function printRows($rs) {
     while ($row = mysql_fetch_row($rs)) {
       print "<tr>";
       foreach($row as $value) {
         print "<td>$value</td>";
       }
       print "</tr>";
     }
   }
?>

<!DOCTYPE html>
<html>
  <head>
    <title> SQL Interface </title>
    
    <style>
    table, th, td {
      border: 1px solid black;
    }
    </style>
  </head>

  <body>
    <div>
      <h3> SQL Query Interface </h3>h
      <p>Enter you SQL query below:</p>
    </div>

    <div>
      <form method="GET">
  <div>
    <textarea name="query" style="width: 400px; height: 100px;"><?php if($query){print "$query";}else{print "SQL query";} ?></textarea>
  </div>
  <div>
    <input type="submit" value="Submit Query" class="btn btn-primary">
  </div>
      </form>
    </div>

    <div>
      <?php
   if($query) {
     $db_connection = mysql_connect($db_addr, $username, $password);
     mysql_select_db($db, $db_connection);

     $rs = mysql_query($query, $db_connection);
     if (mysql_num_rows($rs) == 0) {
       print "No result.";
     }
     else {
       print "<table>";
       printFields($rs);
       printRows($rs);
       print "</table>";
     }

     mysql_close($db_connection);
   }
   ?>
    </div>
     
  </body>
</html>
