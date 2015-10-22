<!-- //This makes shapes and tests classes and subclasses -->

<html>
<head>
</head>

<body>

<?php

$shape = new Shape();
//Assign side lengths to the shape in question.
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
$shape->sideLengths[] = 2;
//Then put the height and width into the constructor (in that order)
$shape->__construct(6.15,6.15, 100);
//Demos the double function
$shape->double($shape);
//Demos the printShape function
$shape->printShape();

//Rectangle
$rec = new Rectangle();
$rec->__construct(4, 8, 20, 4, 2);
$rec->printShape();

//Square
$sq = new Square();
$sq->__construct(10,40,0,5);
$sq->printShape();

//Triangle
$tri = new Triangle();
$tri->__construct(35,20,20,50,50,50);
$tri->printShape();

//Oval
$oval = new Oval();
$oval->__construct(10,9,8);
$oval->printShape();

//Circle
$circle = new Circle();
$circle->__construct(80,80,10);
$circle->printShape();

//Demos the getAreas function
$shape->getAreas($shape, $rec, $circle);

class Shape
{
	/*Due to the nature of random shapes
	  sideLengths does not go into the constructor.
	  numSides will be calculated based on the number of sides entered.*/

	public $sideLengths;
	public $numSides;
	public $width;
	public $height;
	public $rotation;
	public $perim;
	public $area;

	//Basic shape constructor
	function __construct($h,$w,$r)
	{
		$this->width = $w;
		$this->height = $h;
//This is to compensate for things like 720 degrees where in reality, it means 0 since the object rotated 360 degrees twice.
		if($r>360)
		$r = $r%360;
		$this->rotation = $r;
		$this->cPerim();
		$this->cArea();
		$this->numSides = count($this->sideLengths);
	}
//Calculate area
	function cArea()
	{
		//http://www.mathwords.com/a/area_regular_polygon.htm
		$this->area = .5*((.5*$this->width)*$this->perim);
		return $area;
	}
//Calculate Perimeter
	function cPerim()
	{
		$this->perim = array_sum($this->sideLengths);
		return $area;
	}
//Give info about a shape
	function printShape()
	{
		print(get_class($this));
		print("<br/>Sides:". $this->numSides);
		print("<br/>Lengths:");
		//For loop does the printing of the array values.
		for($i=0;$i<$this->numSides;$i++)
		{
		if($i==0)
			print("[".$this->sideLengths[$i].", ");
		else if($i==$this->numSides-1)
			print($this->sideLengths[$i]."]");
		else
			print($this->sideLengths[$i].", ");
		}
		print("<br/>Area:". $this->area);
		print("<br/>Perimeter:". $this->perim);
		print("<br/>Width:". $this->width);
		print("<br/>Height:". $this->height);
		print("<br/>Rotation:". $this->rotation . " degrees <br/> <br/>");
	}
	
//I have no idea why I really need this here other than to return an array.
	function returnSides()
	{
		print_r($this->sideLengths);
		return $this->sideLengths;
	}

//Doubles the size of a shape. (Mults all parameters by 2 and recalculates perimeter and area.
	function double(&$shape){
	$shape->width = $shape->width*2;
	$shape->height = $shape->height*2;
	$shape->numSides = count($shape->sideLengths);
	for($i=0;$i<$shape->numSides;$i++)
	{
		$shape->sideLengths[$i] = $shape->sideLengths[$i]*2;
	}
	$shape->cPerim();
	$shape->cArea();
	}
//Prints areas of shapes that are input.
	function getAreas($shape, $shape2, $shape3)
	{

		print(get_class($shape)." Area: ".$shape->area."<br/>");

		print(get_class($shape2)." Area: ".$shape2->area."<br/>");

		print(get_class($shape3)." Area: ".$shape3->area."<br/>");
	}
}


class Rectangle extends Shape
{
	function __construct($h,$w,$r,$s1,$s2)
	{
		parent::__construct($h,$w,$r);
		$this->numSides = 4;
//Rectangles with unequal heights or widths isn't a rectangle. This fixes that
		$this->height = $s1;
		$this->width = $s2;
		$this->sideLengths[0] = $s1;
		$this->sideLengths[1] = $s1;
		$this->sideLengths[2] = $s2;
		$this->sideLengths[3] = $s2;
		$this->cPerim();
		$this->cArea();
	}

	function cArea()
	{
		$this->area = $this->width*$this->height;
		return $area;
	}
}


class Square extends Rectangle
{
	function __construct($h,$w,$r,$s1)
	{
		parent::__construct($h,$w,$r);
//Square heights = square widths
		$this->height = $s1;
		$this->width = $s1;
		$this->numSides = 4;
		$this->sideLengths[0] = $s1;
		$this->sideLengths[1] = $s1;
		$this->sideLengths[2] = $s1;
		$this->sideLengths[3] = $s1;
		$this->cPerim();
		$this->cArea();
	}
}

class Triangle extends Shape
{
	function __construct($h,$w,$r,$s1,$s2,$s3)
	{
		//I'm counting on the user to make a triangle that makes sense. Probably a mistake.
		parent::__construct($h,$w,$r);
//Triangles only have 3 sides.
		$this->numSides = 3;
		$this->sideLengths[0] = $s1;
		$this->sideLengths[1] = $s2;
		$this->sideLengths[2] = $s3;
		$this->cPerim();
		$this->cArea();
	}

	function cArea()
	{
		$this->area = ($this->height*$this->width)/2;
		return $this->area;
	}

	function cPerim()
	{
		$this->perim = array_sum($this->sideLengths);
		return $this->perim;
	}
}

class Oval extends Shape
{
//Circles and ovals can technically have 0 sides, 1 side or infinitely many sides.
//0 is the most unique and the easiest to represent and work with.
	function __construct($h,$w,$r)
	{
		$this->width = $w;
		$this->height = $h;
		$this->rotation = $r;
		$this->width = $w;
		$this->numSides = 0;
		$this->cPerim();
		$this->cArea();
	}

	function cArea()
	{
		//For an oval width!==height, for circle width = height
		$this->area = pi()*($this->width*$this->height);
		return $this->area;
	}

	function cPerim()
	{
		//Indian mathematician Ramanujan's formula.
		$this->perim = pi()*(3*($this->width+$this->height)-sqrt((3*$this->width + $this->height)*($this->width+3*$this->height)));
		return $this->perim;
	}

}

class Circle extends Oval
{
	function __construct($h,$r)
	{
		//Circles should have the same height and width.
		$this->height = $h;
		$this->width = $h;
		$this->numSides = 0;
		$this->cPerim();
		$this->cArea();
	}

	function cperim()
	{
		$this->perim = 2*pi()*(($this->width)/2);
		return $this->perim;
	}
}


?>

</body>
</html>

