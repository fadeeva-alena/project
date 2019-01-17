<?php
require('ImageManipulation.php');
  
$src = 'david_sm.jpg';
  
$objImage = new ImageManipulation($src);
if ( $objImage->imageok ) {
    $objImage->setPixelate(3);
   $objImage->show();
//$objImage->save('../images/profile/temp/david_sm1.jpg');
}





?>