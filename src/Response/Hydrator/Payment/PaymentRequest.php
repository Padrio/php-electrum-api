<?php

namespace Electrum\Response\Hydrator\Payment;

use Laminas\Hydrator\NamingStrategy\MapNamingStrategy;
use Laminas\Hydrator\ReflectionHydrator;

/**
 * @author Pascal Krason <p.krason@padr.io>
 */
class PaymentRequest extends ReflectionHydrator
{

    public function __construct()
    {
        parent::__construct();

        $namingStrategy = new MapNamingStrategy([
            'id' => 'id',
            'status' => 'status',
            'status_str' => 'status_str',
            'message' => 'memo',
            'address' => 'address',
            'URI' => 'uri',
            'expiration' => 'expires',
            'timestamp' => 'time',
            'confirmations' => 'confirmations',
        ]);

        $this->setNamingStrategy($namingStrategy);
    }
}
