<?php


namespace Electrum\Request\Method\Wallet;


use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;

/**
 * Return all loaded wallets
 * @original_author Pascal Krason <p.krason@padr.io>
 */
class ListWallets extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'list_wallets';

    /**
     * @return object
     * @throws \Electrum\Request\Exception\BadRequestException
     * @throws \Electrum\Response\Exception\ElectrumResponseException
     */
    public function execute()
    {
        return $this->getClient()->execute($this->method);
    }
}