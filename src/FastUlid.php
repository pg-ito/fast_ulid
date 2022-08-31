<?php
declare(strict_types=1);
namespace PgIto\FastUlid;

class FastUlid{
    const BASE32_CHARS = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    const BASE_NUM = 32;
    private static $last_timestamp = 0;
    private static $last_timestamp_base32 = '';
    private static $last_generated_upper = 0;
    private static $last_generated_lower = 0;

    public static function gen(): string{
        $is_sametime = false;
        $time = static::short_timestamp(null,$is_sametime);
        if($is_sametime){
            return $time.static::increment_id();
        }
        return $time.static::random();
    }
    public static function gen_full_random(): string{
        return static::psudo_timestamp().static::random();
    
    }
    public static function psudo_timestamp():string{
        return str_pad( static::base10_to_32(mt_rand(0,0xFFFFFFFFFFFF)), 10, '0', STR_PAD_LEFT);
    }    
    public static function short_timestamp(null|float $utime=null ,bool &$is_sametime=false):string{
        $utime = $utime??microtime(true);
        $milli_timestamp = (int)($utime*1000);
        if(static::$last_timestamp == $milli_timestamp){
            $is_sametime = true;
            return static::$last_timestamp_base32;
        }
        static::$last_timestamp = $milli_timestamp;
        $base32 = static::base10_to_32($milli_timestamp);
        $len = mb_strlen($base32, 'ASCII');
        static::$last_timestamp_base32 = ($len>10)? substr($base32,-10): str_pad( $base32, 10, '0', STR_PAD_LEFT);
        return static::$last_timestamp_base32;
    }
    public static function random():string{
        static::$last_generated_upper = random_int(0,0xFFFFFFFFFF);
        static::$last_generated_lower = random_int(0,0xFFFFFFFFFF);
        return static::encode_random(static::$last_generated_upper, static::$last_generated_lower);
    }
    protected static function encode_random(int $upper_num, int $lower_num):string{
        $upper =  str_pad( static::base10_to_32($upper_num), 8, '0', STR_PAD_LEFT);
        $lower =  str_pad( static::base10_to_32($lower_num), 8, '0', STR_PAD_LEFT);        
        return $upper.$lower;
    }
    public static function increment_id():string{
        if(static::$last_generated_lower+1 <= 0xFFFFFFFFFF){
            static::$last_generated_lower++;
            return static::encode_random(static::$last_generated_upper, static::$last_generated_lower);
        }
        static::$last_generated_lower = 0;
        if(static::$last_generated_upper+1 <= 0xFFFFFFFFFF){
            static::$last_generated_upper++;
            return static::encode_random(static::$last_generated_upper, static::$last_generated_lower);
        }
        static::$last_generated_upper = 0;
        return static::encode_random(static::$last_generated_upper, static::$last_generated_lower);
    }
    protected static function base10_to_32(int $num):string{
        // return base_convert((string)$num, 10, 32);
        $result = [];
        $tmp = $num;
        while($tmp > 0){
            $result[] = static::BASE32_CHARS[$tmp % static::BASE_NUM];
            $tmp = (int)($tmp / static::BASE_NUM);
        }
        $result = array_reverse($result);
        return implode('',$result);
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

