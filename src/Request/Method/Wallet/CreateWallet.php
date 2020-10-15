<?php

namespace Electrum\Request\Method\Wallet;

use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;

/**
 * Return newly created wallet
 * @original_author Pascal Krason <p.krason@padr.io>
 */
class CreateWallet extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'create';

    /**
     * @param array $attributes
     * @return object
     * @throws \Electrum\Request\Exception\BadRequestException
     * @throws \Electrum\Response\Exception\ElectrumResponseException
     */
    public function execute(array $attributes = [])
    {
        return $this->getClient()->execute($this->method, $attributes);
    }
}