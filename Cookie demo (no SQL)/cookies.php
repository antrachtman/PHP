<!DOCTYPE html>
<html>
  <head>
    <title>Using Cookies</title>
  </head>
  <body>	
  
	<form id = "cookieForm" method = "post" action = "cookies.php">
		<input type = "text" name = "textbox">
		<button type = "submit" name = "save"> Save </button>
		<button type = "submit" name = "delete"> Delete </button>
	</form>
	
    <?php
	echo "<p><b>The current value of the cookie is: ";
	  if (isset($_COOKIE['test'])){ 
	    $currVal = $_COOKIE['test'];
		echo $currVal;
	  }
	 echo "</b></p>";
	  
	  //Form uses a name/value pair
      if (isset($_POST['save'])) {
		  $test = $_POST['textbox'];
		  //setcookie(cookieName, value)
		  setcookie('test', $test);
	  }
	  
	  if (isset($_POST['delete'])) {
		//Uses a negative time to invalidate the cookie
		setcookie('test', '', time() - 2956000);
		}
    ?>
	
  </body>
</html>
