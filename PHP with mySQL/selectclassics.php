<?php
	$query = "select * FROM classics";
	$result = mysql_query($query);
	
	if(!$result) die("Database access failed: ".mysql_error());
?>