<?php

namespace Electrum\Response;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{

    /**
     * Factory method.
     * Create Response-Instance filled with data
     *
     * @param array $data
     *
     * @return ResponseInterface
     */
    public static function createFromArray(array $data);
}