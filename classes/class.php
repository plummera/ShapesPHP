<?php
require('db.php');

class Shape {

  public $name;
  public $length;
  public $width;
  public $height;
  public $diameter;

  public function __construct($name, $length, $width, $height, $diameter = NULL) {
    $this->name = $name;
    $this->length = $length;
    $this->width = $width;
    $this->height = $height;
    $this->diameter = $diameter;

  }

  public function getShape() {
    $xml=simplexml_load_file("shapes.xml") or die("Error: Cannot create object");
    $shapeNames = $xml->name;
    $i = 0;

    foreach ($shapeNames as $shapeName) {
      $i++;
      echo $i . ": " . $shapeName . "\n";
    }
    echo "Which shape would you like to use? \n(1-" . count($shapeNames) . ")";
    $selectedShape = fopen("php://stdin", "r");
    $line = fgets($selectedShape) or die("That is not a valid option. \n");
    $shape = trim($line);

    for ($i=0;$i<count($shapeNames);$i++) {
      switch ($shape) {
        case $i:
          echo "Building a " . $shapeNames[$i-1] . ".\n";

          // If Rectangle
          if ($i == 1) {
            //Get Name of Shape
            $selectedShape = $shapeNames[$i-1];
            //Get Length of Shape
            $shapeLength = $this->getLength($selectedShape);
            //Get Width of Shape
            $shapeWidth = $this->getWidth($selectedShape);

            $this->buildShape($selectedShape, $shapeLength, $shapeWidth, $shapeHeight = NULL, $shapeDiameter = NULL);
          }
          // If Square
          if ($i == 2) {
            //Get Name of Shape
            $selectedShape = $shapeNames[$i-1];
            //Get Width of Shape
            $shapeWidth = $this->getWidth($selectedShape);
            // Get Length of Shape
            $shapeLength = $shapeWidth;
            $shapePerimeter = $this->getPerimeter($selectedShape);
            $this->buildShape($selectedShape, $shapeLength, $shapeWidth, $shapeHeight = NULL, $shapeDiameter = NULL);

          }
          // If Circle
          if ($i == 3) {
            //Get Name of Shape
            $selectedShape = $shapeNames[$i-1];
            //Get Diameter of Shape
            $shapeDiameter = $this->getDiameter($selectedShape);

            $this->buildShape($selectedShape, $shapeLength = NULL, $shapeWidth = NULL, $shapeHeight = NULL, $shapeDiameter);
          }

          //If a Right Angle
          if ($i == 4) {
            //Get Name of Shape
            $selectedShape = $shapeNames[$i-1];
            //Get Height of Shape
            $shapeHeight = $this->getHeight($selectedShape);
            // Get Width of Shape
            $shapeWidth = $this->getWidth($selectedShape);
            $this->buildShape($selectedShape, $shapeLength = NULL, $shapeWidth, $shapeHeight, $shapeDiameter = NULL);
          }

          //If an Equilateral Triangle
          if ($i == 5) {
            //Get Name of Shape
            $selectedShape = $shapeNames[$i-1];
            //Get Length of Shape
            $shapeLength = $this->getLength($selectedShape);
            $this->buildShape($selectedShape, $shapeLength, $shapeWidth = NULL, $shapeHeight = NULL, $shapeDiameter = NULL);
          }
      }
    }
  }

  public function buildShape($name, $length, $width, $height, $diameter) {
    $shape = new Shape($name, $length, $width, $height, $diameter);
    $shape->displayShape($shape);
  }

  public function getDiameter($selectedShape) {
    echo "What is the diameter of your " . $selectedShape[0] . " in ft.?\n";
    $diameter = fopen("php://stdin", "r");
    $line = fgets($diameter) or die("Need an Integer");
    $shapeDiameter = trim($line);
    echo "The " . $selectedShape . " is " . $shapeDiameter . "ft. in diameter. \n";
    return $shapeDiameter;
    $this->getRadius($selectedShape);
  }

  public function getHeight($selectedShape) {
    echo "How tall is your " . $selectedShape[0] . " in ft.?\n(ft.)";
    $height = fopen("php://stdin", "r");
    $line = fgets($height) or die("Need an Integer");
    $shapeHeight = trim($line);
    echo "The " . $selectedShape . " is " . $shapeHeight . "ft. tall. \n";
    return $shapeHeight;
  }

  public function getLength($selectedShape) {
    echo "How Long is your " . $selectedShape . " in ft.?\n(ft.)";
    $length = fopen("php://stdin", "r");
    $line = fgets($length) or die("Need an Integer");
    $shapeLength = trim($line);
    echo "The " . $this->name . " is " . $shapeLength . "ft. long. \n";
    return $shapeLength;
  }

  public function getWidth($selectedShape) {
    echo "How Wide is your " . $selectedShape . "\n(ft.)";
    $width = fopen("php://stdin", "r");
    $line = fgets($width) or die("Need an Integer");
    $shapeWidth = trim($line);
    echo "The " . $this->name . " is " . $shapeWidth . "ft. wide. \n";
    return $shapeWidth;
  }

  public function getArea($selectedShape) {
    // If Rectangle
    if ($selectedShape->length != NULL && $selectedShape->width != NULL) {
      $area = $this->length * $this->width;
      return number_format($area);
    }
    // If Circle
    if ($selectedShape->diameter != NULL) {
      $area = 3.1415 * (($this->diameter/2) * ($this->diameter/2));
      return number_format($area);
    }
    // If Right Triangle
    if ($selectedShape->height != NULL) {
      $area = $this->height * $this->width/2;
      return number_format($area);
    }
    // If Triangle
    if ($selectedShape->length != NULL) {
      $area = ($selectedShape->length*$selectedShape->length)*(sqrt(3)/4);
      return number_format($area);
    }
    // If Square
    if ($selectedShape->width != NULL) {
      $area = $selectedShape->width * $selectedShape->width;
      return number_format($area);
    }
  }

  public function getPerimeter($shape) {
    // If Rectangle
    if ($this->length != NULL && $this->width != NULL) {
      $perimeter = (2*$shape->length) + (2*$shape->width);
      return number_format($perimeter);
    }
    // If Circle
    if ($this->diameter != NULL) {
      $perimeter = 3.1415 * $this->diameter;
      return number_format($perimeter);
    }
    // If Right Triangle
    if ($this->height != NULL) {
      $perimeter = $shape->height + $shape->width + (sqrt(($shape->height*$shape->height)+($shape->width*$shape->width)));
      return number_format($perimeter);
    }
    // If Triangle
    if ($this->length != NULL) {
      $perimeter = $this->length * 3;
      return number_format($perimeter);
    }
    // If Square
    if ($this->width != NULL) {
      $perimeter = 4*$this->width;
      return number_format($perimeter);
    }
  }

  public function displayShape($shape) {
    echo "+++++++++++++++++++++++++++++\n";
    echo "Shape: " . $this->name . "\n";
          if (isset($this->length)) {
            echo "Length: " . $this->length . "ft.\n";
          }
          if (isset($this->width)) {
            echo "Width: " . $this->width . "ft.\n";
          }
          if (isset($this->height)) {
            echo "Height: " . $this->height . "ft.\n";
          }
          if (isset($this->diameter)) {
            echo "Radius: " . $this->diameter/2 . "ft.\n";
            echo "Diameter: " . $this->diameter . "ft.\n";
          }
          echo "Area: " . $this->getArea($shape) . "sq ft.\n";
          echo "Perimeter: " . $this->getPerimeter($shape) . "sq ft.\n";
    echo "+++++++++++++++++++++++++++++\n";
  }
};

?>
