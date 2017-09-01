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
     * Factory method
     *
     * @param array $data
     *
     * @return Version
     */
    public static function createFromArray(array $data)
    {
        $instance = new self;
        $instance->setVersion($data['version']);
        return $instance;
    }

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