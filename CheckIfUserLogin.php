<?php

session_start();

if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) 
{	
    //header( 'Location: https://devweb2013.cis.strath.ac.uk/~gfb11176/WAD/practicals/website/index.php');
    header( 'Location: https://devweb2013.cis.strath.ac.uk/~ckb12185/WAD/practicals/mass/index.php');
    //header( 'Location: https://localhost/Cologer/index.php');
}
  
?>
