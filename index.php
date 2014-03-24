<?php
require_once('RecognizeImAPI.php');

//RecognizeImAPI::imageDelete(); die;

$imagePath = 'test.jpg';
$mode = 'single';

if (RecognizeImAPI::checkImageLimits($imagePath, $mode)) {
	$singleOneResult = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode);
	$singleAllResults = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode, TRUE);
	echo $singleOneResult, "\n", $singleAllResults, "\n";
} else {
	echo "Image does not fulfill the requirements.\n";
}
//$imageList = RecognizeImAPI::imageList();
