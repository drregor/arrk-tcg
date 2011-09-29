<?php
//Image size
$x = 825;
$y = 1125;

//Gutter
$g = 55;

//panel boarder
$b = ($g*.75);

//Font
$font = "/mnt/wd2tb/Temp/arrk-tcg/Alike-Regular.ttf";
$fontsize = 180;
$ty = $y * 2;

$im  = imagecreatetruecolor($x, $y);
$white = imagecolorallocate($im, 255,255,255);
$black = imagecolorallocate($im, 0,0,0);
$grey = imagecolorallocate($im, 150,150,150);
imagefilledrectangle($im, 0,0,$x,$y,$white);


$cardtypes = array("Hero","Dungeon","Present","Action","Monster","Boss");

foreach($cardtypes as $ctype) {


	$fontsize = 180;
	$ty = $y * 2;

	if ($ctype == "Monster") {$bbcolour = imagecolorallocate($im, 204,0,0);} //Red
	if ($ctype == "Action") {$bbcolour = imagecolorallocate($im, 202,153,0);} // Green, slime
        if ($ctype == "Dungeon") {$bbcolour = imagecolorallocate($im, 0,55,0);} // Green, earthy
        if ($ctype == "Hero") {$bbcolour = imagecolorallocate($im, 0,0,255);} // blue
        if ($ctype == "Boss") {$bbcolour = imagecolorallocate($im, 51,0,0);} // black
        if ($ctype == "Present") {$bbcolour = imagecolorallocate($im, 255,255,0);} // gold
	imagefilledrectangle($im, 0,0,$x,$y,$bbcolour);
	imagefilledrectangle($im, $g, $g, $x-$g, $y-$g,$white);

	while ($ty-$g > $y-$g){
	$fontsize = $fontsize -1;
	$bbox = imagettfbbox($fontsize, 90, $font, $ctype);
	$ty = $bbox[3]*-1;
	$tx = $bbox[6]*-1;
	}

#	print_r($bbox);
        imagettftext($im, $fontsize, 90, ($x/2)+($tx/2)+10, ($y/2)+10+($ty/2), $grey, $font, $ctype);
	imagettftext($im, $fontsize, 90, ($x/2)+($tx/2), ($y/2)+($ty/2), $black, $font, $ctype);
	imagepng($im,"output/$ctype-back.png");


}

imagedestroy($im);

?>
