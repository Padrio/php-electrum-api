![Packagist](https://img.shields.io/packagist/dt/padrio/php-electrum-api.svg?color=%234c1)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/padrio/php-electrum-api.svg?color=%234c1)

# php-electrum-api - Electrum library
```
Licence: GPL-3.0
Author: Pascal Krason <p.krason@padr.io>
Language: PHP 5.6-7.1
```
Please note, this library is by far not completed and but can be used in production. Until now i only implemented the most commonly used API-Calls. If you think im missing something, just create an issue or fork the project.

# Setting up Electrum
First you need to setup a new Electrum wallet. Follow the instructions according to your OS at the [Electrum Download Page](https://electrum.org/#download). After the successfull installation you need to set a rpcport by typing:
```
electrum setconfig rpcport 7777
electrum setconfig rpcuser "username"
electrum setconfig rpcpassword "password"
```
Then we can create a default wallet, dont forget to note your generated seed, it's nescessary if you want to recover it one day:
```
electrum create
```
Now we can go ahead and start Electrum in daemon mode:
```
electrum daemon start
```
Since some new version electrum wants you to load your wallet by hand on startup:
```
electrum daemon load_wallet
```

# Requirements
On the PHP side there are not much requirements, you only need at least PHP 5.6 and the curl-Extension installed. Then you can go ahead ans it through [Composer](http://getcomposer.org) which will do everything else for you.

# Install
First you need to install [Composer](https://getcomposer.org/doc/00-intro.md), after you accomplished this you can go ahead:
```
composer require padrio/php-electrum-api
```
Then you can simply include the autoloader and begin using the library:
```php
// Include composer autoloader
require_once 'vendor/autoloader.php';
```

# Examples

## Basic example
A very basic useage example. Every API-Call has it's own request-object. You simply create one and execute it.
```php

$method = new \Electrum\Request\Method\Version();

try {
    $response = $method->execute();
} catch(\Exception $exception) {
    die($exception->getMessage());
}

$response->getVersion();
```

## Create new wallet

Create default wallet:
```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $wallet = new \Electrum\Request\Method\Wallet\CreateWallet($client);
    $response = $wallet->execute();
```

This code is similar to the command:
```bash
$ electrum create
```

You can also create more wallets with custom names specifying flag of the new wallet. 
```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $wallet = new \Electrum\Request\Method\Wallet\CreateWallet($client);
    $response = $wallet->execute(['wallet_path' => '~/.electrum/wallets/your_wallet']);
```

This code is similar to the command:
```bash
$ electrum create -w ~/.electrum/wallets/your_wallet
```

Response will be:
```php
[
    'seed' => 'wallet seed',
    'path' => 'path where wallet file is stored',
    'msg'  => 'Please keep your seed in a safe place; if you lose it, you will not be able to restore your wallet.',
];
```

## Load wallet

```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $load_wallet = new \Electrum\Request\Method\Wallet\LoadWallet($client);
    $load_wallet->execute(['wallet_path' => '~/.electrum/wallets/your_wallet']);
````

## List wallets

Get list of all loaded wallets:
```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $list_wallets = new \Electrum\Request\Method\Wallet\ListWallets($client);
    $list_wallets->execute();
```

## Get new address
```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $wallet = new \Electrum\Request\Method\Payment\AddRequest($client);
    $tx     = $wallet->execute();
    echo $tx->getAddress();
```

## Create new address for wallet

```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $newAddress = new \Electrum\Request\Method\Address\CreateNewAddress($client);
    $newAddress->execute(['wallet'  => '~/.electrum/wallets/your_wallet']);
```


## Make a new Payment
```php
    $client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'user', 'password');
    $method = new \Electrum\Request\Method\Payment\PayTo($client);
    $method->setDestination('BTC4ddress1234'); //Destination parameter is the address where we'll send the btc
    $method->setAmount(1); //send 1 BTC = 10k usd
    
    $tx = $method->execute(); //$tx returns the transaction ID of the payment, this is still not sent to the blockchain
    /**
    * @param array ['password' => '<password>']
    * If the Electrum wallet is encrypted with a password use the following execute method instead
    * The previous one will return an error of "Password required"
    */
    //$tx = $method->execute(['password' => 'myPass123']); //
    
    $broadcast = new Electrum\Request\Method\Payment\Broadcast($client);
    $broadcast->setTransaction($tx);
    $result = $broadcast->execute(); //broadcasts payment to the blockchain
    echo $result;
    
    A payment has been made
    
```

## Custom Client Configuration
Every Request/Method takes a `Electrum\Client`-instance as parameter which replaces the default one. A custom instance can be usefull if you want to set custom config params like another Hostname or Port.
```php
$client = new \Electrum\Client('http://127.0.0.1', 7777, 0, 'username', 'password');
$method = new \Electrum\Request\Method\Version($client);

try {
    $response = $method->execute();
} catch (\Exception $exception) {
    die($exception->getMessage());
}

$response->getVersion();
```

## Advanced exception handling
Dealing with exceptions is easy. You can catch two types of exceptions which indicates whether it's an Request or Response fault.
```php
$method = new \Electrum\Request\Method\Version();

try {
    $response = $method->execute();
} catch (\Electrum\Request\Exception\BadRequestException $exception) {
    die(sprintf(
        'Failed to send request: %s',
        $exception->getMessage()
    ));
} catch(\Electrum\Response\Exception\BadResponseException $exception) {
    die(sprintf(
        'Electrum-Client failed to respond correctly: %s',
        $exception->getMessage()
    ));
}
```
