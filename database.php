<?php
  // Database config information.
  // OSU DB
  // $dbhost = 'oniddb.cws.oregonstate.edu';
  // $dbname = 'siddonj-db';
  // $dbuser = 'siddonj-db';
  // $dbpass = 'AFHMfMrQNPUENiKr';

  // LOCAL DEV
  $dbhost = 'localhost';
  $dbname = 'siddonj-db';
  $dbuser = 'root';
  $dbpass = 'root';

  $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

  mysql_select_db($dbname, $mysql_handle)	or die("Error selecting database: $dbname");        // Select database.

?>
