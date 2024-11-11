<?php

namespace app\interfaces;

use app\dto\ExchangeRatesDTO;

interface ExchangeRatesApi
{
    public function getLatest(string $base = 'USD'): ExchangeRatesDTO;
}