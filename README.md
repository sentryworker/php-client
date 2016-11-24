### SentryWorker Client Library

```php

require_once 'src/SentryWorker/autoload.php';

use SentryWorker\Client;
use SentryWorker\Exception\ClientException;

$client = new Client(array(
    'app_key' => 'APP_KEY',
    'app_secret' => 'APP_SECRET',
));

try {
    var_dump($client->sendToReview('8347238479237427'));
} catch (ClientException $e) {
    echo $e->getCode();
    echo $e->getMessage();
}

```