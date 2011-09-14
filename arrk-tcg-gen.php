<?php
//Pulls data from a wikia site, and creates png's well jpegs but we will fix that.
// anyway my code is crap, so don't judge I am sure there are a million ways better of doing this.

print "## Arrk Card Generator ##\n";

//Set test or not
$test = 1; //set to 1 to use local file, rather than web page

//Image size
$x = 825;
$y = 1125;

//Gutter
$g = 55;

//gutter x
$gx = 55;
//gutter y
$gy = 55;

//panel boarder
$b = ($gx*.75);

//eh lets do maths here for image size, in case we wan to change or soemthing
$ix = $x-($g*2)-($b*2);
$iy = $y/2-$g-$b-($b/2);

//Font
$font = "/mnt/wd2tb/Temp/arrk-tcg/Alike-Regular.ttf";

//Font Sizes
$smallfontsize = ($x/2);

//make the image  YAY!
$im = imagecreatetruecolor($x,$y);

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
imagefilledrectangle($im, $g,$g,$x-$g,$y-$g,$white);

unset ($data);

if ($test == 0) {
$data = file_get_contents('http://arrktcg.wikia.com/wiki/Hero_Cards'); //read the file
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $heromatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Dungeon_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $dungeonmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Monster_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $monstermatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Trap_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $trapmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Potions');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $potionmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Boss_Cards');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $bossmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Rings');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $ringmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Scrolls');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $scrollmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Amulets');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $amuletmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Chest');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $chestmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Head');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $headmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Pants');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $pantsmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Boots');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $bootsmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Weapons');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $weaponsmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Miscellaneous_Items');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $miscmatches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Gloves');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $glovematches);
sleep(5);

$data = file_get_contents('http://arrktcg.wikia.com/wiki/Belts');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $beltsmatches);

$allcards = array_merge($dungeonmatches, $chestmatches, $miscmatches, $beltsmatches, $glovematches, $bootsmatches, $weaponsmatches, $pantsmatches, $ringmatches, $headmatches, $scrollmatches,  $amuletmatches, $heromatches, $bossmatches, $potionmatches, $monstermatches, $trapmatches);
}

//just set variables so we know how many of each card is made
$tmonsterc = 0;
$tpresentc = 0;
$theroc = 0;
$tbossc = 0;
$ttrapc = 0;
$tdungeonc = 0;

if ($test == 1) {
//did this so as not to kill wikia pulling data
$data = file_get_contents('list.txt');
preg_match_all('/<pre>(.*?)<\/pre>/s', $data, $allcards);
}

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

	//Set card colours
	$bbcolour = imagecolorallocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	if ($type == "Monster") {$bbcolour = imagecolorallocate($im, 204,0,0);$tmonsterc=$tmonsterc+1;} //Red
        if ($type == "Trap") {$bbcolour = imagecolorallocate($im, 0,153,0);$ttrapc=$ttrapc+1;} // Green, slime
	if ($type == "Dungeon") {$bbcolour = imagecolorallocate($im, 0,55,0);$tdungeonc=$tdungeonc+1;} // Green, earthy
	if ($type == "Hero") {$bbcolour = imagecolorallocate($im, 0,0,255);$theroc=$theroc+1;} // blue
        if ($type == "Boss") {$bbcolour = imagecolorallocate($im, 51,0,0);$tbossc=$tbossc+1;} // black
        if ($type == "Present") {$bbcolour = imagecolorallocate($im, 255,255,0);$tpresentc=$tpresentc+1;} // gold

