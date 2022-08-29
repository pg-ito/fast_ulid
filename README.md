# fast_ulid
implement of fast ULID for php

## install

### type require command

```
$ composer require pg-ito/fast_ulid:dev-main
```



## usage

```
$loader = require_once __DIR__.'/vendor/autoload.php';
use \PgIto\FastUlid\FastUlid;

echo FastUlid::gen().PHP_EOL;
// 01GAGJ3TPGR82PLAS7K37HNIDV
```

## benchmark

```
$ php -v
PHP 8.1.2 (cli) (built: Jul 21 2022 12:10:37) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2, Copyright (c), by Zend Technologies
    
$ php bench.php 
number of generated ids 1000000
elapsed 3.9800428 Sec.
3980.0428 nSec/generate
```

## test

```
$ ./vendor/bin/phpunit ./tests/
```