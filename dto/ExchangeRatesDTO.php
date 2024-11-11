<?php

namespace app\dto;

readonly class ExchangeRatesDTO implements \JsonSerializable
{
    public function __construct(
        private string $base,
        private int $timestamp,
        private array $rates
    )
    {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'base' => $this->base,
            'timestamp' => $this->timestamp,
            'rates' => $this->rates
        ];
    }
}