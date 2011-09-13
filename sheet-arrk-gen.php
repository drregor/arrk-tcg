<?php
//Pulls data from a wikia site, and creates png's well jpegs but we will fix that.
// anyway my code is crap, so don't judge I am sure there are a million ways better of doing this.

print "## Arrk Sheet Generator ##\n";

//Image size
$x = 2550;
$y = 3300;

//make the image  YAY!
$im = imagecreatetruecolor($x,$y);


$dira = './output';
$imagedir = dir($dira);

$i = 1;
$row = 0;
$colom = 0;
$counta = 1;
while ($images = $imagedir->read())
        {
                $is_png = eregi( "png",$images);
                if ( $images != '.' && $images != '..' && $is_png)
                {
			$cardimage = imagecreatefrompng("$dira/$images");
		        print "$images\n";
			//merge in an image here...
			imagecopymerge($im, $cardimage, 0+(850*$colom),0+(1100*$row),0,0,850,1100,100);
#			imagejpeg($im,"cardsheets/Sheet-$counta.jpg");
#			$row = $row + 1;
			$colom = $colom + 1;
			if ($colom == 3) {$colom = 0;$row = $row + 1;}
			if ($row == 3) {
				$row = 0;
				imagepng($im,"cardsheets/Sheet-$counta.png");
				$counta = $counta+1;
			}
			#$counta = $counta + 1;
		}
	}

imageDestroy($im);

?>
