<!doctype html>

<?php
require_once './login.php';
require_once './connect.php';
require_once './mySQLMagic.php';
?>

<html>
<head>
	<title>
		Print a chessboard that your friends will all be jealous of!
	</title>
</head>

<!--

We can just make a non functional boardgame 
with pieces that you can customize
the colors for. Make it as a way to print the pieces.

The plan:
Drop down bar to select piece types
Create piece types in photoshop
Call images to the page on click
Set up sql database to store the changes
Make a button to view changes
Make a button to commit the changes
Allow the user to retrieve the configuration by name (via dropdown?)

-->

<body>

<script>
function preloader(){
//http://www.techrepublic.com/article/preloading-and-the-javascript-image-object/#.
//The preloader is necessary so that the large .png files are already in the cache for use

	//create object
	imageObject = new Image();

	images = new Array();
	images[0]= "./grid.png";
	images[1]= "./grid2.png";
	images[2]= "./grid3.png";
	images[3]= "./grid4.png";
	images[4]= "./Tile0.png";
	images[5]= "./Tile1.png";
	images[6]= "./Tile2.png";
	images[7]= "./Tile3.png";
	images[8]= "./Tile4.png";
	images[9]= "./board1.png";
	images[10]= "./board2.png";
	images[11]= "./board3.png";
	images[12]= "./board4.png";
	images[13]= "./board5.png";
	images[14]= "./board6.png";
	images[15]= "./board7.png";
	images[16]= "./board8.png";
	images[17]= "./board9.png";
	images[18]= "./Pieces/pawn1.png";
	images[19]= "./Pieces/pawn2.png";
	images[20]= "./Pieces/pawn3.png";
	images[21]= "./Pieces/rook1.png";
	images[22]= "./Pieces/rook2.png";
	images[23]= "./Pieces/rook3.png";
	images[24]= "./Pieces/knight1.png";
	images[25]= "./Pieces/knight2.png";
	images[26]= "./Pieces/knight3.png";
	images[27]= "./Pieces/bishop1.png";
	images[28]= "./Pieces/bishop2.png";
	images[29]= "./Pieces/bishop3.png";
	images[30]= "./Pieces/queen1.png";
	images[31]= "./Pieces/queen2.png";
	images[32]= "./Pieces/queen3.png";
	images[33]= "./Pieces/king1.png";
	images[34]= "./Pieces/king2.png";
	images[35]= "./Pieces/king3.png";

	//begin the preloading
	for(var i = 0; i<images.size; i++){
		imageObject.src = images[i];
	}

}

<!--Forces the page to load images before trying to use them.-->
window.onload = function(){
	preloader();
	loadDraw();
}
</script>

<!--Provides the post function to the form-->

<?php
//Gets the value from the loadslot form
	$ls = get_post($link, 'loadSlot');
//Queries the server to update the row being read in to the values of the one being loaded.
//$query is what is sent to the server while the mysqli_query($link, is what connects to the server.
			$query = "update customChess SET board = (select * from(select board from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET grid = (select * from(select grid from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET tiles = (select * from(select tiles from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET pawn = (select * from(select pawn from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET pawn2 = (select * from(select pawn2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET knight = (select * from(select knight from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET knight2 = (select * from(select knight2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET rook = (select * from(select rook from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET rook2 = (select * from(select rook2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET bishop = (select * from(select bishop from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET bishop2 = (select * from(select bishop2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET king = (select * from(select king from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET king2 = (select * from(select king2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET queen = (select * from(select queen from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
			$query = "update customChess SET queen2 = (select * from(select queen2 from customChess where saveSlot = $ls)x) where saveSlot=0;";
			mysqli_query($link, $query);
?>

