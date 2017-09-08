<?php

namespace Electrum\Response\Address;

use Electrum\Response\ResponseInterface;
use Electrum\Response\Traits\Balance;
use Electrum\Response\Traits\Transactions;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class History implements ResponseInterface
{
    use Balance;
    use Transactions;
}