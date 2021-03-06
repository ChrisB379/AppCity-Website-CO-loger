<?php

include ("Connection.php");
include ("Password.php");
include ("CheckIfUserLogin.php");

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
    <li class = "default"><a href = "addReading.php"  class="nav">CO Readings</a></li>
    <?php } ?>
    
  </ul>
  
  <!-- The login bar -->
<div class = "loginlink">

	<a href = "loginreg.php" class="nav"><button>Login/Register</button></a>

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

<div class="registration">
<form method = "POST" action = "Register.php">
<table>
<tr><td><h1>Welcome</h1><br></td></tr>
<tr><td>Your email address and password will be used to login to your account.</td></tr>
<tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Username:</td></tr>
<td><input class="fields" type = "text" name = "regUser"  size = "30"></td>
</tr>
<tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Email Address:</td></tr>
<td><input class="fields" type = "text" name = "regEmail"  size = "30"></td>
</tr>
<tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Password:</td></tr>
<td><input class="fields" type = "password" name = "regPass"  size = "30"></td>
</tr>
<tr>
<tr><td>&nbsp;</td></tr>
<td><input type = "submit" value = "Register" /></td>
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

<?php

	$continue = false;
	
	// Checks for registration input.
	if(isset($_POST['regUser']))
	{
	    $username = $_POST['regUser'];
	    
	    $userLength = strlen(trim($username));
	    if ($userLength >= 5 && $userLength <= 15)
	    {
		$continue = true;
	    }
	    else
	    {
		$continue = false;
	    }
	}
	if(isset($_POST['regEmail']))
	{
	    $email = $_POST['regEmail'];
	    
	    $emailLength = strlen(trim($email));
	    if ($emailLength >= 10 && $emailLength <= 35)
	    {
		$continue = true;
	    }
	    else
	    {
		$continue = false;
	    }
	}
	if(isset($_POST['regPass']))
	{	
	    $password = $_POST['regPass'];
	    
	    $passLength = strlen(trim($password));
	    if ($passLength >= 8 && $passLength <= 20)
	    {
		$continue = true;
	    }
	    else
	    {
		$continue = false;
	    }
	}
	
	if ($continue == true)
	{
		// If already logged in with an account dont let the user register.
		if ($_SESSION['login'] == "1")
		{
		    header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/index.php');
		    //header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/index.php');
		    //header( 'Location: https://localhost/Cologer/index.php');
		}
		else
		{
		    $sql = "SELECT * FROM COUsers WHERE email = '$email'";
			
		    $result = mysqli_query($connection, $sql) or trigger_error ("Query Failed: " . mysql_error());
			
		    $numRows = mysqli_num_rows($result); 
		    
		//a row is found then the email is already in use
		if($numRows > 0)
		{
			echo "Email already taken";
		}
		else
		{
			// Hash a new password for storing in the database
			// Using PASSWORD_BCRYPT below so the hash will always be 60 characters long
			$hash = password_hash($password, PASSWORD_BCRYPT);
		
			
			// Prepared MySQL statement for user registration to the website.
			$sql = "INSERT INTO COUsers (Username, Email, Password) VALUES ( ?, ?, ?)";
			
			$stmt = mysqli_stmt_init($connection);
			
			if (mysqli_stmt_prepare($stmt, $sql))
			{
			    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hash);
			    mysqli_stmt_execute($stmt);
			
			
			// Insert a value into the COReadings table for the user - the graph won't display on the
			// addReadings.php page if there are no values to show for the logged in user.
			$sql = "INSERT INTO COReadings (UserID, COValue) VALUES 
		          ((SELECT id from COUsers where Email = '$email'), '0.0')";
		          
			$result = mysqli_query($connection, $sql) or trigger_error ("Query Failed: " . mysql_error());
			
			
			// Send an email to the newly registered user with their Username, Email $ Password.
			// Define the receiver of the email.
			$to = $email;
			// Define the subject of the email
			$subject = 'Cologer Account Details';
			// Define the message to be sent. Each line should be separated with \n
			$message = "Thank you for registering with Cologer!\n
						Your registration details are shown below:\n\n
						Username - $username
						Email - $email
						Password - $password\n";
			// Send the email
			$mail_sent = @mail($to, $subject, $message);
			
			
			session_start();
			// We dont set the login session variable to 1 because
			// instead we direct the user to the login page where
			// they can login using the account they just created.
			$_SESSION['login'] = "";
			
		    header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/loginreg.php');
		    //header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/loginreg.php');
		    //header( 'Location: https://localhost/Cologer/loginreg.php');
		    }
		}	
		
		}
	}
?>