#	print "Name Position: $namepos Type Postion: $typepos Quote Pos: $quotepos Name: $name Type: $type\n";  //for testing

	$title = $name;

	// create bleed boarder
	imagefilledrectangle($im, 0,0,$x,$y,$bbcolour);

	// create inner boarder
	imagefilledrectangle($im, $g,$g,$x-$g,$y-$g,$black);

	//create uppper picture area (although is this needed?  probably we can leave it in
	imagefilledrectangle($im, $g+$b,$b+$g,$x-$g-$b,($y/2)-($b/2),$white);

	//create image from folder or elsewhere... this is horrible!
	if(!file_exists("./cardimages/$name.png"))
 	{

		print "Being nice to flickr, 10sec pause\n";
		sleep(10);
		$imgdata = file_get_contents("http://www.flickr.com/search/?q=$name&l=commderiv&ss=0&ct=5&mt=all&adv=1&s=int");

		#echo "$imgdata\n";
		preg_match_all('/ResultsThumbsChild(.*?)ResultsThumbsChild/s', $imgdata, $imgmatches);
		#print $imgmatches[0][0];
		preg_match_all('/<a href(.*?)title/s', $imgmatches[0][0], $singleimg);
		#print_r($singleimg);

		$ahref = "a href=";
	        $ahrefpos = strpos($singleimg[0][0], $ahref);
	        $titlepos = "title";
	        $urlpos = strpos($singleimg[0][0], $title);
	        $url = substr($singleimg[0][0], $ahrefpos+8,$titlepos-8);
		#print "$url\n";
		unset ($imgdata);
		unset ($imgmatches);
		unset ($singleimg);

		print "Being nice again, 10sec\n";
		sleep(10);
		$imgdata = file_get_contents("http://www.flickr.com/$url");

		preg_match_all('/image_src(.*?)link/s', $imgdata, $imgurl);
		#print_r($imgurl);

                $ahref = "href=";
                $ahrefpos = strpos($imgurl[0][0], $ahref);
                $titlepos = ">";
                $urlpos = strpos($imgurl[0][0], $title);
                $url = substr($imgurl[0][0], $ahrefpos+6,$titlepos-11);
                #print "$url\n";

		$file = "./cardimages/$type.png";
                $file = "$url";
		$cardimage = imagecreatefromjpeg($file);
		list($cx, $cy) = getimagesize($file);
                //merge in an image here...
                imagecopyresized($im, $cardimage, $g+$b,$b+$g,0,0,$ix,$iy,$cx,$cy);
		#imagecopymerge($im, $cardimage, $g+$b,$b+$g,0,0,633,446,100);
                imagedestroy($cardimage);
 	}
	else
 	{
		$file = "./cardimages/$name.png";
	        $cardimage = imagecreatefrompng($file);
		list($cx, $cy) = getimagesize($file);
	        //merge in an image here...
        	imagecopyresized($im, $cardimage, $g+$b,$b+$g,0,0,$ix,$iy,$cx,$cy);
		#imagecopymerge($im, $cardimage, $gx+$b,$b+$gy,0,0,633,446,100);
	        imagedestroy($cardimage);
	}

        // Create write space
        imagefilledrectangle($im, $g+$b,($b/2)+($y/2),$x-$g-$b,$y-$g-$b,$white);

	//Write the name on the card

	$fsize = 30; //small base font size, which we will increase
	$bbox = imageftbbox($fsize, 0, $font, $name); //figure out width

	//shrink font to fit long names
	while ($bbox[2] > $x-($g*2)){
		$fsize = $fsize-1;
		$bbox = imageftbbox($fsize, 0, $font, $name);
	}

	//shrink the hight.. in case
	while (($bbox[7]*-1) > $b){
                $fsize = $fsize-1;
                $bbox = imageftbbox($fsize, 0, $font, $name);
	}

	imagefttext($im, $fsize,0,$g+($g*.25)+($g*.1),$g+($g*.25)+($b/2)+($g*.1),$black,$font,$name); //shadow
        imagefttext($im, $fsize,0,$g+($g*.25),$g+($g*.25)+($b/2),$white,$font,$name);

#	print_r ($bbox);

	//put the text in
	imagefttext($im, 15,0,$gx+20+$b,$gy+($y/2),$black,$font,$v2);
	// create image
	print "Creating Card: $type-$title\n";
	imagepng($im,"output/$type-$title.png");

		}
	}
}

imageDestroy($im);

$tcards = $tmonsterc+$tdungeonc+$tbossc+$ttrapc+$theroc+$tpresentc;

print "Total Monster Cards: $tmonsterc\n";
print "Total Dungeon Cards: $tdungeonc\n";
print "Total Boss Cards: $tbossc\n";
print "Total Present Cards: $tpresentc\n";
print "Total Trap Cards: $ttrapc\n";
print "Total Hero Cards: $theroc\n";
print "Total Cards: $tcards\n";

?>
