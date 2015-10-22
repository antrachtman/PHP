<?php //from 13-7
  function destroy_session_and_data()
  {
	session_start();
	//Resets all session array data
	$_SESSION = array();
	//Invalidates all cookies associated with the session
	setcookie(session_name(), '', time() - 2592000, '/');
	//Close the session
	session_destroy();
  }
  
  destroy_session_and_data();
  
  echo "Successfully logged out. Click <a href = index.php> here </a> to go back.";
  echo "<br/><br/> To log in with a different username/password close your browser.";
?>