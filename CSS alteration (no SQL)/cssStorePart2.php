<!DOCTYPE html>

<?php
require_once './login.php';
require_once './connect.php';
require_once './cssStore.php';
?>

<html>

<head>
<style>
<?php
$query = "select * from cssId where idNumber in (select max(idNumber) from cssId group by idName)";

$result = mysqli_query($link, $query);

if(!$result) die ("Database access failed: ".mysqli_error($link));
$rows = mysqli_num_rows($result);

for($j = 0; $j < $rows; $j++){
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	
	echo <<<_END
	
	#$row[0] {
		position:$row[1];
		left:$row[2];
		top:$row[3];
		width:$row[4];
		height:$row[5];
	}
	
_END;
}

?>

<?php
$query = "select * from cssClass where classNumber in (select max(classNumber) from cssClass group by className)";

$result = mysqli_query($link, $query);

if(!$result) die ("Database access failed: ".mysqli_error($link));
$rows = mysqli_num_rows($result);

for($j = 0; $j < $rows; $j++){
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	
	echo <<<_END
	#$row[0] {
	
		font-style:$row[1];
		font-size:$row[2];
		color:$row[3];
		font-family:$row[4];
		margin:$row[5];
		border-style:$row[6];
		border-width:$row[7];
		border-radius:$row[8];
		border-color:$row[9];
	}
	
_END;
}

?>
</style>
</head>

<body>

<br>

  <form id="idForm" method = "post" action="cssStorePart2.php">
  ID Name: <select name="idName:" size = 1>
    <option value='testId1'>Test ID1</option>
    <option value='testId2'>Test ID2</option>
    <option value='testId3'>Test ID3</option>
	<option value='testId4'>Test ID4</option>
   </select><br>
  
  Position: <select name="position:" size = 1>
    <option value='relative'>relative</option>
    <option value='absolute'>absolute</option>
    <option value='fixed'>fixed</option>
  </select><br>
	
  top: <select name="top:" size = 1>
    <option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br>
  
  left: <select name="left:" size = 1>
    <option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br>
	
  width: <select name="width:" size = 1>
	<option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br>
  
  height: <select name="height:" size = 1>
	<option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br><br>
  
  <input type = "submit" value = "Store ID preferences" onclick = "idFunction()"</submit>
  <br><br>
  
  </form>
  
  <form id="classForm" method = "post" action="cssStorePart2.php">
  Class Name: <select name="className:" size = 1>
    <option value='testClass1'>Test Class1</option>
    <option value='testClass2'>Test Class2</option>
    <option value='testClass3'>Test Class3</option>
	<option value='testClass4'>Test Class4</option>
   </select><br>
  
  Font Style: <select name="font-style:" size = 1>
    <option value='relative'>Relative</option>
    <option value='absolute'>Absolute</option>
    <option value='fixed'>Fixed</option>
  </select><br>
	
  Font Size: <select name="font-size:" size = 1>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br>
  
  Color: <select name="color:" size = 1>
    <option value='black'>Black</option>
    <option value='yellow'>Yellow</option>
    <option value='blue'>Blue</option>
    <option value='red'>Red</option>
  </select><br>
	
  Font Family: <select name="font-family:" size = 1>
	<option value='normal'>Normal</option>
    <option value='italic'>Italic</option>
    <option value='oblique'>Oblique</option>
  </select><br>
  
  Margin: <select name="margin:" size = 1>
	<option value='0px,0px,0px,0px'>0px,0px,0px,0px</option>
	<option value='10px,10px,10px,10px,'>10px,10px,10px,10px</option>
	<option value='50px,50px,50px,50px'>50px,50px,50px,50px</option>
	<option value='75px,75px,75px,75px'>75px,75px,75px,75px</option>
    <option value='100px,100px,100px,100px'>100px,100px,100px,100px</option>
 </select><br>
 
   Border-Style: <select name="border-style:" size = 1>
	<option value='dotted'>Dotted</option>
    <option value='solid'>Solid</option>
    <option value='groove'>Groove</option>
 </select><br>
 
   Border-Width: <select name="border-width:" size = 1>
	<option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
 </select><br>
 
   Border-Radius: <select name="border-radius:" size = 1>
	<option value='0px'>0px</option>
	<option value='10px'>10px</option>
	<option value='50px'>50px</option>
	<option value='75px'>75px</option>
    <option value='100px'>100px</option>
    <option value='120px'>120px</option>
	<option value='150px'>150px</option>
	<option value='200px'>200px</option>
  </select><br>
 
   Border-Color: <select name="border-color:" size = 1>
    <option value='black'>Black</option>
	<option value='yellow'>Yellow</option>
    <option value='blue'>Blue</option>
    <option value='red'>Red</option>
  </select><br><br>
  
  <input type = "submit" value = "Store class preferences" onclick = "classFunction()"</submit>
  <br>
  
  </form>

<div id = 'testId1' class = 'classA'>This is testId1 with classA</div>
<div id = 'testId2' class = 'classA'>This is testId2 with classA</div>
<div id = 'testId3' class = 'classB'>This is testId3 with classB</div>
<div id = 'testId4' class = 'classB'>This is testId4 with classB</div>
  
<div id = 'testClass1' class = 'classA'>This is testClass1 with classA</div>
<div id = 'testClass2' class = 'classA'>This is testClass2 with classA</div>
<div id = 'testClass3' class = 'classB'>This is testClass3 with classB</div>
<div id = 'testClass4' class = 'classB'>This is testClass4 with classB</div>

<script>
function idFunction() {
var x = document.getElementById("idForm");
var text = "";
var divid = "";
var i;
	//Loops through the id form and parses out the div id and creates test for the style
	for (i = 0; i < x.length; i++) {
		if(x.elements[i].name == "idName:") {
			divid = x.elements[i].value;
		}else{
			text += x.elements[i].name;
			text += x.elements[i].value + ";";
		}
	}
var z = document.getElementById(divid);
z.setAttribute('style',text);
}
</script>

<script>
function classFunction() {
var y = document.getElementById("classForm");
var text = "";
var divid = "";
var i;
	//Loops through the id form and parses out the div id and creates test for the style
	for (k = 0; k < y.length; k++) {
		if(y.elements[k].name == "className:") {
			divid = y.elements[k].value;
		}else{
			text += y.elements[k].name;
			text += y.elements[k].value + ";";
		}
	}
var w = document.getElementById(divid);
w.setAttribute('style',text);
}
</script>































</body>
</html>