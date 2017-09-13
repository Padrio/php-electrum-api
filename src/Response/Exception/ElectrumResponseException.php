<?php

namespace Electrum\Response\Exception;

use Exception;
use Throwable;

/**
 * @author Pascal Krason <pascal.krason@padr.io>
 */
class ElectrumResponseException extends Exception
{

    /**
     * Extract electrum error from response if given
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (is_array($message)) {

            if(isset($message['error']['message'])) {
                $message = vsprintf(
                    'Electrum API returned error: `%s`',
                    $message['error']['message']
                );
            }

            if(isset($message['error']['code'])) {
                $code = $message['error']['code'];
            }

        }

        parent::__construct($message, $code, $previous);
    }
}