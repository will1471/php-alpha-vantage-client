<?php

namespace Will1471\AlphaVantage;

final class Point
{
    private $datetime;
    private $open;
    private $high;
    private $low;
    private $close;
    private $adjustedClose;
    private $volume;
    private $dividendAmount;
    private $splitCoefficient;

    public function __construct(
        string $datetime,
        string $open,
        string $high,
        string $low,
        string $close,
        string $adjustedClose,
        string $volume,
        string $dividendAmount,
        string $splitCoefficient
    ) {
        $this->datetime = $datetime;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->adjustedClose = $adjustedClose;
        $this->volume = $volume;
        $this->dividendAmount = $dividendAmount;
        $this->splitCoefficient = $splitCoefficient;
    }

    public function datetime(): string
    {
        return $this->datetime;
    }

    public function open(): string
    {
        return $this->open;
    }

    public function high(): string
    {
        return $this->high;
    }

    public function low(): string
    {
        return $this->low;
    }

    public function close(): string
    {
        return $this->close;
    }

    public function adjustedClose(): string
    {
        return $this->adjustedClose;
    }

    public function volume(): string
    {
        return $this->volume;
    }

    public function dividendAmount(): string
    {
        return $this->dividendAmount;
    }

    public function splitCoefficient(): string
    {
        return $this->splitCoefficient;
    }
}
