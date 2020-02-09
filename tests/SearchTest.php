<?php

namespace Will1471\AlphaVantage;

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testSearchUsingDemoKey()
    {
        $client = new Client('demo');
        $r = $client->search('Micro');
        $this->assertIsArray($r);
        foreach ($r as $i) {
            $this->assertInstanceOf(SearchResult::class, $i);
        }
    }
}
