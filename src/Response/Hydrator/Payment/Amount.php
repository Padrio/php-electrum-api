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
        //parent::__construct();

        $namingStrategy = MapNamingStrategy::createFromHydrationMap([
            'amount_BTC' => 'bitcoins',
            'amount_LTC' => 'litecoins',
            'amount_sat' => 'satoshis',
        ]);

        $this->setNamingStrategy($namingStrategy);
    }

}
