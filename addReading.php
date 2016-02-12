
<?php

include ("Connection.php");
include ("CheckIfUserNotLogin.php");

?>

<html>
    <head>
        <title>Cologer</title>
        
	<link REL="stylesheet" TYPE="text/css" href="styles.css" title="Default">
        <link REL="alternate stylesheet" TYPE="text/css" href="styles2.css" title="New">

        <script type="text/javascript" src="randomSite.js"></script>
        <script type="text/javascript" src="pageChooser.js"></script>
        <script src="swapstyle.js" type="text/javascript" language="javascript1.2"></script>
       

     </head>

    
<!-- Changes the body to load the appropriate style sheet using cookies as referenced from the swapstyle.js file -->    
<body onload="useStyleAgain('styleTestStore');" onunload="rememberStyle('styleTestStore');">

<div id="wrap">

<div class="h">
  <ul class = "g">

    <li class = "default"><a href = "index.php" class="nav">Home</a></li>
	
    <li class = "default"><a onclick="loadPagesXMLDoc('facts')"  class="nav">Fact File</a></li>
    
        <?php if (!empty($_SESSION['login'])) { ?>
    <li class = "default"><a href = "addReading.php"   class="nav">CO Readings</a></li>
    <?php } ?>
    
  </ul>
  
    <!-- The login bar -->
<div class = "loginlink">
  <?php if (empty($_SESSION['login'])) { ?>
      <a href = "loginreg.php" class="nav"><button>Login/Register</button></a>
  <?php } else { ?>
      <form method = "POST" action = "Logout.php">
	  <input type = "submit" value = "Logout"/>
      </form>
  <?php } ?>
</div>
  
</div>

<div class = "but">
	<button onclick="rand();" type="button" name="" value="" class="but">Crave</button>
</div>

<!-- Used to switch style sheets -->
<div class = "styles">
<ul class="style">
		<h9>Choose a style</h9>
		<input class ="buttons" type="button" value="Default" onclick="changeStyle('Default')">
		<input class ="buttons" type="button" value="Dark" onclick="changeStyle('New')">
</ul>
</div>



<div id = "content" class = "c">
       <form method = "POST" action = "addReading.php">
            <table>
                <tr>
                    <td><strong><h8>Enter CO Reading:</h8></strong></td>
                    <td><input type = "text" name = "entryReading" size = "30"></td>
                </tr>
                <tr>
                    <td><input type = "submit" value = "Add Reading" /></td>
                </tr>
            </table>
        </form>
       
        <form method = "POST" action = "viewAll.php">
            <table>
                <tr>
                    <td><input type = "submit" value = "View All Readings" /></td>
                </tr>
            </table>
        </form>
		
<?php

/*
$added = false;

// We originally planned on limiting the user to adding one reading per day.
// The below mysql statement checks if they have added a value today
// by using the CURDATE() mysql function.
// We later reconsidered.
$sql = "SELECT id, UserID, COValue FROM COUsers, COReadings WHERE Email = '$email' and id = UserID and DATE(AddedOn) = CURDATE()";

$result = mysql_query($sql) or trigger_error ("Query Failed: " . mysql_error());

if (mysql_num_rows($result) > 0)
{
    $added = true;
}
else
{
    $added = false;
}*/

// Prepared MySQL statement for adding a reading to the graph.
if(isset($_POST['entryReading'])) //&& $added == false)
{	
	$COValue = $_POST['entryReading'];

	if (is_numeric($COValue) && $COValue > 0)
	{
	    // Get the email of whoever is logged in.
	    $email = $_SESSION['login'];
	    $sql = "INSERT INTO COReadings (UserID, COValue) VALUES 
		        ((SELECT id from COUsers where Email = '$email'), ?)";	
		        
	    $stmt = mysqli_stmt_init($connection);
	    
	    if (mysqli_stmt_prepare($stmt, $sql))
	    {
		mysqli_stmt_bind_param($stmt, 'i', $COValue);
		mysqli_stmt_execute($stmt);
	    }
	    header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/addReading.php');				
	    //header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/addReading.php');
	    //header( 'Location: https://localhost/Cologer/addReading.php');
	}
}

function printAverage()
{
        include ("Connection.php");
        
	$email = $_SESSION['login'];
	$sql = "SELECT AVG(COValue) FROM COReadings
			JOIN COUsers ON COUsers.id = COReadings.UserID
			WHERE COUsers.Email = '$email' AND COValue > 0.0";
	
	$result = mysqli_query($connection, $sql) or trigger_error ("Query Failed: " . mysql_error());
	
	if($result)
	{
	    while($row = mysqli_fetch_assoc($result)) 
	    {
		$averageCOValue = $row["AVG(COValue)"];
	    }
	}
	
	// "A rough guide to readings
	//  0-5ppm    Non-smoker
	//  5-10ppm   Light smoker
	//  10-20ppm  Medium smoker
	//  20-30ppm  Heavy smoker"
	// http://www.stopsmokingmanchester.co.uk/downloads/factsheets/HP_EncourageControl.pdf
	if(isset($averageCOValue))
	{
	    if($averageCOValue <= 5)
	    {
	    ?>
			     
				<table>
					<tr>
						<td>
							<font color="black">Great job - you have the average reading of a Non-smoker!
							Your average Carbon Monoxide reading is <?php echo round($averageCOValue) ?></font>
						</td>
					</tr>
				</table> 

	    <?php
	    }
	    else if($averageCOValue >= 5 && $averageCOValue <= 10)
	    {
	    ?>

				<table>
					<tr>
						<td>
							<font color="black">Keep it up - you have the average reading of a Light smoker!
							Your average Carbon Monoxide reading is <?php echo round($averageCOValue) ?> . </font>
						</td>
					</tr>
				</table>

	    <?php
	    }
	    else if($averageCOValue >= 10 && $averageCOValue <= 20)
	    {
	    ?>

				<table>
					<tr>
						<td>
							<font color="black">Anything over 10ppm is considered a health risk - you have the average reading of a Medium smoker!
							Your average Carbon Monoxide reading is <?php echo round($averageCOValue) ?> . </font>
						</td>
					</tr>
				</table>

	    <?php
	    }
	    else if($averageCOValue >= 20 && $averageCOValue <= 30)
	    {
	    ?>

				<table>
					<tr>
						<td>
							<font color="black">A level of 25ppm has harmful effects ranging from headaches, fatigue and drowsiness to respiratory failure. 
							Your average Carbon Monoxide reading is  <?php echo round($averageCOValue) ?> . You have the average reading of a Heavy smoker!
							  </font>
						</td>
					</tr>
				</table>

	    <?php
	    }
		else if($averageCOValue > 30)
	    {
	    ?>

				<table>
					<tr>
						<td>
							<font color="black"> Your average Carbon Monoxide reading is <?php echo round($averageCOValue) ?> .
							Please visit a hospital. You could die any minute!</font>
						</td>
					</tr>
				</table>

	    <?php
	    }
	}
}

?> 
       
  <!-- chart container -->
  <div id="chartdiv" class ="chartdiv" style="width: 1000; height: 300; ">
    <?php printAverage(); ?>
 <img src="graph.php"/>
  
  <table>
  <tr>
	<td><font color="black">The 0.0 Reading is added to the graph upon registering with the site. 
	  This is your starting date - this is when you took the first step to quit!</font>
	</td>
  </tr>
  </table>
 
  </div>
  
</div>


<div class = "b">
Copyright &copy Baillie & Smyth 2014
</div>
</div>
</body>
</html>
