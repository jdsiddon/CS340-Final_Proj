<?php

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'siddonj-db';
$dbuser = 'siddonj-db';
$dbpass = 'AFHMfMrQNPUENiKr';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)	or die("Error selecting database: $dbname");

$query = "INSERT INTO fp_color (name) VALUES ('green')";


mysql_query($query);

mysql_close($mysql_handle);

?>

<? include "header.php" ?>
  <?php echo '<p>Hello World</p>'; ?>
<? include "footer.php" ?>
