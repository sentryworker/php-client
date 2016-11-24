<?php

require_once 'src/SentryWorker/autoload.php';

use SentryWorker\Client;
use SentryWorker\Exception\ClientException;

$client = new Client(array(
    'app_key' => '153A04124AE6A6BDEE2358A39987E040',
    'app_secret' => 'BD2B007B5F32B6E70D367FC1C28000BF',
));

$client->setSessionId('75a525a3202db7b57d3255e549cb24300d3de0abc7d9d22eab46e643184ed28e');

try {
    var_dump($client->sendToReview('999'));
} catch (ClientException $e) {
    echo $e->getCode();
    echo $e->getMessage();
}