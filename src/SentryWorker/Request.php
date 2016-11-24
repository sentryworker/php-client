<?php

namespace SentryWorker;

use SentryWorker\Exception\ClientException;

/**
 * Class Request
 * @package SentryWorker
 */
class Request
{
    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'sentry_client_php'
    );

    /**
     * @param string $url
     * @param array $params
     * @return array
     * @throws ClientException
     */
    public function post($url, $params = array())
    {
        $ch = curl_init();

        $opts = self::$CURL_OPTS;
        $opts[CURLOPT_URL] = $url;
        $opts[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');

        curl_setopt_array($ch, $opts);

        $result = curl_exec($ch);

        if ($result === false) {
            $errno = curl_errno($ch);
            $e = new ClientException('Curl error code: ' .  $errno, ClientException::CONNECTION_ERROR);
            curl_close($ch);
            throw $e;
        }

        curl_close($ch);

        $decodedResult = json_decode($result, true);

        if (!$decodedResult) {
            throw new ClientException("Can't decode response", ClientException::RESPONSE_ERROR);
        }

        if (!isset($decodedResult['status'])) {
            throw new ClientException("'status' field is missing", ClientException::RESPONSE_ERROR);
        }

        if ($decodedResult['status'] != 'success') {
            throw new ClientException($decodedResult['message'], ClientException::SENTRY_ERROR);
        }

        return $decodedResult;
    }

}