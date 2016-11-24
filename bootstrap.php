<?php

require_once 'src/SentryWorker/autoload.php';

use SentryWorker\Client;
use SentryWorker\Exception\ClientException;

$client = new Client(array(
    'app_key' => '71F60EA8AD9720EB704C6E7890EE1683',
    'app_secret' => '731BCB68B3BFC594886604E6D7C2E93D',
));

$client->setSessionId('4182107525192d99e922f932da4e2338c45f9b60d2cd6ff91cba15cebfcfdca5');

try {
    var_dump($client->sendToReview('666'));
} catch (ClientException $e) {
    echo $e->getCode();
    echo $e->getMessage();
}