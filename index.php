<?php
require_once('RecognizeImAPI.php');

$imagePath = 'test.jpg';
$mode = 'single';

if ($mode == 'single') {
	if (RecognizeImAPI::checkImageLimits($imagePath, $mode)) {
		$singleOneResult = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode);
		$singleAllResults = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode, TRUE);
		var_dump($singleOneResult);
		var_dump($singleAllResults);
	} else {
		echo "Image does not fulfill the requirements.\n";
	}
} else if ($mode == 'multi') {
	if (RecognizeImAPI::checkImageLimits($imagePath, $mode)) {
		$multiOneInstance = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode);
		$multiAllInstances = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode, TRUE);
		var_dump($multiOneInstance);
		var_dump($multiAllInstances);
	} else {
		echo "Image does not fulfill the requirements.\n";
	}
} else {
	echo "Wrong recognition mode.\n";
}
//$imageList = RecognizeImAPI::imageList();
