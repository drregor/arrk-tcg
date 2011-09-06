<?php

print "\n## Arrk Card Generator ##\n";

//Image size
$x =
$y =

//gutter x
$gx = ($width*.02);
//gutter y
$gy = ($height*.075);

//panel boarder
$boarder = ($width*.01);

//Font
$font = "/mnt/wd2tb/Temp/arrk-tcg/font.ttf";

//Font Sizes
$smallfontsize = ($gy/2);

//make the image  YAY!
$im = imagecreate($x,$y);

$c4 = mt_rand(200,255); //r(ed)
$c5 = mt_rand(200,255); //g(reen)
$c6 = mt_rand(200,255); //b(lue)

$randomcolor = imagecolorallocate($im,$c4,$c5,$c6);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0,0,0);
$red = imagecolorallocate($im, 20,0,0);
$clear = imagecolorallocate($im, 138,138,138);

$homepage = file_get_contents('http://arrktcg.wikia.com/wiki/Hero_Cards');
echo $homepage;

$type = "hero";
$type = "title";

imagecolortransparent($im, $clear);
imagefilledrectangle($im, 0,0,$width,$height,$white);


imagejpeg($im,"output/$type-$title.jpg");
imageDestroy($im);

?>
