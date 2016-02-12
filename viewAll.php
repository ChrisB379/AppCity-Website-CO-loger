<?php

include ("Connection.php");
include ("CheckIfUserNotLogin.php");

$email = $_SESSION['login'];

// SQL query to view all CO readings added for the currently logged in user.
$sql = mysqli_query($connection, "SELECT COValue, AddedOn FROM COReadings 
				   JOIN COUsers ON COUsers.id = COReadings.UserID
				   WHERE COUsers.Email = '$email';");

// Loop over readings
while ($row = mysqli_fetch_array($sql))
{
    echo "Reading:  {$row["COValue"]}<br>
	      Added On: {$row["AddedOn"]}<br><br>";
}

?>

<html>
    <body>
        <form method = "POST" action = "addReading.php">
            <table>
                <tr>
                    <td><input type = "submit" value = "Back" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>