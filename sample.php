<?php
require_once 'src/FastUlid.php';

use PgIto\FastUlid\FastUlid;

echo 'FastUlid::gen()'.PHP_EOL;
echo FastUlid::gen().PHP_EOL;
echo 'FastUlid::gen_full_random()'.PHP_EOL;
echo FastUlid::gen_full_random().PHP_EOL;


/*
FastUlid::gen()
01GAPNQIU5CDT3HK3J3D5LRR0E
FastUlid::gen_full_random()
7BEP8CU2SGKF44O9JU3SVGPTDM
*/