### SentryWorker Client Library

#### Installation 

You can install client library by composer.

```
composer require sentryworker/client
```

Or if you have to autoload it manually you can use old style autoloader, just require
one src/SentryWorker/autoload.php

```
require_once 'src/SentryWorker/autoload.php';
```

#### Working example

When order form is completed you need to close order in sentryworker service. There is a simple 
example that do work.

```php

require_once 'vendor/autoload.php';

use SentryWorker\Client;
use SentryWorker\Exception\ClientException;

$client = new Client(array(
    'app_key' => 'APP_KEY',
    'app_secret' => 'APP_SECRET',
));

try {
    $trxId = $client->sendToReview('8347238479237427');
    echo $trxId;
} catch (ClientException $e) {
    echo $e->getCode();
    echo $e->getMessage();
}

```

Don't forget to include tracker js file on your order form to complete integration.