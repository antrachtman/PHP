<?php // convert.php
  $hogsheads = '';
  $liters = '';
  
//Removes html elements from input
  if (isset($_POST['hogsheads'])) $hogsheads = sanitizeString($_POST['hogsheads']);
  if (isset($_POST['liters'])) $liters = sanitizeString($_POST['liters']);

 //If hogsheads != blank
  if ($hogsheads != '')
  {
    $liters = round((($hogsheads*128*63)/(33.814)), 5);
	if($hogsheads == 1)
	$out = "$hogsheads hogshead equals $liters liters";
	else
    $out = "$hogsheads hogsheads equals $liters liters";
  }
  //if liters is blank
  else if($liters != '')
  {
    $hogsheads = round((($liters*33.8140)/(63*128)),5);
	if($liters == 1)
	$out = "$liters liter equals $hogsheads hogsheads";
	else
    $out = "$liters liters equals $hogsheads hogsheads";
  }
  else $out = "";

  echo <<<_END
<html>
  <head>
    <title>Hogsheads/Liters Converter</title>
  </head>
  <body>
    <pre>
      Enter either Hogsheads or Liters and click on Convert
        
      <b>$out</b>
      <form method="post" action="convert.php">
        Hogsheads <input type="text" name="hogsheads" size="7">
           Liters <input type="text" name="liters" size="7">
                   <input type="submit" value="Convert">
      </form>
    </pre>
  </body>
</html>
_END;

  function sanitizeString($var)
  {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
  }
?>
