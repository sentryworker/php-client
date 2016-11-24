<?php

namespace SentryWorker\Exception;

class ClientException extends \Exception
{
    const CONNECTION_ERROR = 100;
    const RESPONSE_ERROR = 101;
    const SENTRY_ERROR = 102;
}