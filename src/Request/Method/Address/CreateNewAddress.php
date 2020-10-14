<?php


namespace Electrum\Request\Method\Address;


use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;

class CreateNewAddress extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'createnewaddress';

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