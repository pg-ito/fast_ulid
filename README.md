# php_ulid
implement of fast ULID for php

## install


### add repository in composer.json

```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/pg-ito/fast_ulid.git"
        }
    ]
```
### type require command

```
composer require pg-ito/fast_ulid:dev-main
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
$ php bench.php 
number of generated ids 1000000
elapsed 1.0562382 Sec.
1056.2382 nSec/generate
```
