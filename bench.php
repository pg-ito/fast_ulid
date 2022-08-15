<?php
require_once 'src/FastUlid.php';
use PgIto\FastUlid\FastUlid;
// usage 
$list = [];
$start_time = hrtime(true);
for($i=0;$i<1000000;$i++){
    $list[] = FastUlid::gen().PHP_EOL;
}
$elapsed_nano = hrtime(true) - $start_time;
$num_of_generated = count($list);
echo 'number of generated ids '.$num_of_generated.PHP_EOL;
echo 'elapsed '.($elapsed_nano/1000000000).' Sec.'.PHP_EOL;
echo ($elapsed_nano / $num_of_generated).' nSec/generate'.PHP_EOL;

