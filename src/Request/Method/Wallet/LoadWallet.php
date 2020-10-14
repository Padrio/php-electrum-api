<?php


namespace Electrum\Request\Method\Wallet;


use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;

class LoadWallet extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'load_wallet';

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