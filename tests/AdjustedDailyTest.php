<?php

namespace Will1471\AlphaVantage;

use PHPUnit\Framework\TestCase;

class AdjustedDailyTest extends TestCase
{

    public function testWithDemoKey()
    {
        $client = new Client('demo');
        $r = $client->timeSeriesDailyAdjusted('MSFT', false);
        $this->assertIsArray($r);
        foreach ($r as $i) {
            $this->assertInstanceOf(Point::class, $i);
        }
    }

}