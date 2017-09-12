<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;
use Electrum\Response\Model\Payment\PaymentRequest;
use InvalidArgumentException;

/**
 * Remove a payment request.
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class RemoveRequest extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'rmrequest';

    /**
     * @var string
     */
    private $address = null;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param PaymentRequest $request
     */
    public function setPaymentRequest(PaymentRequest $request)
    {
        if(empty($request->getAddress())) {
            throw new InvalidArgumentException(sprintf(
                '$request does not contain valid address, %s given',
                $request->getAddress()
            ));
        }

        $this->address = $request->getAddress();
    }

    /**
     * @param array $optional
     *
     * @return boolean
     * @throws \Electrum\Request\Exception\BadRequestException
     * @throws \Electrum\Response\Exception\ElectrumResponseException
     */
    public function execute(array $optional = [])
    {
        return $this->getClient()->execute($this->method,
            array_merge(
                [
                    'address' => $this->getAddress()
                ],
                $optional
            )
        );
    }
}