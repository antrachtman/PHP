<?php
	require_once 'connect.php';
	require_once 'usedatabase.php';
	
	require_once 'selectclassics.php';
	
	$rows = mysql_num_rows($result);
	
for($j = 0; $j < $rows; ++$j)
{
	$row = mysql_fetch_row($result);
	
	echo 'Author: '.$row[0].'<br>';
	echo 'Title: '.$row[1].'<br>';
	echo 'Category: '.$row[2].'<br>';
	echo 'Year: '.$row[3].'<br>';
	echo 'ISBN: '.$row[4].'<br><br>';
}

require_once 'closeconnection.php';

?>