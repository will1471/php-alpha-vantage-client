<?php

namespace Will1471\AlphaVantage;

final class SearchResult
{

    private $symbol;
    private $name;
    private $type;
    private $region;
    private $marketOpen;
    private $marketClose;
    private $timezone;
    private $currency;

    /**
     * @param string $symbol
     * @param string $name
     * @param string $type
     * @param string $region
     * @param string $marketOpen
     * @param string $marketClose
     * @param string $timezone
     * @param string $currency
     */
    public function __construct(
        string $symbol,
        string $name,
        string $type,
        string $region,
        string $marketOpen,
        string $marketClose,
        string $timezone,
        string $currency
    ) {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->type = $type;
        $this->region = $region;
        $this->marketOpen = $marketOpen;
        $this->marketClose = $marketClose;
        $this->timezone = $timezone;
        $this->currency = $currency;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }
}
