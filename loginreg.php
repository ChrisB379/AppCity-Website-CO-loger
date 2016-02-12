<?php

session_start();

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
		<h1>Choose a style</h1>
		<input class ="buttons" type="button" value="Default" onclick="changeStyle('Default')">
		<input class ="buttons" type="button" value="Dark" onclick="changeStyle('New')">
</ul>
</div>


<div id = "content" class = "c">

<h1>Login or Create Account </h1><br>

<!-- The login box -->

<div class="login">
	<h2>EXISTING USERS</h2>
				
<?php if (empty($_SESSION['login'])) { ?>

  <form method = "POST" action = "Login.php">
      <table>
	<tr>
	    <tr><td>Email Address:</td></tr>
	  <td><input class="fields" type = "text" name = "loginEmail" size = "30"></td>
	</tr>
	<tr>
	  <tr><td>Password:</td></tr>
	  <td><input class="fields" type = "password" name = "loginPass" size = "30"></td>
	</tr>
		  <td>&nbsp;</td>
		  <tr><td>&nbsp;</td></tr>
		  
	<tr>
	  <td><input type = "submit" value = "Login" /></td>
	</tr>
      </table>
  </form>

<?php } ?>

<?php if (!empty($_SESSION['login'])) { ?>

    <form method = "POST" action = "Logout.php">
	<table>
	  <tr>
	    <td><input class="fields" type = "text" name = "loginEmail"  size = "30" disabled></td>
	  </tr>
	  <tr>
	    <td><input class="fields" type = "password" name = "loginPass"  size = "30" disabled></td>
	  </tr>
		    <td>&nbsp;</td>
		  <tr><td>&nbsp;</td></tr>
		  
	  <tr>
	    <td><input type = "submit" value = "Login" disabled/></td>
	  </tr>
	  <tr>
	    <td><input type = "submit" value = "Logout"/></td>
	  </tr>
	</table>
    </form>

<?php } ?>
			</div>
		

<!-- The register box -->

			<div class="register">
				<h2>NEW USERS</h2>
				<form method = "POST" action = "Register.php">
				    <table>
				    <tr><td><h7>Welcome to COloger</h7><br><br>
				Setting up your account is quick & easy and enables you to 
				start tracking your progress immediately.</td></tr>
				      <tr>
				      <tr><td>&nbsp;</td></tr>
				      <tr><td>&nbsp;</td></tr>
				      
					<td><input type = "submit" value = "Register"></td>
				      </tr>
				    </table>
				</form>
			</div>



</div>

<div class = "b">
Copyright &copy Baillie & Smyth 2014
</div>
</div>
</body>
</html>
