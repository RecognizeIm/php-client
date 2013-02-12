<?php
require_once('RecognizeImAPI.php');
$oneResult = RecognizeImAPI::recognize(file_get_contents('test.jpg'), 'multi');
$allResults = RecognizeImAPI::recognize(file_get_contents('test.jpg'), TRUE);
$imageList = RecognizeImAPI::imageList();