<?php
//If gridtype has a value (which it will), all of these other variables are given values from the form selections of the drop down options.
	if (isset($_POST['gridType'])){
		$ss = get_post($link, 'saveSlot');
		$b = get_post($link, 'boardBG');
		$g = get_post($link, 'gridType');
		$t = get_post($link, 'tileType');
		$p = get_post($link, 'pawns');
		$p2 = get_post($link, 'pawns2');
		$k = get_post($link, 'knights');
		$k2 = get_post($link, 'knights2');
		$r = get_post($link, 'rooks');
		$r2 = get_post($link, 'rooks2');
		$bi = get_post($link, 'bishops');
		$bi2 = get_post($link, 'bishops2');
		$king = get_post($link, 'kings');
		$king2 = get_post($link, 'kings2');
		$q = get_post($link, 'queens');
		$q2 = get_post($link, 'queens2');
		
		//Inserts the following values into the chess table.
		//The first names are from the sql table, the second names are the php variable versions, and the third modifies specific values on duplicate keys.
		$query = "INSERT INTO customChess (saveSlot, board, grid, tiles, pawn, pawn2, knight, knight2, rook, rook2, bishop, bishop2, king, king2, queen, queen2) VALUES" . "('$ss','$b','$g','$t','$p','$p2','$k','$k2','$r','$r2','$bi','$bi2','$king','$king2','$q','$q2') ON DUPLICATE KEY UPDATE board = $b, grid = $g, tiles = $t, pawn = $p, pawn2 = $p2, knight = $k, knight2 = $k2, rook = $r, rook2 = $r2, bishop = $bi, bishop2 = $bi2, king = $king, king2 = $king2, queen = $q, queen2 = $q2";
		
		if(!mysqli_query($link, $query))
			echo "INSERT failed: $query<br>" . mysqli_error($link) . "<br><br>";
	}

	
	function get_post($link, $var)
		{
			return mysqli_real_escape_string($link,$_POST[$var]);
		}
?>
</script>
<!--Dropdown forms. size means how many rows the dropdown menu takes up when not opened-->
<form id = "board" method = "post" action = "index.php">
Grid type: <select name = "gridType" size = 1>
	<option value = "1">Checker black</option>
	<option value = "2">Checker white</option>
	<option value = "3">Lines black</option>
	<option value = "4">Lines white</option>
</select><br/><br/>
	
Board background: <select name = "boardBG" size = 1>
	<option value = "1">Rainbow</option>
	<option value = "2">Michael Bay</option>
	<option value = "3">Fire</option>
	<option value = "4">Grass</option>
	<option value = "5">Isaac</option>
	<option value = "6">Caution</option>
	<option value = "7">Metal</option>
	<option value = "8">420 Praise it</option>
</select><br/><br/>

Tile type: <select name = "tileType" size = 1>
	<option value = "1">Blank</option>
	<option value = "2">Flaming Skull</option>
	<option value = "3">Dark Ponies</option>
	<option value = "4">PRAISING INTENSIFIES</option>
	<option value = "5">The Michael Bay Special</option>
</select><br/><br/>

PLAYER 1: <br/>
Pawns: <select name = "pawns" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Rooks: <select name = "rooks" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Knights: <select name = "knights" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Bishops: <select name = "bishops" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Queens: <select name = "queens" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Kings: <select name = "kings" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select><br/><br/>

PLAYER 2 </br>
Pawns: <select name = "pawns2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Rooks: <select name = "rooks2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Knights: <select name = "knights2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Bishops: <select name = "bishops2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Queens: <select name = "queens2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select>

Kings: <select name = "kings2" size = 1>
	<option value = "1">Dark Souls</option>
	<option value = "2">Classic Chess</option>
	<option value = "3">Isaac</option>
</select><br/><br/>

Save slot: <select name = "saveSlot" size = 1>
	<option value = "1">Slot 1</option>
	<option value = "2">Slot 2</option>
	<option value = "3">Slot 3</option>
	<option value = "4">Slot 4</option>
	<option value = "5">Slot 5</option>
	<option value = "6">Slot 6</option>
	<option value = "7">Slot 7</option>
	<option value = "8">Slot 8</option>
	<option value = "9">Slot 9</option>
	<option value = "10">Slot 10</option>
	<option value = "11">Slot 11</option>
	<option value = "12">Slot 12</option>
	<option value = "13">Slot 13</option>
	<option value = "14">Slot 14</option>
	<option value = "15">Slot 15</option>
	<option value = "16">Slot 16</option>
	<option value = "17">Slot 17</option>
	<option value = "18">Slot 18</option>
	<option value = "19">Slot 19</option>
	<option value = "20">Slot 20</option>
</select>

