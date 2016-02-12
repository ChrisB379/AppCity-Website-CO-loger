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
		<h9>Choose a style</h9>
		<input class ="buttons" type="button" value="Default" onclick="changeStyle('Default')">
		<input class ="buttons" type="button" value="Dark" onclick="changeStyle('New')">
</ul>
</div>


<div id = "content" class = "c">

<h1>A Rough Guide To Readings(In Parts Per Million(PPM))</h1>
<table>
<tr><td>0-5ppm: Non-smoker</td></tr>
<tr><td>5-10ppm: Light smoker</td></tr>
<tr><td>10-20ppm: Medium smoker</td></tr>
<tr><td>20-30ppm: Heavy smoker</td></tr>
<tr><td>&nbsp;</td></tr>
</table>

<h1>What The Readings Mean:</h1>

<ul class = "list" style="list-style-type:disc">
<li class = "lists" >People smoke and metabolise CO differently so analysis of readings 
cannot be exact. There is no average or normal level of CO for smokers. </li><br>


<li class = "lists" >The body has a self-regulating mechanism so that the CO reading of a 60 
a day smoker may not be twice that of a 30 a day smoker. All readings 
measure CO encountered over the last 24 hours.</li><br>


<li class = "lists" >A non-smoker can have a reading up to around 9ppm but will usually 
have 0-4ppm.</li><br>

<li class = "lists" >Anything over 10ppm is considered a health risk, although there is no 
'safe' level.</li><br>


<li class = "lists" >A level of 25ppm has harmful effects (in addition to thickening the 
blood and narrowing the arteries) ranging from headache, fatigue and 
drowsiness to respiratory failure and coma.</li><br>


<li class = "lists" >CO builds up cumulatively; each cigarette smoked adds 5-10ppm.</li><br><br>

</ul>

<h1>Factors Influencing Readings Include:</h1>
<ul class = "list" style="list-style-type:disc">

 <li class = "lists" >Type of cigarette smoked - 'low tar' brands, herbal 
 and menthol cigarettes tend to produce more CO. 
 Hand rolled cigarettes yield less CO (but more tar).</li><br>
 
 <li class = "lists" >Number of cigarettes smoked and depth of 
 inhalation. Readings tend to climb as the day 
 progresses. (People don't smoke while asleep).</li><br>
 
 <li class = "lists" >Time of last cigarette - smoking regularly over a 
 longer period produces lower readings than the 
 same number smoked in quick succession.</li><br>
 
 <li class = "lists" >Smoking pipes and cigars can produce high readings 
 due to less complete combustion of tobacco.</li><br>
 
 <li class = "lists" >Where people work - eg a garage mechanic could 
 have a higher than expected reading.</li><br>
 
 <li class = "lists" >Health status - people who are unwell may have 
 inaccurately low readings because they are unable 
 to exhale sufficiently. Very few medical conditions 
 cause higher than expected readings.</li><br>
 
 <li class = "lists"> Age - young people sometimes do not inhale.</li><br>
 
 <li class = "lists" >Exercise/activity level - people who are more 
 physically active eliminate CO more rapidly.</li><br>
</ul> 

</div>

<div class = "b">
Copyright &copy Baillie & Smyth 2014
</div>

</div>

</body>
</html>
