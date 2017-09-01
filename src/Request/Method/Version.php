<?php

namespace Electrum\Request\Method;

use Electrum\Request\AbstractMethod;
use Electrum\Request\MethodInterface;
use Electrum\Response\Version as VersionResponse;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class Version extends AbstractMethod implements MethodInterface
{

    /**
     * @var string
     */
    private $method = 'version';

    /**
     * @return VersionResponse
     */
    public function execute()
    {
        $data = $this->getClient()->execute($this->method, []);
        return VersionResponse::createFromArray($data);
    }
}