<input type = "submit" value = "Save your board"></submit>
  
 </form>
 
 
 <!--The load button literally is just here to refresh the page. Whatever the value of the loadSlot is a number. 
 The number is the row saveSlot in the table that will be updated in the SQL table.-->
<form name = "load" method = "post" action = "index.php">
 
Load Slot: <select name = "loadSlot" size = 1>
	<option value = "1">Slot 1</option>
	<option value = "2">Slot 2</option>
	<option value = "3">Slot 3</option>
	<option value = "4">Slot 4</option>
	<option value = "5">Slot 5</option>
	<option value = "6">Slot 6</option>
	<option value = "7">Slot 7</option>
	<option value = "8">Slot 8</option>
	<option value = "9">Slot 9</option>
	<option value = "10">Slot 10</option>
	<option value = "11">Slot 11</option>
	<option value = "12">Slot 12</option>
	<option value = "13">Slot 13</option>
	<option value = "14">Slot 14</option>
	<option value = "15">Slot 15</option>
	<option value = "16">Slot 16</option>
	<option value = "17">Slot 17</option>
	<option value = "18">Slot 18</option>
	<option value = "19">Slot 19</option>
	<option value = "20">Slot 20</option>
</select>
 
 <input type = "submit" value = "Load"></submit>

 </form>

Use the save slots to hold your designs. Use the load slots to load them. Use "Create your board" to see the printable result without saving.<br/>
CAUTION: Saving doesn't display your results and refreshes the page. Loading also refreshes the page. You must refresh the page after loading to see the result. <br/>
 
<button value = "tryIt" onclick = "create()">Create your board</button>
<br/><br/>

<!--Creates the canvas and hides the images in it.-->
<canvas id = "canvas" width = "1100" height = "1630">
<img src = "./grid.png" id = "checkers">
<img src = "./grid2.png" id = "whiteCheckers">
<img src = "./grid3.png" id = "openBlack">
<img src = "./grid4.png" id = "openWhite">

<img src = "./Tile0.png" id = "emptyTile">
<img src = "./Tile1.png" id = "flameSkull">
<img src = "./Tile2.png" id = "darkPonyTile">
<img src = "./Tile3.png" id = "praiseTile">
<img src = "./Tile4.png" id = "bayTile">

<img src = "./board1.png" id = "rainbow">
<img src = "./board2.png" id = "michaelBay">
<img src = "./board3.png" id = "fire">
<img src = "./board4.png" id = "grass">
<img src = "./board5.png" id = "isaac">
<img src = "./board6.png" id = "caution">
<img src = "./board7.png" id = "metal">
<img src = "./board8.png" id = "praiseIt">

<img src = "./Pieces/rook1.png" id = "solaire">
<img src = "./Pieces/knight1.png" id = "tarkus">
<img src = "./Pieces/bishop1.png" id = "havel">
<img src = "./Pieces/pawn1.png" id = "patches">
<img src = "./Pieces/queen1.png" id = "havelmom">
<img src = "./Pieces/king1.png" id = "giantdad">

<img src = "./Pieces/rook2.png" id = "rook">
<img src = "./Pieces/knight2.png" id = "knight">
<img src = "./Pieces/bishop2.png" id = "bishop">
<img src = "./Pieces/pawn2.png" id = "pawn">
<img src = "./Pieces/queen2.png" id = "queen">
<img src = "./Pieces/king2.png" id = "king">

<img src = "./Pieces/rook3.png" id = "iRook">
<img src = "./Pieces/knight3.png" id = "iKnight">
<img src = "./Pieces/bishop3.png" id = "iBishop">
<img src = "./Pieces/pawn3.png" id = "iPawn">
<img src = "./Pieces/queen3.png" id = "iQueen">
<img src = "./Pieces/king3.png" id = "iKing">
</canvas>

<!--THE SPRITES AND CONTEXT CODE-->
<script>
//Grid
var grid = document.getElementById("checkers");
var grid2 = document.getElementById("whiteCheckers");
var grid3 = document.getElementById("openBlack");
var grid4 = document.getElementById("openWhite");

//Backgrounds
var board1 = document.getElementById("rainbow");
var board2 = document.getElementById("michaelBay");
var board3 = document.getElementById("fire");
var board4 = document.getElementById("grass");
var board5 = document.getElementById("isaac");
var board6 = document.getElementById("caution");
var board7 = document.getElementById("metal");
var board8 = document.getElementById("praiseIt");

