<!DOCTYPE html>
<html>
<body>

<?php
/*
		foreach($_POST as $key => $value)
		{
			echo $key;
			echo ",";
			echo $value;
			echo "<br>";
		}
*/
		//Borrowed from mysqlitest.php

		//Need to mod database to have a different primary key so we can track history

		//Insert new id style to database
	if(isset($_POST['idName:']) ){
	
		$idName = get_post($link, 'idName:');
		$position = get_post($link, 'position:');
		$left = get_post($link, 'left:');
		$top = get_post($link, 'top:');
		$width = get_post($link, 'width:');
		$height = get_post($link, 'height:');
		
		$query = "INSERT INTO cssId VALUES" . "('$idName', '$position', '$left', '$top', '$width', '$height',0)";
		
		//$link->close();
		
		if(!mysqli_query($link, $query))
			echo "INSERT failed: $query<br>" . mysqli_error($link) . "<br><br>";
	}
	
	if(isset($_POST['className:']) ){
	
		$className = get_post($link, 'className:');
		$fontStyle = get_post($link, 'font-style:');
		$fontSize = get_post($link, 'font-size:');
		$color = get_post($link, 'color:');
		$fontFamily = get_post($link, 'font-family:');
		$margin = get_post($link, 'margin:');
		//border elements
		$bStyle = get_post($link, 'border-style:');
		$bWidth = get_post($link, 'border-width:');
		$bRadius = get_post($link, 'border-radius:');
		$bColor = get_post($link, 'border-color:');
		
		$query = "INSERT INTO cssClass VALUES" . "('$className', '$fontStyle', '$fontSize', '$color', '$fontFamily', '$margin', '$bStyle', '$bWidth', '$bRadius', '$bColor',0)";
		
		//$link->close();
		
		if(!mysqli_query($link, $query))
			echo "INSERT failed: $query<br>" . mysqli_error($link) . "<br><br>";
	}
	
	function get_post($link, $var)
		{
			return mysqli_real_escape_string($link,$_POST[$var]);
		}
	
?>

</body>
</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	