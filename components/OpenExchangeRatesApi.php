<?php

namespace app\components;

use app\dto\ExchangeRatesDTO;
use app\interfaces\ExchangeRatesApi;
use yii\base\Component;
use yii\httpclient\Client;

class OpenExchangeRatesApi extends Component implements ExchangeRatesApi
{
    protected string $appId;
    protected string $url;

    public function __construct(
        protected Client $client,
        array $config = []
    )
    {
        parent::__construct($config);
    }

    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @throws \Exception
     */
    public function getLatest(string $base = 'USD'): ExchangeRatesDTO
    {
        $url = $this->url . 'latest.json';
        $response = $this->client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->setData(['app_id' => $this->appId, 'base' => $base])
            ->send();

        if (!$response->getIsOk()) {
            throw new \Exception('Failed to fetch exchange rates');
        }

        $data = $response->data;
        return new ExchangeRatesDTO($data['base'], $data['timestamp'], $data['rates']);
    }
}