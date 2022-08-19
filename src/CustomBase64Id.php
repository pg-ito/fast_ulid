<?php
declare(strict_types=1);
namespace PgIto\FastUlid;

class CustomBase64Id{
    public static function gen(): string{
        return base64_encode(static::short_timestamp().static::random());
    }
    public static function gen_full_random(): string{
        return base64_encode(random_bytes(16));   
    }
    public static function short_timestamp():string{
        $milli_timestamp = (int)( microtime(true)* 1000 );
        $bin_timestamp = pack('q', $milli_timestamp);
        return substr($bin_timestamp,-6);
    }
    public static function random():string{
        return random_bytes(10);// 80bit
    }
}
