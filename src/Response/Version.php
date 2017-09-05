<?php

namespace Electrum\Response;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class Version implements ResponseInterface
{

    /**
     * @var string
     */
    protected $version = '';

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Version
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}