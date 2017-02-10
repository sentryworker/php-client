<?php

namespace SentryWorker;

use SentryWorker\Exception\ClientException;

/**
 * Class Client
 * @package SentryWorker
 */
class Client
{
    /**
     * @var string
     */
    protected $appKey;

    /**
     * @var string
     */
    protected $appSecret;

    /**
     * @var string
     */
    protected $sessionId;

    protected $request;

    public function __construct($config)
    {
        $this->setAppKey($config['app_key']);
        $this->setAppSecret($config['app_secret']);

        if (!empty($config['curl_opts'])) {
            $this->setRequest(new Request($config['curl_opts']));
        } else {
            $this->setRequest(new Request());
        }

        if (!empty($_COOKIE['id_sentry_sess'])) {
            $this->setSessionId($_COOKIE['id_sentry_sess']);
        }
    }

    /**
     * @param string $appKey
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->appKey;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param null $orderId
     * @return int
     * @throws ClientException
     */
    public function sendToReview($orderId = null)
    {
        $params = array(
            'app_key' => $this->getAppKey(),
            'app_secret' => $this->getAppSecret(),
            'id_session' => $this->getSessionId(),
        );

        if ($orderId) {
            $params['id_order'] = $orderId;
        }

        $result = $this->getRequest()->post('https://doriddle.net/api/order/', $params);

        return $result['id_trx'];
    }
}