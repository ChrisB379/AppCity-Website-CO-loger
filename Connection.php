<?php

// Connect to Database Server

//$connection = mysqli_connect("devweb2013.cis.strath.ac.uk", "gfb11176", "buonstat", "gfb11176") or die("MySQL Error: " . mysql_error());
$connection = mysqli_connect("devweb2013.cis.strath.ac.uk", "ckb12185", "cengonap", "ckb12185") or die("MySQL Error: " . mysql_error());
//mysql_connect("localhost", "root", "") or die("MySQL Error: " . mysql_error());
     
     
     
// Choose database

//mysqli_select_db($connection,"gfb11176") or die("MySQL Error: " . mysql_error());
mysqli_select_db($connection, "ckb12185") or die("MySQL Error: " . mysql_error());
//mysql_select_db("mydatabase") or die("MySQL Error: " . mysql_error());

?>































