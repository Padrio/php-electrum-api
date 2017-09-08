<?php

namespace Electrum\Response\Hydrator\Payment;

use Zend\Hydrator\NamingStrategy\MapNamingStrategy;
use Zend\Hydrator\Reflection;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class PaymentRequest extends Reflection
{

    public function __construct()
    {
        parent::__construct();

        $namingStrategy = new MapNamingStrategy([
            'id' => 'id',
            'status' => 'status',
            'memo' => 'memo',
            'address' => 'address',
            'URI' => 'uri',
            'exp' => 'expires',
            'time' => 'time',
        ]);

        $this->setNamingStrategy($namingStrategy);
    }
}