//Tiles
var tile0 = document.getElementById("emptyTile");
var tile1 = document.getElementById("flameSkull");
var tile2 = document.getElementById("darkPonyTile");
var tile3 = document.getElementById("praiseTile");
var tile4 = document.getElementById("bayTile");

//Pieces
var pawn1= document.getElementById("patches");
var pawn2= document.getElementById("pawn");
var pawn3= document.getElementById("iPawn");

var rook1= document.getElementById("solaire");
var rook2= document.getElementById("rook");
var rook3= document.getElementById("iRook");

var knight1= document.getElementById("tarkus");
var knight2= document.getElementById("knight");
var knight3= document.getElementById("iKnight");

var bishop1= document.getElementById("havel");
var bishop2= document.getElementById("bishop");
var bishop3= document.getElementById("iBishop");

var king1= document.getElementById("giantdad");
var king2= document.getElementById("king");
var king3= document.getElementById("iKing");

var queen1= document.getElementById("havelmom");
var queen2= document.getElementById("queen");
var queen3= document.getElementById("iQueen");

//canvas stuff
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");

//Grabs the current data without touching the server
var currBoard;
var currGrid;
var currTile;

var currPawn;
var currBishop;
var currKnight;
var currRook;
var currQueen;
var currKing;

var currPawn2;
var currBishop2;
var currKnight2;
var currRook2;
var currQueen2;
var currKing2;

