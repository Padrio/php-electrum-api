<?php

namespace Electrum\Request;

use Electrum\Client;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
abstract class AbstractMethod
{

    /**
     * @var string
     */
    private $method = '';

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var Client
     */
    private $client = null;

    /**
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        if($client instanceof Client) {
            $this->setClient($client);
        } else {
            $this->setClient(new Client());
        }
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return AbstractMethod
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

}