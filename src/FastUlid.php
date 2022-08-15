<?php
class FastUlid{
    private static string $base32_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUV';
    public static function gen(): string{
        return strtoupper(static::short_timestamp().static::random());
    }
    public static function short_timestamp():string{
        $milli_timestamp = (int)( microtime(true)* 1000 );
        $base32 = static::base10_to_32($milli_timestamp);
        $len = mb_strlen($base32, 'ASCII');
        return ($len>10)? strstr($base32,-1, 10): str_pad( $base32, 10, '0', STR_PAD_LEFT);
    }
    public static function random():string{
        $upper =  str_pad( static::base10_to_32(mt_rand(0,0xFFFFFFFFFF)), 8, '0', STR_PAD_LEFT);
        $lower =  str_pad( static::base10_to_32(mt_rand(0,0xFFFFFFFFFF)), 8, '0', STR_PAD_LEFT);
        return $upper.$lower;
    }

    protected static function base10_to_32(int $num):string{
        return base_convert($num, 10, 32);
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
$num_of_generated = count($list).PHP_EOL;
echo 'elapsed '.($elapsed_nano/1000000000).' Sec.'.PHP_EOL;
echo ($elapsed_nano / $num_of_generated).' nSec/generate'.PHP_EOL;
*/

