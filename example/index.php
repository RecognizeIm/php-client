<?php

//	Usage:
//	php index.php
//

//Required.
require_once('../lib/RecognizeImAPI.php');
require_once('../lib/RecognizeImAPIResult.php');
require_once('../lib/RecognizeImAPIResultObject.php');

//Setup your credentials in config.php.
//You can get them from your [account tab](http://recognize.im/user/profile).
$soap_enabled = TRUE;	//Init with SOAP enabled (not necessary for recognition).
RecognizeImAPI::init(require_once('config.php'), $soap_enabled);

//Settings.
$imagePath = 'test.jpg';
$mode = 'single';

//You can check the image properties before sending it to the API.
//Please note that API checks the pictures anyway and throws relevant exceptions if necessary.
//Visit www.recognize.im/site/documentation for more details.
if (!RecognizeImAPI::checkImageLimits($imagePath, $mode)) {
	echo "Image does not fulfill the requirements.\n";
}

//Recognition call (REST API).
$allResults = TRUE;	//Disable results filtering (enable all).
$result = RecognizeImAPI::recognize(file_get_contents($imagePath), $mode, $allResults);
echo $result, "\n";

//Draw bounding boxes.
if ($result->isOK()) {
	$im = $result->drawFrames(file_get_contents($imagePath));
	file_put_contents('bb.jpg', $im);
	echo "Bounding boxes drawn, check 'bb.jpg' image.\n";
}

//The easiest way to view the results structure:
//var_dump($result);



//Sample SOAP API metod calls:

//Adding image:
////$id and $name - strings, must be provided
//$imgdata = fread(fopen($image, "r"), filesize($image));
//$data = base64_encode($imgdata);
//$result = RecognizeImAPI::imageInsert($id, $name, $data);

//Applying changes:
//RecognizeImAPI::indexBuild();

//Listing images:
//$imageList = RecognizeImAPI::imageList();

