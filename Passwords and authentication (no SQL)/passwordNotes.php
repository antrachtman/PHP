

<?php
/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 8-10 is a good baseline, and more is good if your servers
 * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
 * which is a good baseline for systems handling interactive logins.
 */

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shchar = str_shuffle($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
	//.= acts as an append
        $randomString .= $shchar[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$timeTarget = 0.05; // 50 milliseconds 

/*
CRYPT_BLOWFISH - Blowfish hashing with a salt as follows: "$2a$",
 "$2x$" or "$2y$", a two digit cost parameter, "$", and 22 characters
 from the alphabet "./0-9A-Za-z". Using characters outside of this range
 in the salt will cause crypt() to return a zero-length string.
 The two digit cost parameter is the base-2 logarithm of the iteration count for the 
underlying Blowfish-based hashing algorithmeter and must be in range 04-31,
 values outside this range will cause crypt() to fail. Versions of PHP before 5.3.7
 only support "$2a$" as the salt prefix: PHP 5.3.7 introduced the new prefixes to
 fix a security weakness in the Blowfish implementation. To summarise, developers 
targeting only PHP 5.3.7 and later should use "$2y$" in preference to "$2a$".
*/
$alg = '$2y$';
  // coststr can be between 04 and 31
$cost = 3;
do {
  $salt = generateRandomString(22);
  $cost++;
  if ($cost < 10) {
    $coststr = str_pad($cost,2,'0',STR_PAD_LEFT);
  } else {
    $coststr = $cost;
  }
  echo "cost string: " . $coststr;
  //$cost = $cost + 100;
  //$crounds = $cost * 1000; 
    $start = microtime(true);
    //    crypt('rasmuslerdorf', '$6$rounds=" . $crounds . "$" . $coststr . "usesomesillystringforsalt$');
   $test =  crypt('hello', $alg . $coststr . '$' . $salt );
    $end = microtime(true);
echo " testedcost: " . $cost . " end: " . $end 
  . " start: " . $start . " crypt = " . $test .  "<br>";
    
} while ($cost < 32 && ($end - $start) < $timeTarget);

echo "Appropriate Cost Found: " . $cost . "<br>";
?>
