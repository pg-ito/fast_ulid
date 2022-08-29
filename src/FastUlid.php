<?php
declare(strict_types=1);
namespace PgIto\FastUlid;

class FastUlid{
    public static function gen(): string{
        return strtoupper(static::short_timestamp().static::random());
    }
    public static function gen_full_random(): string{
        return strtoupper(static::psudo_timestamp().static::random());
    
    }
    public static function psudo_timestamp():string{
        return str_pad( static::base10_to_32(mt_rand(0,0xFFFFFFFFFFFF)), 10, '0', STR_PAD_LEFT);
    }    
    public static function short_timestamp(float|null $utime=null):string{
        $utime = $utime??microtime(true);
        $milli_timestamp = (int)($utime*1000);
        $base32 = static::base10_to_32($milli_timestamp);
        $len = mb_strlen($base32, 'ASCII');
        return ($len>10)? substr($base32,-10): str_pad( $base32, 10, '0', STR_PAD_LEFT);
    }
    public static function random():string{
        $upper =  str_pad( static::base10_to_32(random_int(0,0xFFFFFFFFFF)), 8, '0', STR_PAD_LEFT);
        $lower =  str_pad( static::base10_to_32(random_int(0,0xFFFFFFFFFF)), 8, '0', STR_PAD_LEFT);
        return $upper.$lower;
    }
    protected static function base10_to_32(int $num):string{
        return base_convert((string)$num, 10, 32);
    }
}
/*
// usage 
$list = [];
$start_time = hrtime(true);
for($i=0;$i<1000000;$i++){
    $list[] = FastUlid::gen().PHP_EOL;
}
$elapsed_nano = hrtime(true) - $start_time;
$num_of_generated = count($list);
echo 'elapsed '.($elapsed_nano/1000000000).' Sec.'.PHP_EOL;
echo ($elapsed_nano / $num_of_generated).' nSec/generate'.PHP_EOL;
*/

