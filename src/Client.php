<?php

namespace Will1471\AlphaVantage;

/**
 * @ee https://www.alphavantage.co/documentation/
 */
final class Client
{

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://www.alphavantage.co/query'
        ]);
    }

    /**
     * @param string $query
     *
     * @return array<SearchResult>
     */
    public function search(string $query)
    {
        $response = $this->http->get(
            '',
            [
                'query' => [
                    'function' => 'SYMBOL_SEARCH',
                    'keywords' => $query,
                    'apikey' => $this->apiKey,
                    'datatype' => 'json'
                ]
            ]
        );
        $content = $response->getBody()->getContents();
        $obj = json_decode($content);

        $r = [];
        foreach ($obj->bestMatches as $bestMatch) {
            $r[] = new SearchResult(
                $bestMatch->{"1. symbol"},
                $bestMatch->{"2. name"},
                $bestMatch->{"3. type"},
                $bestMatch->{"4. region"},
                $bestMatch->{"5. marketOpen"},
                $bestMatch->{"6. marketClose"},
                $bestMatch->{"7. timezone"},
                $bestMatch->{"8. currency"}
            );
        }
        return $r;
    }

    /**
     * @param string $symbol
     * @param bool $full
     * @return array<Point>
     */
    public function timeSeriesDailyAdjusted(string $symbol, bool $full = true)
    {
        $response = $this->http->get(
            '',
            [
                'query' => [
                    'function' => 'TIME_SERIES_DAILY_ADJUSTED',
                    'symbol' => $symbol,
                    'apikey' => $this->apiKey,
                    'datatype' => 'json',
                    'outputsize' => ($full ? 'full' : 'compact')
                ]
            ]
        );
        $content = $response->getBody()->getContents();
        $obj = json_decode($content);
        $r = [];

        foreach ($obj->{"Time Series (Daily)"} as $datetime => $obj) {
            $r[] = new Point(
                $datetime,
                $obj->{"1. open"},
                $obj->{"2. high"},
                $obj->{"3. low"},
                $obj->{"4. close"},
                $obj->{"5. adjusted close"},
                $obj->{"6. volume"},
                $obj->{"7. dividend amount"},
                $obj->{"8. split coefficient"}
            );
        }
        return $r;
    }
}
