<?php
require('RecognizeImAPI.php');
$res = RecognizeImAPI::recognize(file_get_contents('test.jpg'));
$imageList = RecognizeImAPI::imageList();
