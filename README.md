# php-electrum-api - Electrum libarary with no dependencies 
```
Licence: GPL-3.0
Author: Pascal Krason <p.krason@padr.io>
Language: PHP 5.6
```
Please note, this library is by far not completed and production ready, there are still a lot methods which aren't neither tested or even implemented.

# Setting up Electrum
First you need to setup a new Electrum wallet. Follow the instructions according to your OS at the [Electrum Download Page](https://electrum.org/#download). After the successfull installation you need to set a rpcport by typing:
```
electrum setconfig rpcport 7777
``` 
Then we can create a default wallet, dont forget to note your generated seed, it's nescessary if you want to recover it one day:
```
electrum create
```
Now we can go ahead and start Electrum in daemon mode:
```
electrum daemon start
```

# Requirements
On the PHP side there are not much requirements, you only need atleast PHP 5.6 and the curl-Extension installed. Optional you need [Composer](http://getcomposer.org) to install this library. 

# Install
First you need to install [Composer](https://getcomposer.org/doc/00-intro.md), after you accomplished this you can go ahead:
```
composer require padrio/php-electrum-api
```
Then you can simply include the autoloader and begin using the library:
```php
// Include composer autoloader
require_once 'vendor/autoloader.php';

// Create new instance
$electrum = new \Electrum\Client('http://127.0.0.1/', 7777);
$electrum->getVersion();
```
