Recognize.im API
===============

Recognize.im is providing API for Image Recognition. Those module is sample PHP connector to the API

Installation
============

Just download the content of the lib/ directory and include the classes in your
project or use composer:

    $ composer.phar require "recognizeim/php-client" "dev-master"

Or add the following to your composer.json in the require section:

    "require": {
        ... other requirements ...,
        "recognizeim/php-client": "dev-master"
    }

Usage
=====

To initialize your RecognizeIm call the init static method:

``` php
\RecognizeImAPI::init(array(
    'URL'       => $url,
    'CLIENT_ID' => $client_id,
    'API_KEY'   => $api_key,
    'CLAPI_KEY' => $clapi_key
));
```

You'll find a full example in the example/ directory.

Authorization
=============

You don't need to call method auth by yourself. Module object will authorize you when needed, you just need do provide valid credentials. You can get them from your [account tab](http://recognize.im/user/profile)