/*I'm sorry, this code was originally quite pretty, but it didn't work
because the form was returning values as strings and then the object
draw functions weren't actually calling the correct sprites, so I just
decided to do it manually. It's a bit forced.*/
function getCurrents(){
//Gets an element from the board form which contains almost all of the drop down values
var x = document.getElementById("board");

	for (var i = 0; i < x.length; i++) {
	//If the xElement is equal to a specific dropdown name stick that value into curr_____Str.
		if(x.elements[i].name === "gridType") {
			currGridStr = x.elements[i].value;
			//If a value match is found, it sets currGrid to grid. This was necessary since when I tried to use the x.elements[i].value with names like "rook" and "queen"
			//the issue was that it was reading in STRINGS, not the variables, so nothing worked. 
			if(currGridStr == 1)
				currGrid = grid;
			else if(currGridStr == 2)
				currGrid = grid2;
			else if(currGridStr == 3)
				currGrid = grid3;
			else
				currGrid = grid4;
		}else if(x.elements[i].name === "boardBG") {
			currBoardStr = x.elements[i].value;
			if(currBoardStr == 1)
				currBoard = board1;
			else if(currBoardStr == 2)
				currBoard = board2;
			else if(currBoardStr == 3)
				currBoard = board3;
			else if(currBoardStr == 4)
				currBoard = board4;
			else if(currBoardStr == 5)
				currBoard = board5;
			else if(currBoardStr == 6)
				currBoard = board6;
			else if(currBoardStr == 7)
				currBoard = board7;
			else
				currBoard = board8;
		}else if(x.elements[i].name === "tileType") {
			currTileStr = x.elements[i].value;
			if(currTileStr == 1)
				currTile = tile0;
			else if(currTileStr == 2)
				currTile = tile1;
			else if(currTileStr == 3)
				currTile = tile2;
			else if(currTileStr == 4)
				currTile = tile3;
			else
				currTile = tile4;
		}else if(x.elements[i].name === "pawns") {
			currPawnStr = x.elements[i].value;
			if(currPawnStr == 1)
				currPawn = pawn1;
			else if(currPawnStr == 2)
				currPawn = pawn2;
			else
				currPawn = pawn3;
		}else if(x.elements[i].name === "rooks") {
			currRookStr = x.elements[i].value;
			if(currRookStr == 1)
				currRook = rook1;
			else if(currRookStr == 2)
				currRook = rook2;
			else
				currRook = rook3;
		}else if(x.elements[i].name === "knights") {
			currKnightStr = x.elements[i].value;
			if(currKnightStr == 1)
				currKnight = knight1;
			else if(currKnightStr == 2)
				currKnight = knight2;
			else
				currKnight = knight3;
		}else if(x.elements[i].name === "bishops") {
			currBishopStr = x.elements[i].value;
			if(currBishopStr == 1)
				currBishop = bishop1;
			else if(currBishopStr == 2)
				currBishop = bishop2;
			else
				currBishop = bishop3;
		}else if(x.elements[i].name === "kings") {
			currKingStr = x.elements[i].value;
			if(currKingStr == 1)
				currKing = king1;
			else if(currKingStr == 2)
				currKing = king2;
			else
				currKing = king3;
		}else if(x.elements[i].name === "queens") {
			currQueenStr = x.elements[i].value;
			if(currQueenStr == 1)
				currQueen = queen1;
			else if(currQueenStr == 2)
				currQueen = queen2;
			else
				currQueen = queen3;
		}else if(x.elements[i].name === "pawns2") {
			currPawnStr2 = x.elements[i].value;
			if(currPawnStr2 == 1)
				currPawn2 = pawn1;
			else if(currPawnStr2 == 2)
				currPawn2 = pawn2;
			else
				currPawn2 = pawn3;
		}else if(x.elements[i].name === "rooks2") {
			currRookStr2 = x.elements[i].value;
			if(currRookStr2 == 1)
				currRook2 = rook1;
			else if(currRookStr2 == 2)
				currRook2 = rook2;
			else
				currRook2 = rook3;
		}else if(x.elements[i].name === "knights2") {
			currKnightStr2 = x.elements[i].value;
			if(currKnightStr2 == 1)
				currKnight2 = knight1;
			else if(currKnightStr2 == 2)
				currKnight2 = knight2;
			else
				currKnight2 = knight3;
		}else if(x.elements[i].name === "bishops2") {
			currBishopStr2 = x.elements[i].value;
			if(currBishopStr2 == 1)
				currBishop2 = bishop1;
			else if(currBishopStr2 == 2)
				currBishop2 = bishop2;
			else
				currBishop2 = bishop3;
		}else if(x.elements[i].name === "kings2") {
			currKingStr2 = x.elements[i].value;
			if(currKingStr2 == 1)
				currKing2 = king1;
			else if(currKingStr2 == 2)
				currKing2 = king2;
			else
				currKing2 = king3;
		}else if(x.elements[i].name === "queens2") {
			currQueenStr2 = x.elements[i].value;
			if(currQueenStr2 == 1)
				currQueen2 = queen1;
			else if(currQueenStr2 == 2)
				currQueen2 = queen2;
			else
				currQueen2 = queen3;
		}
	}
	//draws board background
			context.drawImage(currBoard, 0, 0);
	//Draws the grid pattern
			context.drawImage(currGrid, 0, 0);
	
	//Draws the tiles
			context.drawImage(currTile, 43, 43);
			context.drawImage(currTile, 294, 43);
			context.drawImage(currTile, 545, 43);
			context.drawImage(currTile, 798, 43);
			
			context.drawImage(currTile, 168, 168);
			context.drawImage(currTile, 420, 168);
			context.drawImage(currTile, 670, 168);
			context.drawImage(currTile, 923, 168);
			
			context.drawImage(currTile, 43, 294);
			context.drawImage(currTile, 294, 294);
			context.drawImage(currTile, 545, 294);
			context.drawImage(currTile, 798, 294);
			
			context.drawImage(currTile, 168, 420);
			context.drawImage(currTile, 420, 420);
			context.drawImage(currTile, 670, 420);
			context.drawImage(currTile, 923, 420);
			
			context.drawImage(currTile, 43, 545);
			context.drawImage(currTile, 294, 545);
			context.drawImage(currTile, 545, 545);
			context.drawImage(currTile, 798, 545);
			
			context.drawImage(currTile, 168, 670);
			context.drawImage(currTile, 420, 670);
			context.drawImage(currTile, 670, 670);
			context.drawImage(currTile, 923, 670);
			
			context.drawImage(currTile, 43, 798);
			context.drawImage(currTile, 294, 798);
			context.drawImage(currTile, 545, 798);
			context.drawImage(currTile, 798, 798);
			
			context.drawImage(currTile, 168, 923);
			context.drawImage(currTile, 420, 923);
			context.drawImage(currTile, 670, 923);
			context.drawImage(currTile, 923, 923);
			
	//Draws the game pieces
			context.drawImage(currPawn, 0, 1130);
			context.drawImage(currPawn, 125, 1130);
			context.drawImage(currPawn, 250, 1130);
			context.drawImage(currPawn, 375, 1130);
			context.drawImage(currPawn, 500, 1130);
			context.drawImage(currPawn, 625, 1130);
			context.drawImage(currPawn, 750, 1130);
			context.drawImage(currPawn, 875, 1130);

			context.drawImage(currBishop, 0, 1255);
			context.drawImage(currBishop, 125, 1255);
			context.drawImage(currRook, 250, 1255);
			context.drawImage(currRook, 375, 1255);
			context.drawImage(currKnight, 500, 1255);
			context.drawImage(currKnight, 625, 1255);
			context.drawImage(currQueen, 750, 1255);
			context.drawImage(currKing, 875, 1255);
			
			context.drawImage(currPawn2, 0, 1380);
			context.drawImage(currPawn2, 125, 1380);
			context.drawImage(currPawn2, 250, 1380);
			context.drawImage(currPawn2, 375, 1380);
			context.drawImage(currPawn2, 500, 1380);
			context.drawImage(currPawn2, 625, 1380);
			context.drawImage(currPawn2, 750, 1380);
			context.drawImage(currPawn2, 875, 1380);

			context.drawImage(currBishop2, 0, 1505);
			context.drawImage(currBishop2, 125, 1505);
			context.drawImage(currRook2, 250, 1505);
			context.drawImage(currRook2, 375, 1505);
			context.drawImage(currKnight2, 500, 1505);
			context.drawImage(currKnight2, 625, 1505);
			context.drawImage(currQueen2, 750, 1505);
			context.drawImage(currKing2, 875, 1505);
}

