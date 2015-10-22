<?php
//Tells the program that connect.php and usedatabase.php must be present. Imports the files.
	require_once 'connect.php';
//usedatabase just selects the database to use.
	require_once 'usedatabase.php';
	
//Is there a variable passed into the document called delete? The data comes in from a forum and then runs the code inside.
		if(isset($_POST['delete']) && isset($_POST['isbn']))
		{
		//Gets the isbn and sanatizes it
			$isbn = get_post('isbn');
		//Sets query to be passed in.
			$query = "DELETE FROM classics WHERE isbn = '$isbn'";
		
		//Anything echoed in php goes to the web page/html and can be read as such by the html.
				if(!mysql_query($query, $db_server))
		/*The other way to do this:
		*Note: End the php file first. Then use HTML. Swap between the two.
		  ))?> DELETE failed: 
		  <?php echo $query?> <br>
		  <?php echo mysql_error()?> 
		  <br><br>
		  <?php } ?>*/
			echo "DELETE failed: $query<br>".mysql_error()."<br><br>";
		}

//Gets post values. Sanatizes string and gets the post information. (Get posts initially and use as variables later for simplicity.)
	if(
		isset($_POST['author']) && isset($_POST['title']) &&
	    isset($_POST['category']) && isset($_POST['year']) &&
	    isset($_POST['isbn'])
	  )
	{
		$author = get_post('author');
		$title = get_post('title');
		$category = get_post('category');
		$year = get_post('year');
		$isbn = get_post('isbn');
	
	//Insert values into the table via a query string.
		$query = "INSERT INTO classics VALUES"."('$author','$title','$category','$year','$isbn')";
	
	//If a query or server aren't there, echo an error.
		if(!mysql_query($query, $db_server))
			echo "INSERT failed: $query<br>".mysql_error()."<br><br>";
	}
	
//The _END used to end the <<<_END MUST HAVE NO WHITESPACE.	
	
//action is the link to go to. Posts to sqltest. Posts these variables. <pre> tags preserve the format. (ie: We don't need breaks when we use <pre></pre>)
//_$POST["author"] = "name"	
	echo <<<_END
	<form action="sqltest.php" method="post"><pre>
	Author <input type = "text" name = "author">
	Title <input type = "text" name = "title">
	Category <input type = "text" name = "category">
	Year <input type = "text" name = "year">
	ISBN <input type = "text" name = "isbn">
		<input type = "submit" value = "ADD RECORD">
	</pre></form>
_END;
	
		$query = "SELECT * FROM classics";
		$result = mysql_query($query);
		
//If there are no valid results, database access returns an error.
	if(!$result) 
	die("Database access failed: ".mysql_error());
	
//Rows will be used in the for loop to fetch the appropriate number of results.
	$rows = mysql_num_rows($result);
	
	for($j = 0; $j < $rows; ++$j)
	{
	//Grabs next row from row set.
		$row = mysql_fetch_row($result);
	//Makes a string that formats text to output.
	//action: Where the form will go.
	//type: hidden = we can't see them. This stuff happens on post, but we can't see it.
	//When we hit DELETE RECORD, then delete and isbn will happen. The input fields cannot be seen or changed, they just happen when the button is clicked.
		echo <<<_END
		
	<pre>
		Author $row[0]
		Title $row[1]
		Category $row[2]
		Year $row[3]
		ISBN $row[4]
	</pre>
	<form action = "sqltest.php" method = "post">
	<input type = "hidden" name = "delete" value = "yes">
	<input type = "hidden" name = "isbn" value = "$row[4]">
	<input type = "submit" value = "DELETE RECORD"></form>
_END;
	}

//Stops calling database.
	mysql_close($db_server);

//Defines the function get_post() takes a variable and returns a sanitized string. We will pass in the sanitized string using the return statement.
//This just shortens things so we don't have to retype $POST[$var] over and over.
//escape sanitizes the string.
	function get_post($var)
	{
		return mysql_real_escape_string($_POST[$var]);
	}
	
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	