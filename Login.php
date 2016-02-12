<?php

include ("Connection.php");
include ("Password.php");
include ("CheckIfUserNotLogin.php");

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPass'];

    // SQL query to get the hashed password.
    $sql = "SELECT Password FROM COUsers WHERE Email = '$email'";
    
    $result = mysqli_query($connection, $sql);
    
    if (!$result) 
    {
	die('Query Failed: ' . mysql_error());
    }
	else
	{
		$pass = "";
		while ($row = mysqli_fetch_array($result)) 
		{
			$pass = $row["Password"];
		}
	}
	
	// Ensure the password entered to login is the same as the hashed password in the COUser table.
	if (password_verify($password, $pass))
	{
		$numRows = mysqli_num_rows($result);
		// If a row in the COUsers table is found with the same email the user logged in with..
		if ($numRows == 1)
		{
			// Set the $_SESSION variable to the logged in users email and direct them to the 
			// COReading page.
			session_start();
			$_SESSION['login'] = $email;
			header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/addReading.php');
			//header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/addReading.php');
			//header( 'Location: https://localhost/Cologer/addReading.php');
		}
	}
	else
	{
		// If the user tries to login with account credentials that aren't recognised
		// the $_SESSION variable isn't set and they are taken back to the Login, 
		// Register page.
		session_start();
		
		$_SESSION['login'] = "";
		
		header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/loginreg.php');
		//header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/loginreg.php');
		//header( 'Location: https://localhost/Cologer/loginreg.php');
	}

?>































