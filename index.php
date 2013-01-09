<?php
require('RecognizeImAPI.php');
$oneResult = RecognizeImAPI::recognize(file_get_contents('test.jpg'));
$allResults = RecognizeImAPI::recognize(file_get_contents('test.jpg'), TRUE);
$imageList = RecognizeImAPI::imageList();
