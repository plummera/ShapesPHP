<?php
  require('classes/class.php');

  echo "###############################################################". "\r\n";
  echo "#                                                             #". "\r\n";
  echo "#      Shape Maker '\x1b[45mShapeShifter\x1b[0m' v0.1                        #". "\r\n";
  echo "#                                                             #". "\r\n";
  echo "#                written by Anthony Plummer                   #". "\r\n";
  echo "#                                                             #". "\r\n";
  echo "###############################################################". "\r\n";
  echo "\r\n";
  echo "Pick your shape from the follwing that are available: \r\n";
  $shape = new Shape("Shape",0,0,0);
  $shape->getShape();

?>
