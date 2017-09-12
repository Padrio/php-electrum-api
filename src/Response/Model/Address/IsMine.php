<?php

namespace Electrum\Response\Model\Address;

/**
 * @author Pascal Krason <pascal.krason@check24.de>
 */
class IsMine implements ResponseInterface
{

    /**
     * @var bool
     */
    private $isMine = false;

    /**
     * @return bool
     */
    public function isMine()
    {
        return $this->isMine;
    }

    /**
     * @param bool $isMine
     *
     * @return IsMine
     */
    public function setIsMine($isMine)
    {
        $this->isMine = $isMine;

        return $this;
    }

}