<!--THE CANVAS DISPLAY CODE-->
	
	//Draws from the javascript. No serverside needed.
	function create(){
		context.clearRect(0,0,canvas.width, canvas.height);	
		getCurrents();
	}
	
	//Loads the saved presets
	function loadDraw(){
	context.clearRect(0,0,canvas.width, canvas.height);	
	
			if(currGridStr == 1)
				currGrid = grid;
			else if(currGridStr == 2)
				currGrid = grid2;
			else if(currGridStr == 3)
				currGrid = grid3;
			else
				currGrid = grid4;

			if(currBoardStr == 1)
				currBoard = board1;
			else if(currBoardStr == 2)
				currBoard = board2;
			else if(currBoardStr == 3)
				currBoard = board3;
			else if(currBoardStr == 4)
				currBoard = board4;
			else if(currBoardStr == 5)
				currBoard = board5;
			else if(currBoardStr == 6)
				currBoard = board6;
			else if(currBoardStr == 7)
				currBoard = board7;
			else
				currBoard = board8;

			if(currTileStr == 1)
				currTile = tile0;
			else if(currTileStr == 2)
				currTile = tile1;
			else if(currTileStr == 3)
				currTile = tile2;
			else if(currTileStr == 4)
				currTile = tile3;
			else
				currTile = tile4;

			if(currPawnStr == 1)
				currPawn = pawn1;
			else if(currPawnStr == 2)
				currPawn = pawn2;
			else
				currPawn = pawn3;

			if(currRookStr == 1)
				currRook = rook1;
			else if(currRookStr == 2)
				currRook = rook2;
			else
				currRook = rook3;

			if(currKnightStr == 1)
				currKnight = knight1;
			else if(currKnightStr == 2)
				currKnight = knight2;
			else
				currKnight = knight3;

			if(currBishopStr == 1)
				currBishop = bishop1;
			else if(currBishopStr == 2)
				currBishop = bishop2;
			else
				currBishop = bishop3;

			if(currKingStr == 1)
				currKing = king1;
			else if(currKingStr == 2)
				currKing = king2;
			else
				currKing = king3;

			if(currQueenStr == 1)
				currQueen = queen1;
			else if(currQueenStr == 2)
				currQueen = queen2;
			else
				currQueen = queen3;

			if(currPawnStr2 == 1)
				currPawn2 = pawn1;
			else if(currPawnStr2 == 2)
				currPawn2 = pawn2;
			else
				currPawn2 = pawn3;

			if(currRookStr2 == 1)
				currRook2 = rook1;
			else if(currRookStr2 == 2)
				currRook2 = rook2;
			else
				currRook2 = rook3;

			if(currKnightStr2 == 1)
				currKnight2 = knight1;
			else if(currKnightStr2 == 2)
				currKnight2 = knight2;
			else
				currKnight2 = knight3;

			if(currBishopStr2 == 1)
				currBishop2 = bishop1;
			else if(currBishopStr2 == 2)
				currBishop2 = bishop2;
			else
				currBishop2 = bishop3;

			if(currKingStr2 == 1)
				currKing2 = king1;
			else if(currKingStr2 == 2)
				currKing2 = king2;
			else
				currKing2 = king3;

			if(currQueenStr2 == 1)
				currQueen2 = queen1;
			else if(currQueenStr2 == 2)
				currQueen2 = queen2;
			else
				currQueen2 = queen3;
				
			context.drawImage(currBoard, 0, 0);
			context.drawImage(currGrid, 0, 0);
			
			context.drawImage(currTile, 43, 43);
			context.drawImage(currTile, 294, 43);
			context.drawImage(currTile, 545, 43);
			context.drawImage(currTile, 798, 43);
			
			context.drawImage(currTile, 168, 168);
			context.drawImage(currTile, 420, 168);
			context.drawImage(currTile, 670, 168);
			context.drawImage(currTile, 923, 168);
			
			context.drawImage(currTile, 43, 294);
			context.drawImage(currTile, 294, 294);
			context.drawImage(currTile, 545, 294);
			context.drawImage(currTile, 798, 294);
			
			context.drawImage(currTile, 168, 420);
			context.drawImage(currTile, 420, 420);
			context.drawImage(currTile, 670, 420);
			context.drawImage(currTile, 923, 420);
			
			context.drawImage(currTile, 43, 545);
			context.drawImage(currTile, 294, 545);
			context.drawImage(currTile, 545, 545);
			context.drawImage(currTile, 798, 545);
			
			context.drawImage(currTile, 168, 670);
			context.drawImage(currTile, 420, 670);
			context.drawImage(currTile, 670, 670);
			context.drawImage(currTile, 923, 670);
			
			context.drawImage(currTile, 43, 798);
			context.drawImage(currTile, 294, 798);
			context.drawImage(currTile, 545, 798);
			context.drawImage(currTile, 798, 798);
			
			context.drawImage(currTile, 168, 923);
			context.drawImage(currTile, 420, 923);
			context.drawImage(currTile, 670, 923);
			context.drawImage(currTile, 923, 923);
			
			context.drawImage(currPawn, 0, 1130);
			context.drawImage(currPawn, 125, 1130);
			context.drawImage(currPawn, 250, 1130);
			context.drawImage(currPawn, 375, 1130);
			context.drawImage(currPawn, 500, 1130);
			context.drawImage(currPawn, 625, 1130);
			context.drawImage(currPawn, 750, 1130);
			context.drawImage(currPawn, 875, 1130);

			context.drawImage(currBishop, 0, 1255);
			context.drawImage(currBishop, 125, 1255);
			context.drawImage(currRook, 250, 1255);
			context.drawImage(currRook, 375, 1255);
			context.drawImage(currKnight, 500, 1255);
			context.drawImage(currKnight, 625, 1255);
			context.drawImage(currQueen, 750, 1255);
			context.drawImage(currKing, 875, 1255);
			
			context.drawImage(currPawn2, 0, 1380);
			context.drawImage(currPawn2, 125, 1380);
			context.drawImage(currPawn2, 250, 1380);
			context.drawImage(currPawn2, 375, 1380);
			context.drawImage(currPawn2, 500, 1380);
			context.drawImage(currPawn2, 625, 1380);
			context.drawImage(currPawn2, 750, 1380);
			context.drawImage(currPawn2, 875, 1380);

			context.drawImage(currBishop2, 0, 1505);
			context.drawImage(currBishop2, 125, 1505);
			context.drawImage(currRook2, 250, 1505);
			context.drawImage(currRook2, 375, 1505);
			context.drawImage(currKnight2, 500, 1505);
			context.drawImage(currKnight2, 625, 1505);
			context.drawImage(currQueen2, 750, 1505);
			context.drawImage(currKing2, 875, 1505);
}
</script>
	
	
	
































</body>
</html>