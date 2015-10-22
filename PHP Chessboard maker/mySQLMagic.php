<!DOCTYPE html>

<!--Update needed: Should read in only data based on the login
This file pulls the variables from the MySQL database and turns them into values that javascript can use.-->

<?php
require_once './login.php';
require_once './connect.php';
?>

<html>
<body>

<?php
$query = "select * from customChess WHERE saveSlot = 0";

//Sends out the query to the SQL database. This is how you input commands to mySQL.
$result = mysqli_query($link, $query);

if(!$result) die ("Database access failed: ".mysqli_error($link));

//Gets the server data as an array called $row. Stores numbers. ($Result of the query, Return type)
$row = mysqli_fetch_array($result, MYSQLI_NUM);
	
		$saveSlot = $row[0];
		$board = $row[1];
		$grid = $row[2];
		$tiles = $row[3];
		$pawn = $row[4];
		$pawn2 = $row[5];
		$knight = $row[6];
		$knight2 = $row[7];
		$rook = $row[8];
		$rook2 = $row[9];
		$bishop = $row[10];
		$bishop2 = $row[11];
		$king = $row[12];
		$king2 = $row[13];
		$queen = $row[14];
		$queen2 = $row[15];

//Does some magic and basically sticks the values retrieved into 
//variables that javascript can use. This php file essentially
//creates a <script>...</script> block of code to create the variables.
echo "<script>";
echo "\nvar saveSlot=$saveSlot;\n";
echo "var currBoardStr=$board;\n";
echo "var currGridStr=$grid;\n";
echo "var currTileStr=$tiles;\n";
echo "var currPawnStr=$pawn;\n";
echo "var currPawnStr2=$pawn2;\n";
echo "var currKnightStr=$knight;\n";
echo "var currKnightStr2=$knight2;\n";
echo "var currRookStr=$rook;\n";
echo "var currRookStr2=$rook2;\n";
echo "var currBishopStr=$bishop;\n";
echo "var currBishopStr2=$bishop2;\n";
echo "var currKingStr=$king;\n";
echo "var currKingStr2=$king2;\n";
echo "var currQueenStr=$queen;\n";
echo "var currQueenStr2=$queen2;\n";
echo "</script>";

?>

</body>
</html>