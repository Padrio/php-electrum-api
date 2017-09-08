<?php

namespace Electrum\Request\Method;

use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;
use Electrum\Response\Wallet\Balance as BalanceResponse;

/**
 * Return the balance of your wallet
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class GetBalance extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'getbalance';

    /**
     * @param array $optional
     *
     * @return BalanceResponse
     * @throws \Electrum\Request\Exception\BadRequestException
     * @throws \Electrum\Response\Exception\ElectrumResponseException
     */
    public function execute(array $optional = [])
    {
        $data = $this->getClient()->execute($this->method, $optional);
        return $this->hydrate(new BalanceResponse(), $data);
    }
}