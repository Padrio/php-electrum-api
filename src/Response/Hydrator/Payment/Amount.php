<?php

namespace Electrum\Response\Hydrator\Payment;

use Laminas\Hydrator\NamingStrategy\MapNamingStrategy;
use Laminas\Hydrator\ReflectionHydrator;

/**
 * @author Pascal Krason <p.krason@padr.io>
 */
class Amount extends ReflectionHydrator
{
    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $namingStrategy = new MapNamingStrategy([
            'amount (BTC)' => 'bitcoins',
            'amount (LTC)' => 'litecoins',
            'amount' => 'satoshis',
        ]);

        $this->setNamingStrategy($namingStrategy);
    }

}