<?php

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
  $algorithm = '$2y$';
  $cost = 10;
  $timeTarget = 0.05;
  
  do{
	$salt = generateRandomString(22);
	$cost++;
		if($cost <10){
			$coststr = str_pad($cost, 2, '0', STR_PAD_LEFT);
		}
		else
		{
			$coststr = $cost;
		}
		$start = microtime(true);
		$end = microtime(true);
		
	}while ($cost < 32 && ($end - $start) < $timeTarget);
	
?>