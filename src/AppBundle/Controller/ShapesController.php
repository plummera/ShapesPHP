<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ShapesController
{
    public $name;
    public $length;
    public $width;

    public function __construct($name, $length, $width) {
      $name   = $this->name;
      $length = $this->length;
      $width  = $this->width;
    }

    /**
    * @Route("/shape")
    */
    public function loadShapesFromXML() {
      $xml=simplexml_load_file("shapes.xml") or die("Error: Cannot create object");
      $shapeNames = $xml->name;
      $i = 0;

      foreach ($shapeNames as $shapeName) {
        $i++;
        echo $i . ": " . $shapeName . "\n";
      }
    }

    /**
    * @Route("/shape/{shape}")
    */
    public function getShape() {
      echo "Which shape would you like to use?";
      $selectedShape = fopen("php://stdin", "r");
      $line = fgets($selectedShape) or die("That is not a valid option. \n");
      $shape = trim($line);

      for ($i=0;$i<count($shapeNames);$i++) {
        switch ($shape) {
          case $i:
            echo "Building a " . $shapeNames[$i] . ".\n";
            $selectedShape = $shapeNames[$i];
            $this->getDimensionLength($selectedShape);
            break;
        }
      }
    }
}
