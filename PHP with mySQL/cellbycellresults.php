<?php //query.php
	require_once 'connect.php';
	require_once 'usedatabase.php';
	
	require_once 'selectclassics.php';
	
	/* This section is not needed since it is already in selectclassics.php which is a required file.
		$result = mysql_query($query);
		
		if(!$result) die("Database access failed: ".mysql_error());
	*/
		$rows = mysql_num_rows($result);
		
		//Great for getting single cells. Inefficient for large numbers.
		for($j = 0; $j<$rows; ++$j)
		{
			echo 'Author: '.mysql_result($result,$j,'author').'<br>';
			echo 'Title: '.mysql_result($result,$j,'title').'<br>';
			echo 'Category: '.mysql_result($result,$j,'category').'<br>';
			echo 'Year: '.mysql_result($result,$j,'year').'<br>';
			echo 'ISBN: '.mysql_result($result,$j,'isbn').'<br><br>';
			}
			
	require_once 'closeconnection.php';

?>