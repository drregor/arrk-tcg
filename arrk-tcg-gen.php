<?php
//Pulls data from a wikia site, and creates png's well jpegs but we will fix that.  
// anyway my code is crap, so don't judge I am sure there are a million ways better of doing this.

print "## Arrk Card Generator ##\n";

//Image size
$x = 825;
$y = 1125;

//gutter x
$gx = (55);
//gutter y
$gy = (55);

//panel boarder
$b = ($gx*.75);

//Font
$font = "/mnt/wd2tb/Temp/arrk-tcg/Alike-Regular.ttf";

//Font Sizes
$smallfontsize = ($x/2);

//make the image  YAY!
$im = imagecreate($x,$y);

$c4 = mt_rand(200,255); //r(ed)
$c5 = mt_rand(200,255); //g(reen)
$c6 = mt_rand(200,255); //b(lue)

$randomcolor = imagecolorallocate($im,$c4,$c5,$c6);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0,0,0);
$blue = imagecolorallocate($im, 0,0,255);
$red = imagecolorallocate($im, 255,0,0);
$clear = imagecolorallocate($im, 138,138,138);

imagefilledrectangle($im, 0,0,$x,$y,$red);
imagefilledrectangle($im, $gx,$gy,$x-$gx,$y-$gy,$white);

unset ($data);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Hero_Cards'); //read the file
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $heromatches);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Dungeon_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $dungeonmatches);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Monster_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $monstermatches);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Trap_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $trapmatches);

$allcards = array_merge($dungeonmatches, $heromatches, $monstermatches,$trapmatches);

#print_r($matches);

#print $matches[1][1];

foreach ($allcards as $v1) {
	foreach ($v1 as $v2) {
		$has_pre = eregi( "<pre>",$v2);
                        if ($has_pre){
                        }else{

	// print out datea
#	echo "$v2\n";
	// set search string
	$mname = "Name:";
	$namepos = strpos($v2, $mname);
	$type = "Type:";
	$typepos = strpos($v2, $type);
	$quote = "Quote:";
	$quotepos = strpos($v2, $quote);
	$name = substr($v2, $namepos+6,$typepos-6);
	$name = trim($name);
	$type = substr($v2, $typepos+5,$quotepos-$typepos-6);
	$type = trim($type);


#	print "Name Position: $namepos Type Postion: $typepos Quote Pos: $quotepos Name: $name Type: $type\n";  //for testing

	$title = $name;
	// create bleed boarder
	imagefilledrectangle($im, 0,0,$x,$y,$blue);

	// create inner space
	imagefilledrectangle($im, $gx,$gy,$x-$gx,$y-$gy,$white);

        // Create write space
        imagefilledrectangle($im, $b,$b+($y/2),$x,$y,$white);

	//Write the name on the card
	imagefttext($im, 15,0,$gx+20,$gy+20,$black,$font,$name);

	//put the text in
	imagefttext($im, 15,0,$gx+20,$gy+($y/2),$black,$font,$v2);
	// create image
	print "Creating Card: $type-$title\n";
	imagejpeg($im,"output/$type-$title.jpg");

		}
	}
}

imageDestroy($im);

?>
