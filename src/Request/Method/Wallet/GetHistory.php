<?php

namespace Electrum\Request\Method;

use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;
use Electrum\Response\Model\Wallet\History as HistoryResponse;

/**
 * Wallet history. Returns the transaction history of your wallet.
 * @author Pascal Krason <p.krason@padr.io>
 */
class GetHistory extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'history';

    /**
     * @param array $optional
     *
     * @return HistoryResponse
     * @throws \Electrum\Request\Exception\BadRequestException
     * @throws \Electrum\Response\Exception\ElectrumResponseException
     */
    public function execute(array $optional = [])
    {
        $data = $this->getClient()->execute($this->method, $optional);
        return $this->hydrate(new HistoryResponse(), $data);
    }
}