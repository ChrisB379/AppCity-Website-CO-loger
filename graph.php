<?php

include ("CheckIfUserNotLogin.php");
include ("phpgraphlib.php");

$email = $_SESSION['login'];
$graph = new PHPGraphLib(1010, 425); 

$link = mysqli_connect("devweb2013.cis.strath.ac.uk", "ckb12185", "cengonap", "ckb12185") or die('Could not connect: ' . mysql_error());
//$link = mysqli_connect("devweb2013.cis.strath.ac.uk", "gfb11176", "buonstat","gfb11176") or die('Could not connect: ' . mysql_error());
//$link = mysql_connect("localhost", "root", "") or die("MySQL Error: " . mysql_error());
   
mysqli_select_db($link, "ckb12185") or die('Could not select database');   
//mysqli_select_db($link,'gfb11176') or die('Could not select database');
//mysql_select_db("mydatabase") or die("MySQL Error: " . mysql_error());
  
$dataArray = array();
  
// Get the values from the COReadings table for the currently logged in user.
$sql = "SELECT COValue, AddedOn FROM COReadings 
		JOIN COUsers ON COUsers.id = COReadings.UserID
		WHERE COUsers.Email = '$email'";

$result = mysqli_query($link, $sql) or die('Query failed: ' . mysql_error());

if ($result) 
{
	while ($row = mysqli_fetch_assoc($result)) 
	{
		$dateAdded = $row["AddedOn"];
		$count = $row["COValue"];
				
		// Add to data array
		$dataArray[$dateAdded] = $count;
	}
}
  
// Configure graph
$graph->addData($dataArray);
$graph->setTitle("Carbon Monoxide Readings");
$graph->setTitleColor('navy');
$graph->setGradient("lime", "green");
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataValues(true);
$graph->setDataValueColor('navy');
$graph->setDataPointColor('navy');
$graph->setXValuesHorizontal(true);
//$graph->setBackgroundColor("black");
$graph->setYAxisTextColor('black');
$graph->setXAxisTextColor('black');
$graph->setLineColor('navy');
$graph->createGraph();

?>