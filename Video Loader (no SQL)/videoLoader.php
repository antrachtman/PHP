<!DOCTYPE html>

<link rel = "stylesheet" type = "text/css" href = "style.css">

<html>
  <head>
    <title></title>

  </head>

  <body>

<div id='upload'>
<?php // upload.php
//Since this is mostly html it could have gone into an html file, but 
//using .php makes the second and third blocks of PHP function properly

  echo <<<_END
    <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='index.php' enctype='multipart/form-data'>
    Select File: <input type='file' name='filename' size='10'>
    <input type='submit' value='Upload'>
    </form>
_END;

  if ($_FILES)
  {
    $name = $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    echo "Uploaded video '$name'<br>"; 

//Uses substrings to get just the filename without the extension
	$nameLength = strlen($name);
	$extLength = strlen(substr($name, strrpos($name, '.')));
	$nameNoExtLength = strlen(substr($name,0,$nameLength-$extLength));
	$nameNoExt = substr($name, 0, ($nameLength-$extLength));   
  }


?>

</div>

<div id = 'video'></div>

<script>
function loadVideo(videoTitle,videoDiv) {

//controls gives the play/volume/fullscreen options.
//HTML5 cannot handle MPEGs

var videoString = "<video width='560' height='320' controls> \
      <source src='" + videoTitle + ".mp4'  type='video/mp4'> \
      <source src='" + videoTitle + ".webm' type='video/webm'> \
      <source src='" + videoTitle + ".ogv'  type='video/ogg'> \
      <source src='" + videoTitle + ".wmv'  type='video/wmv'> \
    </video>"

    document.getElementById(videoDiv).innerHTML = videoString;

}

function clearVideo(videoDiv) {
    document.getElementById(videoDiv).innerHTML = "";
}
</script>

<script>

//http://stackoverflow.com/questions/23740548/how-to-pass-variables-and-data-from-php-to-javascript
//This solution makes enough sense since it just throws php in and echoes a universal form of the value (it's also just a string.).

	var nameNoExt = <?php echo json_encode($nameNoExt);?>;

	loadVideo(nameNoExt, 'video');

</script>

<div id='directory'>

<?php

$files = scandir (".");

?>

<?php

function stripExt($item){
		$itemLength = strlen($item);
		$itemExtLength = strlen(substr($item, strrpos($item, '.')));
		$itemNoExt = substr($item, 0, ($itemLength-$itemExtLength));

		return $itemNoExt; 
}

echo 'Compatible files:<br>';

foreach($files as $item)
  {
//Checks the substring of the filename in question and returns the extension TEXT. pathinfo() doesn't work here since these are just strings.
    
//The switch makes sense since it acts like a bunch of if statements.

	switch(substr($item, strrpos($item, '.')+1)){

		case 'mp4':

			//This wonderful thing pulls data from php and interweaves it with html tags.
			echo "<button onclick=\"loadVideo('" . stripExt($item) . "','video')\">".$item."</button> <br/>";

			break;

		case 'wmv':
			echo "<button onclick=\"loadVideo('" . stripExt($item) . "','video')\">".$item."</button> <br/>";
			break;

		case 'webm':
			echo "<button onclick=\"loadVideo('" . stripExt($item) . "','video')\">".$item."</button> <br/>";
			break;

		case 'ogv':
			echo "<button onclick=\"loadVideo('" . stripExt($item) . "','video')\">".$item."</button> <br/>";
			break;

		case 'mpeg':
			echo "<button onclick=\"loadVideo('" . stripExt($item) . "','video')\">".$item."</button> <br/>";
			break;

		default:
		break;
	}

  }

?>

</div>




















</body>
</html>