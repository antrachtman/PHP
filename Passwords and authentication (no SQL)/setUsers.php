<?php //setupusers.php
  require_once './login.php';
  $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

  if ($connection->connect_error) die($connection->connect_error);

  $query = "DROP TABLE IF EXISTS users";
  
  $result = $connection->query($query);
  if (!$result) die($connection->error);
  
  $query = "CREATE TABLE users (
    forename VARCHAR(32) NOT NULL,
    surname  VARCHAR(32) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL
  )";
  
  $result = $connection->query($query);
  if (!$result) die($connection->error);

  function generateRandomString($length = 20){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$shchar = str_shuffle($characters);
	$randomString = '';
	for($i = 0; $i < $length; $i++){
	//.= acts as an append
		$randomString .= $shchar[rand(0, strlen($characters) -1)];
	}
	return $randomString;
}

//Consult passwordNotes.php for more information
  $alg = '$2y$';
  // coststr can be between 04 and 31 This string is just a constant value.
	$coststr = '10';
	
  $salt = generateRandomString(22);

  $forename = 'Andrew';
  $surname  = 'Trachtman';
  $username = 'admin';
  $password = 'admin';
  $token    = crypt ("$password", $alg . $coststr . '$' . $salt);

  add_user($connection, $forename, $surname, $username, $token);

   $salt = generateRandomString(22);
  
  $forename = 'Other';
  $surname  = 'Person';
  $username = 'guest';
  $password = 'guestpass';
  $token    = crypt ("$password", $alg . $coststr . '$' . $salt);

  add_user($connection, $forename, $surname, $username, $token);
  
  echo "Users set to defaults. <br/>Guest users can use the username: 'guest' and password: 'guesspass'. <br/>Click <a href = index.php> here </a> to go back.";

  function add_user($connection, $fn, $sn, $un, $pw)
  {
    $query  = "INSERT INTO users VALUES('$fn', '$sn', '$un', '$pw')";
    $result = $connection->query($query);
    if (!$result) die($connection->error);
  }
?>