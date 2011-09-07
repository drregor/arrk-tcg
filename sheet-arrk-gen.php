<?php
//Pulls data from a wikia site, and creates png's well jpegs but we will fix that.  
// anyway my code is crap, so don't judge I am sure there are a million ways better of doing this.

print "## Arrk Sheet Generator ##\n";

//Image size
$x = 2550;
$y = 3300;

//make the image  YAY!
$im = imagecreate($x,$y);


imagejpeg($im,"sheets/Sheet-$counta.jpg");


imageDestroy($im);

?>
