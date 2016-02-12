//sourced from http://www.w3schools.com/ajax/ajax_xmlhttprequest_onreadystatechange.asp
function loadPagesXMLDoc(x)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  //declaring the function to handle the event when the ready state is 4
xmlhttp.onreadystatechange=function()
  {
     //Check whether the XMLHttpRequest object successfully retrieved the data, 200 is code for OK 
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    } 
  }
  if(x == 'facts'){
    xmlhttp.open("GET","factfile.txt",true);
  }
  else if (x == 'CO Reading')
  {
    xmlhttp.open("GET","addReading.php",true);
  }
xmlhttp.send();
}
