<?php
print "## Arrk Card Generator ##\n";

//Image size
$x = 825;
$y = 1125;

//gutter x
$gx = ($x*.02);
//gutter y
$gy = ($y*.075);

//panel boarder
$boarder = ($x*.01);

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

imagefilledrectangle($im, 0,0,$x,$y,$red);
imagefilledrectangle($im, $gx,$gy,$x-$gx,$y-$gy,$white);

unset ($data);
$data = file_get_contents('http://arrktcg.wikia.com/wiki/Hero_Cards'); //read the file
#$data = file_get_contents('http://arrktcg.wikia.com/wiki/Monster_Cards');
#$data = file_get_contents('http://arrktcg.wikia.com/wiki/Dungeon_Cards');

preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $matches);

#print_r($matches);

#print $matches[1][1];

foreach ($matches as $v1) {
	foreach ($v1 as $v2) {
	$type = "Hero";
	echo "$v2\n";
	$hero = "Hero:";
	$heropos = strpos($v2, $hero);
	$quote = "Quote:";
	$quotepos = strpos($v2, $quote);
	$name = substr($v2, $heropos+6, $quotepos-6);
	$name = trim($name);
	print "$name\n";
	$title = $name;
	imagejpeg($im,"output/$type-$title.jpg");

	}
}

#$type = "hero";
$title = "title";

#imagecolortransparent($im, $clear);
#imagefilledrectangle($im, $gx,$gy,$x-$gx,$y-$gy,$white);


#imagejpeg($im,"output/$type-$title.jpg");
imageDestroy($im);

?>
