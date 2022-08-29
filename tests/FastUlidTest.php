<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once 'src/FastUlid.php';
use PgIto\FastUlid\FastUlid;

class FastUlidTest extends TestCase{
    public function testGen(){
        $ulid1 = FastUlid::gen();
        $ulid2 = FastUlid::gen();
        $this->assertNotSame($ulid1, $ulid2);       
    }
    public function testGenBase32(){
        $ulid1 = FastUlid::gen();
        // 0123456789ABCDEFGHIJKLMNOPQRSTUV
        $matches = null;
        preg_match('/[0-9A-V]{26}/', $ulid1, $matches);
        $this->assertSame($matches[0], $ulid1);
    }
    public function testGenFullRandom(){
        $ulid1 = FastUlid::gen_full_random();
        $ulid2 = FastUlid::gen_full_random();
        $this->assertNotSame($ulid1, $ulid2);       
    }
    public function testGenFullRandomBase32(){
        $ulid1 = FastUlid::gen_full_random();
        // 0123456789ABCDEFGHIJKLMNOPQRSTUV
        $matches = null;
        preg_match('/[0-9A-V]{26}/', $ulid1, $matches);
        $this->assertSame($matches[0], $ulid1);
    }
    public function testShortTimestamp(){
        $short_timestamp1 = FastUlid::short_timestamp();
        usleep(1500);
        $short_timestamp2 = FastUlid::short_timestamp();

        $this->assertNotSame($short_timestamp1, $short_timestamp2);  
    }
    public function testShortTimestampFuture(){
        $future_timestamp = (float)281456521200;// 10889-01-01 00:00:00
        $short_timestamp1 = FastUlid::short_timestamp($future_timestamp);// 7vvepvegc0
        $short_timestamp2 = FastUlid::short_timestamp($future_timestamp);
        $this->assertSame($short_timestamp1, $short_timestamp2);  
    }
    public function testShortTimestampFutureLength(){
        $future_timestamp = (float)281456521200;// 10889-01-01 00:00:00
        $short_timestamp1 = FastUlid::short_timestamp($future_timestamp);
        preg_match('/[0-9a-v]{10}/', $short_timestamp1, $matches);
        $this->assertSame($matches[0], $short_timestamp1);
    }
    public function testShortTimestampLength(){
        $fixed_timestamp = (float)1660869868;// 2022-08-19 09:44:28
        $short_timestamp1 = FastUlid::short_timestamp($fixed_timestamp);// "01gapotuf0"
        preg_match('/[0-9a-v]{10}/', $short_timestamp1, $matches);
        $this->assertSame($matches[0], $short_timestamp1);
    }    
}
