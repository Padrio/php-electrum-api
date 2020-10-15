<?php


namespace Electrum\Request\Method\Address;


use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;

/**
 * Generating new address if you need more
 * @original_author Pascal Krason <p.krason@padr.io>
 */
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