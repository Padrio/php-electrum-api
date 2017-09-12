<?php

namespace Electrum\Response\Model\Payment;

/**
 * @author Pascal Krason <pascal.krason@check24.de>
 */
class Amount
{
    /**
     * @var float
     */
    private $bitcoins = 0;

    /**
     * @var int
     */
    private $satoshis = 0;

    /**
     * @return float
     */
    public function getBitcoins()
    {
        return $this->bitcoins;
    }

    /**
     * @param float $bitcoins
     *
     * @return Amount
     */
    public function setBitcoins($bitcoins)
    {
        $this->bitcoins = $bitcoins;

        return $this;
    }

    /**
     * @return int
     */
    public function getSatoshis()
    {
        return $this->satoshis;
    }

    /**
     * @param int $satoshis
     *
     * @return Amount
     */
    public function setSatoshis($satoshis)
    {
        $this->satoshis = $satoshis;

        return $this;
    }

}