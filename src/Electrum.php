<?php

/**
 * Created using PHPStorm
 * User: Pascal Krason <p.krason@padr.io>
 * Date: 18.01.2017
 */
class Electrum
{

    /**
     * @var string JSONRPC Host
     */
    protected $host;

    /**
     * @var integer JSONRPC Port
     */
    protected $port;

    /**
     * @var integer Last Message-ID
     */
    protected $id;

    /**
     * Last occured curl error
     *
     * @var null
     */
    protected $lastError = null;

    public function __construct($host = 'http://127.0.0.1', $port = 7777, $id = 0)
    {
        $this->setHost($host);
        $this->setPort($port);
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return Electrum
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     *
     * @return Electrum
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns current ID + 1
     *
     * @return int
     */
    public function getNextId()
    {
        return ++$this->id;
    }

    /**
     * @param int $id
     *
     * @return Electrum
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null
     */
    public function getLastError()
    {
        return $this->lastError;
    }

    /**
     * @param null $lastError
     *
     * @return Electrum
     */
    private function setLastError($lastError)
    {
        $this->lastError = $lastError;

        return $this;
    }

    /**
     * @param       $method
     * @param array $params
     *
     * @return bool|mixed
     */
    public function PlainRequest($method, array $params = [])
    {
        // ### Build request string
        $request = json_encode([
            'method' => $method,
            'params' => $params,
            'id'     => $this->getNextId(),
        ]);

        // ### Replace braces
        $request = str_replace(['[{', '}]'], ['{', '}'], $request);

        // ### Create CURL instance
        $curl = curl_init(vsprintf(
            '%s:%s', [$this->getHost(), $this->getPort()]
        ));

        // ### Set some options we need
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $request,
        ]);

        // ### Execute request & convert data to array
        $response = curl_exec($curl);

        // ### Catch error if occured
        $error = curl_error($curl);

        // ### Check if request was successfull
        if ($error) {

            // ### Set last error, so user can catch it
            $this->setLastError($error);

            // ### Return a false, so the user knows something went wrong
            return false;

        } else {

            // ### Return Data converted to an array
            return json_decode($response, true);
        }
    }

    /**
     * Get current balance
     *
     * @return bool|array
     */
    public function GetBalance()
    {
        return $this->PlainRequest('getbalance');
    }

    /**
     * Wallet history. Returns the transaction history of your wallet.
     *
     * @return bool|array
     */
    public function GetHistory()
    {
        return $this->PlainRequest('history');
    }

    /**
     * Create a payment request.
     *
     * @param      $amount          integer     Bitcoin amount to request
     * @param null $memo            string      Description of the request
     * @param null $expiration      integer     Time in seconds
     *
     * @return bool|array
     */
    public function AddRequest($amount, $memo = null, $expiration = null /*, $force = false */)
    {
        $params = ['amount' => $amount];

        if($memo !== null) {
            $params['memo'] = $memo;
        }

        if($expiration !== null) {
            $params['expiration'] = $expiration;
        }

        return $this->PlainRequest('addrequest', $params);
    }

    /**
     * List the payment requests you made.
     *
     * @return bool|array
     */
    public function getRequests()
    {
        return $this->PlainRequest('listrequests');
    }

    /**
     * Return a payment request
     * @param $key          string  Variable name
     *
     * @return bool|array
     */
    public function GetRequest($key)
    {
        return $this->PlainRequest('getrequest', ['key' => $key]);
    }
}