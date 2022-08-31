<?php
require_once 'src/FastUlid.php';

use PgIto\FastUlid\FastUlid;

echo 'FastUlid::gen()'.PHP_EOL;
echo FastUlid::gen().PHP_EOL;
echo FastUlid::gen().PHP_EOL;
echo FastUlid::gen().PHP_EOL;
echo FastUlid::gen().PHP_EOL;
echo PHP_EOL;
echo 'FastUlid::gen_full_random()'.PHP_EOL;
echo FastUlid::gen_full_random().PHP_EOL;
echo FastUlid::gen_full_random().PHP_EOL;
echo FastUlid::gen_full_random().PHP_EOL;
echo FastUlid::gen_full_random().PHP_EOL;


/*
FastUlid::gen()
01GBTYEKB8FVKCKBD925SZ2HGV
01GBTYEKB8FVKCKBD925SZ2HGW
01GBTYEKB91AWTPSV8CJVVPAVG
01GBTYEKB91AWTPSV8CJVVPAVH

FastUlid::gen_full_random()
61F0C73MEB5JW0SY1213JGWCGG
1EWJ9VZQT4EEA896F0RF39RTM8
4653Y1H03RA20NTAC8KZPK0YXP
6GN7SFC0A3098EAP1DDY78RV89
*/