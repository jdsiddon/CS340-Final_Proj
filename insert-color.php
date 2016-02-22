<?php

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'siddonj-db';
$dbuser = 'siddonj-db';
$dbpass = 'AFHMfMrQNPUENiKr';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
  or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)	or die("Error selecting database: $dbname");        // Select database.

$name = $_POST['name'];                           // Get name
$name = mysql_real_escape_string($name);    // Clean string.

$query = "INSERT INTO fp_color (name) VALUES ('$name');";

$result=mysql_query($query);

if($result == 1) {
  echo "<h2>Success!</h2>";
} else {
  echo "<h2>Failure</h2>";
}

mysql_close($mysql_handle);

?>
