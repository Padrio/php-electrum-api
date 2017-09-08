<?php

namespace Electrum\Response\Wallet;

use Electrum\Response\ResponseInterface;
use Electrum\Response\Traits\Transactions;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class History implements ResponseInterface
{
    use Transactions;
}